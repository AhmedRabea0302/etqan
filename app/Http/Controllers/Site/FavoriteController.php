<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class FavoriteController extends Controller
{
    public function index() {
        $user_id = auth()->guard('auth-site')->user()->id;

        $favSuspicions = DB::table('favorite_subjects')->leftJoin('suspicions', 'favorite_subjects.subject_id', '=', 'suspicions.id')
        ->where('type', '=', 'suspicions')->where('user_id', '=', $user_id)->get();

        $favHotSuspicions = DB::table('favorite_subjects')->leftJoin('hot_suspicions', 'favorite_subjects.subject_id', '=', 'hot_suspicions.id')
        ->where('type', '=', 'hot-suspicions')->where('user_id', '=', $user_id)->get();

        $favEevidences = DB::table('favorite_subjects')->leftJoin('evidence', 'favorite_subjects.subject_id', '=', 'evidence.id')
        ->where('type', '=', 'evidences')->where('user_id', '=', $user_id)->get();

        $favDiscussions = DB::table('favorite_subjects')->leftJoin('discussions', 'favorite_subjects.subject_id', '=', 'discussions.id')
        ->where('type', '=', 'discussions')->where('user_id', '=', $user_id)->get();
        // dd($favSuspicions);
        


        return view('site.pages.favorites.index', [
                'favSuspicions' => $favSuspicions,
                'favHotSuspicions' => $favHotSuspicions,
                'favEevidences' => $favEevidences,
                'favDiscussions' => $favDiscussions,
            ]
        );
    }
}
