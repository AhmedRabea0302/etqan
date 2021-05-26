<?php

namespace App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuspicionReply;
use App\HotSuspicionReply;
use App\DiscussionReply;
use App\EvidenceReply;
use App\MarsadReply;
use App\AppUser;
use App\Sheikh;
use Validator;
class RepliesController extends Controller
{
    public function addReply(Request $request) {
        $suspicionReply    = new SuspicionReply();
        $hotSuspicionReply = new HotSuspicionReply();
        $discussionReply   = new DiscussionReply();
        $evidenceReply     = new EvidenceReply();
        $marsadReply       = new MarsadReply();
        // dd($request->all());
        switch($request->subject_type) {
            case 'suspicions':
                $rules = [
                    'subject_id'    => 'required',
                    'comment_id'    => 'required',
                    'user_type'     => 'required',
                    'subject_type'  => 'required',
                    'reply'         => 'required'
                ];        
                $messages = [
                    'subject_id.required'   => 'Subject Id Required',
                    'comment_id.required'   => 'Comment Id Required',
                    'user_type.required'    => 'User Type required',
                    'subject_type.required' => 'subject Type Required',
                    'user_id.required'      => 'User Id Required',
                    'reply.required'      => 'من فضلك أدخل نص الرد!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }
          
                $suspicionReply->subject_id     = $request->subject_id;
                $suspicionReply->comment_id     = $request->comment_id;
                $suspicionReply->user_type      = $request->user_type;
                $suspicionReply->subject_type   = $request->subject_type;
                $suspicionReply->reply        = $request->reply;
                $suspicionReply->user_id        = $request->user_id;
            
                $suspicionReply->save();

                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'تم إضافة الرد بنجاح',
                    'Data' => ['reply_id' => $suspicionReply->id]
                ]);
          
                break;

            case 'hot-suspicions':
                $rules = [
                    'subject_id'    => 'required',
                    'comment_id'    => 'required',
                    'user_type'     => 'required',
                    'subject_type'  => 'required',
                    'reply'         => 'required'
                ];        
                $messages = [
                    'subject_id.required'   => 'Subject Id Required',
                    'comment_id.required'   => 'Comment Id Required',
                    'user_type.required'    => 'User Type required',
                    'subject_type.required' => 'subject Type Required',
                    'user_id.required'      => 'User Id Required',
                    'reply.required'      => 'من فضلك أدخل نص الرد!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }
          
                $hotSuspicionReply->subject_id     = $request->subject_id;
                $hotSuspicionReply->comment_id     = $request->comment_id;
                $hotSuspicionReply->user_type      = $request->user_type;
                $hotSuspicionReply->subject_type   = $request->subject_type;
                $hotSuspicionReply->reply        = $request->reply;
                $hotSuspicionReply->user_id        = $request->user_id;
            
                $hotSuspicionReply->save();

                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'تم إضافة الرد بنجاح',
                    'Data' => ['reply_id' => $hotSuspicionReply->id]
                ]);

                break;
            
            case 'discussions':
                $rules = [
                    'subject_id'    => 'required',
                    'comment_id'    => 'required',
                    'user_type'     => 'required',
                    'subject_type'  => 'required',
                    'reply'         => 'required'
                ];        
                $messages = [
                    'subject_id.required'   => 'Subject Id Required',
                    'comment_id.required'   => 'Comment Id Required',
                    'user_type.required'    => 'User Type required',
                    'subject_type.required' => 'subject Type Required',
                    'user_id.required'      => 'User Id Required',
                    'reply.required'      => 'من فضلك أدخل نص الرد!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }
          
                $discussionReply->subject_id     = $request->subject_id;
                $discussionReply->comment_id     = $request->comment_id;
                $discussionReply->user_type      = $request->user_type;
                $discussionReply->subject_type   = $request->subject_type;
                $discussionReply->reply          = $request->reply;
                $discussionReply->user_id        = $request->user_id;
            
                $discussionReply->save();

                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'تم إضافة الرد بنجاح',
                    'Data' => ['reply_id' => $discussionReply->id]
                ]);
          
                break;

            case 'evidences':
                 $rules = [
                    'subject_id'    => 'required',
                    'comment_id'    => 'required',
                    'user_type'     => 'required',
                    'subject_type'  => 'required',
                    'reply'         => 'required'
                ];        
                $messages = [
                    'subject_id.required'   => 'Subject Id Required',
                    'comment_id.required'   => 'Comment Id Required',
                    'user_type.required'    => 'User Type required',
                    'subject_type.required' => 'subject Type Required',
                    'user_id.required'      => 'User Id Required',
                    'reply.required'      => 'من فضلك أدخل نص الرد!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }
          
                $evidenceReply->subject_id     = $request->subject_id;
                $evidenceReply->comment_id     = $request->comment_id;
                $evidenceReply->user_type      = $request->user_type;
                $evidenceReply->subject_type   = $request->subject_type;
                $evidenceReply->reply        = $request->reply;
                $evidenceReply->user_id        = $request->user_id;
            
                $evidenceReply->save();
          
                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'تم إضافة الرد بنجاح',
                    'Data' => ['reply_id' => $evidenceReply->id]
                ]);

                break;


            case 'marsads':
                $rules = [
                    'subject_id'    => 'required',
                    'comment_id'    => 'required',
                    'user_type'     => 'required',
                    'subject_type'  => 'required',
                    'reply'         => 'required'
                ];        
                $messages = [
                    'subject_id.required'   => 'Subject Id Required',
                    'comment_id.required'   => 'Comment Id Required',
                    'user_type.required'    => 'User Type required',
                    'subject_type.required' => 'subject Type Required',
                    'user_id.required'      => 'User Id Required',
                    'reply.required'      => 'من فضلك أدخل نص الرد!',
                ];
            
                $validator = Validator::make($request->all(), $rules, $messages);
            
                if($validator->fails()) {
                    return response()->json(['message' => $validator->customMessages]);
                }
            
                $marsadReply->subject_id     = $request->subject_id;
                $marsadReply->comment_id     = $request->comment_id;
                $marsadReply->user_type      = $request->user_type;
                $marsadReply->subject_type   = $request->subject_type;
                $marsadReply->reply          = $request->reply;
                $marsadReply->user_id        = $request->user_id;
            
                $marsadReply->save();
            
                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'تم إضافة الرد بنجاح',
                    'Data' => ['reply_id' => $marsadReply->id]
                ]);

                break;
    
            default:    
                return response()->json([
                    'Success'=> false,
                    'Code'=> 400,
                    'Message' => 'أدخل نوع صحيح',
                    'Data' => null
                ]);
        }

    }

    public function getCommentReplies($subject_type, $comment_id) {
        switch($subject_type) {
            case 'evidences': 
                $evidenceReplies = EvidenceReply::select('id', 'user_id', 'user_type', 'reply', 'created_at')->where('comment_id', $comment_id)->orderBy('created_at', 'ASC')->get();
                foreach($evidenceReplies as $evidenceReplie) {
                    if($evidenceReplie->user_type == 'normal') {
                        $user = AppUser::find($evidenceReplie->user_id);
                        $evidenceReplie->user_name = $user->name;
                        if($user->image_name) {
                            $evidenceReplie->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                        }
                        $evidenceReplie->created_at->format('d M Y');
                    } elseif($evidenceReplie->user_type =='sheikh') {
                        $user = Sheikh::find($evidenceReplie->user_id);
                        $evidenceReplie->user_name = $user->name;
                        if($user->image_name) {
                            $evidenceReplie->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                        }

                        $evidenceReplie->created_at->format('d M Y');
                    }
                    
                }
                if($evidenceReplies->count()) {

                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => '',
                        'Data' => $evidenceReplies
                    ]);

                }
                
                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'لا توجد ردود على هذا التعليق',
                    'Data' => []
                ]);
                break;

            case 'suspicions': 
                $suspicionReplies = SuspicionReply::select('id', 'user_id', 'user_type', 'reply', 'created_at')->where('comment_id', $comment_id)->orderBy('created_at', 'ASC')->get();
                foreach($suspicionReplies as $suspicionReplie) {
                    if($suspicionReplie->user_type == 'normal') {
                        $user = AppUser::find($suspicionReplie->user_id);
                        $suspicionReplie->user_name = $user->name;
                        if($user->image_name) {
                            $suspicionReplie->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                        }
                        $suspicionReplie->created_at->format('d M Y');
                    } elseif($suspicionReplie->user_type =='sheikh') {
                        $user = Sheikh::find($suspicionReplie->user_id);
                        $suspicionReplie->user_name = $user->name;
                        if($user->image_name) {
                            $suspicionReplie->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                        }

                        $suspicionReplie->created_at->format('d M Y');
                    }
                    
                }
                if($suspicionReplies->count()) {

                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => '',
                        'Data' => $suspicionReplies
                    ]);

                }

                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'لا توجد ردود على هذا التعليق',
                    'Data' => []
                ]);
                break;

            case 'hot-suspicions': 
                $hotSuspicionReplies = HotSuspicionReply::select('id', 'user_id', 'user_type', 'reply', 'created_at')->where('comment_id', $comment_id)->orderBy('created_at', 'ASC')->get();
                foreach($hotSuspicionReplies as $hotSuspicionReplie) {
                    if($hotSuspicionReplie->user_type == 'normal') {
                        $user = AppUser::find($hotSuspicionReplie->user_id);
                        $hotSuspicionReplie->user_name = $user->name;
                        if($user->image_name) {
                            $hotSuspicionReplie->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                        }
                        $hotSuspicionReplie->created_at->format('d M Y');
                    } elseif($hotSuspicionReplie->user_type =='sheikh') {
                        $user = Sheikh::find($hotSuspicionReplie->user_id);
                        $hotSuspicionReplie->user_name = $user->name;
                        if($user->image_name) {
                            $hotSuspicionReplie->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                        }

                        $hotSuspicionReplie->created_at->format('d M Y');
                    }
                    
                }
                if($hotSuspicionReplies->count()) {

                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => '',
                        'Data' => $hotSuspicionReplies
                    ]);

                }

                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'لا توجد ردود على هذا التعليق',
                    'Data' => []
                ]);
                break;

            case 'discussions': 
                $discussionReplies = DiscussionReply::select('id', 'user_id', 'user_type', 'reply', 'created_at')->where('comment_id', $comment_id)->orderBy('created_at', 'ASC')->get();
                foreach($discussionReplies as $discussionReplie) {
                    if($discussionReplie->user_type == 'normal') {
                        $user = AppUser::find($discussionReplie->user_id);
                        $discussionReplie->user_name = $user->name;
                        if($user->image_name) {
                            $discussionReplie->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                        }
                        $discussionReplie->created_at->format('d M Y');
                    } elseif($discussionReplie->user_type =='sheikh') {
                        $user = Sheikh::find($discussionReplie->user_id);
                        $discussionReplie->user_name = $user->name;
                        if($user->image_name) {
                            $discussionReplie->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                        }

                        $discussionReplie->created_at->format('d M Y');
                    }
                    
                }
                if($discussionReplies->count()) {

                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => '',
                        'Data' => $discussionReplies
                    ]);

                }

                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'لا توجد ردود على هذا التعليق',
                    'Data' => []
                ]);
                break;

            case 'marsads': 
                $marsadReplies = MarsadReply::select('id', 'user_id', 'user_type', 'reply', 'created_at')->where('comment_id', $comment_id)->orderBy('created_at', 'ASC')->get();
                foreach($marsadReplies as $marsadReply) {
                    if($marsadReply->user_type == 'normal') {
                        $user = AppUser::find($marsadReply->user_id);
                        $marsadReply->user_name = $user->name;
                        if($user->image_name) {
                            $marsadReply->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/app_users/' . $user->image_name;
                        }
                        $marsadReply->created_at->format('d M Y');
                    } elseif($marsadReply->user_type =='sheikh') {
                        $user = Sheikh::find($marsadReply->user_id);
                        $marsadReply->user_name = $user->name;
                        if($user->image_name) {
                            $marsadReply->image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/sheikhs/' . $user->image_name;
                        }

                        $marsadReply->created_at->format('d M Y');
                    }
                    
                }
                if($marsadReplies->count()) {
                    
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => '',
                        'Data' => $marsadReplies
                    ]);

                }

                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'لا توجد ردود على هذا التعليق',
                    'Data' => []
                ]);
                break;
  
            default:
                return response()->json([
                    'Success'=> false,
                    'Code'=> 400,
                    'Message' => 'أدخل نوع صحيح',
                    'Data' => null
                ]);
                break;
        }
    }

    public function updateReply(Request $request) {
        $suspicionReply    = SuspicionReply::find($request->reply_id);
        $hotSuspicionReply = HotSuspicionReply::find($request->reply_id);
        $discussionReply   = DiscussionReply::find($request->reply_id);
        $evidenceReply     = EvidenceReply::find($request->reply_id);
        $marsadReply       = MarsadReply::find($request->reply_id);

        switch($request->subject_type) {
            case 'suspicions':
                $rules = [
                    'reply_id'    => 'required',
                    'subject_type'  => 'required',
                    'reply'       => 'required'
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'reply_id.required'      => 'reply Id Required',
                    'reply.required'      => 'من فضلك أدخل نص الرد!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }

                if($suspicionReply) {
                    $suspicionReply->reply        = $request->reply;
                    $suspicionReply->update();

                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم تعديل الرد بنجاح',
                        'Data' => ['reply_id' => $suspicionReply->id]
                    ]);

                } else {
                    return response()->json([
                        'Success'=> false,
                        'Code'=> 400,
                        'Message' => 'Invalid Reply ID',
                        'Data' => null
                    ]);
                }
                break;
            case 'hot-suspicions':
                $rules = [
                    'reply_id'    => 'required',
                    'subject_type'  => 'required',
                    'reply'       => 'required'
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'reply_id.required'      => 'reply Id Required',
                    'reply.required'      => 'من فضلك أدخل نص الرد!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }

                if($hotSuspicionReply) {
                    $hotSuspicionReply->reply        = $request->reply;
                    $hotSuspicionReply->update();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم تعديل الرد بنجاح',
                        'Data' => ['reply_id' => $hotSuspicionReply->id]
                    ]);

                } else {
                    return response()->json([
                        'Success'=> false,
                        'Code'=> 400,
                        'Message' => 'Invalid Reply ID',
                        'Data' => null
                    ]);
                }
                break;  
            case 'discussions':
                $rules = [
                    'reply_id'    => 'required',
                    'subject_type'  => 'required',
                    'reply'       => 'required'
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'reply_id.required'      => 'reply Id Required',
                    'reply.required'      => 'من فضلك أدخل نص الرد!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }

                if($discussionReply) {
                    $discussionReply->reply        = $request->reply;
                    $discussionReply->update();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم تعديل الرد بنجاح',
                        'Data' => ['reply_id' => $discussionReply->id]
                    ]);

                } else {
                    return response()->json([
                        'Success'=> false,
                        'Code'=> 400,
                        'Message' => 'Invalid Reply ID',
                        'Data' => false
                    ]);
                }
                break;  

            case 'evidences':
                $rules = [
                    'reply_id'    => 'required',
                    'subject_type'  => 'required',
                    'reply'       => 'required'
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'reply_id.required'      => 'reply Id Required',
                    'reply.required'      => 'من فضلك أدخل نص الرد!',
                ];
          
                $validator = Validator::make($request->all(), $rules, $messages);
          
                if($validator->fails()) {
                  return response()->json(['message' => $validator->customMessages]);
                }

                if($evidenceReply) {
                    $evidenceReply->reply        = $request->reply;
                    $evidenceReply->update();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم تعديل الرد بنجاح',
                        'Data' => ['reply_id' => $evidenceReply->id]
                    ]);

                } else {
                    return response()->json([
                        'Success'=> false,
                        'Code'=> 400,
                        'Message' => 'Invalid Reply ID',
                        'Data' => false
                    ]);
                }
                break;  
            
            case 'marsads':
                $rules = [
                    'reply_id'    => 'required',
                    'subject_type'  => 'required',
                    'reply'       => 'required'
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'reply_id.required'      => 'reply Id Required',
                    'reply.required'      => 'من فضلك أدخل نص الرد!',
                ];
            
                $validator = Validator::make($request->all(), $rules, $messages);
            
                if($validator->fails()) {
                    return response()->json(['message' => $validator->customMessages]);
                }

                if($marsadReply) {
                    $marsadReply->reply        = $request->reply;
                    $marsadReply->update();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم تعديل الرد بنجاح',
                        'Data' => ['reply_id' => $marsadReply->id]
                    ]);

                } else {
                    return response()->json([
                        'Success'=> false,
                        'Code'=> 400,
                        'Message' => 'Invalid Reply ID',
                        'Data' => null
                    ]);
                }
                break;
              
            default:    
                return response()->json([
                    'Success'=> false,
                    'Code'=> 400,
                    'Message' => 'أدخل نوع صحيح',
                    'Data' => null
                ]);
        }

    }

    public function deleteReply(Request $request) {

        $type = $request->subject_type;
        
        switch($type) {
            case 'suspicions':
                $rules = [
                    'reply_id'    => 'required',
                    'subject_type'  => 'required',
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'reply_id.required'      => 'reply Id Required',
                ];
                $reply = SuspicionReply::find($request->reply_id);
                if($reply) {
                    $reply->delete();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم حذف الرد بنجاح',
                        'Data' => ['reply_id' => $reply->id]
                    ]);
                }
                break;

            case 'hot-suspicions':
                $rules = [
                    'reply_id'    => 'required',
                    'subject_type'  => 'required',
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'reply_id.required'      => 'reply Id Required',
                ];
                $reply = HotSuspicionReply::find($request->reply_id);
                if($reply) {
                    $reply->delete();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم حذف الرد بنجاح',
                        'Data' => ['reply_id' => $reply->id]
                    ]);
                }
                break;

            case 'discussions':
                $rules = [
                    'reply_id'    => 'required',
                    'subject_type'  => 'required',
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'reply_id.required'      => 'reply Id Required',
                ];
                $reply = DiscussionReply::find($request->reply_id);
                if($reply) {
                    $reply->delete();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم حذف الرد بنجاح',
                        'Data' => ['reply_id' => $reply->id]
                    ]);
                }
                break;

            case 'evidences':
                $rules = [
                    'reply_id'    => 'required',
                    'subject_type'  => 'required',
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'reply_id.required'      => 'reply Id Required',
                ];
                $reply = EvidenceReply::find($request->reply_id);
                if($reply) {
                    $reply->delete();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم حذف الرد بنجاح',
                        'Data' => ['reply_id' => $reply->id]
                    ]);
                }
                break;

            case 'marsads':
                $rules = [
                    'reply_id'    => 'required',
                    'subject_type'  => 'required',
                ];        
                $messages = [
                    'subject_type.required' => 'subject Type Required',
                    'reply_id.required'      => 'reply Id Required',
                ];
                $reply = MarsadReply::find($request->reply_id);
                if($reply) {
                    $reply->delete();
                    return response()->json([
                        'Success'=> true,
                        'Code'=> 200,
                        'Message' => 'تم حذف الرد بنجاح',
                        'Data' => ['reply_id' => $reply->id]
                    ]);
                }
                break;
            
    
            default:
                return response()->json([
                    'Success'=> true,
                    'Code'=> 200,
                    'Message' => 'من فضلك أدخل نوع صحيح',
                    'Data' => false
                ]);
        }
    }
}
