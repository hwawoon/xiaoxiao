<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>xiaoxiao</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap-1390898781649.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header-1391708844091.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@include('header');

<!-- Begin page content -->
<div class="container">
    @if(Session::get('status'))
    <div class="row" style="padding: 10px 20px 0px 20px; text-align: center;">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('message')}}
        </div>
    </div>
    @elseif(Session::get('status') === false)
    <div class="row" style="padding: 10px 20px 0px 20px; text-align: center;">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('message')}}
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-xs-3" id="sidebar" role="navigation" style="margin-top: 30px;">
            <div class="list-group">
                <a href="{{URL::to('/user/setting')}}" class="list-group-item active">基本信息</a>
                <a href="{{URL::to('/user/setting/icon')}}" class="list-group-item ">头像设置</a>
                <a href="{{URL::to('/user/setting/security')}}" class="list-group-item">账号安全</a>
                <a href="{{URL::to('/user/setting/message')}}" class="list-group-item">消息中心</a>
            </div>
        </div>
        <!--/span-->
        <div class="col-xs-9">
            <div class="page-header">
                <h3>基本信息</h3>
            </div>
            <div>
                <form role="form" id="basicForm" action="{{URL::to('/user/saveUserBasicInfo')}}" style="line-height: 40px;" method="post">
                    <div class="form-group">
                        <label for="inputName">尊称</label>
                        <input type="text" class="form-control" name="username" id="username" value="{{Auth::user()->name}}" placeholder="尊称" disabled />
<!--                        <span class="help-block">建议使用实名、或您常用的昵称注册</span>-->
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1">一句话介绍</label>
                        <textarea class="form-control" rows="3" name="introduction" id="introduction" placeholder="让人们认识你">{{Auth::user()->introduction}}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn">保存</button>
                    </div>
                </form>
            </div>
        </div>
        <!--/span-->
    </div>
</div>
@include("footer")
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap-1390898781657.js') }}
{{ HTML::script('js/jquery.validate-1390898781640.js') }}
{{ HTML::script('js/jquery.form-1390898781635.js') }}
{{ HTML::script('js/header-1390898781631.js') }}
<script type="text/javascript">
    $(function(){
        $("#basicForm").validate({
            rules: {
                username: {
                    required: true
                }
            },
            messages: {
                username: "请输入亲的尊称"
            }
        });
    });
</script>
</body>
</html>