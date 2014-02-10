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
    {{ HTML::style('packages/bootstrap/css/bootstrap-1391792299980.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header-1391790726872.css') }}
    {{ HTML::style('packages/jcrop/jquery.Jcrop-1390924906017.css') }}
    {{ HTML::style('css/user.icon-1390898781616.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Wrap all page content here -->
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
        <div class="col-xs-3 " bs-sidebar
        " id="sidebar" role="navigation" style="margin-top: 30px;">
        <div class="list-group">
            <a href="{{URL::to('/user/setting')}}" class="list-group-item">基本信息</a>
            <a href="{{URL::to('/user/setting/icon')}}" class="list-group-item active">头像设置</a>
            <a href="{{URL::to('/user/setting/security')}}" class="list-group-item">账号安全</a>
            <a href="{{URL::to('/user/setting/message')}}" class="list-group-item">消息中心</a>
        </div>
    </div>
    <!--/span-->
    <div class="col-xs-9">
        <div class="page-header">
            <h3>头像设置</h3>
        </div>
        <div style="color: #4444dd; font-size: 15px;">
            （请先上传图片，然后选定区域后保存即可完成头像上传功能）
        </div>
        <div style="padding: 20px 0px;">
            <form action="{{URL::to('/user/uploadSourceImage')}}" method="post" id="resizeForm" class="form-inline" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="userSelectIcon">上传头像：</label>
                    <input type="file" name="userSelectIcon" id="userSelectIcon" style="display: inline;"/>
                </div>
                <button type="button" class="" id="uploadResizeBtn">上传</button>
            </form>
        </div>
        <div class="row" style="padding: 30px 0px; background-color: #eeeeee;">
            <div class="col-xs-6">
                <img src="{{URL::to('/img')}}/default.jpg" id="targetImage" width="300" height="280" />
            </div>
            <div class="col-xs-5">
                <div id="preview-pane">
                    <div class="preview-container">
                        <img src="{{URL::to('/')}}/{{Auth::user()->getAvatar()}}" id="thumnailImage" class="jcrop-preview"/>
                    </div>
                </div>
                <div style="padding-top: 30px;">
                    <form action="{{URL::to('/user/saveUserIcon')}}" method="post" id="saveAvatarForm" class="form-inline" enctype="multipart/form-data">
                        <input type="hidden" id="cropImgPath" name="cropImgPath"/>
                        <input type="hidden" id="x" name="x"/>
                        <input type="hidden" id="y" name="y"/>
                        <input type="hidden" id="w" name="w"/>
                        <input type="hidden" id="h" name="h"/>
                        <button type="submit" class="btn btn-success" id="avatar_submit">保存</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!--/span-->
</div>
@include("footer")
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap-1390898781657.js') }}
{{ HTML::script('packages/noty/packaged/jquery.noty.packaged.min.js')}}
{{ HTML::script('js/jquery.validate-1390898781640.js') }}
{{ HTML::script('js/jquery.form-1390898781635.js') }}
{{ HTML::script('js/header-1391790244642.js') }}
{{ HTML::script('packages/jcrop/jquery.Jcrop-1390898781659.js') }}
{{ HTML::script('js/user.icon-1391186978611.js') }}
</body>
</html>
