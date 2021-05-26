<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Image;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function index() {
        $users = User::all();
        return view('pages.admins')->with('users', $users);
    }

    public function addAdmin(Request $request) {
        $user = new User();
        $rules = [
            'admin_name' => 'required',
            'email' => 'email|unique:users|required',
            'password' => 'required|min:6',
        ];

        $messages = [
            'admin_name.required' => 'من فضلك أدخل اسم للمدير',
            'email.email' => 'من فضلك أدخل بريد إلكتروني صحيح للمدير',
            'email.required' => 'من فضلك أدخل البريد الإلكتروني للمُدير',
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
            $destination = 'storage/uploads/images/admins';
            // $file->move($destination, $file_name);
            $img = Image::make($request->file('file1')->getRealPath());
            $img->resize(70, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destination.'/'.$file_name);
            $user->file1 = $file_name;
        } else {
            $user->file1 = 'avatar.png';
        }

        $user->name     = $request->input('admin_name');
        $user->email    = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->phone_number    = $request->input('phone_number');

        $user->save();

        session()->push('m', 'success');
        session()->push('m', 'تم إضافة المُدير بنجاح');
        return redirect()->back();
    }

    public function getAdminEditPage($id) {
        $user = User::find($id);
        return view('pages.edit-admin')->with('user', $user);
    }

    public function updateAdmin(Request $request, $id) {
        $user = User::find($id);

        $rules = [
            'admin_name' => 'required',
            'password' => 'required|min:6',
        ];

        $messages = [
            'admin_name.required' => 'من فضلك أدخل اسم للمدير',
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
            $destination = 'storage/uploads/images/admins';
            // $file->move($destination, $file_name);
            $img = Image::make($request->file('file1')->getRealPath());
            $img->resize(70, 70, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destination.'/'.$file_name);
            $user->file1 = $file_name;
        }

       
        $user->name = $request->admin_name;
        $user->phone_number = $request->phone_number;
    
        $user->password = bcrypt($request->password);

        $user->update();

        session()->push('m', 'success');
        session()->push('m', 'تم تعديل المُدير بنجاح!');
        return redirect()->back();
    }

    public function deleteAdmin($id) {
        $user = User::find(($id));
        $user->delete();
        session()->push('m', 'success');
        session()->push('m', 'تم حذف المًدير بنجاح!');
        return redirect()->back();
    }
}
