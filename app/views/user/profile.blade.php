@extends('layouts.main')

@section('title', '个人主页 - 为生活添欢乐')

@section('styles')
{{ HTML::style('css/user.profile.css') }}
@stop

@section('header_type')
navbar-fixed-top
@stop

@section('profile-header')
<div class="profile-header">
    <p>
        <img src="{{URL::to('/')}}/{{Auth::user()->avatar}}" class="img-user-avatar" style="width: 120px;"/>
    </p>
    <p style="font-weight: bold;">{{Auth::user()->name}}</p>
    <p class="lead">{{Auth::user()->introduction}}</p>
</div>
<nav class="navbar navbar-default profile-navbar" role="navigation">
    <div class="container">
        <ul class="nav navbar-nav profile-nav">
            <li><a class="selected" href="#">发布内容</a></li>
            <li><a href="#">评论</a></li>
            <li><a href="#">投票</a></li>
        </ul>
    </div>
</nav>
@stop

@section('content')
<div class="row">
    <div class="col-xs-8">
        @include('includes.article-section')
    </div>
    <div class="col-xs-4 rrecommend">
        <div class="row recomdhead">
            <span class="label label-warning">推荐一下</span>
        </div>
        <div class="row tags">
            @include('includes.sidebar')
        </div>
        @include('includes/hfooter')
    </div>
</div>
@stop

@section('scripts')
{{ HTML::script('packages/jquery.masonry.min.js')}}
{{ HTML::script('js/user.profile.js') }}
@stop