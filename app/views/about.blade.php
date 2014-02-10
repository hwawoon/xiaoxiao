<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>关于我</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap-1391792299980.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header-1391790726872.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@include('header')
<div class="container">
    <div class="row" style="margin-top: 50px;text-align: center;">
        <p>哈喽啊,我是KimHwawoon</p>
        <p>我是一个苦逼的程序猿，活在天朝帝都</p>
        <p>代码写了一大堆,项目做了一个又一个,可是兜里的荷包不见多= =</p>
        <p>我想找点乐子，就自己动手写了个小网站，分享个小图片，找找乐子</p>
        <p>这网站名字么，我有个小屁孩，天天能给我带点欢乐，就起了这么个名字《搞笑娃》</p>
        <p>我是java出身，现在被忽悠去搞php了，总是有被坑了的赶脚...</p>
        <p>网站代码在github上，代码写的不咋样，多多包涵= =!</p>
        <p>php代码基于Laravel4框架开发的，真心觉得这个框架很方便啊！</p>
        <p>前端框架使用bootstrap3，就是twitter那个，也很不错</p>
        <p>有问题可以联系我啊,老板盯着紧，联系我就给我发邮件吧！</p>
        <p>kimhwawoon@gmail.com</p>
        <p><a href="https://github.com/kimhwawoon/xiaoxiao" target="_blank">搞笑娃 on GitHub</a></p>
    </div>
</div> <!-- /container -->

@include('footer')
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap-1390898781657.js') }}
{{ HTML::script('packages/noty/packaged/jquery.noty.packaged.min.js')}}
{{ HTML::script('js/jquery.validate-1390898781640.js') }}
{{ HTML::script('js/jquery.form-1390898781635.js') }}
{{ HTML::script('js/header-1391790244642.js') }}
</body>
</html>