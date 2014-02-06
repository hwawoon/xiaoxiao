<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>消息中心</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap-1390898781649.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header-1391708844091.css') }}

    {{ HTML::style('css/user.message.css') }}
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
                    <a href="{{URL::to('/user/setting/security')}}" class="list-group-item">账号安全</a>
                    <a href="{{URL::to('/user/setting/message')}}" class="list-group-item active">消息中心</a>
                </div>
            </div>
            <!--/span-->
            <div class="col-xs-9">
                <div class="page-header">
                    <h3>消息中心</h3>
                </div>
                <div>
                    @foreach($messages as $message)
                        <div>
                            {{$message->from_username}} 回复了 <a href="{{URL::to('/')}}/article/{{$message->articleid}}">
                                {{$message->title}}
                            </a>
                        </div>
                        <div>

                        </div>
                    @endforeach
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
</body>
</html>