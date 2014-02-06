<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>注册</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap-1390898781649.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header-1391708844091.css') }}
    {{ HTML::style('css/user.register-1391621541843.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<script type="text/javascript">
    var ROOT_PATH = "{{URL::to('/')}}";
</script>
<body>
@include('header');

<!-- Begin page content -->
<div class="container register">
    <div class="">
        <h1>注&nbsp;&nbsp;册</h1>
    </div>
    <div class="row">
        <form class="form-horizontal" role="form" id="registerform" action="{{URL::to('/user/doRegister')}}" method="post">
            @if($errors->has())
                @foreach ($errors->all() as $error)
                <div class="form-group" style="margin-top: 0px;">
                    <div class="alert alert-danger" style="text-align: center; padding: 10px 10px;">
                        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                            {{ $error }}
                    </div>
                </div>
                @endforeach
            @endif
            <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">尊称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="名字">
                    <span class="help-block">建议使用您常用的昵称注册，注册后不允许修改</span>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">邮箱</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="邮箱">
                    <span class="help-block">建议使用您常用的邮箱注册</span>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">密码</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="password" name="password" placeholder="密码">
                    <span class="help-block">密码不能小于6个字符</span>
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="确认密码">
                </div>
            </div>
            <div class="form-group" style="">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    点击注册即表明你同意我们的<a href="#">服务条款</a>且你已阅读过我们的<a href="#">数据使用政策</a>，包括我们的<a href="#">Cookie使用</a>。
                </div>
            </div>
            <div class="form-group submitDiv">
                    <button type="submit" >注册</button>
            </div>
        </form>
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
{{ HTML::script('js/user.register-1390898781641.js') }}
</body>
</html>