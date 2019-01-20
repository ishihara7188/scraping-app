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
        // 複数検索に対応させるため、空白で文字を分断
        $words = explode(" ", $keyword);

        // form入力確認をしてDBから検索
        if(!empty($words))
        {   
            $articles = DB::table('articles');
            foreach ($words as $word) {
                    $articles->where('airline', 'like', '%'.$word.'%');
            } 
            $articles->paginate(100);
        }

        // あらかじめ決まったキーワードを検索
        $ruby = DB::table('articles')->where('airline', 'like', '%'.'ruby'.'%')->get();
        $php = DB::table('articles')->where('airline', 'like', '%'.'php'.'%')->get();
        $python = DB::table('articles')->where('airline', 'like', '%'.'python'.'%')->get();

        return view('index', [
            'keyword' => $keyword,
            'articles' => $articles->get(),
            'ruby' => $ruby,
            'php' => $php,
            'python' => $python
        ]);
    }
}
