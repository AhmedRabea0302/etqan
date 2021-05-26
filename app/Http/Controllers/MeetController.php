<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meet;
use Validator;
use Illuminate\Support\Facades\DB;

class MeetController extends Controller
{
    public function index() {
        $meets = DB::table('meets')->orderBy('created_at','DES')->paginate(5);
        return view('pages.meets.meets')->with('meets', $meets);
    }

    public function addMeet(Request $request) {
        $meet = new Meet();
        
        $rules = [
            'title' => 'required',
            'details' => 'required',
            'time' => 'required',
            'date' => 'required'
        ];        
        $messages = [
            'title.required' => 'من فضلك أدخل عنوان الحدث',
            'details.required' => 'من فضلك أدخل توصيف للحدث',
            'time.required' => 'من فضلك أدخل توقيت الحدث',
            'date.required' => 'من فضلك أدخل تاريخ الحدث',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $meet->title     = $request->title;
        $meet->link      = $request->link;
        $meet->details   = $request->details;
        $meet->user_id   = auth()->user()->id;
        $meet->user_type = 'admin';
        $meet->user_name   = auth()->user()->name;
        $meet->date   = $request->date;
        $meet->time   = $request->time;
        $meet->threeshold   = $request->date . ' ' . $request->time;

        if($request->status == "on") {
            $meet->status = 1;
        }
        
        $meet->save();

        session()->push('m', 'success');
        session()->push('m', 'تم إضافة الحدث بنجاح، قم بتفعيله وقتما تشاء');
        return redirect()->back();
    }

    public function alterMeet($id) {
        $meet = Meet::find($id);
        if($meet->status == 1) {
            $meet->status = 0; 
        } else {
            $meet->status = 1;
        }

        $meet->save();

        session()->push('m', 'success');
        if($meet->status) {
            session()->push('m', 'تم تفعيل الحدث بنجاح!');
        } else {
            session()->push('m', 'تم تعطيل الحدث بنجاح!');
        }
        
        return redirect()->back();
    }

    public function getUpdateMeet($id) {
        $meet = Meet::find($id);
        return view('pages.meets.update-meet')->with('meet', $meet);
    }

    public function updateMeet(Request $request, $id) {
        $meet = Meet::find($id);
        
        $rules = [
            'link' => 'required',
            'title' => 'required',
            'details' => 'required'
        ];        
        $messages = [
            'title.required' => 'من فضلك أدخل عنوان الحدث',
            'link.required' => 'من فضلك أدخل رابط الحدث',
            'details.required' => 'من فضلك أدخل توصيف للحدث',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $meet->title     = $request->title;
        $meet->link      = $request->link;
        $meet->details   = $request->details;
        $meet->date   = $request->date;
        $meet->time   = $request->time;
        $meet->threeshold   = $request->date . ' ' . $request->time;
        if($request->status == "on") {
            $meet->status = 1;
        } else {
            $meet->status = 0;
        }

        $meet->save();

        session()->push('m', 'success');
        session()->push('m', 'تم تعديل الحدث بنجاح');
        return redirect()->back();
    }

    public function deleteMeet($id) {
        $meet = Meet::find($id);
        $meet->delete();
        session()->push('m', 'success');
        session()->push('m', 'تم حذف الحدث بنجاح');
        return redirect()->back();
    }
}
