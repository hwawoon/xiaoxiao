@extends('layouts.main')

@section('title', '个人主页 - 为生活添欢乐')

@section('styles')
{{ HTML::style('css/user.profile.css')}}
@stop

@section('header_type')
navbar-fixed-top
@stop

@section('container-header')
<div class="profile-header">
    <p>
        <img src="{{URL::to('/')}}/{{$user->avatar}}" class="img-user-avatar" style="width: 120px;"/>
    </p>
    <p style="font-weight: bold;">{{$user->name}}</p>
    <p class="lead">{{$user->introduction}}</p>
</div>
<nav class="navbar navbar-default profile-navbar" role="navigation">
    <div class="container">
        <ul class="nav navbar-nav profile-nav">
            <li><a class="selected" href="{{action('UserController@getUserProfile',array('name'=>$user->name))}}">发布内容</a></li>
            <li><a href="{{action('UserController@getUserCommentArticle',array('name'=>$user->name))}}">评论</a></li>
            <li><a href="{{action('UserController@getUserVoteArticle',array('name'=>$user->name))}}">投票</a></li>
        </ul>
    </div>
</nav>
@stop

@section('content')
<div class="row" style="margin-bottom: 40px;">
    <div class="col-xs-8">
        @if(Auth::check() && Auth::user()->id = $user->id)
            @include('includes.article-section',array('del_display'=>'true'))
        @else
            @include('includes.article-section')
        @endif
        {{$articles->links()}}
    </div>
    <div class="col-xs-4 rrecommend">
        <div class="row tags">
            @include('includes.sidebar')
        </div>
        @include('includes/hfooter')
    </div>
</div>
@stop

@section('scripts')
{{ HTML::script('js/user.profile.js') }}
@if(Session::get('message'))
<script type="text/javascript">
    noty({
        text        : "{{Session::get('message')}}",
        type        : "alert",
        dismissQueue: true,
        killer: true,
        layout      : 'topCenter',
        theme       : 'defaultTheme',
        timeout: 2000
    });
</script>
@endif

@stop