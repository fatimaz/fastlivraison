<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }


    public function store(UserRequest $request)
    {
         try {

            $filePath = "";
            if ($request->has('photo')) {
                $filePath = uploadImage('users', $request->photo);
            }
            else{
                $filePath ="user_profile.png";
            }
            if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'photo' => $filePath,
                'password' => bcrypt($request->password),
                'is_active' => $request->is_active,
            ]);
            return redirect()->route('admin.users')->with(['success' => 'User saved successfuly']);

        } catch (\Exception $ex) {
             return redirect()->route('admin.users')->with(['error' => 'There is an error! please try again']);
        }
    }

    public function edit($user_id)
    {
        try {
            //get specific users
            $user = User::find($user_id);

            if (!$user)
                return redirect()->route('admin.users')->with(['error' => 'This User does not exist']);

            return view('admin.users.edit', compact('user'));

        } catch (\Exception $ex) {
            return redirect()->route('admin.users')->with(['error' => 'Error!! Please try again']);
        }
    }




    public function update($id, UserRequest $request)
    {
     try {

            $user = User::find($id);
            if (!$user)
                return redirect()->route('admin.users')->with(['error' => ' This user does not exist']);



            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);



                if ($request->has('photo')) {
                    $fileName = uploadImage('users', $request->photo);
                    User::where('id',  $id)
                        ->update([
                            'photo' => $fileName,
                        ]);
                }
                

            $data = $request->except('_token', 'id','photo');


            User::where('id', $id)
                ->update(
                    $data
                );

            return redirect()->route('admin.users')->with(['success' => 'The user was updated successfuly']);
        } catch (\Exception $ex) {
             return redirect()->route('admin.users')->with(['error' => 'Error!! Please try again']);
        }
    }

    public function destroy($id){
        try{
            $user = User::find($id);
            if (!$user)
                return redirect()->route('admin.users')->with(['error' => ' This user does not exist']);

        
            $user->delete();

            return redirect()->route('admin.users')->with(['success' => 'User removed successfuly']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.users')->with(['error' => 'Error!! Please try again']);
        }
    }



}
