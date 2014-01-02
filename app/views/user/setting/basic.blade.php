<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <title>xiaoxiao</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header.css') }}
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
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

            <div class="col-xs-6 col-sm-3" id="sidebar" role="navigation" style="margin-top: 30px;">
                <div class="list-group">
                    <a href="{{URL::to('/user/setting')}}" class="list-group-item active">基本信息</a>
                    <a href="{{URL::to('/user/setting/icon')}}" class="list-group-item ">头像设置</a>
                    <a href="{{URL::to('/user/setting/security')}}" class="list-group-item">账号安全</a>
                </div>
            </div>
            <!--/span-->
            <div class="col-xs-9">
                <div class="page-header">
                    <h3>基本信息</h3>
                </div>
                <div>
                    <form role="form" style="line-height: 40px;">
                        <div class="form-group">
                            <label for="inputName">昵称</label>
                            <input type="text" class="form-control" id="inputName" placeholder="昵称">
                            <span class="help-block">建议使用实名、或您常用的昵称注册</span>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1">一句话介绍</label>
                            <textarea class="form-control" rows="3" placeholder="让人们认识你这个大英雄"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">所在地</label><br>
                            <div class="col-xs-3">
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn">保存</button>
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
{{ HTML::script('js/usersetting.js') }}
</body>
</html>