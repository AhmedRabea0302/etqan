<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sheikh;
use App\Meet;
use App\SheikhMeet;
use Auth;
use Validator;
use JWTAuth;
class SheikhAuthController extends Controller
{
    public $loginAfterSignUp = true;

    public function register(Request $request)
    {
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
      ]);

      $token = auth()->login($user);

      return response()->json([
        'Success'=> true,
        'Code'=> 200,
        'Message' => 'تم إنشاء حساب بنجاح',
        'Data' => ['token' => $token, 'user_data' => $user]
      ]);

    }

    public function login(Request $request)
    {

      $rules = [
        'email' => 'required',
        'password' => 'required',
      ];        
      $messages = [
          'email.required' => 'من فضلك أدخل البريد الإلكتروني!',
          'password.required' => 'من فضلك أدخل كلمة السر!',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()) {
        return response()->json(['errors' => $validator->customMessages]);
      }
          
      $credentials = $request->only(['email', 'password']);
      $sheikh = Sheikh::select('id', 'name', 'email', 'banned', 'can_add_meets', 'can_comment', 'user_type', 'image_name')->where('email', $request->email)->first();
      if($sheikh) {

      
        $sheikh->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $sheikh->image_name;
        if(!$sheikh) {
          return response()->json([
            'Success'=> false,
            'Code'=> 400,
            'Message' => 'خطا في كلمة السر أو البريد الإلكتروني',
            'Data' => null
          ]);
        }

        if (!$token = Auth::guard('api-sheikh')->attempt($credentials)) {
          return response()->json([
            'Success'=> false,
            'Code'=> 401,
            'Message' => 'خطأ في البريد الإلكتروني أو كلمة السر',
            'Data' => null
          ]);
        } 

        if($sheikh->banned) {
          return response()->json([
            'Success'=> false,
            'Code'=> 400,
            'Message' => 'تم تجميد حسابك، قم بالتواصل مع المًدراء لإستعادة حسابك',
            'Data' => null
          ]);
        }
        return response()->json([
          'Success'=> true,
          'Code'=> 200,
          'Message' => '',
          'Data' => ['token' => $token, 'user_data' => $sheikh]
        ]);
      } else {
        return response()->json([
          'Success'=> false,
          'Code'=> 401,
          'Message' => 'خطأ في كلمة السر أو البريد الإلكتروني',
          'Data' => null
        ]);
      }
      
      
    }
    public function getAuthUser(Request $request)
    {
        return response()->json(Auth::guard('api')->user());
    }
    public function logout()
    {
      Auth::guard('api-sheikh')->logout();
      
      return response()->json([
        'Success'=> true,
        'Code'=> 200,
        'Message' => 'تم تسجيل الخروج بنجاح',
        'Data' => null
      ]);

      
    }
    protected function respondWithToken($token)
    {  
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth('api')->factory()->getTTL() * 60
      ]);
    }
    
}
