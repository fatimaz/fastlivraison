<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Validator;
use App\Models\User;
use DB;
use Hash;
class ProfileController extends Controller
{

    use GeneralTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_id = auth('api')->user()->id;
         $user_id =169;
        $profile = User::where('id', $user_id)->firstOrFail();
       return $this-> returnData('profile',$profile , 'Compte utilisateur');  
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
    }
//     $user = User::where('id', auth('api')->user()->id)->firstOrFail();
//     return new PostResource($post);


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         try {
        DB::beginTransaction();
        // $user_id = auth('api')->user()->id;
          $user_id =169;
        $profile = User::find($user_id);
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255|string',
            'mobile' => 'required',
            'email' => 'required|email|max:255',
        ]);
        if ($validator->fails()) {
               $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
        }
         // else {
            if ($request->email != $profile->email) {
                $checkemail = $profile->where('email', $request->input('email'))->count();
                if ($checkemail != 0) {
                     return $this->returnError('E007', 'Adresse e-mail déjà prise');
                }
            }
            $profile->fill($request->all())->save();


           DB::commit();

             return $this-> returnData('signup',$profile , 'Compte utilisateur enregistré');  
      } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
      }
    }


    public function update(Request $request)
    {
     try {
        DB::beginTransaction();
        // $user_id = auth('api')->user()->id;
          $user_id =169;
        $profile = User::find($user_id);
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255|string',
            'mobile' => 'required',
            'email' => 'required|email|max:255',
        ]);
        if ($validator->fails()) {
               $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
        }
         // else {
            if ($request->email != $profile->email) {
                $checkemail = $profile->where('email', $request->input('email'))->count();
                if ($checkemail != 0) {
                     return $this->returnError('E007', 'Adresse e-mail déjà prise');
                }
            }
            $profile->fill($request->all())->save();


           DB::commit();

             return $this-> returnData('signup',$profile , 'Compte utilisateur enregistré');  
      } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
      }
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function changePassword(Request $request)
    {
  try{
          $userId = 169;
        $user = User::find($userId);

        $validator = Validator::make($request->all(), [
              'password' => 'required|max:255',
            'newpassword' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

            if (Hash::check($request->password, $user->password)) {
                $hash = Hash::make($request->newpassword);
                 $user->fill(['password' => $hash])->save();
                
                  return $this->returnSuccessMessage('Password saved successfully');
       
           } else {
                      return $this->returnError('E031', 'Veuillez vous assurer de taper le bon mot de passe');
           }
                  return $this->returnSuccessMessage('Password saved successfully');
                  DB::commit();

      } catch (\Exception $ex) {
                 DB::rollback();
                return $this->returnError($ex->getCode(), $ex->getMessage());
       }

   }


   public function showUserBalance(){
        $user_id = auth('api')->user()->id;
        $user= User::find($user_id);
          if (!$user) 
                 return $this->returnError('E048','User not found');

          $user_balance =  $user->balance; 
         
          return $this->returnData('user_balance', $user_balance); 
   }

}