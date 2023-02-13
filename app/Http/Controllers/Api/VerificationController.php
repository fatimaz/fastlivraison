<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\GeneralTrait;
use Validator;
use DB;

class VerificationController extends Controller
{
    use GeneralTrait;
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api')->only('setVerify');
        // $this->middleware('auth:api')->only('resend');
        // $this->middleware('signed')->only('verify');
        // $this->middleware('throttle:6,1')->only('verify', 'resend');
    }



    public function verifyEmail(Request $request)
    {
          try {
             DB::beginTransaction();
            $email = $request->input('email');
            $validator = Validator::make($request->all(), [
                 "email" => "email|required"
               ]);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $checkEmail = DB::table('users')->where('email', $email)->get();
            $randomNumber = rand(1, 500);
            $token_sl = bcrypt($randomNumber);
            $token = stripslashes($token_sl);
            if (!$checkEmail )
               return redirect()->route('admin.trips')->with(['error' => 'This trip doesnt exist']);

            $name = User::select("name")->where("email", $email)->first();
            $user_id = User::select("id")->where('email', $email)->first();
                 $randomNumber = rand(1, 500);
                $token_sl = bcrypt($randomNumber);
                $token = stripslashes($token_sl);

            $baseUrl = route('verify', [$token, $user_id]);
            $to = $email;
            $subject = "Réinitialisation du mot de passe";
            $message = "<a href='$baseUrl'>'sss'</a>";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <hello@yawyapp.com>' . "\r\n";
            //mail($to, $subject, $message, $headers);
            $data = [
                'token' => $token,
                'baseUrl' => $baseUrl,
                'name' => $name,
            ];
            Mail::send('front.pages.emails.verifyEmail', $data, function ($message) use ($email, $subject) {
                $message->from('hello@yawyapp.com', 'Yawy');
                $message->to($email);
                $message->subject($subject);
            });

                DB::commit();          
                return $this->returnSuccessMessage('Email envoyé successfully');

         } catch (\Exception $ex) {
         return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }



    public function setVerify($token, $user_id ){
        User::whereId($user_id) -> update(['email_verified_at' => now()]);
        return view('front.pages.emails.confirmationEmail');
 }



}
