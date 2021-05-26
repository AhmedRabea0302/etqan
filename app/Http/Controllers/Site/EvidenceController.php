<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Evidence;
use App\EvidenceComment;
use App\AppUser;
use App\Sheikh;
use App\EvidenceReply;
use App\FavoriteSubject;
use App\ReadLater;

use DB;
use Validator;
use Auth;

use Carbon\Carbon;

class EvidenceController extends Controller
{
    public function index() {

        $evidences = Evidence::select('id', 'parent_id','title', 'short_reply')->where('parent_id', '0')->with('childrenEvidences')->get();
        return view('site.pages.evidences.index')->with('evidences', $evidences);
    }

    public function getEvidenceContent($id) {
        $evidence = Evidence::find($id);
        return $evidence;
    }

    // Comments
    public function getEvidenceComments($id) {

        $comments = EvidenceComment::select('id', 'user_id', 'user_type', 'comment', 'created_at')->where('subject_id', $id)->orderBy('created_at', 'ASC')->get();
        foreach($comments as $comment) {
            
            $comment->date = Carbon::parse($comment->created_at)->format('d/m/Y h:m'); 
            if($comment->user_type == 'normal') {
                $user = AppUser::find($comment->user_id);
                $comment->user_name = $user->name;
                $comment->country   = $user->country;
                $comment->city   = $user->city;
                if($user->image_name) {
                    $comment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                }

                $comment->comment_replies =  $this->getReplies($comment->id);
                
            } elseif($comment->user_type =='sheikh') {
                
                $user = Sheikh::find($comment->user_id);
                $comment->user_name = $user->name;
                $comment->country   = $user->country;
                $comment->city   = $user->city;
                if($user->image_name) {
                    $comment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                }

                $comment->comment_replies =  $this->getReplies($comment->id);
            }
            
        }

        if($comments->count()) {
            return $comments;
        } 

    }

    // get Replies 
    public function getReplies($commentId) {
        $replies = EvidenceReply::select('id', 'user_id', 'user_type', 'reply', 'created_at')->where('comment_id', $commentId)->orderBy('created_at', 'ASC')->get();
        if(count($replies)) {
            foreach($replies as $reply) {
                if($reply->user_type == 'normal') {
                    $user = AppUser::find($reply->user_id);
                    $reply->user_name = $user->name;
                    $reply->country   = $user->country;
                    $reply->city   = $user->city;
                    if($user->image_name) {
                        $reply->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                    }
                    if($reply) {
                        // $reply->created_at->format('d M Y');
                        $reply->date = Carbon::parse($reply->created_at)->format('d/m/Y h:m');
                    }
                } elseif($reply->user_type =='sheikh') {
                    $user = Sheikh::find($reply->user_id);
                    $reply->user_name = $user->name;
                    $reply->country   = $user->country;
                    $reply->city   = $user->city;
                    if($user->image_name) {
                        $reply->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                    }
    
                    if($reply) {
                        // $reply->created_at->format('d M Y');
                        $reply->date = Carbon::parse($reply->created_at)->format('d/m/Y h:m'); 
                    }
                }
                
            }
        }
          
        return $replies;

    }

    // ADD COMMENT 
    public function addCommnet(Request $request) {
        $comment = new EvidenceComment();
        $rules = [
            'comment'       => 'required'
        ];        
        $messages = [
            'comment.required'      => 'من فضلك أدخل نص التعليق!',
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()) {
          return response()->json(['message' => $validator->customMessages]);
        }
  
        $comment->subject_id     = $request->subject_id;
        $comment->subject_type   = 'evidences';
        $comment->comment        = $request->comment;
        
        if(auth()->guard('auth-site')->check()) {
            $comment->user_id        = auth()->guard('auth-site')->user()->id;
            $comment->user_type      = 'normal';
        } else {
            $comment->user_id        = auth()->guard('auth-site-sheikh')->user()->id;
            $comment->user_type      = 'sheikh';
        }
        $comment->save();

        if(auth()->guard('auth-site')->check()) {
            $user = AppUser::find($comment->user_id);
            if($user->image_name) {
                $comment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
            }
            $comment->user_name      = $user->name;
            $comment->country   = $user->country;
            $comment->city   = $user->city;
            $comment->date      = Carbon::parse($comment->created_at)->format('d/m/Y h:m');
        } else {
            $user = Sheikh::find($comment->user_id);
            if($user->image_name) {
                $comment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
            }
            $comment->user_name      = $user->name;
            $comment->date      = Carbon::parse($comment->created_at)->format('d/m/Y h:m');
        }
        

        return $comment;
    }

    // ADD REPLY 
    public function addReply(Request $request) {
        $reply = new EvidenceReply();
  
        $reply->subject_id   = $request->subject_id;
        $reply->user_type    = 'normal';
        $reply->subject_type = 'evidences';
        $reply->reply        = $request->reply;
        $reply->user_id      = auth()->guard('auth-site')->user()->id;
        $reply->comment_id   = $request->comment_id;
    
        $reply->save();
        
        $user = AppUser::find($reply->user_id);
        if($user->image_name) {
            $reply->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
        }
        $reply->user_name      = $user->name;
        $reply->country   = $user->country;
        $reply->city   = $user->city;
        $reply->date      = Carbon::parse($reply->created_at)->format('d/m/Y h:m');

        return $reply;
    }

    // Add To Favorite
    public function addToFavorite($id) {
        $user_id = auth()->guard('auth-site')->user()->id;
        $subject_id = number_format($id);
        $checkFav = DB::select('select * from favorite_subjects where(user_id = :user_id AND subject_id = :sub_id AND type = "evidences")', ['user_id' => $user_id, 'sub_id' => $subject_id]);
        if($checkFav) {
            return response()->json(['message' => 'هذا الدليل موجودة بالفعل في قائمة مفضﻻتك!']);
        }
        $fav = new FavoriteSubject();
        $fav->user_id = $user_id;
        $fav->subject_id = $id;
        $fav->type = 'evidences';

        $fav->save();

        return response()->json(['message' => 'تم إضافة الدليل لقائمة مفضﻻتك بنجاح']);
    }

    // Read Later
    public function readLater($id) {
        $user_id = auth()->guard('auth-site')->user()->id;
        $subject_id = number_format($id);
        $readLater = DB::select('select * from read_laters where(user_id = :user_id AND subject_id = :sub_id AND type = "evidences")', ['user_id' => $user_id, 'sub_id' => $subject_id]);
        if($readLater) {
            return response()->json(['message' => 'هذا الدليل موجود بالفعل في قائمة القراءة!']);
        }
        $rLater = new ReadLater();
        $rLater->user_id = $user_id;
        $rLater->subject_id = $id;
        $rLater->type = 'evidences';

        $rLater->save();

        return response()->json(['message' => 'تم إضافة الدليل لقائمة القراءة بنجاح']);
    }


    // Get Evidence Content
    public function getEvidenceContentShare($id) {
        $suspicion = Evidence::find($id);
        $suspicionComments = $this->getEvidenceComments($suspicion->id);

        $suspicion_book = $suspicion->book_url;
        $arr = explode('/', $suspicion_book);
        $book_name = end($arr);
        // dd($suspicionComments);
        return view('site.pages.evidences.evidence-content-share')->
        with(['suspicion' => $suspicion, 'suspicionComments' => $suspicionComments, 'book_name' => $book_name]);
    }

}
