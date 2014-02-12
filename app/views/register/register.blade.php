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
    {{ HTML::style('packages/bootstrap/css/bootstrap-1391792299980.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header-1391790726872.css') }}
    {{ HTML::style('css/user.register.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@include('header');
<!-- Begin page content -->
<div class="container register">
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
    <div class="row">
        <form role="form" id="registerform" action="{{URL::to('/user/doRegister')}}" method="post">
            <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
            <div class="col-xs-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="名字">
            </div>
            <div class="col-xs-4">
                <input type="email" class="form-control" id="email" name="email" placeholder="邮箱">
            </div>
            <div class="col-xs-3">
                <input type="text" class="form-control" id="password" name="password" placeholder="密码">
            </div>
            <div class="col-xs-1">
                <button class="btn btn-primary" type="submit" >注册</button>
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
{{ HTML::script('js/header-1391790244642.js') }}
{{ HTML::script('js/user.register.js') }}
</body>
</html>