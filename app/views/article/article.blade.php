<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>{{$article->title}}</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap-1391792299980.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header-1391790726872.css') }}
    {{ HTML::style('css/article-1390898781613.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Wrap all page content here -->
@include('header');
<!-- Begin page content -->
<div class="container">
    <div class="col-xs-7">
        <section>
            <div class="row atitle">
                {{$article->title}}
            </div>
            <div class="row points">
                <a href="#" class="artileparam btn btn-default btn-xs">
                    <span id="article_points">{{$article->up - $article->down}}</span>分
                </a>
                <a href="#commentArea" class="artileparam btn btn-default btn-xs">{{$article->comments}}评论</a>
            </div>
            <div class="row acomment">
                <div class="sharediv">
                    <a href="javascript:void(0)" onclick="sinaweibo('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="btn btn-danger" title="分享到新浪微博" target="_blank" >
                        分享到新浪微博
                    </a>
                    <a href="javascript:void(0)" onclick="postToWb('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="btn btn-primary" title="分享到腾讯微博" target="_blank" >
                        分享到腾讯微博
                    </a>
                </div>
                <div class="apoint horizontal-vote">
                        @if (Auth::check())
                        <span><a class="up" href="javascript:void(0);"  onclick="articlePointUp({{$article->id}});void(0);">赞</a></span>
                        <span><a class="down" href="javascript:void(0);" onclick="articlePointDown({{$article->id}});void(0);">踩</a></span>
                        @else
                        <span><a class="up" href="javascript:void(0);" onclick="openLoginModal();">赞</a></span>
                        <span><a class="down" href="javascript:void(0);" onclick="openLoginModal();">踩</a></span>
                        @endif
                </div>
            </div>
            <div class="row">
                <a href="javascript:void(0)">
                    <img class="" src="{{URL::to('/')}}/{{$article->savepath}}" style="width: 100%;">
                </a>
            </div>
            <div class="row" style="padding-top: 5px;text-align: center;">
                <a href="javascript:void(0)" onclick="sinaweibo('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="btn btn-danger btn-group" title="分享到新浪微博" target="_blank" >
                    分享到新浪微博
                </a>
                <a href="javascript:void(0)" onclick="postToWb('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="btn btn-primary btn-group" title="分享到腾讯微博" target="_blank" >
                    分享到腾讯微博
                </a>
            </div>
            <div class="row" id="commentArea">
                <div style="margin-bottom: 0px; margin-top: 0px; border-bottom: 1px solid #eeeeee;">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#">全部评论(<span id="commentCount">{{$article->comments}}</span>)</a></li>
                    </ul>
                </div>
            </div>
            @if (Auth::check())
            <div class="row userreplydiv">
                <form class="form-horizontal" id="articleCommentForm" role="form" method="post" action="{{URL::to('/')}}/comment/addComment/{{Auth::user()->getId()}}/{{$article->id}}">
                    <input type="hidden" name="articleAuthor" id="articleAuthor" value="{{$article->userid}}" />
                    <div class="useravatar">
                        <img
                            src="{{URL::to('/')}}/{{Auth::user()->getAvatar()}}" class="img-responsive img-thumbnail" style="width: 50px;"/>
                    </div>
                    <div class="myreplay">
                        <textarea class="form-control" name="myComment" id="myComment" rows="3" placeholder="最多100字"></textarea>
                    </div>
                    <div class="myreplybtn">
                            <button type="button" id="articleCommentBtn" class="btn btn-default btn-sm">发送</button>
                    </div>
                </form>
            </div>
            @else
            <div class="row userreplydiv">
                <form class="form-horizontal" id="articleCommentForm" role="form" method="post" action="">
                    <div class="useravatar">
                        <img
                            src="{{URL::to('/')}}/img/defaultavatar.jpg"
                            class="img-responsive img-thumbnail" style="width: 50px;"/>
                    </div>
                    <div class="myreplay">
                        <textarea class="form-control" name="myComment" id="myComment" rows="3" placeholder="最多100字"></textarea>
                    </div>
                    <div class="myreplybtn">
                        <a href="#login" id="login" class="btn btn-default btn-sm" data-toggle="modal" data-target="#loginModal">登录</a>
                    </div>
                </form>
            </div>
            @endif
            <div id="articlereplies">
                @foreach ($comments as $cmt)
                <div class="row">
                    <div class="useravatar">
                        <img src="{{URL::to('/')}}/{{$cmt->avatar}}" class="img-responsive img-thumbnail" />
                    </div>
                    <div class="userreply">
                        <div style="padding: 0px 0px 1px 0px;">
                           <span style="color: #269abc;">{{$cmt->name}} 发表于 {{$cmt->created_at}}</span>
                        </div>
                        <div>
                            {{$cmt->content}}
                        </div>
                    </div>
                </div>
                @endforeach

                {{$comments->links()}}
            </div>
        </section>
    </div>

    <div class="col-xs-5 atags">
        <div class="row pager">
                <a href="{{URL::to('/')}}/article/previous/{{$article->id}}" class="btn btn-info" style="padding: 10px;"
                @if(!$previous)
                    disabled="disabled"
                @endif
                >
                    <i class="glyphicon glyphicon-arrow-left"></i>
                    上一页
                </a>
            &nbsp;&nbsp;
                <a href="{{URL::to('/')}}/article/next/{{$article->id}}" class="btn btn-success" style="padding: 10px;"
                @if(!$next)
                    disabled="disabled"
                @endif
                >
                    下一页
                    <i class="glyphicon glyphicon-arrow-right"></i>
                </a>
        </div>
        <div class="row" id="recommend" style="padding-top: 10px;">
            @foreach ($rarticles as $article)
            <section style="padding: 10px;">
                <div class="row" style="padding: 5px;">
                    <a href="{{URL::to('/article').'/'.$article->id}}" style="text-decoration: none;color: #000000;">
                        @if(strlen($article->title) > 51)
                        {{substr($article->title, 0, 51)}}...
                        @else
                        {{$article->title}}
                        @endif
                    </a>
                </div>
                <div class="row">
                    <a href="{{URL::to('/article').'/'.$article->id}}">
                        <img class="" src="{{URL::to('/')}}/{{$article->thumbnailpath}}">
                    </a>
                </div>
            </section>
            @endforeach
        </div>
    </div>
</div>
@include("footer")
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap-1390898781657.js') }}
{{ HTML::script('packages/noty/packaged/jquery.noty.packaged.min.js')}}
{{ HTML::script('js/jquery.validate-1390898781640.js') }}
{{ HTML::script('js/jquery.form-1390898781635.js') }}
{{ HTML::script('js/header-1391790244642.js') }}
{{ HTML::script('js/article/article-1390898781630.js') }}
{{ HTML::script('js/ishare-1390898781634.js') }}
</body>
</html>