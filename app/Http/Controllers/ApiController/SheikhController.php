<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sheikh;
use App\Meet;
use App\AppUser;
use Auth;
use Validator;
use JWTAuth;

class SheikhController extends Controller
{

  public function getAllSheikhs() {
    $sheikhs = Sheikh::select('id', 'name', 'email', 'image_name', 'banned', 'can_comment', 'can_add_meets')->get();
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

  public function sheikhAddMeet(Request $request) {
    
    if($request->sheikh_id) {
      $sheikh = Sheikh::find($request->sheikh_id);
    } else {
      return response()->json([
        'Success'=> false,
        'Code'=> 400,
        'Message' => 'Sheikh ID Required',
        'Data' => null
      ]);
    }

    if($sheikh->can_add_meets) {
      $meet = new Meet();
      
      $rules = [
          'link' => 'required',
          'title' => 'required',
          'details' => 'required',
          'time' => 'required',
          'date' => 'required'
      ];        
      $messages = [
          'title.required' => 'من فضلك أدخل عنوان الحدث',
          'link.required' => 'من فضلك أدخل رابط الحدث',
          'details.required' => 'من فضلك أدخل توصيف للحدث',
          'time.required' => 'من فضلك أدخل توقيت الحدث',
          'date.required' => 'من فضلك أدخل تاريخ الحدث',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()) {
        return response()->json(['message' => $validator->customMessages]);
      }

      $meet->title     = $request->title;
      $meet->link      = $request->link;
      $meet->details   = $request->details;
      $meet->user_id   = Auth::guard('api-sheikh')->user()->id;
      $meet->user_type = 'sheikh';
      $meet->user_name   = Auth::guard('api-sheikh')->user()->name;
      $meet->date   = $request->date;
      $meet->time   = $request->time;
      $meet->threeshold   = $request->date . ' ' . $request->time;

      if($request->status == "1") {
          $meet->status = 1;
      }

      $meet->save();
      return response()->json([
        'Success'=> true,
        'Code'=> 200,
        'Message' => 'تم إضافة الحدث بنجاح',
        'Data' => ['meet_id' => $meet->id]
      ]);
    
    } else {
      return response()->json([
        'Success'=> false,
        'Code'=> 400,
        'Message' => 'غير مسموح لك بإضافة أحداث، للإستفسار تواصل مع المُدراء',
        'Data' => false
      ]);

    }
  //  else {
  //     return response()->json(['message' => 'تحتاج لتسجيل الدخول أولا!'], 200); 
  //   }
  }

  public function sheikhUpdateMeet(Request $request) {
    
    if($request->sheikh_id) {
      $sheikh = Sheikh::find($request->sheikh_id);
    } else {
      return response()->json(['message' => 'sheikh id required']); 
    }

    if($sheikh->can_add_meets) {
      $meet = Meet::find($request->meet_id);
      
      $rules = [
          'link' => 'required',
          'title' => 'required',
          'details' => 'required',
          'time' => 'required',
          'date' => 'required',
          'status' => 'required'
      ];        
      $messages = [
          'title.required' => 'من فضلك أدخل عنوان الحدث',
          'link.required' => 'من فضلك أدخل رابط الحدث',
          'details.required' => 'من فضلك أدخل توصيف للحدث',
          'time.required' => 'من فضلك أدخل توقيت الحدث',
          'date.required' => 'من فضلك أدخل تاريخ الحدث',
          'status.required' => 'من فضلك أدخل حالة الحدث',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()) {
        return response()->json(['message' => $validator->customMessages]);
      }

      $meet->title     = $request->title;
      $meet->link      = $request->link;
      $meet->details   = $request->details;
      $meet->date   = $request->date;
      $meet->time   = $request->time;
      $meet->threeshold   = $request->date . ' ' . $request->time;

      if($request->status == "1") {
          $meet->status = 1;
      } else {
        $meet->status = 0;
      }

      $meet->save();

      return response()->json([
        'Success'=> true,
        'Code'=> 200,
        'Message' => 'تم تعديل الحدث بنجاح',
        'Data' => ['meet_id' => $meet->id]
      ]);

    } else {
      return response()->json([
        'Success'=> false,
        'Code'=> 400,
        'Message' => 'غير مسموح لك بتعديل أحداث، للإستفسار تواصل مع المُدراء',
        'Data' => null
      ]);
    }
  }

  public function sheikhBanUser($id) {
    $user = AppUser::find($id);
    // Auth::guard('api-app-user')->logout($id);
    // JWTAuth::invalidate(JWTAuth::getToken($id));
    $user->banned = 1;

    $user->save();

    return response()->json([
      'Success'=> true,
      'Code'=> 200,
      'Message' => 'تم حظر المسنخدم بنجاح',
      'Data' => null
    ]);
  }
  
  public function updateProfile() {
    
  }
}
