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
    {{ HTML::style('css/bootstrap.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header.css') }}
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<style type="text/css">

</style>
<body>
<!-- Wrap all page content here -->
<div id="wrap">
    @include('header');
    <!-- Begin page content -->
    <div class="container">
        <div class="page-header">
            <h2>亲，欢迎加入我们！</h2>
        </div>
        <form class="form-horizontal" role="form" id="registerform" action="{{URL::to('/user/doRegister')}}" method="post">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">尊称</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" name="name" placeholder="名字">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">邮箱</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="邮箱">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="password" name="password" placeholder="密码">
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="确认密码">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-6">
                    点击注册即表明你同意我们的<a href="#">服务条款</a>且你已阅读过我们的<a href="#">数据使用政策</a>，包括我们的<a href="#">Cookie使用</a>。
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" class="btn btn-success btn-lg">我来注册！</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@include("footer")
</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#registerform').validate(
            {
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    }
                },
                messages: {
                    name: {
                        required: "请输入您的尊称！"
                    },
                    email: {
                        required: "请输入Email地址！",
                        email: "请输入正确的email地址"
                    },
                    password: {
                        required: "请输入密码",
                        minlength: jQuery.format("密码不能小于{0}个字 符")
                    },
                    password_confirmation: {
                        required: "请输入确认密码",
                        minlength: "确认密码不能小于6个字符",
                        equalTo: "两次输入密码不一致"
                    }
                }
            });
    });
</script>