<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use Validator;

class DiscussionsController extends Controller
{
    public function index() {
        $discussions = Discussion::select('id', 'title')->where('level','!=' , 1)->get();
        return view('pages.discussions.add-discussions')->with('discussions', $discussions);
    }

    public function addDiscussion(Request $request) {
        $discussion = new Discussion();
        $rules = [
            'discussion' => 'required',
        ];        
        $messages = [
            'discussion.required' => 'من فضلك أدخل نص المناظرة',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $discussion->parent_id     = $request->parent_id;
        $discussion->title         = $request->discussion;
        $discussion->short_reply   = $request->short_reply;
        $discussion->long_reply    = $request->long_reply;
        if($request->level == 1) {  // MEANS A LEAF SUSOCION
            $discussion->level = 1;
        } else {
            $discussion->level = 0;  // MEANS A NODE discussion
        }
        $file1 = $request->file('file1');
        $file2 = $request->file('file2');
        // dd($request->all());
        if(!empty($file1)) {
            $file_name = time() . '.' . $file1->getClientOriginalExtension();
           
            $destination = 'storage/uploads/videos/discussions';
           
            if($discussion->video_url) {
                unlink($discussion->video_url);
            }
            $file1->move($destination, $file_name);
            $discussion->video_url = url('/storage/uploads/videos/discussions/') . '/' . $file_name;
        }

        if(!empty($file2)) {
            $file_name = time() . '342.' . $file2->getClientOriginalExtension();
           
            $destination = 'storage/uploads/books/discussions';
            if($discussion->book_url) {
                unlink($discussion->book_url);
            }
            $file2->move($destination, $file_name);
            $discussion->book_url = url('/storage/uploads/books/discussions/') . '/' . $file_name;
        }

        $discussion->save();

        session()->push('m', 'success');
        session()->push('m', 'تم إضافة المناظرة بنجاح');
        return redirect()->back();
    }

    public function getAllDiscussions() {
        $discussions = Discussion::select('id', 'parent_id','title','short_reply', 'long_reply', 'video_url', 'book_url')->where('parent_id', '0')->with('childrenDiscussions')->get();
        return view('pages.discussions.all-discussions')->with('discussions', $discussions);
    }

    public function getDiscussionContent($id) {
        $discussion = Discussion::find($id);
        $discussion_book = $discussion->book_url;
        $arr = explode('/', $discussion_book);
        $book_name = end($arr);
        return view('pages.discussions.discussion-content')->with(['discussion' =>  $discussion, 'book_name' => $book_name]);
    }

    public function updateDiscussionTitle(Request $request) {
        $id = json_decode($request->id);
        $discussion = Discussion::find($id);
        $discussion->title = $request->title;

        $discussion->save();
        return response()->json(['message'=>'تم تعديل عنوان المناظرة بنجاح!']);
    }

    public function updateDiscussionContent(Request $request, $id) {
        $discussion = Discussion::find($id);

        $rules = [
            'discussion' => 'required',
        ];        
        $messages = [
            'discussion.required' => 'من فضلك أدخل نص المناظرة',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $discussion->title     = $request->discussion;
        $discussion->short_reply   = $request->short_reply;
        $discussion->long_reply    = $request->long_reply;
        
        $file1 = $request->file('file1');
        $file2 = $request->file('file2');
        // dd($request->all());
        if(!empty($file1)) {
            $file_name = $file1->getClientOriginalName();
           
            $destination = 'storage/uploads/videos/discussions';
            if($discussion->video_url) {
                // unlink($discussion->video_url);
            }
            $file1->move($destination, $file_name);
            $discussion->video_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/videos/discussions/' . $file_name;
        }

        if(!empty($file2)) {
            $file_name = $file2->getClientOriginalName();
           
            $destination = 'storage/uploads/books/discussions';
            if($discussion->book_url) {
                // unlink($discussion->book_url);
            }
            $file2->move($destination, $file_name);
            $discussion->book_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/books/discussions/' . $file_name;
        }

        $discussion->save();

        session()->push('m', 'success');
        session()->push('m', 'تم تعديل المناظرة بنجاح');
        return redirect()->back();

    }

    public function deleteDiscussion(Request $request) {
        $id = json_decode($request->id);
        $discussionP = Discussion::find($id);
        
        $discussions = $discussionP->childrendiscussions()->get();
        
        if($discussions) {
            foreach($discussions as $discussion) {
                if($discussion->book_url) {
                    $book_arr = explode('/', $discussion->book_url);
                    $book_name = end($book_arr);
                    unlink('storage/uploads/books/discussions/' . $book_name);
                }

                if($discussion->video_url) {
                    $video_arr = explode('/', $discussion->video_url);
                    $video_name = end($video_arr);
                    unlink('storage/uploads/videos/discussions/' . $video_name);
                }
                $discussion->delete();
            }
        }
        $discussionP->delete();
        return response()->json(['message'=>'تم حذف المناظرة بنجاح!']);
    }
}
