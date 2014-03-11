<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>@yield('title')</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/app.css') }}
    @yield('styles')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    @include('includes.ga')
</head>
<body>
<!-- Fixed navbar -->
<div class="navbar navbar-default @yield('header_type')" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand header-logo" href="{{URL::to('/')}}">
                搞笑娃
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if(isset($pageinfo) && $pageinfo == 'latest')
                <li class="sitenav"><a href="{{URL::to('/')}}"><i class="glyphicon glyphicon-fire"></i>热门</a></li>
                <li class="sitenav active"><a href="{{URL::to('/latest')}}">新鲜</a></li>
                @elseif(isset($pageinfo) && $pageinfo == 'home')
                <li class="sitenav active"><a href="{{URL::to('/')}}"><i class="glyphicon glyphicon-fire"></i>热门</a></li>
                <li class="sitenav"><a href="{{URL::to('/latest')}}">新鲜</a></li>
                @else
                <li class="sitenav"><a href="{{URL::to('/')}}"><i class="glyphicon glyphicon-fire"></i>热门</a></li>
                <li class="sitenav"><a href="{{URL::to('/latest')}}">新鲜</a></li>
                @endif
                <li class="sitenav"><a href="{{URL::to('/gif')}}">动图</a></li>
                <li class="dropdown">
                    <a href="#" id="morelist" role="button" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="morelist">
                        <li><a tabindex="-1" href="{{URL::to('/cute')}}">可爱</a></li>
                        <li><a tabindex="-1" href="{{URL::to('/jiong')}}">囧图</a></li>
                        <li><a tabindex="-1" href="{{URL::to('/beauty')}}">美女</a></li>
                        <li><a tabindex="-1" href="{{URL::to('/tucao')}}">吐槽</a></li>
                        <li><a tabindex="-1" href="{{URL::to('/other')}}">其他</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <form class="navbar-form" role="search" method="post">
                        <div class="input-group">
                            @if (Auth::check())
                            <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">上传</a>
                            <ul class="dropdown-menu" role="menu" style="min-width: 100px;">
                                <li><a data-toggle="modal" data-target="#uploadModal">本地上传</a></li>
                                <li><a  data-toggle="modal" data-target="#forwardModal">转发图片</a></li>
                            </ul>
                            @else
                            <a class="btn btn-danger" href="javascript:openLoginModal();void(0);">上传</a>
                            @endif
                        </div>
                    </form>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                <li class="dropdown">
                    <a href="#" id="message_list" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-bell messageicon"></i> <span class="badge" id="message_count">
                            {{Auth::user()->messages}}
                        </span>
                    </a>
                    <ul class="dropdown-menu" id="message_box">
                        <li class="msg_loading" >
                            {{HTML::image('img/loading.gif')}}
                        </li>
                        <li class="divider"></li>
                        <li style="text-align: center;"><a href="{{URL::to('/user/message')}}">查看更多消息</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{URL::to('/')}}/{{Auth::user()->getAvatar()}}" width="20px" />
                         我 <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{URL::to('/user/profile')}}">个人主页</a></li>
                        <li><a href="{{URL::to('/user/setting')}}">设置</a></li>
                        @if(Auth::user()->is_admin)
                        <li><a href="{{URL::to('/admin')}}">管理后台</a></li>
                        @endif
                        <li><div class="divider"></div> </li>
                        <li><a href="{{URL::to('/user/logout')}}" id="alogout">退出</a></li>
                    </ul>
                </li>
                @else
                <li class="loginbar">
                    <a href="#" data-toggle="dropdown" id="loginShowBtn">登录<span class="caret"></span></a>
                    <div id="loginPanel" class="dropdown-menu">
                        <form class="form-horizontal" role="form" id="loginForm" method="post" action="{{URL::to('/user/doLogin')}}">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="text" id="inputLoginEmail" name="inputLoginEmail" class="form-control inputlog" placeholder="邮箱">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control inputlog" id="inputLoginPassword" name="inputLoginPassword" placeholder="密码">
                            </div>
                            <div class="input-group loginrmb">
                                <div style="float: left;">
                                    <input type="checkbox" name="rememberme" id="rememberme" value="1" checked />
                                    <label for="rememberme">下次自动登录</label>
                                </div>
                                <div style="float: right !important;">
                                    <a href="{{URL::to('/user/reset')}}">忘记密码</a>
                                </div>
                            </div>
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary" id="btnLogin">登录</button>
                            </div>
                            <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                        </form>
                    </div>
                </li>
                <li><a href="{{URL::to('/register')}}" id="register">注册</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right searchbar">
                <li>
                    <form class="navbar-form" id="searchform" role="search" method="get" action="{{URL::to('/article/search')}}">
                        <div class="input-group">
                            <input type="text"  class="form-control" placeholder="搜索" name="srch-term" id="srch-term">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<!-- feedback Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{URL::to('/uploadImage')}}" method="post" id="uploadImageForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">分享搞笑图片</h3>
                    上传有趣的图片，也可以从其他地方转载, 图片格式：GIF/JPG/PNG (最大: 3MB)
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" id="uploadImage" name="uploadImage" />
                    </div>
                    <div class="form-group">
                        <label>标题</label>
                        <textarea class="form-control" rows="2" id="title" name="title" placeholder="标题..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>分类</label>
                        <select class="form-control" name="uplaodType" id="uplaodType">
                            <option value="0">默认分类</option>
                            <option value="1">可爱</option>
                            <option value="2">囧图</option>
                            <option value="3">美女</option>
                            <option value="4">吐槽</option>
                        </select>
                    </div>
                    <div class="form-group" style="padding-top: 15px;">
                        <button type="button" id="uploadImageBtn" class="btn btn-success" style="padding: 6px 25px;">上传</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- feedback Modal -->
<div class="modal fade" id="forwardModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="forwardImageForm" action="{{URL::to('/article/forwardImage')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">分享搞笑图片</h3>
                    上传有趣的图片，也可以从其他地方转载, 图片格式：GIF/JPG/PNG (最大: 3MB)
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="forwardUrl">地址</label>
                        <input type="text" class="form-control" name="forwardUrl" id="forwardUrl" placeholder="http://">
                    </div>
                    <div class="form-group">
                        <label>标题</label>
                        <textarea class="form-control" rows="2" name="title" placeholder="标题..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>分类</label>
                        <select class="form-control" name="forwardType" id="forwardType">
                            <option value="0">默认分类</option>
                            <option value="1">可爱</option>
                            <option value="2">囧图</option>
                            <option value="3">美女</option>
                            <option value="4">吐槽</option>
                        </select>
                    </div>
                    <div class="form-group" style="padding-top: 15px;">
                        <button type="button" id="forwardImageBtn" class="btn btn-success" style="padding: 6px 25px;">上传</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="feedback">
    <a href="mailto:kimhwawoon@gmail.com" class="btn btn-feedback" role="button" title="我会认真处理每一个反馈">反<br>馈</a>
</div>
<a href="#" title="返回顶部" class="goto-top"></a>
@yield('profile-header')
<div class="container mainarea">
    @yield('content')
</div>

</body>
</html>
<script type="text/javascript">
    var ROOT_PATH = "{{URL::to('/')}}";
</script>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('packages/jquery.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('packages/noty/packaged/jquery.noty.packaged.min.js')}}
{{ HTML::script('packages/jquery.validate.min.js')}}
{{ HTML::script('packages/jquery.form.min.js') }}
{{ HTML::script('js/app.js') }}
@yield('scripts')