<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\About;

class AboutController extends Controller
{
    public function getAbouts() {
        $about = About::find(1);
        $about = [
            'message' => $about->message,
            'goals'   => $about->goals,
            'vision'  => $about->vision,
            'social_links'   => [
                'facebook'   => $about->facebook,
                'twitter'    => $about->twitter,
                'googleplus' => $about->googleplus,
                'linkedin'   => $about->linkedin,
                'youtube'    => $about->youtube,
                'whatsapp'   => $about->whatsapp,
                'instagram'  => $about->instagram,
                'website'    => $about->website,
            ]
        ];
        

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $about
        ]);
    }
}
