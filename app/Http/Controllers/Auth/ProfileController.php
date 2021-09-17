<?php

namespace App\Http\Controllers\Auth;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\MerchantEditRequest;
use App\Http\Requests\UserEditPasswordRequest;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function edit()
    {
        return view('auth.edit');
    }

    public function updateUserProfile(UserEditRequest $request)
    {
        auth()->user()->update($request->validated());
        Session::flash('success', 'user updated successfully');
        return redirect()->back();
    }

    public function updateupdatePassword(UserEditPasswordRequest $request)
    {
        $hash = auth()->user()->password;
        $pas  = request('current_password');
        if (password_verify($pas, $hash)) {
            auth()->user()->update(['password' => request('password')]);
            Session::flash('success', 'password successfully updated');
        } else {
            Session::flash('danger', 'old password is wrong');
        }
        return redirect()->back();
    }

    public function updateMerchantProfile(MerchantEditRequest $request)
    {
        auth()->user()->merchant()->update($request->validated());
        Session::flash('success', 'user merchant successfully');
        return redirect()->back();
    }
}
