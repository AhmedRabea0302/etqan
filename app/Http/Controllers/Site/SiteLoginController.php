<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Session;
use Validator;
use App\AppUser;


class SiteLoginController extends Controller
{

    public function register(Request $request) {
        // $rules = [
        //     'user_name' => 'required',
        //     'phone_number' => 'required',
        //     'country' => 'required',
        //     'city' => 'required',
        //     'reg_password' => 'required',
        // ];        
        // $messages = [
        //     'user_name.required' => 'من فضلك أدخل إسم المستخدم!',
        //     'phone_number.required' => 'من فضلك أدخل رقم الهاتف!',
        //     'reg_password.required' => 'من فضلك أدخل كلمة السر!',
        //     'country.required' => 'من فضلك أدخل الدولة!',
        //     'city.required' => 'من فضلك أدخل المدينة!'
        // ];

        // $validator = Validator::make($request->all(), $rules, $messages);

        // if($validator->fails()) {
        //     dd($validator);
        //     return response()->json('تم إنشاء حسابك بنجاح');
        // }
        
        $user = new AppUser();

        $user->name = $request->name;
        $user->phone = $request->phone_number;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->password =  bcrypt($request->reg_password);

        $user->save();

        Auth::guard('auth-site')->login($user);

        return response()->json('Registered');

    }

    public function login() {
        return view('site.pages.login');
    } 

    public function postLogin(Request $request) {
        $request->validate([
            'phone'     => 'required',
            'password'  => 'required'
        ]);

        $credentials = $request->only('phone', 'password');
        if (Auth::guard('auth-site')->attempt($credentials)) {
            // Authentication passed...
            // return redirect()->intended('/');
            return response()->json('Logedin');
        }

        // return Redirect::to("/login")->withData('');
        return response()->json('خطأ في رقم الهاتف او كلمة السر!');
    }

    public function sheikhLogin() {
        return view('site.pages.sheikh-login');
    }

    public function postSheikhLogin(Request $request) {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('auth-site-sheikh')->attempt($credentials)) {
            // Authentication passed...
            // return redirect()->intended('/');
            return response()->json('sheikhLogedin');
        }

        // return Redirect::to("/login")->withData('');
        return response()->json('خطأ في البريد او كلمة السر!');
    } 
    public function logout() {
        Session::flush();
        Auth::guard('auth-site')->logout();
        return Redirect('/');
    }
}
