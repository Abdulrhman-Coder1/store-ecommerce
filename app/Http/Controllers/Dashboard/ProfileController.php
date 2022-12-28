<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editProfile()
    {
        $admin = Admin::find(auth('admin')->user()->id);

        return view('dashboard.profile.edit', compact('admin'));
    }

    public function updateProfile(ProfileRequest $request)
    {

        //validate
        //db


        $admin = Admin::find(auth('admin')->user()->id);


        if ($request->filled('password')) {
            unset($request['id']);
            unset($request['password_confirmation']);

            $request->merge(['password' => bcrypt($request->password)]);
            $admin->update($request->all());
            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
        }

        unset($request['id']);

        $admin->update(['name' => $request->name, 'email' => $request->email]);

        return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);

    }
}
