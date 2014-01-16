<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>{{$pagetitle}}</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header.css') }}
    {{ HTML::style('css/user.profile.css') }}
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
        <div class="jumbotron">
            <p>
                <img src="{{URL::to('/')}}/{{Auth::user()->avatar}}" class="img-responsive img-thumbnail" style="width: 100px;"/>
            </p>
            <p>{{Auth::user()->name}}</p>
            <p class="lead">{{Auth::user()->introduction}}</p>
        </div>
        <div class="row" id="timeliner">
            <div class="timeline_container">
                <div class="timeline">
                    <div class="plus"></div>
                </div>
            </div>
            @foreach($articles as $article)
            <div class="item">
                <div>
                    <p>
                        <a href="{{URL::to('/article').'/'.$article->id}}">
                            {{$article->title}} 发表于{{$article->created_at}}
                        </a>
                    </p>
                    <p>
                    <a href="{{URL::to('/article').'/'.$article->id}}">
                        <img class="img-responsive img-thumbnail" src="{{URL::to('/')}}/{{$article->thumbnailpath}}" style="width: 250px;height: 120px;">
                    </a>
                    </p>
                </div>
            </div>
            @endforeach
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
{{Html::script('js/jquery.masonry.min.js')}}
{{Html::script('js/user.profile.js')}}
</body>
</html>