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
    {{ HTML::style('js/jcrop/jquery.Jcrop.css') }}
    {{ HTML::style('css/user.icon.css') }}
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<script type="text/javascript">
    var ROOT_PATH = "{{URL::to('/')}}";
</script>
<body>
<!-- Wrap all page content here -->
<div id="wrap">
    @include('header');
    <!-- Begin page content -->
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-3" id="sidebar" role="navigation" style="margin-top: 30px;">
                <div class="list-group">
                    <a href="{{URL::to('/user/setting')}}" class="list-group-item">基本信息</a>
                    <a href="{{URL::to('/user/setting/icon')}}" class="list-group-item active">头像设置</a>
                    <a href="{{URL::to('/user/setting/security')}}" class="list-group-item">账号安全</a>
                </div>
            </div>
            <!--/span-->
            <div class="col-xs-9">
                <div class="page-header">
                    <h3>头像设置</h3>
                </div>
                <div class="row">
                    <div class="row">
                        <form action="{{URL::to('/user/uploadSourceImage')}}" method="post" id="resizeForm" class="form-inline" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label" for="userSelectIcon">上传头像</label>
                                <input type="file" name="userSelectIcon" id="userSelectIcon" style="display: inline;" />
                            </div>
                            <button type="button" class="btn btn-info" id="uploadResizeBtn">上传</button>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-lg-7">
                            <img src="{{URL::to('/')}}/default.jpg" id="targetImage" width="300" height="280" />
                        </div>
                        <div class="col-lg-4">
                            <div id="preview-pane">
                                <div class="preview-container">
                                    <img src="{{URL::to('/')}}/{{Auth::user()->getAvatar()}}" id="thumnailImage" class="jcrop-preview" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{URL::to('/user/saveUserIcon')}}" method="post" id="saveAvatarForm" class="form-inline" enctype="multipart/form-data">
                        <input type="hidden" id="cropImgPath" name="cropImgPath" />
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                        <button type="button" class="btn btn-info" id="avatar_submit">保存</button>
                    </form>
                </div>
            </div>
            <!--/span-->
        </div>
    </div>
</div>
@include("footer")
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('js/bootstrap.js') }}
{{ HTML::script('js/jquery.validate.js') }}
{{ HTML::script('js/jquery.form.js') }}
{{ HTML::script('js/header.js') }}
{{ HTML::script('js/jcrop/jquery.Jcrop.js') }}
{{ HTML::script('js/user.icon.js') }}
</body>
</html>
