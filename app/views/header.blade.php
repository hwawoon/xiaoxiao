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
            <a class="navbar-brand" href="{{URL::to('/')}}">xiao</a>
        </div>
        <div class="collapse navbar-collapse">
            <div class="col-sm-3 col-md-3 pull-left">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{URL::to('/')}}">热门的</a></li>
                    <li><a href="#about">新鲜的</a></li>
                </ul>
            </div>
            <div class="col-sm-1 col-md-1 pull-right">
                <form class="navbar-form" role="search" method="post">
                    <div class="input-group">
                        @if (Session::has('user'))
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
            </div>
            <div class="col-sm-2 col-md-2 pull-right">
                <ul class="nav navbar-nav navbar-right">
                    @if (Session::has('user'))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Session::get('user')->getUserName()}}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{URL::to('/user/setting')}}">个人主页</a></li>
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
            </div>
            <!--              搜索框预留位置-->
            <div class="col-sm-3 col-md-3 pull-right">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="搜索" name="srch-term" id="srch-term">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>

<div class="feedback">
    <a href="#" class="btn btn-default btn-lg" role="button" data-toggle="modal" data-target="#feedbackModal">反<br>馈</a>
</div>
<a href="#" title="返回顶部" class="goto-top"></a>


<!-- login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">
                    &nbsp;&nbsp;登录
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <small><a href="{{URL::to('/user/register')}}">没有账号？现在就去注册！</a></small>
                </h4>
            </div>
            <div class="alert alert-danger" id="loginAlert" style="display: none;text-align: center;">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                <strong>用户名或密码错误</strong>
            </div>
            <div class="modal-body" style="padding-left: 70px;">
                <form class="form-horizontal" role="form" id="loginForm" method="post" action="{{URL::to('/user/doLogin')}}">
                    <div class="form-group">
                        <label for="inputLoginEmail" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control inputlog" id="inputLoginEmail" name="inputLoginEmail" placeholder="邮箱">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLoginPassword" class="col-sm-2 control-label">密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control inputlog" id="inputLoginPassword" name="inputLoginPassword"
                                   placeholder="密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                            <div style="float: left;"><input type="checkbox" name="rememberme" id="rememberme" value="1" checked /> 记住我</div>
                            <div style="float: right;margin-right: 100px;"><a>忘记密码</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">&nbsp;</label>
                        <div style="margin: 0 auto;">
                            <button type="submit" class="btn btn-primary btn-lg" id="btnLogin">
                                &nbsp;&nbsp;&nbsp;&nbsp;登&nbsp;&nbsp;录&nbsp;&nbsp;&nbsp;&nbsp;
                            </button>
                        </div>
                    </div>
                </form>
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
                    <h3 class="modal-title">Just For Fun!</h3>
                    Upload funny pictures, paste pictures or YouTube URL, accepting GIF/JPG/PNG (最大: 3MB)
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

<!-- feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">亲，有什么好建议吗</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">提交</button>
            </div>
        </div>
    </div>
</div>