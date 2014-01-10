<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <title>{{$article->title}}</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header.css') }}
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
                <div class="row">
                    <h3>{{$article->title}}</h3>
                </div>
                <div class="row">
                    <a href="javascript:void(0)">
                        <img class="img-responsive img-thumbnail" src="{{URL::to('/')}}/{{$article->savepath}}" style="width: 100%;">
                    </a>
                </div>
                <div class="row">
                    <div style="display: inline;float: left; padding-right: 10px;margin-top: 5px;">
                    @if (Auth::check())
                        <button type="button" class="btn btn-success" onclick="articlePointUp({{$article->id}});"><i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;&nbsp;<span id="article_up">{{$article->up}}</span></button>
                        <span style="width: 50px;">&nbsp;</span>
                        <button type="button" class="btn btn-success" onclick="articlePointDown({{$article->id}});"><i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;&nbsp;<span id="article_down">{{$article->down}}</span></button>
                    @else
                        <button type="button" class="btn btn-success" onclick="openLoginModal();"><i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;&nbsp;<span id="article_up">{{$article->up}}</span></button>
                        <span style="width: 50px;">&nbsp;</span>
                        <button type="button" class="btn btn-success" onclick="openLoginModal();"><i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;&nbsp;<span id="article_down">{{$article->down}}</span></button>
                    @endif
                    </div>
                    <div style="display: inline;float: left;">
                        <div class="bdsharebuttonbox"><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a
                                href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq"
                                                                                                   data-cmd="tqq"
                                                                                                   title="分享到腾讯微博"></a><a
                                href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#"
                                                                                                    class="bds_t163"
                                                                                                    data-cmd="t163"
                                                                                                    title="分享到网易微博"></a><a
                                href="#" class="bds_kaixin001" data-cmd="kaixin001" title="分享到开心网"></a><a href="#"
                                                                                                          class="bds_sqq"
                                                                                                          data-cmd="sqq"
                                                                                                          title="分享到QQ好友"></a><a
                                href="#" class="bds_more" data-cmd="more"></a></div>
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
                <div class="row" style="margin-top: 5px;">
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
                            <textarea class="form-control" name="myComment" rows="3"></textarea>
                        </div>
                        <div class="myreplybtn">
                                <button type="button" id="articleCommentBtn" class="btn btn-default btn-sm">发送</button>
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
        <div class="col-sm-5">
        </div>
    </div>
    <div class="containerbottom"></div>
</div>
@include("footer")
{{ HTML::script('js/article/article.js') }}
</body>
</html>