<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Discussion;

class DiscussionController extends Controller
{
    public function getDiscussions() {
        $discussions = Discussion::select('id', 'parent_id','title','short_reply', 'long_reply', 'video_url', 'book_url')->get();
    
        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $discussions
        ]);

    }

    public function getDiscussionContent($id) {
        $discussion = Discussion::select('id', 'parent_id','title','short_reply', 'long_reply', 'video_url', 'book_url')->find($id);

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $discussion
        ]);

    }
}
