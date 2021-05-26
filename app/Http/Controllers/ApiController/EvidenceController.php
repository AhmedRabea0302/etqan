<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Evidence;
class EvidenceController extends Controller
{
    public function getEvidences() {
        $evidences = Evidence::select('id', 'parent_id', 'title', 'short_reply', 'long_reply', 'video_url', 'book_url')->get();

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $evidences
        ]);

    }

    public function getEvidencesContent($id) {
        $evidence = Evidence::select('id', 'parent_id', 'title', 'short_reply', 'long_reply', 'video_url', 'book_url')->find($id);

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $evidence
        ]);

    }
}
