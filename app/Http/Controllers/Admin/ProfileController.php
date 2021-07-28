<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function editProfile()
    {
        $id = auth('admin')-> user() -> id;
        $admin = Admin::find($id);
        return view('admin.profile.edit',compact('admin'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        //validate
        // db

      try {

            $admin = Admin::find(auth('admin')->user()->id);


            if ($request->filled('password')) {
                $request->merge(['password' => bcrypt($request->password)]);
            }else{
                unset($request['password']);
            }

            unset($request['id']);
            unset($request['password_confirmation']);

            $admin->update($request->all());

            return redirect()->back()->with(['success' => 'Profile updated successfuly']);
//
        } catch (\Exception $ex) {
           return redirect()->back()->with(['error' => 'There is an error please try again']);
        }
    }
}