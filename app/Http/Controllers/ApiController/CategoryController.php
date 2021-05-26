<?php

namespace App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ApiModels\Category;

class CategoryController extends Controller
{
    public function getMainCaats() {
        $categories = Category::select('category_name')->get();
        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $categories
        ]);
    }
}
