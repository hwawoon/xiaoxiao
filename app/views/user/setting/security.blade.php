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
    {{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Wrap all page content here -->
<div id="wrap">
    @include('header');
    <!-- Begin page content -->
    <div class="container">
        <div class="row">
            <div class="col-xs-3" id="sidebar" role="navigation" style="margin-top: 30px;">
                <div class="list-group">
                    <a href="{{URL::to('/user/setting')}}" class="list-group-item ">基本信息</a>
                    <a href="{{URL::to('/user/setting/icon')}}" class="list-group-item ">头像设置</a>
                    <a href="{{URL::to('/user/setting/security')}}" class="list-group-item active">账号安全</a>
                </div>
            </div>
            <!--/span-->
            <div class="col-xs-9">
                <div class="page-header">
                    <h3>账号安全</h3>
                </div>
                <div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/span-->
        </div>
    </div>
</div>
</div>
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
</body>
</html>