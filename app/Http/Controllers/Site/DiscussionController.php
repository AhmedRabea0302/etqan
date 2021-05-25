<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Discussion;
use App\DiscussionComment;
use App\AppUser;
use App\Sheikh;
use App\DiscussionReply;
use App\FavoriteSubject;
use App\ReadLater;

use DB;
use Validator;
use Auth;

use Carbon\Carbon;

class DiscussionController extends Controller
{
    public function index() {

        $discussions = Discussion::select('id', 'parent_id','title', 'short_reply')->where('parent_id', '0')->with('childrenDiscussions')->get();
        return view('site.pages.discussions.index')->with('discussions', $discussions);
    }

    public function getDiscussionContent($id) {
        $suspicion = Discussion::find($id);
        return $suspicion;
    }

    // Comments
    public function getDiscussionComments($id) {

        $comments = DiscussionComment::select('id', 'user_id', 'user_type', 'comment', 'created_at')->where('subject_id', $id)->orderBy('created_at', 'ASC')->get();
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
        $replies = DiscussionReply::select('id', 'user_id', 'user_type', 'reply', 'created_at')->where('comment_id', $commentId)->orderBy('created_at', 'ASC')->get();
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
        $comment = new DiscussionComment();
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
        $comment->subject_type   = 'discussions';
        $comment->comment        = $request->comment;
        $comment->user_id        = auth()->guard('auth-site')->user()->id;
    
        $comment->save();
        
        $user = AppUser::find($comment->user_id);
        if($user->image_name) {
            $comment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
        }
        $comment->user_name      = $user->name;
        $comment->country   = $user->country;
        $comment->city   = $user->city;
        $comment->date      = Carbon::parse($comment->created_at)->format('d/m/Y h:m');

        return $comment;
    }

    // ADD REPLY 
    public function addReply(Request $request) {
        $reply = new DiscussionReply();
  
        $reply->subject_id   = $request->subject_id;
        $reply->user_type    = 'normal';
        $reply->subject_type = 'discussions';
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
        $checkFav = DB::select('select * from favorite_subjects where(user_id = :user_id AND subject_id = :sub_id AND type = "discussions")', ['user_id' => $user_id, 'sub_id' => $subject_id]);
        if($checkFav) {
            return response()->json(['message' => 'هذه المناظرة موجودة بالفعل في قائمة مفضﻻتك!']);
        }
        $fav = new FavoriteSubject();
        $fav->user_id = $user_id;
        $fav->subject_id = $id;
        $fav->type = 'discussions';

        $fav->save();

        return response()->json(['message' => 'تم إضافة المناظرة لقائمة مفضﻻتك بنجاح']);
    }

    // Read Later
    public function readLater($id) {
        $user_id = auth()->guard('auth-site')->user()->id;
        $subject_id = number_format($id);
        $readLater = DB::select('select * from read_laters where(user_id = :user_id AND subject_id = :sub_id AND type = "discussions")', ['user_id' => $user_id, 'sub_id' => $subject_id]);
        if($readLater) {
            return response()->json(['message' => 'هذه المناظرة موجود بالفعل في قائمة القراءة!']);
        }
        $rLater = new ReadLater();
        $rLater->user_id = $user_id;
        $rLater->subject_id = $id;
        $rLater->type = 'discussions';

        $rLater->save();

        return response()->json(['message' => 'تم إضافة المناظرة لقائمة القراءة بنجاح']);
    }

    // Get Discussion Content
    public function getDiscussionContentShare($id) {
        $discussion = Discussion::find($id);
        $discussionComments = $this->getDiscussionComments($discussion->id);

        $suspicion_book = $discussion->book_url;
        $arr = explode('/', $suspicion_book);
        $book_name = end($arr);
        // dd($suspicionComments);
        return view('site.pages.discussions.discussion-content-share')->
        with(['discussion' => $discussion, 'discussionComments' => $discussionComments, 'book_name' => $book_name]);
    }

}
