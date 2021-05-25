<?php

namespace App\Http\Controllers;

use App\Evidence;
use Illuminate\Http\Request;
use Validator;
class EvidenceController extends Controller
{
    public function index() {
        $evidences = Evidence::select('id', 'parent_id','title')->where('level', '!=', 1)->get();
        return view('pages.evidences.add-evidences')->with('evidences', $evidences);
    }

    public function addEvidence(Request $request) {
        $evidence = new Evidence();
        $rules = [
            'title' => 'required',
        ];        
        $messages = [
            'title.required' => 'من فضلك أدخل نص الدليل',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $evidence->parent_id     = $request->parent_id;
        $evidence->title         = $request->title;
        $evidence->short_reply   = $request->short_reply;
        $evidence->long_reply    = $request->long_reply;
        if($request->level == 1) {  // MEANS A LEAF SUSOCION
            $evidence->level = 1;
        } else {
            $evidence->level = 0;  // MEANS A NODE evidence
        }
        $file1 = $request->file('file1');
        $file2 = $request->file('file2');
        // dd($request->all());
        if(!empty($file1)) {
            $file_name = time() . '.' . $file1->getClientOriginalExtension();
           
            $destination = 'storage/uploads/videos/evidences';

            if($evidence->video_url) {
                unlink($evidence->video_url);
            }
            $file1->move($destination, $file_name);

            $evidence->video_url = url('/storage/uploads/videos/evidences/') . '/' . $file_name;
        }

        if(!empty($file2)) {
            $file_name = time() . '342.' . $file2->getClientOriginalExtension();
           
            $destination = 'storage/uploads/books/evidences';
            if($evidence->book_url) {
                unlink($evidence->book_url);
            }
            $file2->move($destination, $file_name);
            $evidence->book_url = url('/storage/uploads/books/evidences/') . '/' . $file_name;
        }

        $evidence->save();

        session()->push('m', 'success');
        session()->push('m', 'تم إضافة الدليل بنجاح');
        return redirect()->back();
    }

    public function getAllEvidences() {
        $evidences = Evidence::select('id', 'parent_id','title')->where('parent_id', '0')->with('childrenEvidences')->get();
        return view('pages.evidences.all-evidences')->with('evidences', $evidences);
    }

    public function getEvidenceContent($id) {
        $evidence = Evidence::find($id);
        $evidence_book = $evidence->book_url;
        $arr = explode('/', $evidence_book);
        $book_name = end($arr);
        return view('pages.evidences.evidence-content')->with(['evidence' => $evidence, 'book_name' => $book_name]);
    }

    public function updateEvidenceTitle(Request $request) {
        $id = json_decode($request->id);
        $evidence = Evidence::find($id);
        $evidence->title = $request->suspicion;

        $evidence->save();
        return response()->json(['message'=>'تم تعديل عنوان الدليل بنجاح!']);
    }

    public function updateEvidenceContent(Request $request, $id) {

        $evidence = Evidence::find($id);

        $rules = [
            'evidence' => 'required',
        ];        
        $messages = [
            'evidence.required' => 'من فضلك أدخل نص الدليل',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $evidence->title     = $request->evidence;
        $evidence->short_reply   = $request->short_reply;
        $evidence->long_reply    = $request->long_reply;
        
        $file1 = $request->file('file1');
        $file2 = $request->file('file2');
        // dd($request->all());
        if(!empty($file1)) {
            $file_name = $file1->getClientOriginalName();
           
            $destination = 'storage/uploads/videos/evidences';
            if($evidence->video_url) {
                // unlink($evidence->video_url);
            }
            $file1->move($destination, $file_name);
            $evidence->video_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/videos/evidences/' . $file_name;
        }

        if(!empty($file2)) {
            $file_name = $file2->getClientOriginalName();
           
            $destination = 'storage/uploads/books/evidences';
            if($suspicion->book_url) {
                // unlink($suspicion->book_url);
            }
            $file2->move($destination, $file_name);
            $evidence->book_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/books/evidences/' . $file_name;
        }

        $evidence->save();

        session()->push('m', 'success');
        session()->push('m', 'تم تعديل الدليل بنجاح');
        return redirect()->back();
        


    }

    public function deleteEvidence(Request $request) {

        $id = json_decode($request->id);
        $evidenceP = Evidence::find($id);
        
        $evidences = $evidenceP->childrenEvidences()->get();
        
        if($evidences) {
            foreach($evidences as $evidence) {
                if($evidence->book_url) {
                    $book_arr = explode('/', $evidence->book_url);
                    $book_name = end($book_arr);
                    unlink('storage/uploads/books/evidences/' . $book_name);
                }

                if($evidence->video_url) {
                    $video_arr = explode('/', $evidence->video_url);
                    $video_name = end($video_arr);
                    unlink('storage/uploads/videos/evidences/' . $video_name);
                }
                $evidence->delete();
            }
        }
        $evidenceP->delete();
        return response()->json(['message'=>'تم حذف الدليل بنجاح!']);
    }
}
