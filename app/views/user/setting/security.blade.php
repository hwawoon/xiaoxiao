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
    {{ HTML::style('css/header-1391627402231.css') }}
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
        @if(Session::get('message'))
        <div class="row" style="padding: 10px 20px 0px 20px; text-align: center;">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{Session::get('message')}}
            </div>
        </div>
        @endif
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
                    <form class="form-horizontal" id="passwordForm" method="post" action="{{action('UserController@updatePassword')}}">
                        <div class="form-group">
                            <label for="old_password" class="col-sm-2 control-label">当前密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="old_password" id="old_password" placeholder="当前密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-sm-2 control-label">新密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="新密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newPasswordConfirm" class="col-sm-2 control-label">确认密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="确认密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">保存</button>
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
{{ HTML::script('packages/bootstrap/js/bootstrap-1390898781657.js') }}
{{ HTML::script('js/jquery.validate-1390898781640.js') }}
{{ HTML::script('js/jquery.form-1390898781635.js') }}
{{ HTML::script('js/header-1390898781631.js') }}
{{ HTML::script('js/user.security-1391442139359.js') }}
</body>
</html>