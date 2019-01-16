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

            <form action="" method="">
                <input type="text" name="keyword" value="{{ $keyword }}">
                <input type="submit" value="検索">
            </form>

            @if(count($articles) > 0)
                <div class="row">
                    @foreach($articles as $article)
                        <div class="col-md-3">
                        <a href="{{ $article->url }}">{{ $article->airline }}</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </body>
</html>
