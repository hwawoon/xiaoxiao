<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>管理后台</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('css/admin.css') }}
    @yield('styles')
    <!-- Add custom CSS here -->
</head>

<body>

<div id="wrapper">
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('/admin')}}">管理后台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active"><a href="{{URL::to('/admin')}}">仪表盘</a></li>
                <li><a href="{{URL::to('/admin/users')}}">用户管理</a></li>
                <li><a href="{{URL::to('/admin/articles')}}">图片管理</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right navbar-user">
                <li class="dropdown alerts-dropdown">
                    <a href="{{URL::to('/')}}">
                        返回首页
                    </a>
                </li>
                <li><a href="{{URL::to('/user/logout')}}" id="alogout">退出</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-xs-12">
                @yield('content')
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- JavaScript -->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap.js') }}
@yield('scripts')
</body>
</html>