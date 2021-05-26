<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meet;
use Auth;
use DB;
class MeetController extends Controller
{
    public function getAllMeets(Request $requst) {
        $meets = Meet::select('id', 'title', 'link', 'details', 'status', 'user_name', 'date', 'time')->get();

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $meets
        ]);

    }

    public function getAllActiveMeets() {
        $meets = Meet::select('id', 'title', 'link', 'details', 'user_name', 'date', 'time')->where('status', '1')->get();

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $meets
        ]);
          
    }

    public function getAllUpcommingMeets() {
        $date = date('Y-m-d') . ' ' . date('H:s');
        $meets = DB::select('select id, title, link, details, status, user_id, user_type, user_name, date, time from meets where (threeshold >= :date) ORDER BY date,time ASC', ['date' => $date]);
        // $meets = Meet::select('id', 'title', 'link', 'details', 'user_name', 'date', 'time')->where('date', '>', $date)->get();

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $meets
        ]);

    }

    public function getSheikhMeets($id) {
        $meets = DB::select('select id, title, link, details, status, user_id, user_type, user_name, date, time from meets where (user_id = :id AND user_type = :user_type) ORDER BY date,time ASC', ['id' => $id, 'user_type' => 'sheikh']);
        // $meets = Meet::select('id', 'title', 'link', 'details', 'user_name', 'date', 'time')->where('user_id', '=', $id)->get();

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $meets
        ]);

    }
}
