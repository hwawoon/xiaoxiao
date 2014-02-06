<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>重置密码</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap-1390898781649.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header-1391627402231.css') }}
    {{ HTML::style('css/password.remind-1391625679099.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@include('header')

<div class="container">
    <div class="remindpage">
        <div class="page-header">
            找回密码
        </div>
        {{Session::get("status");}}
        {{Session::get("error");}}
        <form class="form-inline" role="form" action="{{ action('RemindersController@postRemind') }}" method="POST">
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="输入邮箱">
            </div>
            <button type="submit" class="btn btn-default">发送</button>
        </form>
    </div>
</div> <!-- /container -->

@include('footer')
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap-1390898781657.js') }}
{{ HTML::script('packages/noty/packaged/jquery.noty.packaged.min.js')}}
{{ HTML::script('js/jquery.validate-1390898781640.js') }}
{{ HTML::script('js/jquery.form-1390898781635.js') }}
{{ HTML::script('js/header-1390898781631.js') }}
{{ HTML::script('js/ishare-1390898781634.js') }}
</body>
</html>