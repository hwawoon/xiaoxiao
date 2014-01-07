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
</head>
<style type="text/css">
    section .row {
        padding: 5px 0px;
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
                    <button type="button" class="btn btn-success" onclick="articlePointUp({{$article->id}});"><i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;&nbsp;<span id="article_up">{{$article->up}}</span></button>
                    <span style="width: 50px;">&nbsp;</span>
                    <button type="button" class="btn btn-success" onclick="articlePointDown({{$article->id}});"><i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;&nbsp;<span id="article_down">{{$article->down}}</span></button>
                </div>
                <div class="row">
                    <div style="margin-bottom: 10px; margin-top: 0px; border-bottom: 1px solid #eeeeee;">
                        <h4>全部评论({{$article->comments}})</h4>
                    </div>
                </div>
                @if (Session::has('user'))
                <div class="row">
                    <form class="form-horizontal" role="form" method="post" action="{{URL::to('/')}}/article/addcomments/{{Session::get('user')->getId()}}/{{$article->id}}">
                        <div class="form-group">
                            <div class="col-sm-1" style="padding-right: 0px;">
                                <img
                                    src="http://img.dewen.org/upload/avatar/032/180/543/user_32180543_avatar_1374741946_r.jpg"
                                    class="img-responsive img-thumbnail" style="width: 50px;"/>
                            </div>
                            <div class="col-sm-11">
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-1" style="padding-right: 0px;">
                                &nbsp;
                            </div>
                            <div class="col-sm-11" style="text-align: right;">
                                <button type="button" class="btn btn-default btn-sm">发送</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
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