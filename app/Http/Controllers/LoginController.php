<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function actionLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            Alert::success('Welcome back', 'Success Login');

            $user = Auth::user(); // ✅ aman & jelas buat Intelephense

            if ($user && $user->role_id == 3) {
                return redirect('kasir');
            }

            return redirect('/');
        } else {
            Alert::toast('Email and Password are wrong', 'error');
            return back()->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        Alert::toast('Success Logout!', 'success');
        return redirect()->to('/');
    }
}
