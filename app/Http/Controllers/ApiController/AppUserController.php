<?php

namespace App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\AppUser;
use Auth;
use Validator;
use Image;
use Illuminate\Http\Request;

class AppUserController extends Controller
{
    public $loginAfterSignUp = true;

    public function register(Request $request)
    {

      $rules = [
        'name' => 'required',
        'phone' => 'required',
        'country' => 'required',
        'city' => 'required',
        'password' => 'required',
      ];        
      $messages = [
        'name.required' => 'من فضلك أدخل إسم المستخدم!',
        'phone.required' => 'من فضلك أدخل رقم الهاتف!',
        'password.required' => 'من فضلك أدخل كلمة السر!',
        'country.required' => 'من فضلك أدخل الدولة!',
        'city.required' => 'من فضلك أدخل المدينة!'
      ];
      // dd($request);

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()) {
        return response()->json([
          'Success'=> false,
          'Code'=> 401,
          'Message' => $validator,
          'Data' => null
        ]);
      }

      // $user = AppUser::create([
      //   'name' => $request->name,
      //   'phone' => $request->phone,
      //   'country' => $request->country,
      //   'password' => bcrypt($request->password),
      // ]);

      $user = new AppUser();

      $user->name = $request->name;
      $user->phone = $request->phone;
      $user->country = $request->country;
      $user->city = $request->city;
      $user->password =  bcrypt($request->password);

      $user->save();

      $token =  Auth::guard('api-app-user')->login($user);

      return response()->json([
        'Success'=> true,
        'Code'=> 200,
        'Message' => 'تم إنشاء حسابك بنجاح',
        'Data' => ['token' => $token, 'user_data' => $user]
      ]);

    }

    public function login(Request $request)
    {

      $credentials = $request->only(['phone', 'password']);
      $user = AppUser::where('phone', $request->phone)->first();
      if($user) {
        if (!$token = Auth::guard('api-app-user')->attempt($credentials)) {
          return response()->json([
            'Success'=> false,
            'Code'=> 401,
            'Message' => 'خطأ في كلمة السر أو رقم الهاتف',
            'Data' => null
          ]);
        }
  
        if($user->banned) {
          return response()->json([
            'Success'=> false,
            'Code'=> 400,
            'Message' => 'تم تجميد حسابك، قم بالتواصل مع المًدراء لإستعادة حسابك',
            'Data' => null
          ]);
        }
        
        $user_data = Auth::guard('api-app-user')->user()->only(['id', 'name', 'email', 'phone', 'bio', 'user_type']);
  
        return response()->json([
          'Success'=> true,
          'Code'=> 200,
          'Message' => '',
          'Data' => ['token' => $token, 'user_data' => $user_data]
        ]);
      } else {
        return response()->json([
          'Success'=> false,
          'Code'=> 401,
          'Message' => 'خطأ في كلمة السر أو رقم الهاتف',
          'Data' => null
        ]);
      }
      

    }
    public function getAuthUser(Request $request)
    {
        return response()->json(Auth::guard('api-app-user')->user());
    }
    public function logout()
    {
        Auth::guard('api-app-user')->logout();

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

    public function getAllSheikhs() {
      $sheikhs = Sheikh::select('id', 'name', 'email', 'image_name')->get();
      foreach($sheikhs as $sheikh) {
        $sheikh->uploaded_image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $sheikh->image_name;
      }

      return response()->json([
        'Success'=> true,
        'Code'=> 200,
        'Message' => '',
        'Data' => $sheikhs
      ]);

    }

    public function updateProfile(Request $request) {
      if($request->user_id) {
        $app_user = AppUser::find($request->user_id);
        $rules = [
          'name' => 'required',
          'country' => 'required',
          'city' => 'required',
        ];
  
        $messages = [
            'name.required' => 'من فضلك أدخل الاسم',
            'country.required' => 'من فضلك أدخل بريد البلد',
            'city.required' => 'من فضلك أدخل المدينة',
        ];
  
        $app_user->name = $request->name;
        $app_user->country = $request->country;
        $app_user->city = $request->city;
        $app_user->bio = $request->bio;
        $app_user->email = $request->email;
        $app_user->password = bcrypt($request->password);
  
        $validator = Validator::make($request->all(), $rules, $messages);
          
        if($validator->fails()) {
          return response()->json(['message' => $validator->customMessages]);
        }
  
        $file = $request->file('file1');
        
        if(!empty($file)) {
            $file_name = $file->getClientOriginalName();
            $destination = 'storage/uploads/images/app_users';
            // $file->move($destination, $file_name);
            $img = Image::make($request->file('file1')->getRealPath());
            $img->resize(70, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destination.'/'.$file_name);
            $app_user->image_name = $file_name;
        } 
  
        $app_user->save();
      
        return response()->json([
          'Success'=> true,
          'Code'=> 200,
          'Message' => 'تم تعديل بياناتك بنجاح',
          'Data' => [
            'user_id'        => $app_user->id,
            'user_name'      => $app_user->name,
            'user_email'     => $app_user->email,
            'user_phone'     => $app_user->phone,
            'user_bio'       => $app_user->bio,
            'user_country'   => $app_user->country,
            'user_city'      => $app_user->city,
            'status'         => $app_user->banned,
            'user_image_url' => 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/'. $app_user->image_name,
          ]
      ]);
  
      } else {
        return response()->json([
          'Success'=> false,
          'Code'=> 400,
          'Message' => 'Invalid USER ID',
          'Data' => null
        ]); 
      }
    }
}
