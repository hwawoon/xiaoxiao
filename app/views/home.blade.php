<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <title>xiaoxiao</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header.css') }}
    {{ HTML::style('css/home.css') }}
</head>
<body>
<!-- Wrap all page content here -->
<div id="wrap">
    @include('header');
    <!-- Begin page content -->
    <div class="container">
        <div class="col-sm-7" id="home_articles">
            @foreach ($articles as $art)
            <section style="padding-bottom: 20px;">
                <div class="row">
                    <h2><a href="#" class="article_title">{{$art->title}}</a></h2>
                </div>
                <div class="row">
                    <a href="#">
                        <img class="img-responsive img-thumbnail" src="{{$art->savepath}}" style="width: 100%;">
                    </a>
                </div>
            </section>
            @endforeach
        </div>
        <div class="col-sm-5" style="padding: 30px; text-align: center; position: fixed; left: 57%; top: 6%; width: 35%;">
            <h4>推荐</h4>
            <div class="row" style="padding: 5px;">
                <div class="row" id="tags">
                @foreach ($articles as $art)
                    <a href="#"><span class="label">{{$art->title}}</span></a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{$articlenum}}" id="articlenum" />
    <div class="containerbottom"></div>
</div>
@include("footer")
{{ HTML::script('js/home.js') }}
</body>
</html>