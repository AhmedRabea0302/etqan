<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MessageSite;
use Validator;

class MessageSiteController extends Controller
{
    public function sendMessage(Request $request) {
        $message = new MessageSite();

        $rules = [
            'name' => 'required',
            'message' => 'required',
            'email' => 'email|required',
        ];

        $messages = [
            'name.required' => 'من فضلك أدخل الإسم',
            'message.required' => 'من فضلك أدخل نص الرسالة',
            'email.email' => 'من فضلك أدخل بريد إلكتروني صحيح',
            'email.required' => 'من فضلك أدخل البريد الإلكتروني',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $message->name     = $request->input('name');
        $message->email    = $request->input('email');
        $message->phone    = $request->input('phone');
        $message->message  = $request->input('message');

        $message->save();

        session()->push('m', 'success');
        session()->push('m', 'تم إرسال رسالتك بنجاح');
        return redirect()->back();
    }
}
