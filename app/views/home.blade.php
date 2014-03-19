@extends('layouts.main')

@section('title', '搞笑娃 - 为生活添欢乐')

@section('keywords', '搞笑娃,为生活添欢乐')

@section('description', '搞笑娃,为生活添欢乐')

@section('styles')
@stop

@section('header_type')
navbar-fixed-top
@stop

@section('content')

<div class="col-xs-8" id="home_articles">
    @include('includes.article-section')
</div>
<div class="col-xs-4">
    @include('includes.sidebar')
    @include('includes.hfooter')
</div>

<div class="containerbottom"></div>
@stop

@section('scripts')
<script type="text/javascript">
var XIAO =
{
    "stop": false,
    "loadingArticle": 0,
    "getMoreUrl": "{{$getmore}}",
    "loadedCount": "{{$num}}"
};
</script>
{{ HTML::script('js/home.js') }}
<script type="text/javascript" id="bdshare_js" data="type=tools" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
@stop