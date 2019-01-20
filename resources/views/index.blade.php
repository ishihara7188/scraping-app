<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Scraping-app</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="css/custom.css">
    </head>
    <body>
        <div class="container">
            <h1>Scraping app</h1>
            <div class="form-position">
                <form action="" method="">
                    <input type="text" name="keyword" class="type-box" value="{{ $keyword }}">
                    <input type="submit" class="type-btn" value="検索">
                </form>
            </div>
            <br>
            <h2>検索結果</h2>
            <hr>
            @if(count($articles) > 0)
                <div class="article-box">
                    @foreach($articles as $article)
                        <div class="articles">
                            <a href="{{ $article->url }}">{{ $article->airline }}</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p>検索結果　0件</p>
            @endif



            <div class="articles-folder">
                <div class="box">
                    <h2>Ruby</h2>
                    <hr>
                    <div class="article-box">
                        @foreach($ruby as $r)
                            <div class="articles">
                                <a href="{{ $r->url }}">{{ $r->airline }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="box">
                    <h2>PHP</h2>
                    <hr>
                    <div class="article-box">
                        @foreach($php as $p)
                            <div class="articles">
                                <a href="{{ $p->url }}">{{ $p->airline }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="box">
                    <h2>Python</h2>
                    <hr>
                    <div class="article-box">
                        @foreach($python as $py)
                            <div class="articles">
                                <a href="{{ $py->url }}">{{ $py->airline }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
