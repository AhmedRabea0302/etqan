<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SuspicionComment;
use App\HotSuspicionComment;
use App\DiscussionComment;
use App\EvidenceComment;
use App\MarsadComment;

use App\SuspicionReply;

use App\AppUser;
use App\Sheikh;
use Validator;
class CommentsController extends Controller
{
    public function getAllComments() {

    }

    public function getAllReplies() {

    }

    public function addComment(Request $request) {
        $suspicionComment    = new SuspicionComment();
        $hotSuspicionComment = new HotSuspicionComment();
        $discussionComment   = new DiscussionComment();
        $evidenceComment     = new EvidenceComment();
        $marsadComment       = new MarsadComment();

        switch($request->subject_type) {
            case 'suspicions':
                $rules = [
                    'subject_id'    => 'required',
                    'user_type'     => 'required',
                    'subject_type'  => 'required',
                    'comment'       => 'required'
                ];        
                $messages = [
                    'subject_id.required'   => 'Subject Id Required',
                    'user_type.required'    => 'User Type required',
                    'subject_type.required' => 'subject Type Required',
                    'user_id.required'      => 'User Id Required',
                    'comment.required'      => 'من فضلك أدخل نص التعليق!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }
          
                $suspicionComment->subject_id     = $request->subject_id;
                $suspicionComment->user_type      = $request->user_type;
                $suspicionComment->subject_type   = $request->subject_type;
                $suspicionComment->comment        = $request->comment;
                $suspicionComment->user_id        = $request->user_id;
            
                $suspicionComment->save();

                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'تم إضافة التعليق بنجاح',
                    'Data' => ['comment_id' => $suspicionComment->id]
                ]);
          
                break;
            case 'hot-suspicions':
                $rules = [
                    'subject_id'    => 'required',
                    'user_type'     => 'required',
                    'subject_type'  => 'required',
                    'comment'       => 'required'
                ];        
                $messages = [
                    'subject_id.required'   => 'Subject Id Required',
                    'user_type.required'    => 'User Type required',
                    'subject_type.required' => 'subject Type Required',
                    'user_id.required'      => 'User Id Required',
                    'comment.required'      => 'من فضلك أدخل نص التعليق!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }
          
                $hotSuspicionComment->subject_id     = $request->subject_id;
                $hotSuspicionComment->user_type      = $request->user_type;
                $hotSuspicionComment->subject_type   = $request->subject_type;
                $hotSuspicionComment->comment        = $request->comment;
                $hotSuspicionComment->user_id        = $request->user_id;
            
                $hotSuspicionComment->save();
          
                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'تم إضافة التعليق بنجاح',
                    'Data' => ['comment_id' => $hotSuspicionComment->id]
                ]);
                break;
            
            case 'discussions':
                $rules = [
                    'subject_id'    => 'required',
                    'user_type'     => 'required',
                    'subject_type'  => 'required',
                    'comment'       => 'required'
                ];        
                $messages = [
                    'subject_id.required'   => 'Subject Id Required',
                    'user_type.required'    => 'User Type required',
                    'subject_type.required' => 'subject Type Required',
                    'user_id.required'      => 'User Id Required',
                    'comment.required'      => 'من فضلك أدخل نص التعليق!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }
          
                $discussionComment->subject_id     = $request->subject_id;
                $discussionComment->user_type      = $request->user_type;
                $discussionComment->subject_type   = $request->subject_type;
                $discussionComment->comment        = $request->comment;
                $discussionComment->user_id        = $request->user_id;
            
                $discussionComment->save();
          
                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'تم إضافة التعليق بنجاح',
                    'Data' => ['comment_id' => $discussionComment->id]
                ]);
                break;
            
            case 'evidences':
                $rules = [
                    'subject_id'    => 'required',
                    'user_type'     => 'required',
                    'subject_type'  => 'required',
                    'comment'       => 'required'
                ];        
                $messages = [
                    'subject_id.required'   => 'Subject Id Required',
                    'user_type.required'    => 'User Type required',
                    'subject_type.required' => 'subject Type Required',
                    'user_id.required'      => 'User Id Required',
                    'comment.required'      => 'من فضلك أدخل نص التعليق!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }
          
                $evidenceComment->subject_id     = $request->subject_id;
                $evidenceComment->user_type      = $request->user_type;
                $evidenceComment->subject_type   = $request->subject_type;
                $evidenceComment->comment        = $request->comment;
                $evidenceComment->user_id        = $request->user_id;
            
                $evidenceComment->save();
          
                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'تم إضافة التعليق بنجاح',
                    'Data' => ['comment_id' => $evidenceComment->id]
                ]);
                break;

            case 'marsads':
                $rules = [
                    'subject_id'    => 'required',
                    'user_type'     => 'required',
                    'subject_type'  => 'required',
                    'comment'       => 'required'
                ];        
                $messages = [
                    'subject_id.required'   => 'Subject Id Required',
                    'user_type.required'    => 'User Type required',
                    'subject_type.required' => 'subject Type Required',
                    'user_id.required'      => 'User Id Required',
                    'comment.required'      => 'من فضلك أدخل نص التعليق!',
                ];
            
                $validator = Validator::make($request->all(), $rules, $messages);
            
                if($validator->fails()) {
                    return response()->json(['message' => $validator->customMessages]);
                }
            
                $marsadComment->subject_id     = $request->subject_id;
                $marsadComment->user_type      = $request->user_type;
                $marsadComment->subject_type   = $request->subject_type;
                $marsadComment->comment        = $request->comment;
                $marsadComment->user_id        = $request->user_id;
            
                $marsadComment->save();
            
                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'تم إضافة التعليق بنجاح',
                    'Data' => ['comment_id' => $marsadComment->id]
                ]);
                break;
                
            default:    
                return response()->json(['message' => 'أدخل نوع صحيح'], 400);
        }

    }

    public function getSubjectComments($subject_type, $subject_id) {

        switch($subject_type) {
            case 'evidences': 
                $evidenceComments = EvidenceComment::select('id', 'user_id', 'user_type', 'comment', 'created_at')->where('subject_id', $subject_id)->orderBy('created_at', 'ASC')->get();
                foreach($evidenceComments as $evidenceComment) {
                    if($evidenceComment->user_type == 'normal') {
                        $user = AppUser::find($evidenceComment->user_id);
                        $evidenceComment->user_name = $user->name;
                        if($user->image_name) {
                            $evidenceComment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                        }
                    } elseif($evidenceComment->user_type =='sheikh') {
                        $user = Sheikh::find($evidenceComment->user_id);
                        $evidenceComment->user_name = $user->name;
                        if($user->image_name) {
                            $evidenceComment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                        }
                    }
                    
                }
                if($evidenceComments->count()) {
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => '',
                        'Data' => $evidenceComments
                    ]);
                }

                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'لا توجد تعليقات على هذا الموضوع',
                    'Data' => []
                ]);

                break;

            case 'suspicions': 
                $suspicionComments = SuspicionComment::select('id', 'user_id', 'user_type', 'comment', 'created_at')->where('subject_id', $subject_id)->orderBy('created_at', 'ASC')->get();
                foreach($suspicionComments as $suspicionComment) {
                    if($suspicionComment->user_type == 'normal') {
                        $user = AppUser::find($suspicionComment->user_id);
                        $suspicionComment->user_name = $user->name;
                        if($user->image_name) {
                            $suspicionComment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                        }
                    } elseif($suspicionComment->user_type =='sheikh') {
                        $user = Sheikh::find($suspicionComment->user_id);
                        $suspicionComment->user_name = $user->name;
                        if($user->image_name) {
                            $suspicionComment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                        }
                    }
                    
                }
                if($suspicionComments->count()) {
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => '',
                        'Data' => $suspicionComments
                    ]);
                } else {
                    return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'لا توجد تعليقات على هذا الموضوع',
                    'Data' => []
                ]);
                }
                break;

            case 'hot-suspicions': 
                $hotSuspicionComments = HotSuspicionComment::select('id', 'user_id', 'user_type', 'comment', 'created_at')->where('subject_id', $subject_id)->orderBy('created_at', 'ASC')->get();
                foreach($hotSuspicionComments as $hotSuspicionComment) {
                    if($hotSuspicionComment->user_type == 'normal') {
                        $user = AppUser::find($hotSuspicionComment->user_id);
                        $hotSuspicionComment->user_name = $user->name;
                        if($user->image_name) {
                            $hotSuspicionComment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                        }
                    } elseif($hotSuspicionComment->user_type =='sheikh') {
                        $user = Sheikh::find($hotSuspicionComment->user_id);
                        $hotSuspicionComment->user_name = $user->name;
                        if($user->image_name) {
                            $hotSuspicionComment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                        }
                    }
                    
                }
                if($hotSuspicionComments->count()) {
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => '',
                        'Data' => $hotSuspicionComments
                    ]);
                }
                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'لا توجد تعليقات على هذا الموضوع',
                    'Data' => []
                ]);
                break;

            case 'discussions': 
                $discussionComments = DiscussionComment::select('id', 'user_id', 'user_type', 'comment', 'created_at')->where('subject_id', $subject_id)->orderBy('created_at', 'ASC')->get();
                foreach($discussionComments as $discussionComment) {
                    if($discussionComment->user_type == 'normal') {
                        $user = AppUser::find($discussionComment->user_id);
                        $discussionComment->user_name = $user->name;
                        if($user->image_name) {
                            $discussionComment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                        }
                    } elseif($discussionComment->user_type =='sheikh') {
                        $user = Sheikh::find($discussionComment->user_id);
                        $discussionComment->user_name = $user->name;
                        if($user->image_name) {
                            $discussionComment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                        }
                    }
                    
                }
                if($discussionComments->count()) {
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => '',
                        'Data' => $discussionComments
                    ]);
                }
                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'لا توجد تعليقات على هذا الموضوع',
                    'Data' => []
                ]);
                break;

            case 'marsads': 
                $marsadComments = MarsadComment::select('id', 'user_id', 'user_type', 'comment', 'created_at')->where('subject_id', $subject_id)->orderBy('created_at', 'ASC')->get();
                foreach($marsadComments as $marsadComment) {
                    if($marsadComment->user_type == 'normal') {
                        $user = AppUser::find($marsadComment->user_id);
                        $marsadComment->user_name = $user->name;
                        if($user->image_name) {
                            $marsadComment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                        }
                    } elseif($marsadComment->user_type =='sheikh') {
                        $user = Sheikh::find($marsadComment->user_id);
                        $marsadComment->user_name = $user->name;
                        if($user->image_name) {
                            $marsadComment->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                        }
                    }
                    
                }
                if($marsadComments->count()) {
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => '',
                        'Data' => $marsadComments
                    ]);
                }

                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'لا توجد تعليقات على هذا الموضوع',
                    'Data' => []
                ]);
                break;
            
            default:
            return response()->json([
                'Success'=> false,
                'Code'=> 400,
                'Message' => 'من فضلك أدخل موضوع صحيح',
                'Data' => null
            ]);
            break;
        }
       
    } 

    public function updateComment(Request $request) {
        $suspicionComment    = SuspicionComment::find($request->comment_id);
        $hotSuspicionComment = HotSuspicionComment::find($request->comment_id);
        $discussionComment   = DiscussionComment::find($request->comment_id);
        $evidenceComment     = EvidenceComment::find($request->comment_id);
        $marsadComment       = MarsadComment::find($request->comment_id);

        switch($request->subject_type) {
            case 'suspicions':
                $rules = [
                    'comment_id'    => 'required',
                    'subject_type'  => 'required',
                    'comment'       => 'required'
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'comment_id.required'      => 'Comment Id Required',
                    'comment.required'      => 'من فضلك أدخل نص التعليق!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }

                if($suspicionComment) {
                    $suspicionComment->comment        = $request->comment;
                    $suspicionComment->update();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم تعديل التعليق بنجاح',
                        'Data' => ['comment_id' => $suspicionComment->id]
                    ]);
                } else {
                    return response()->json([
                        'Success'=> false,
                        'Code'=> 400,
                        'Message' => 'Invalid Comment ID',
                        'Data' => null
                    ]);
                }
                break;
            case 'hot-suspicions':
                $rules = [
                    'comment_id'    => 'required',
                    'subject_type'  => 'required',
                    'comment'       => 'required'
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'comment_id.required'      => 'Comment Id Required',
                    'comment.required'      => 'من فضلك أدخل نص التعليق!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }

                if($hotSuspicionComment) {
                    $hotSuspicionComment->comment        = $request->comment;
                    $hotSuspicionComment->update();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم تعديل التعليق بنجاح',
                        'Data' => ['comment_id' => $hotSuspicionComment->id]
                    ]);
                } else {
                    return response()->json([
                        'Success'=> false,
                        'Code'=> 400,
                        'Message' => 'Invalid Comment ID',
                        'Data' => null
                    ]);
                }
          
                break;
            
            case 'discussions':
                $rules = [
                    'comment_id'    => 'required',
                    'subject_type'  => 'required',
                    'comment'       => 'required'
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'comment_id.required'      => 'Comment Id Required',
                    'comment.required'      => 'من فضلك أدخل نص التعليق!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }

                if($discussionComment) {
                    $discussionComment->comment        = $request->comment;
                    $discussionComment->update();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم تعديل التعليق بنجاح',
                        'Data' => ['comment_id' => $discussionComment->id]
                    ]); 
                } else {
                    return response()->json([
                        'Success'=> false,
                        'Code'=> 400,
                        'Message' => 'Invalid Comment ID',
                        'Data' => null
                    ]); 
                }

                break;

            case 'evidences':
                $rules = [
                    'comment_id'    => 'required',
                    'subject_type'  => 'required',
                    'comment'       => 'required'
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'comment_id.required'      => 'Comment Id Required',
                    'comment.required'      => 'من فضلك أدخل نص التعليق!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                    return response()->json(['message' => $validator->customMessages]);
                }

                if($evidenceComment) {
                    $evidenceComment->comment        = $request->comment;
                    $evidenceComment->update();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم تعديل التعليق بنجاح',
                        'Data' => ['comment_id' => $evidenceComment->id]
                    ]);
                } else {
                    return response()->json([
                        'Success'=> false,
                        'Code'=> 400,
                        'Message' => 'Invalid Comment ID',
                        'Data' => null
                    ]);
                }
                
                break;

            case 'marsads':
                $rules = [
                    'comment_id'    => 'required',
                    'subject_type'  => 'required',
                    'comment'       => 'required'
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'comment_id.required'      => 'Comment Id Required',
                    'comment.required'      => 'من فضلك أدخل نص التعليق!',
                ];
            
                $validator = Validator::make($request->all(), $rules, $messages);
            
                if($validator->fails()) {
                    return response()->json(['message' => $validator->customMessages]);
                }

                if($marsadComment) {
                    $marsadComment->comment        = $request->comment;
                    $marsadComment->update();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم تعديل التعليق بنجاح',
                        'Data' => ['comment_id' => $marsadComment->id]
                    ]);
                } else {
                    return response()->json([
                        'Success'=> false,
                        'Code'=> 400,
                        'Message' => 'Invalid Comment ID',
                        'Data' => null
                    ]); 
                }
                
                break;

                    
            default:    
                return response()->json([
                    'Success'=> false,
                    'Code'=> 400,
                    'Message' => 'من فضلك أدخل نوع صحيح',
                    'Data' => null
                ]);
        }

    }

    public function deleteComment(Request $request) {
        $type = $request->subject_type;
        switch($type) {
            case 'suspicions':
                $rules = [
                    'comment_id'    => 'required',
                    'subject_type'  => 'required',
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'comment_id.required'      => 'comment Id Required',
                ];
                $comment = SuspicionComment::find($request->comment_id);
                if($comment->commentReplies()->count()) {
                    foreach($comment->commentReplies as $reply) {
                        $reply->delete();
                    }
                    $comment->delete();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم حذف التعليق بنجاح',
                        'Data' => ['comment_id' => $comment->id]
                    ]);
                }
                break;

            case 'hot-suspicions':
                $rules = [
                    'comment_id'    => 'required',
                    'subject_type'  => 'required',
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'comment_id.required'      => 'comment Id Required',
                ];
                $comment = HotSuspicionComment::find($request->comment_id);
                if($comment->commentReplies()->count()) {
                    foreach($comment->commentReplies as $reply) {
                        $reply->delete();
                    }
                    $comment->delete();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم حذف التعليق بنجاح',
                        'Data' => ['comment_id' => $comment->id]
                    ]);
                }
                break;

            case 'discussions':
                $rules = [
                    'comment_id'    => 'required',
                    'subject_type'  => 'required',
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'comment_id.required'      => 'comment Id Required',
                ];
                $comment = DiscussionComment::find($request->comment_id);
                if($comment->commentReplies()->count()) {
                    foreach($comment->commentReplies as $reply) {
                        $reply->delete();
                    }
                    $comment->delete();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم حذف التعليق بنجاح',
                        'Data' => ['comment_id' => $comment->id]
                    ]);
                }
                break;
            case 'evidences':
                $rules = [
                    'comment_id'    => 'required',
                    'subject_type'  => 'required',
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'comment_id.required'      => 'comment Id Required',
                ];
                $comment = EvidenceComment::find($request->comment_id);
                if($comment->commentReplies()->count()) {
                    foreach($comment->commentReplies as $reply) {
                        $reply->delete();
                    }
                    $comment->delete();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم حذف التعليق بنجاح',
                        'Data' => ['comment_id' => $comment->id]
                    ]);
                }
                break;

            case 'marsads':
                $rules = [
                    'comment_id'    => 'required',
                    'subject_type'  => 'required',
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'comment_id.required'      => 'comment Id Required',
                ];
                $comment = MarsadComment::find($request->comment_id);
                if($comment->commentReplies()->count()) {
                    foreach($comment->commentReplies as $reply) {
                        $reply->delete();
                    }
                    $comment->delete();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم حذف التعليق بنجاح',
                        'Data' => ['comment_id' => $comment->id]
                    ]);
                }
                break;
            
    
            default:
                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'من فضلك أدخل نوع صحيح',
                    'Data' => null
                ]);
        }
    }
    
}
