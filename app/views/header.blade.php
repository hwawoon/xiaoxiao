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
                    <li class="active"><a href="{{URL::to('/')}}">热门</a></li>
                    <li><a href="#about">最新</a></li>
                </ul>
            </div>
            <div class="col-sm-1 col-md-1 pull-right">
                <form class="navbar-form" role="search" method="post">
                    <div class="input-group">
                            <button class="btn btn-danger" type="submit">上传</button>
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
                <form class="form-horizontal" role="form" id="loginForm" method="post" action="user/doLogin">
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
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">上传</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">上传</button>
            </div>
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