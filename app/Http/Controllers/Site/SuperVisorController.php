<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperVisorController extends Controller
{
    public function suervisorWord() {
        return view('site.pages.supervisor.supervisorword');
    }

    public function suervisorAbout() {
        return view('site.pages.supervisor.supervisor');
    }

}
