<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marsad;
class MarsadController extends Controller
{
    public function getMarsads() {
        $evidences = Marsad::select('id', 'parent_id','marsad', 'short_reply', 'long_reply', 'video_url', 'book_url')->get();

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $evidences
        ]);
   
    }
}
