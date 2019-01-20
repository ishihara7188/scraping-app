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
        // 未認証だと1時間に60アクセスが上限のため60指定
        for($i=1; $i <= 60; $i++){

            // for文で60ページ分を取得
            $url = "http://qiita.com/api/v2/items?page={$i}&per_page=100";
            $context = stream_context_create(array('http' => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
              )));
            $html = file_get_contents($url, false, $context);
            
            // Qiita API内の情報をjson形式に整形してforeachでぶん回す
            foreach(json_decode($html) as $article){

                // 各カラムにデータを保存
                $qiita = new Article;
                $qiita->src = 1; // 1 はQiitaの記事
                $qiita->airline = $article->title;
                $qiita->url = $article->url;
                $qiita->save();
            }
        }


        // $html = file_get_contents("https://qrunch.net/");
        // // preg_match_all("/<div class=\"entry-info\">\n<div class=\"title\">\n<a href=\"(.*)\"\s/", $html, $matches);
        // $matches = preg_match_all("/<div class=\"entry-info\">\n<div class=\"title\"\s/", $html);
        
        // $text = \phpQuery::newDocument($matches)->find("h3")->text();
        
        // var_dump($text);
        // var_dump($matches);

        $html = file_get_contents("https://qrunch.net/");
        preg_match_all('/<div class=\"entry-info\">\n<div class=\"title\">\n<a href=\"(.*)\"\spl=\"content\">\n(.*)/', $html, $matches);
        
        // var_dump($matches);  


//         $html = file_get_contents("https://qrunch.net/entries");
// preg_match($html)

//         // $text = \phpQuery::newDocument($html)->find("div.more")->attr("href")->text();
//         // $article = json_decode($html);
//         // Qiita API内の情報をjson形式に整形してforeachでぶん回す
        for($i=0; $i < count($matches[1]); $i++){
            // 各カラムにデータを保存
            $crunch = new Article;
            $crunch->src = 2;
            $crunch->airline = $matches[2][$i];
            $crunch->url = $matches[1][$i];
            var_dump($crunch); 
            // $crunch->save();
        }
// var_dump($text);

            
//         // }

    }
}
