<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //
    public function indexArticle(Request $request){

    }

    public function postArticle(Request $request){
        $input = $request->request->all();
        return response()->json($input);
    }

    public function deleteArticle(Request $request){
        $input = $request->request->all();
        return response()->json($input);
    }
}
