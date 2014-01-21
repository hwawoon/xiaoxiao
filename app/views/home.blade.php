<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>{{$pagetitle}}</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header.css') }}
    {{ HTML::style('css/home.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
@include('header');

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

<div class="container" id="maintext">
    <div class="row">
        <div class="col-xs-8">
            @foreach ($articles as $article)
            <section class="artsection">
                    <div class="col-xs-10">
                    <div class="row dnav">
                        <a href="{{URL::to('/article').'/'.$article->id}}" class="article_title">
                            <span class="tnav">{{$article->title}}</span>
                        </a>
                    </div>
                    <div class="row nav-point">
                        <a href="{{URL::to('/article').'/'.$article->id}}" class="artileparam btn btn-default btn-xs">
                            {{$article->up - $article->down}}分
                        </a>
                        <a href="{{URL::to('/article').'/'.$article->id}}" class="artileparam btn btn-default btn-xs">
                            {{$article->comments}}评论
                        </a>
                    </div>
                    <div class="row">
                        <a href="{{URL::to('/article').'/'.$article->id}}">
                            <img class="img-responsive img-thumbnail" src="{{URL::to('/')}}/{{$article->savepath}}" style="width: 100%;">
                        </a>
                    </div>
                    <div class="row artshare">
                        <a href="javascript:void(0)" onclick="sinaweibo('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="btn btn-danger" title="分享到新浪微博" target="_blank" >
                            分享到新浪微博
                        </a>
                        <a href="javascript:void(0)" onclick="postToWb('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="tmblog">
                            <img src="http://v.t.qq.com/share/images/s/b32.png" border="0" alt="转播到腾讯微博" >
                        </a>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="row">
                        <ul class="vertical-vote">
                            <li><a class="up" href="javascript:void(0);">Upvote</a></li>
                            <li><a class="down" href="javascript:void(0);">Downvote</a></li>
                        </ul>
                    </div>
                </div>
            </section>
            <hr class="sectionhr" />
            @endforeach
        </div>
        <div class="col-xs-4 rrecommend">
            @if(!empty($rarticles))
            <div class="row recomdhead">
                <span>推荐一下</span>
            </div>
            <div class="row tags">
                @foreach ($rarticles as $article)
                <section>
                    <div class="row tagtitle">
                        <a href="{{URL::to('/article').'/'.$article->id}}" >
                            <span>{{$article->title}}</span>
                        </a>
                    </div>
                    <div class="row">
                        <a href="{{URL::to('/article').'/'.$article->id}}">
                            <img class="" src="{{URL::to('/')}}/{{$article->thumbnailpath}}" >
                        </a>
                    </div>
                </section>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div> <!-- /container -->
<div class="containerbottom"></div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap.js') }}
{{ HTML::script('js/jquery.validate.js') }}
{{ HTML::script('js/jquery.form.js') }}
{{ HTML::script('js/header.js') }}
{{ HTML::script('js/home.js') }}
{{ HTML::script('js/ishare.js') }}
</body>
</html>