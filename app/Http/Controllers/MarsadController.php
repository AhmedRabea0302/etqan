<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marsad;
use Validator;
use Response;
use Redirect;

class MarsadController extends Controller
{
    public function getAddMarsad() {
        
        // $allSuspicions = Suspicion::all();
        $marsads = Marsad::where('parent_id', '0')->with('childs')->get();
        $allMarsads = Marsad::select('id', 'marsad')->where('parent_id', '0')->with('childrenMarsads')->get();
        return view('pages.marsads.add-marsad', ['marsads' => $marsads, 'allMarsads' => $allMarsads]);
    }

    public function AddMarsad(Request $request) {
        $marsad = new Marsad();
        $rules = [
            'marsad' => 'required',
        ];        
        $messages = [
            'marsad.required' => 'من فضلك أدخل نص المرصد',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $marsad->parent_id     = $request->parent_id;
        $marsad->marsad        = $request->marsad;
        $marsad->short_reply   = $request->short_reply;
        $marsad->long_reply    = $request->long_reply;
        
        $file1 = $request->file('file1');
        $file2 = $request->file('file2');
        // dd($request->all());
        if(!empty($file1)) {
            $file_name = $file1->getClientOriginalName();
            // dd($request->all());
            $destination = 'storage/uploads/videos/marsad';
            if($marsad->video_url) {
                unlink($marsad->video_url);
            }
            $file1->move($destination, $file_name);
            $marsad->video_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/videos/marsad/' . $file_name;
        }

        if(!empty($file2)) {
            $file_name = $file2->getClientOriginalName();
           
            $destination = 'storage/uploads/books/marsad';
            if($marsad->book_url) {
                unlink($marsad->book_url);
            }
            $file2->move($destination, $file_name);
            $marsad->book_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/books/marsad/' . $file_name;
        }

        $marsad->save();

        session()->push('m', 'success');
        session()->push('m', 'تم إضافة المرصد بنجاح');
        return redirect()->back();
    }

    public function getAllMarsads() {
        // $suspicions = Suspicion::where('parent_id', '0')->get();
        $marsads = Marsad::select('id', 'parent_id','marsad', 'short_reply', 'long_reply', 'video_url', 'book_url')->where('parent_id', '0')->with('childrenMarsads')->get();
        return view('pages.marsads.all-marsads')->with(['marsads' => $marsads]);
    }

    public function updateMarsad(Request $request) {
        $id = json_decode($request->id);
        $specificMarsad = Marsad::find($id);

        $specificMarsad->marsad = $request->marsad;

        if($specificMarsad->reply != null) {
            $specificMarsad->reply     = $request->reply;
        }

        $specificMarsad->save();
        // return ['status' => 'success', 'message' => 'Updated Successfully'];
        // return redirect('/home')->with(['Success' => 'تم تعديل الشبهة بنجاح!']);
        return response()->json(['message'=>'تم تعديل المرصد بنجاح!']);
    }

    public function getChildSuspicions($id) {
        $childs = Suspicion::where('parent_id', $id)->get();
        return $childs;
    }

    public function getSuspicionReply($id) {
        $reply = Suspicion::select('reply')->find($id);
    }

    public function deleteMarsad(Request $request) {
        $id = json_decode($request->id);
        $marsadP = Marsad::find($id);
        
        $marsads = $marsadP->childrenMarsads()->get();
        
        if($marsads) {
            foreach($marsads as $marsad) {
                $marsad->delete();
            }
        }
        $marsadP->delete();
        return response()->json(['message'=>'تم حذف المرصد بنجاح!']);
    }

}
