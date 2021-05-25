<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HotSuspicion;
class HotSuspicionController extends Controller
{
    public function getAllSuspicions() {
        $mainSuspicions = HotSuspicion::select('id', 'parent_id', 'suspicion', 'short_reply', 'long_reply', 'video_url', 'book_url')->get();

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $mainSuspicions
        ]);

    }

    public function getSuspicionChilds($id) {
        $suspicionChildss = HotSuspicion::select('id','parent_id', 'suspicion', 'short_reply')->where('parent_id', $id)->get();

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $suspicionChildss
        ]);

    }

    public function getSuspicionReply($id) {
        $suspicionReply = HotSuspicion::select('short_reply')->where('id', $id)->get();

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $suspicionReply
        ]);

    }

    public function getChildSuspicions()
    {
        $susps = HotSuspicion::select('id', 'parent_id','suspicion', 'short_reply')->where('parent_id', '0')->with('childrenSuspicions')->get();

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $susps
        ]);

    }
}
