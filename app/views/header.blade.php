<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('/')}}">
                搞笑娃
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="sitenav"><a href="{{URL::to('/')}}"><i class="glyphicon glyphicon-fire"></i>热门</a></li>
                <li class="sitenav"><a href="{{URL::to('/latest')}}">新鲜</a></li>

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
                            <a class="btn btn-danger" data-toggle="modal" data-target="#loginModal">上传</a>
                            @endif
                        </div>
                    </form>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{URL::to('/')}}/{{Auth::user()->getAvatar()}}" width="20px" />
                        {{Auth::user()->name}}<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{URL::to('/user/profile')}}">个人主页</a></li>
                        <li><a href="{{URL::to('/user/setting')}}">设置</a></li>
                        <li><div class="divider"></div> </li>
                        <li><a href="{{URL::to('/user/logout')}}" id="alogout">退出</a></li>
                    </ul>
                </li>
                @else
                <li><a href="#login" id="login" class="" data-toggle="modal" data-target="#loginModal">登录</a></li>
                <li><a href="{{URL::to('/user/register')}}" id="register">注册</a></li>
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

<!-- login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">
                    登录
                </h3>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger" id="loginAlert" style="display:none; text-align: center;">
                    <strong></strong>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <form class="form-horizontal" role="form" id="loginForm" method="post" action="{{URL::to('/user/doLogin')}}">

                        <div class="input-group inputfirst">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" id="inputLoginEmail" name="inputLoginEmail" class="form-control inputlog" placeholder="邮箱">
                        </div>
                        <div class="input-group inputtwo">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control inputlog" id="inputLoginPassword" name="inputLoginPassword" placeholder="密码">
                        </div>
                        <div class="input-group" style="width: 408px;padding: 5px;">
                            <div style="float: left;">
                                <input type="checkbox" name="rememberme" id="rememberme" value="1" checked /> 下次自动登录
                            </div>
                            <div style="float: right !important;">
                                <a href="#">忘记密码</a>
                            </div>
                        </div>
                        <div class="input-group" style="padding: 15px 0px;">
                            <button type="submit" class="btn btn-primary" id="btnLogin">登录</button>
                            <a href="{{URL::to('/user/register')}}"> 还没有账号？立即注册！</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- feedback Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{URL::to('/article/uploadImage')}}" method="post" id="uploadImageForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">只为搞笑</h3>
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
                        <button type="button" id="uploadImageBtn" class="btn btn-success">上传</button>
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
            <form action="{{URL::to('/article/forwardImage')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Just For Fun!</h3>
                    Upload funny pictures, paste pictures or YouTube URL, accepting GIF/JPG/PNG (最大: 3MB)
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="forwardUrl">地址</label>
                        <input type="text" class="form-control" id="forwardUrl" placeholder="http;//">
                    </div>
                    <div class="form-group">
                        <label>标题</label>
                        <textarea class="form-control" rows="2" name="title" placeholder="标题..."></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">上传</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="feedback">
    <a href="mailto:hwawoon@163.com" class="btn btn-primary" style="border-radius: 0px;padding: 10px;"
       role="button" title="我会认真处理每一个反馈">反<br>馈</a>
</div>
<a href="#" title="返回顶部" class="goto-top"></a>