<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Suspicion;
use App\SuspicionComment;
use App\AppUser;
use App\Sheikh;
use App\SuspicionReply;
use Validator;
use App\FavoriteSubject;
use App\ReadLater;
use Auth;
use DB;


use Carbon\Carbon;
use Storage;

class HomeController extends Controller
{
    public function index() {

        $suspicions = Suspicion::select('id', 'parent_id','suspicion', 'short_reply')->where('parent_id', '0')->with('childrenSuspicions')->get();
        return view('site.pages.suspicions.index')->with('suspicions', $suspicions);
    }

    public function getSuspicionContent($id) {
        $suspicion = Suspicion::find($id);
        return $suspicion;
    }

    // Comments
    public function getSuspicionComments($id) {

        $comments = SuspicionComment::select('id', 'user_id', 'user_type', 'comment', 'created_at')->where('subject_id', $id)->orderBy('created_at', 'ASC')->get();
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
        $replies = SuspicionReply::select('id', 'user_id', 'user_type', 'reply', 'created_at')->where('comment_id', $commentId)->orderBy('created_at', 'ASC')->get();
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
        $comment = new SuspicionComment();
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
        $comment->user_type      = 'normal';
        $comment->subject_type   = 'suspicions';
        $comment->comment        = $request->comment;
        $comment->user_id        = auth()->guard('auth-site')->user()->id;
    
        $comment->save();
        
        $user = AppUser::find($comment->user_id);
        if($user->image_name) {
            $comment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
        }
        $comment->user_name = $user->name;
        $comment->country   = $user->country;
        $comment->city      = $user->city;
        $comment->date      = Carbon::parse($comment->created_at)->format('d/m/Y h:m');

        return $comment;
    }

    // ADD REPLY 
    public function addReply(Request $request) {
        $reply = new SuspicionReply();
        
        $reply->subject_id   = $request->subject_id;
        $reply->user_type    = 'normal';
        $reply->subject_type = 'suspicions';
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
        $reply->city      = $user->city;
        $reply->date      = Carbon::parse($reply->created_at)->format('d/m/Y h:m');

        return $reply;
    }

    // Add To Favorite
    public function addToFavorite($id) {
        $user_id = auth()->guard('auth-site')->user()->id;
        $subject_id = number_format($id);
        $checkFav = DB::select('select * from favorite_subjects where(user_id = :user_id AND subject_id = :sub_id AND type = "suspicions")', ['user_id' => $user_id, 'sub_id' => $subject_id]);
        if($checkFav) {
            return response()->json(['message' => 'هذه الشبهة موجودة بالفعل في قائمة مفضﻻتك!']);
        }
        $fav = new FavoriteSubject();
        $fav->user_id = $user_id;
        $fav->subject_id = $id;
        $fav->type = 'suspicions';

        $fav->save();

        return response()->json(['message' => 'تم إضافة الشبهة لقائمة مفضﻻتك بنجاح']);
    }

    // Read Later
    public function readLater($id) {
        $user_id = auth()->guard('auth-site')->user()->id;
        $subject_id = number_format($id);
        $readLater = DB::select('select * from read_laters where(user_id = :user_id AND subject_id = :sub_id AND type = "suspicions")', ['user_id' => $user_id, 'sub_id' => $subject_id]);
        if($readLater) {
            return response()->json(['message' => 'هذه الشبهة موجودة بالفعل في قائمة القراءة!']);
        }
        $rLater = new ReadLater();
        $rLater->user_id = $user_id;
        $rLater->subject_id = $id;
        $rLater->type = 'suspicions';

        $rLater->save();

        return response()->json(['message' => 'تم إضافة الشبهة لقائمة القراءة بنجاح']);
    }

    // Get Suspicion Content
    public function getSuspicionContentShare($id) {
        $suspicion = Suspicion::find($id);
        $suspicionComments = $this->getSuspicionComments($suspicion->id);

        $suspicion_book = $suspicion->book_url;
        $arr = explode('/', $suspicion_book);
        $book_name = end($arr);
        // dd($suspicionComments);
        return view('site.pages.suspicions.suspicion-content-share')->
        with(['suspicion' => $suspicion, 'suspicionComments' => $suspicionComments, 'book_name' => $book_name]);
    }

    public function downloadVideo() {
        $headers = [
            'Content-Type' => 'application/mp4'
        ];
        return Storage::download(url('/storage/uploads/videos/suspicions/1625460602.mp4'), 'Hom');
    }

    // Contact Us Page

    public function contactUs() {

        return view('site.pages.contactus');
    }
}
