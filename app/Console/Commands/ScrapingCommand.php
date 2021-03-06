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

        // Qiita記事のスクレイピング処理

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
                // $qiita->save();
            }
        }



        
        // Crunch記事のスクレイピング処理

        for ($i=1; $i <= 100; $i++ ){
            $urlCrunch = "https://qrunch.net/entries?page={$i}";
            $htmlCrunch = file_get_contents($urlCrunch);
            preg_match_all('/<div class=\"title\">\n<a href=\"(.*)\">\n<h3>(.*)</', $htmlCrunch, $matches);
            
            for ($a=0; $a < count($matches[1]); $a++){
                $crunch = new Article;
                $crunch->src = 2;
                $crunch->airline = $matches[2][$a];
                $crunch->url = $matches[1][$a];
                // $crunch->save();
            }
        }
    }
}
