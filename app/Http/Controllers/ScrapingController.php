<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\DB;

class ScrapingController extends Controller
{
    public function index(Request $request)
    {
        // viewのformから送られてきたkeywordを取得
        $keyword = $request->input('keyword');

        // formに入力されて入れば
        if(!empty($keyword))
        {   
            // DBの絡むから検索
            $articles = DB::table('articles')
                        ->where('airline', 'like', '%'.$keyword.'%')
                        ->paginate(4);
        }else{ // formに入力がなければ
            $articles = DB::table('artticles')->paginate(4);
        }

        return view('index', [
            'keyword' => $keyword,
            'articles' => $articles
        ]);
    }
}
