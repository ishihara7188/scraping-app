<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\DB;

class ScrapingController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if(!empty($keyword))
        {   
            $articles = DB::table('articles')
                        ->where('airline', 'like', '%'.$keyword.'%')
                        ->paginate(4);
        }else{
            $articles = DB::table('artticles')->paginate(4);
        }

        return view('index', [
            'keyword' => $keyword,
            'articles' => $articles
        ]);
    }
}
