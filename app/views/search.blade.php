<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>{{$pagetitle}}</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header.css') }}
    {{ HTML::style('css/home.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<script type="text/javascript">
    var ROOT_PATH = "{{URL::to('/')}}";
    var XIAO =
    {
        "loadingArticle" : 0,
        "getMoreUrl" : "{{$getmore}}",
        "loadedCount" : "{{$articlenum}}"
    };
</script>
<body>
<body>
@include("header")

<div class="container">
    <div class="row">
        <div class="col-xs-8">

        </div>
        <div class="col-xs-4">

        </div>
    </div>
</div> <!-- /container -->

@include("footer")
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap.js') }}
{{ HTML::script('js/jquery.validate.js') }}
{{ HTML::script('js/jquery.form.js') }}
{{ HTML::script('js/header.js') }}
{{ HTML::script('js/home.js') }}
{{ HTML::script('js/ishare.js') }}
</body>
</html>