<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Article;


class ScrapingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrapingcommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'スクレイピングを実行';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // スクレイピングを実行してDBへ格納する処理
        $html = file_get_contents("http://qiita.com/api/v2/items?page=1&per_page=50");
        
        // Qiita API内の情報をjson形式に整形してforeachでぶん回す
        foreach(json_decode($html) as $article){

            // 各カラムにデータを保存
            $qiita = new Article;
            $qiita->src = 1; // 1 はQiitaの記事
            $qiita->airline = $article->title;
            $qiita->url = $article->url;
            $qiita->save();
        }


//         $html = file_get_contents("https://qrunch.net/entries");
// preg_match($html)

//         // $text = \phpQuery::newDocument($html)->find("div.more")->attr("href")->text();
//         // $article = json_decode($html);
//         // Qiita API内の情報をjson形式に整形してforeachでぶん回す
//         // foreach(json_decode($html) as $article){
// var_dump($text);
//             // 各カラムにデータを保存
//             // $qiita = new Article;
//             // $qiita->src = 1; // 1 はQiitaの記事
//             // $qiita->airline = $article->title;
//             // $qiita->url = $article->url;
//             // $qiita->save();
//         // }

    }
}
