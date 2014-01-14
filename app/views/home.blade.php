<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>{{$pagetitle}}</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header.css') }}
    {{ HTML::style('css/home.css') }}
</head>
<script type="text/javascript">
    var ROOT_PATH = "{{URL::to('/')}}";
    var XIAO =
    {
        "loadingArticle" : 0,
        "getMoreUrl" : "{{$getmore}}",
        "loadedCount" : "{{$articlenum}}"
    };
</script>
<body>
<textarea id="section_template" style="display: none;">
    <section style="padding-bottom: 20px;">
        <div class="row">
            <h3><a href="{{URL::to('/article').'/'}}$id$" class="article_title">$title$</a></h3>
        </div>
        <div class="row" style="padding-bottom: 10px;padding-left: 3px;">
            <a href="{{URL::to('/article').'/'}}$id$" class="artileparam btn btn-default btn-xs">$points$分</a>
            <a href="{{URL::to('/article').'/'}}$id$" class="artileparam btn btn-default btn-xs">$comments$评论</a>
        </div>
        <div class="row">
            <a href="{{URL::to('/article').'/'}}$id$">
                <img class="img-responsive img-thumbnail" src="{{URL::to('/')}}/$savepath$" style="width: 100%;">
            </a>
        </div>
        <div class="row" style="padding-right: 0px;margin-top: 5px;">
            <div style="display: inline;float: left;">
                @if (Auth::check())
                <button type="button" class="btn" onclick="articlePointUp(this,$id$);"><i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;&nbsp;<span class="article_up">$up$</span></button>
                <span style="width: 50px;">&nbsp;</span>
                <button type="button" class="btn" onclick="articlePointDown(this,$id$);"><i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;&nbsp;<span class="article_down">$down$</span></button>
                @else
                <button type="button" class="btn" onclick="openLoginModal();"><i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;&nbsp;<span id="article_up">$up$</span></button>
                <span style="width: 50px;">&nbsp;</span>
                <button type="button" class="btn" onclick="openLoginModal();"><i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;&nbsp;<span id="article_down">$down$</span></button>
                @endif
            </div>
            <div style="display: inline;float: right;" >
                <a href="javascript:void(0)" onclick="sinaweibo('$title$','{{URL::to('/article').'/'}}$id$','{{URL::to('/').'/'}}$savepath$');return false;" class="btn btn-danger" title="分享到新浪微博" target="_blank" >
                    分享到新浪微博
                </a>
                <a href="javascript:void(0)" onclick="postToWb('$title$','{{URL::to('/article').'/'}}$id$','{{URL::to('/').'/'}}$savepath$');return false;" class="tmblog">
                    <img src="http://v.t.qq.com/share/images/s/b32.png" border="0" alt="转播到腾讯微博" >
                </a>
            </div>
        </div>
    </section>
</textarea>
<!-- Wrap all page content here -->
<div id="wrap">
    @include('header');
    <!-- Begin page content -->
    <div class="container">
        <div class="col-sm-7" id="home_articles">
            @foreach ($articles as $article)
            <section style="padding-bottom: 20px;">
                <div class="row">
                    <h3><a href="{{URL::to('/article').'/'.$article->id}}" class="article_title">{{$article->title}}</a></h3>
                </div>
                <div class="row" style="padding-bottom: 10px;padding-left: 3px;">
                        <a href="{{URL::to('/article').'/'.$article->id}}" class="artileparam btn btn-default btn-xs">{{$article->up - $article->down}}分</a>
                        <a href="{{URL::to('/article').'/'.$article->id}}" class="artileparam btn btn-default btn-xs">{{$article->comments}}评论</a>
                </div>
                <div class="row">
                    <a href="{{URL::to('/article').'/'.$article->id}}">
                        <img class="img-responsive img-thumbnail" src="{{URL::to('/')}}/{{$article->savepath}}" style="width: 100%;">
                    </a>
                </div>
                <div class="row" style="padding-right: 0px;margin-top: 5px;">
                    <div style="display: inline;float: left;">
                        @if (Auth::check())
                        <button type="button" class="btn" onclick="articlePointUp(this,{{$article->id}});"><i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;&nbsp;<span class="article_up">{{$article->up}}</span></button>
                        <span style="width: 50px;">&nbsp;</span>
                        <button type="button" class="btn" onclick="articlePointDown(this,{{$article->id}});"><i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;&nbsp;<span class="article_down">{{$article->down}}</span></button>
                        @else
                        <button type="button" class="btn" onclick="openLoginModal();"><i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;&nbsp;<span id="article_up">{{$article->up}}</span></button>
                        <span style="width: 50px;">&nbsp;</span>
                        <button type="button" class="btn" onclick="openLoginModal();"><i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;&nbsp;<span id="article_down">{{$article->down}}</span></button>
                        @endif
                    </div>
                    <div style="display: inline;float: right;" >
                        <a href="javascript:void(0)" onclick="sinaweibo('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="btn btn-danger" title="分享到新浪微博" target="_blank" >
                            分享到新浪微博
                        </a>
                        <a href="javascript:void(0)" onclick="postToWb('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="tmblog">
                            <img src="http://v.t.qq.com/share/images/s/b32.png" border="0" alt="转播到腾讯微博" >
                        </a>
                    </div>
                </div>
            </section>
            @endforeach
        </div>
        <div class="col-sm-5" style="padding: 30px; text-align: center;">
            <h4>推荐</h4>
            <div class="row" id="tags">
                @foreach ($rarticles as $article)
                    <section style="padding: 10px;">
                        <div class="row">
                            <a href="#">{{$article->title}}</a>
                        </div>
                        <div class="row">
                            <a href="{{URL::to('/article/').$article->id}}">
                                <img class="img-responsive img-thumbnail" src="{{URL::to('/')}}/{{$article->thumbnailpath}}" style="width: 250px;height: 120px;">
                            </a>
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
    </div>
    <div class="containerbottom"></div>
</div>
@include("footer")
{{ HTML::script('js/home.js') }}
{{ HTML::script('js/ishare.js') }}
</body>
</html>