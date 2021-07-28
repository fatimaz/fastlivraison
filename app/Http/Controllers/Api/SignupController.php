<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Hash;
use DB;
class SignupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = new User();
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255|string',
            'lastname' => 'required|max:255|string',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                    'success' => false,
                    'message' => 'Veuillez remplir tous les champs requis',
                    'error' => $validator->errors()]
                   //'errors' => $validator->getMessageBag()->toArray()]
                , 422);
        }else {
            $checkemail = $profile->where('email', $request->input('email'))->count();
            if ($checkemail == 0) {
                $profile->firstname = $request->input('firstname');
                $profile->lastname = $request->input('lastname');
                $profile->password = bcrypt($request->input('password'));
                $profile->email = $request->input('email');
                $profile->save();
                //hadi jdida dial verify
//                $profile->sendVerificationEmail();
                return response()->json([
                    'success' => true,
                    'message' => 'Compte utilisateur enregistré',
                    'signup' => $profile
                ]);
            } else {
                return response()->json([
                    'message' => 'Adresse e-mail déjà prise',
                ]);
            }
        }
    }
    public function forgetPass(Request $request)
    {
        $email = $request->input('email');;

        //check any user have this email address
        $validator = Validator::make($request->all(), [
            'email' => 'email|required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                    'success' => false,
                    'message' => 'Champ requis',
                    'errors' => $validator->getMessageBag()->toArray()]
                , 422);
        }else {

            $checkEmail = DB::table('users')->where('email', $email)->get();
            $emailcount = DB::table('password_resets')->select("email")->where('email', $email)->count();
            $emailtoken = DB::table('password_resets')->select("token")->where('email', $email)->first();
            if ($emailcount > 0) {
                $token = $emailtoken->token;
            } else {
                $randomNumber = rand(1, 500);
                $token_sl = bcrypt($randomNumber);
                $token = stripslashes($token_sl);
                $insert_token = DB::table('password_resets')->insert(['email' => $email, 'token' => $token,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString()]);
            }
            $name = User::select("firstname")->where("email", $email)->first();

            //echo "send reset link to this email address";
            $baseUrl = route('activate', $token);
            $to = $email;
            $subject = "Réinitialisation du mot de passe";
            $message = "<a href='$baseUrl'>$token</a>";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <admin@seizop.com>' . "\r\n";
            //mail($to, $subject, $message, $headers);
            $data = [
                'token' => $token,
                'baseUrl' => $baseUrl,
                'name' => $name,
            ];
            Mail::send('web.emails.forgetpassword', $data, function ($message) use ($email, $subject) {
                $message->from('admin@seizop.com', 'seizop');
                $message->to($email);
                $message->subject($subject);
            });

            return response()->json([
                'success' => true,
                'message' => 'Email envoyé',
              //'email' => $email
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { }
}