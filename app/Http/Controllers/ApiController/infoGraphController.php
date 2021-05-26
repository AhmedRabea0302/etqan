<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InfoGraph;
class infoGraphController extends Controller
{
    public function getInfographs() {
        $infographs = InfoGraph::select('caption', 'image_name')->get(); 

        foreach($infographs as $infograph) {
            if($infograph->image_name) {
                $infograph->uploaded_image_url = 'https://nusratelsunnahacademy.com/nosrah/storage/uploads/images/infographs/' . $infograph->image_name;
            }
        }

        return response()->json([
            'Success'=> true,
            'Code'=> 200,
            'Message' => '',
            'Data' => $infographs
        ]);
        
    }
}
