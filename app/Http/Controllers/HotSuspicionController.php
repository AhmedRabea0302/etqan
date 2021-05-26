<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HotSuspicion;
use Validator;
use Response;
use Redirect;

class HotSuspicionController extends Controller
{
    public function getAddSuspicion() {
        
        // $allSuspicions = Suspicion::all();
        $suspicions = HotSuspicion::where('parent_id', '0')->with('childs')->get();
        $allSuspicions = HotSuspicion::select('id', 'suspicion')->where('level','!=' , 1)->get();
        return view('pages.hot-suspicions.add-hot-suspicion', ['suspicions' => $suspicions, 'allSuspicions' => $allSuspicions]);
    }

    public function AddSuspicion(Request $request) {
        $suspicion = new HotSuspicion();
        $rules = [
            'suspicion' => 'required',
        ];        
        $messages = [
            'suspicion.required' => 'من فضلك أدخل نص الشبُهة',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $suspicion->parent_id     = $request->parent_id;
        $suspicion->suspicion     = $request->suspicion;
        $suspicion->short_reply   = $request->short_reply;
        $suspicion->long_reply    = $request->long_reply;
        if($request->level == 1) {  // MEANS A LEAF SUSOCION
            $suspicion->level = 1;
        } else {
            $suspicion->level = 0;  // MEANS A NODE SUSPICION
        }
        $file1 = $request->file('file1');
        $file2 = $request->file('file2');
        // dd($request->all());
        if(!empty($file1)) {
            $file_name = time() . '.' . $file1->getClientOriginalExtension();
           
            $destination = 'storage/uploads/videos/hot-suspicions';
            if($suspicion->video_url) {
                unlink($suspicion->video_url);
            }
            $file1->move($destination, $file_name);
            
            $suspicion->video_url = url('/storage/uploads/videos/hot-suspicions/') . '/' . $file_name;
        }

        if(!empty($file2)) {
            $file_name = time() . '342.' . $file2->getClientOriginalExtension();
           
            $destination = 'storage/uploads/books/hot-suspicions';
            if($suspicion->book_url) {
                unlink($suspicion->book_url);
            }
            $file2->move($destination, $file_name);
            $suspicion->book_url = url('/storage/uploads/videos/hot-suspicions/') . '/' . $file_name;
        }

        $suspicion->save();

        session()->push('m', 'success');
        session()->push('m', 'تم إضافة الشبُهة الساخنة بنجاح');
        return redirect()->back();
    }

    public function getAllSuspicions() {
        // $suspicions = Suspicion::where('parent_id', '0')->get();
        $suspicions = HotSuspicion::select('id', 'parent_id','suspicion')->where('parent_id', '0')->with('childrenSuspicions')->get();
        return view('pages.hot-suspicions.all-hot-suspicions')->with(['suspicions' => $suspicions]);
    }

    public function getHotSuspicionContent($id) {
        $suspicion = HotSuspicion::find($id);
        $suspicion_book = $suspicion->book_url;
        $arr = explode('/', $suspicion_book);
        $book_name = end($arr);
        return view('pages.hot-suspicions.hot-suspicion-content')->with(['suspicion' => $suspicion,'book_name' => $book_name] );
    }

    public function updateHotSuspicionTitle(Request $request) {
        $id = json_decode($request->id);
        $suspicion = HotSuspicion::find($id);
        $suspicion->suspicion = $request->suspicion;

        $suspicion->save();
        return response()->json(['message'=>'تم تعديل عنوان الشٌبهة بنجاح!']);
    }

    public function updateSuspicion(Request $request, $id) {
        $suspicion = HotSuspicion::find($id);

        $rules = [
            'suspicion' => 'required',
        ];        
        $messages = [
            'suspicion.required' => 'من فضلك أدخل نص الشبُهة الساخنة',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $suspicion->suspicion     = $request->suspicion;
        $suspicion->short_reply   = $request->short_reply;
        $suspicion->long_reply    = $request->long_reply;
        
        $file1 = $request->file('file1');
        $file2 = $request->file('file2');
        // dd($request->all());
        if(!empty($file1)) {
            $file_name = $file1->getClientOriginalName();
           
            $destination = 'storage/uploads/videos/hot-suspicions';
            if($suspicion->video_url) {
                // unlink($suspicion->video_url);
            }
            $file1->move($destination, $file_name);
            $suspicion->video_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/videos/hot-suspicions/' . $file_name;
        }

        if(!empty($file2)) {
            $file_name = $file2->getClientOriginalName();
           
            $destination = 'storage/uploads/books/hot-suspicions';
            if($suspicion->book_url) {
                // unlink($suspicion->book_url);
            }
            $file2->move($destination, $file_name);
            $suspicion->book_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/books/hot-suspicions/' . $file_name;
        }

        $suspicion->save();

        session()->push('m', 'success');
        session()->push('m', 'تم تعديل الشبُهة بنجاح');
        return redirect()->back();
        
    }

    public function getChildSuspicions($id) {
        $childs = HotSuspicion::where('parent_id', $id)->get();
        return $childs;
    }

    public function getSuspicionReply($id) {
        $reply = HotSuspicion::select('reply')->find($id);
    }

    public function deleteSuspicion(Request $request) {
        $id = json_decode($request->id);
        $suspicionP = HotSuspicion::find($id);
        
        $suspicions = $suspicionP->childrenSuspicions()->get();
        
        if($suspicions) {
            foreach($suspicions as $suspicion) {
                if($suspicion->book_url) {
                    $book_arr = explode('/', $suspicion->book_url);
                    $book_name = end($book_arr);
                    unlink('storage/uploads/books/hot-suspicions/' . $book_name);
                }

                if($suspicion->video_url) {
                    $video_arr = explode('/', $suspicion->video_url);
                    $video_name = end($video_arr);
                    unlink('storage/uploads/videos/hot-suspicions/' . $video_name);
                }
                $suspicion->delete();
            }
        }
        $suspicionP->delete();
        return response()->json(['message'=>'تم حذف الشُبهة بنجاح!']);
    }
}
