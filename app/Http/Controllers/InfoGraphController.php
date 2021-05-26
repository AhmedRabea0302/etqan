<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InfoGraph;
use Validator;

class InfoGraphController extends Controller
{
    public function index() {
        $infographs = InfoGraph::all();
        return view('pages.infographs')->with('infographs', $infographs);
    }

    public function addInfograph(Request $request) {
        $infograph = new InfoGraph();
        $rules = [
            'file1' => 'required',
            'caption' => 'required',
        ];

        $messages = [
            'file1.required' => 'من فضلك إحتر صوة للإنفوجرافيك!',
            'caption.required' => 'من فضلك أدخل نصاً يصف الإنفوجرافيك!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('file1');
       
        if(!empty($file)) {
            $file_name = $file->getClientOriginalName();
            $destination = 'storage/uploads/images/infographs';
            $file->move($destination, $file_name);
            $infograph->image_name = $file_name;
        }

        $infograph->caption     = $request->input('details');

        $infograph->save();

        session()->push('m', 'success');
        session()->push('m', 'تم إضافة الإنفوجرافيك بنجاح');
        return redirect()->back();
    }

    
    public function getUpdateInfograph($id) {
        $infograph = InfoGraph::find($id);
        return view('pages.update-infograph')->with('infograph', $infograph);
    }

    public function posttUpdateInfograph($id, Request $request) {
        $infograph = InfoGraph::find($id);
        $rules = [
            'caption' => 'required',
        ];

        $messages = [
            'caption.required' => 'من فضلك أدخل نصاً يصف الإنفوجرافيك!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('file1');
       
        if(!empty($file)) {
            $file_name = $file->getClientOriginalName();
            $destination = 'storage/uploads/images/infographs';
            $file->move($destination, $file_name);
            $infograph->image_name = $file_name;
        }

        $infograph->caption     = $request->input('caption');

        $infograph->save();

        session()->push('m', 'success');
        session()->push('m', 'تم تعديل الإنفوجرافيك بنجاح');
        return redirect()->back();
    }

    public function posttDeleteInfograph($id) {
        $infograph = Infograph::find($id);
        $infograph->delete();
        session()->push('m', 'success');
        session()->push('m', 'تم حذف الإنفوجرافيك بنجاح');
        return redirect()->back();
    }
}
