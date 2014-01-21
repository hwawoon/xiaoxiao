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
    {{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<style type="text/css">
    section .row {
        padding: 5px 0px;
    }

    .row div.myreplay {
        float: left;
        width: 90%;
    }
    .row div.myreplybtn {
        float: left;
        width: 100%;
        padding: 5px 0px;
        text-align: right;
        display: block;
    }
    .row div.useravatar {
        float: left;
        padding: 0px 10px 0 0;
        width: 10%;
        text-align: center;
    }
    .row div.userreply {
        float: left;
        width: 90%;
    }
</style>
<script type="text/javascript">
    var ROOT_PATH = "{{URL::to('/')}}";
</script>
<body>
<!-- Wrap all page content here -->
<div id="wrap">
    @include('header');
    <!-- Begin page content -->
    <div class="container">
        <div class="col-sm-8">
            <section style="padding-bottom: 20px;">
                <div class="row" style="padding: 0px;">
                    <h3>{{$article->title}}</h3>
                </div>
                <div class="row">
                    <a href="#" class="artileparam btn btn-default btn-xs">{{$article->up - $article->down}}分</a>
                    <a href="#commentArea" class="artileparam btn btn-default btn-xs">{{$article->comments}}评论</a>
                </div>
                <div class="row" style="padding: 0px;">
                    <div style="display: inline;float: left; padding-right: 10px;margin-top: 5px;">
                        @if (Auth::check())
                        <button type="button" class="btn" onclick="articlePointUp({{$article->id}});"><i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;&nbsp;<span id="article_up">{{$article->up}}</span></button>
                        <span style="width: 50px;">&nbsp;</span>
                        <button type="button" class="btn" onclick="articlePointDown({{$article->id}});"><i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;&nbsp;<span id="article_down">{{$article->down}}</span></button>
                        @else
                        <button type="button" class="btn" onclick="openLoginModal();"><i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;&nbsp;<span id="article_up">{{$article->up}}</span></button>
                        <span style="width: 50px;">&nbsp;</span>
                        <button type="button" class="btn" onclick="openLoginModal();"><i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;&nbsp;<span id="article_down">{{$article->down}}</span></button>
                        @endif
                    </div>
                    <div style="display: inline;float: right;">
                        <div class="bdsharebuttonbox">
                            <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                            <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                            <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                            <a href="#" class="bds_t163" data-cmd="t163" title="分享到网易微博"></a>
                            <a href="#" class="bds_kaixin001" data-cmd="kaixin001" title="分享到开心网"></a>
                            <a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
                            <a href="#" class="bds_more" data-cmd="more"></a></div>
                        <script>
                            window._bd_share_config = {
                                "common": {
                                    "bdSnsKey": {},
                                    "bdUrl" : "{{URL::to('/article').'/'.$article->id}}",
                                    "bdText": "搞笑哇！{{$article->title}}",
                                    "bdMini": "2",
                                    "bdSign": "on",
                                    "bdMiniList": false,
                                    "bdPic": "{{URL::to('/')}}/{{$article->savepath}}",
                                    "bdStyle": "1",
                                    "bdSize": "32"
                                },
                                "share": {}
                            };
                            with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=86835285.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
                    </div>
                </div>
                <div class="row">
                    <a href="javascript:void(0)">
                        <img class="img-responsive img-thumbnail" src="{{URL::to('/')}}/{{$article->savepath}}" style="width: 100%;">
                    </a>
                </div>
                <div class="row" style="text-align: center;">
                    <a href="javascript:void(0)" onclick="sinaweibo('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="btn btn-danger" title="分享到新浪微博" target="_blank" >
                        分享到新浪微博
                    </a>
                    <a href="javascript:void(0)" onclick="postToWb('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="tmblog">
                        <img src="http://v.t.qq.com/share/images/s/b32.png" border="0" alt="转播到腾讯微博" >
                    </a>
                    </div>
                <div class="row" style="margin-top: 0px;" id="commentArea">
                    <div style="margin-bottom: 0px; margin-top: 0px; border-bottom: 1px solid #eeeeee;">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#">全部评论(<span id="commentCount">{{$article->comments}}</span>)</a></li>
                        </ul>
                    </div>
                </div>
                @if (Session::has('user'))
                <div class="row">
                    <form class="form-horizontal" id="articleCommentForm" role="form" method="post" action="{{URL::to('/')}}/comment/addComment/{{Session::get('user')->getId()}}/{{$article->id}}">
                        <div class="useravatar">
                            <img
                                src="{{URL::to('/')}}/{{Session::get('user')->getAvatar()}}"
                                class="img-responsive img-thumbnail" style="width: 50px;"/>
                        </div>
                        <div class="myreplay">
                            <textarea class="form-control" name="myComment" id="myComment" rows="3" placeholder="平平仄仄"></textarea>
                        </div>
                        <div class="myreplybtn">
                                <button type="button" id="articleCommentBtn" class="btn btn-default btn-sm">发送</button>
                        </div>
                    </form>
                </div>
                @else
                <div class="row">
                    <form class="form-horizontal" id="articleCommentForm" role="form" method="post" action="">
                        <div class="useravatar">
                            <img
                                src="{{URL::to('/')}}/img/defaultavatar.jpg"
                                class="img-responsive img-thumbnail" style="width: 50px;"/>
                        </div>
                        <div class="myreplay">
                            <textarea class="form-control" name="myComment" id="myComment" rows="3" placeholder="平平仄仄"></textarea>
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
                        <img src="{{URL::to('/')}}/{{$cmt->avatar}}" class="img-responsive img-thumbnail" style="width: 50px;"/>
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
                </div>
            </section>
        </div>
        <div class="col-sm-4" style="padding-left: 60px;text-align: center;">
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
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
            <div class="row" id="tags" style="padding-top: 10px;">
                @foreach ($rarticles as $article)
                <section style="padding: 10px;">
                    <div class="row" style="padding: 5px;">
                        <a href="{{URL::to('/article').'/'.$article->id}}" style="text-decoration: none;color: #000000;">
                            {{$article->title}}
                        </a>
                    </div>
                    <div class="row">
                        <a href="{{URL::to('/article').'/'.$article->id}}">
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
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap.js') }}
{{ HTML::script('js/jquery.validate.js') }}
{{ HTML::script('js/jquery.form.js') }}
{{ HTML::script('js/header.js') }}
{{ HTML::script('js/article/article.js') }}
{{ HTML::script('js/ishare.js') }}
</body>
</html>