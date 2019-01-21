<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Scraping-app</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lekton" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="css/custom.css">

    </head>

    <body>
        <div class="container">
            <h1>&lt;/ Searching Q &gt;</h1>
            <p class="mb-5">QiitaとQrunchの記事を同時に検索できるサービスです</p>

            <!-- 検索フォーム -->
            <div class="row justify-content-center">
                <form class="mb-5">
                    <div class="form-group">
                        <input type="text" name="keyword" class="type-box" value="{{ $keyword }}">
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="type-btn">Search<br>▽</button>
                    </div>
                </form>
            </div>

            <!-- 検索結果表示 -->
            <div class="q-box">

                <!-- Qiita記事表示 -->
                <div class="qiita">
                    <h2><strong>Qiita</strong></h2>
                    <p>" {{ $keyword }} " に関する<br>Qiitaの記事一覧</p>
                    @if(count($qiita) > 0)
                        <div class="article-box">
                            @foreach($qiita as $q)
                                <a href="{{ $q->url }}">・{{ $q->airline }}</a>
                            @endforeach
                        </div>
                    @else
                        <p>検索結果　0件</p>
                    @endif
                </div>

                <!-- Crunch記事表示 -->
                <div class="qrunch">
                    <h2><strong>Qrunch</strong></h2>
                    <p>" {{ $keyword }} " に関する<br>Qrunchの記事一覧</p>
                    @if(count($crunch) > 0)
                        <div class="article-box">
                            @foreach($crunch as $c)
                                <a href="https://qrunch.net/{{ $c->url }}">・{{ $c->airline }}</a>
                            @endforeach
                        </div>
                    @else
                        <p>検索結果　0件</p>
                    @endif
                </div>
            </div>


            <!-- あらかじめ決まったワードで検索した記事を表示 -->
            <!-- <div class="articles-folder">
                <div class="box">
                    <h3>Ruby</h3>
                    <div class="article-box">
                        @foreach($ruby as $r)
                            <div class="articles">
                                <a href="{{ $r->url }}">・{{ $r->airline }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="box">
                    <h3>PHP</h3>
                    <div class="article-box">
                        @foreach($php as $p)
                            <div class="articles">
                                <a href="{{ $p->url }}">・{{ $p->airline }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="box">
                    <h3>Python</h3>
                    <div class="article-box">
                        @foreach($python as $py)
                            <div class="articles">
                                <a href="{{ $py->url }}">・{{ $py->airline }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div> -->

            <footer>
                <p>copyright 2019 scraping app.</p>
            </footer>
        </div>
    </body>
</html>
