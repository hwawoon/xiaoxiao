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
<body>
<!-- Wrap all page content here -->
<div id="wrap">
    @include('header');
    <!-- Begin page content -->
    <div class="container">
        <div class="col-sm-8">
            <section style="padding-bottom: 20px;">
                <div class="row">
                    <h2>{{$article->title}}</h2>
                </div>
                <div class="row" style="padding: 5px;">
                    <a href="#">
                        <img class="img-responsive img-thumbnail" src="{{URL::to('/')}}/{{$article->savepath}}" style="width: 100%;">
                    </a>
                </div>
                <div class="row" style="padding: 5px;">
                    <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;&nbsp;{{$article->up}}</button>
                    <span style="width: 50px;">&nbsp;</span>
                    <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-thumbs-down"></i>&nbsp;&nbsp;{{$article->down}}</button>
                </div>
                <div class="row" style="padding: 5px;">
                    @if (Session::has('user'))
                    <form>
                        <div class="col-sm-1" style="padding: 0px;">
                            <img
                                src="http://img.dewen.org/upload/avatar/032/180/543/user_32180543_avatar_1374741946_r.jpg"
                                class="img-responsive img-thumbnail" />
                        </div>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-sm-11">
                            <button type="button" class="btn btn-success btn-sm">发送</button>
                        </div>
                    </form>
                    @endif
                </div>
            </section>
        </div>
        <div class="col-sm-5">
        </div>
    </div>
    <div class="containerbottom"></div>
</div>
@include("footer")
</body>
</html>