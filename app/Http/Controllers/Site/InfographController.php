<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InfoGraph;

class InfographController extends Controller
{
    public function index() {
        $infographs = InfoGraph::all();
        return view('site.pages.infographs.index')->with('infographs', $infographs);
    }
}
