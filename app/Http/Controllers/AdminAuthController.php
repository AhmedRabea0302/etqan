<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('pages.login');
    } 

    public function getDashBoard() {
        if(Auth::check()){
            return view('pages.home');
        }
        
        return Redirect::to("/admin/login")->withSuccess('Opps! You do not have access, You need To login');
    }

    public function postLogin(Request $request) {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/admin/home');
        }

        return Redirect::to("/admin/login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('/admin/login');
    }
}
