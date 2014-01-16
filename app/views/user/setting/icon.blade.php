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
                <div class="row" style="padding: 50px;">
                    <div class="row">
                        <img src="{{URL::to('/')}}/default.jpg" id="target" alt="[Jcrop Example]" width="300" height="280" class="re" />
                        <div id="preview-pane">
                            <div class="preview-container">
                                <img src="{{URL::to('/')}}/{{Auth::user()->getAvatar()}}" class="jcrop-preview" alt="Preview" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <form action="" method="post" id="uploadImageForm" class="form-inline">
                            <div class="form-group">
                                <label class="control-label" for="userSelectIcon">上传头像</label>
                                <input type="file" name="userSelectIcon" id="userSelectIcon" />
                            </div>

                            <button type="button" class="btn btn-info" id="avatar_submit">上传</button>
                        </form>
                    </div>
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
</body>
</html>
<script type="text/javascript">
    jQuery(function($){
        // Create variables (in this scope) to hold the API and image size
        var jcrop_api,
             boundx,
             boundy,

        // Grab some information about the preview pane
            $preview = $('#preview-pane'),
            $pcnt = $('#preview-pane .preview-container'),
            $pimg = $('#preview-pane .preview-container img'),

            xsize = $pcnt.width(),
            ysize = $pcnt.height();

        $('#target').Jcrop({
            onChange: updatePreview,
            onSelect: updatePreview,
            aspectRatio: 1
        },function(){
            // Use the API to get the real image size
            var bounds = this.getBounds();
            boundx = bounds[0];
            boundy = bounds[1];
            // Store the API in the jcrop_api variable
            jcrop_api = this;

            // Move the preview into the jcrop container for css positioning
            $preview.appendTo(jcrop_api.ui.holder);
        });

        function updatePreview(c)
        {
            if (parseInt(c.w) > 0)
            {
                var rx = xsize / c.w;
                var ry = ysize / c.h;

                $pimg.css({
                    width: Math.round(rx * boundx) + 'px',
                    height: Math.round(ry * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });
            }
        };

        $("#avatar_submit").bind("click",function(){
            $("#uploadImageForm").ajaxSubmit({
                beforeSubmit: function(){
                    if($('#userSelectIcon').val() == "")
                    {
                        alert("请选择上传图片！");
                        return false;
                    }
                },
                dataType:'json',
                success:function(data)
                {

                }
            });
        });

    });

</script>