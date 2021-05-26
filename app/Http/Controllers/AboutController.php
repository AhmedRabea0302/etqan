<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use Validator;

class AboutController extends Controller
{
    public function index() {
        $about = About::find(1);
        return view('pages.about')->with('about', $about);
    }

    public function updateAbout(Request $request) {
        $about = About::find(1);
        
        $rules = [
            'goals' => 'required',
            'vision' => 'required',
            'message' => 'required',
        ];

        $messages = [
            'goals.required' => 'من فضلك أدخل الأهداف',
            'vision.required' => 'من فضلك ادخل الرؤية',
            'message.required' => 'من فضلك أدخل الرسالة'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $about->message = $request->message;
        $about->goals = $request->goals;
        $about->vision = $request->vision;

        $about->whatsapp = $request->whatsapp;
        $about->facebook = $request->facebook;
        $about->twitter = $request->twitter;
        $about->googleplus = $request->googleplus;
        $about->youtube = $request->youtube;
        $about->linkedin = $request->linkedin;
        $about->instagram = $request->instagram;
        $about->website = $request->linkedin;

        $about->update();

        session()->push('m', 'success');
        session()->push('m', 'تم تعديل الصفحة التعريفية للتطبيق بنجاح!');
        return redirect()->back();
    }
}
