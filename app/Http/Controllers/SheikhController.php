<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sheikh;
use Validator;
use Image;
class SheikhController extends Controller
{
    public function index() {
        $sheikhs = Sheikh::all();
        return view('pages.sheikhs.index')->with('sheikhs', $sheikhs);
    }

    public function addSheikh(Request $request) {
        $sheikh = new Sheikh();
        $rules = [
            'sheikh_name' => 'required',
            'email' => 'email|unique:users|required',
            'password' => 'required|min:6',
        ];

        $messages = [
            'sheikh_name.required' => 'من فضلك أدخل اسم للشيخ',
            'email.email' => 'من فضلك أدخل بريد إلكتروني صحيح للشيخ',
            'email.required' => 'من فضلك أدخل البريد الإلكتروني للشيخ',
            'email.unique:users' => 'هذا البريد الإلكتروني مُستخدم من قبل',
            'password.required' => 'من فضلك ادخل كلمة السر',
            'password.min:6' => 'من فضلك كلمة السر لا تقل عن 6 أحرف'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('file1');
       
        if(!empty($file)) {
            $file_name = $file->getClientOriginalName();
            $destination = 'storage/uploads/images/sheikhs';
            // $file->move($destination, $file_name);
            $img = Image::make($request->file('file1')->getRealPath());
            $img->resize(70, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destination.'/'.$file_name);
            $sheikh->image_name = $file_name;
        } else {
            $sheikh->image_name = 'avatar.jpg';
        }

        $sheikh->name     = $request->input('sheikh_name');
        $sheikh->email    = $request->input('email');
        $sheikh->password = bcrypt($request->input('password'));

        $sheikh->save();

        session()->push('m', 'success');
        session()->push('m', 'تم إضافة الشيخ بنجاح');
        return redirect()->back();
    }

    public function getSheikhEditPage($id) {
        $sheikh = Sheikh::find($id);
        return view('pages.sheikhs.edit-sheikh')->with('sheikh', $sheikh);
    }

    public function updateSheikh(Request $request, $id) {
        $sheikh = Sheikh::find($id);
        // dd($request);
        $rules = [
            'sheikh_name' => 'required',
            'password' => 'required|min:6',
        ];

        $messages = [
            'sheikh_name.required' => 'من فضلك أدخل اسم للشيخ',
            'password.required' => 'من فضلك ادخل كلمة السر',
            'password.min:6' => 'من فضلك كلمة السر لا تقل عن 6 أحرف'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('file1');
       
        if(!empty($file)) {
            $file_name = $file->getClientOriginalName();
            $destination = 'storage/uploads/images/sheikhs';
            // $file->move($destination, $file_name);
            $img = Image::make($request->file('file1')->getRealPath());
            $img->resize(70, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destination.'/'.$file_name);
            $sheikh->file1 = $file_name;
        }

       
        $sheikh->name = $request->sheikh_name;    
        $sheikh->password = bcrypt($request->password);
        if($request->can_comment == 'on') {
            $sheikh->can_comment = 1;
        } else {
            $sheikh->can_comment = 0;
        }

        if($request->banned == 'on') {
            $sheikh->banned = 1;
        } else {
            $sheikh->banned = 0;
        }

        if($request->can_add_meets == 'on') {
            $sheikh->can_add_meets = 1;
        } else {
            $sheikh->can_add_meets = 0;
        }

        $sheikh->update();

        session()->push('m', 'success');
        session()->push('m', 'تم تعديل الشيخ بنجاح!');
        return redirect()->back();
    }

    public function deleteSheikh($id) {
        $sheikh = Sheikh::find(($id));
        $sheikh->delete();
        session()->push('m', 'success');
        session()->push('m', 'تم حذف الشيخ بنجاح!');
        return redirect()->back();
    }
}
