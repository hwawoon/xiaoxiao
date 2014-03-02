@extends('layouts.main')

@section('title', '找回密码 - 为生活添欢乐')

@section('styles')
@stop

@section('header_type')
navbar-fixed-top
@stop

@section('content')
<div class="remindpage">
    <div class="page-header">
        <h3>找回密码</h3>
    </div>
    <form class="form-inline" role="form" action="{{ action('RemindersController@postRemind') }}" method="POST">
        <div class="form-group">
            <label class="sr-only" for="email">邮箱</label>
            <input type="email" class="form-control" id="email" size="30" name="email" placeholder="输入邮箱">
        </div>
        <button type="submit" class="btn btn-default btn-primary">发送</button>
    </form>
    <div style="padding-top:10px;color:red;">
    {{Session::get("status");}}
    {{Session::get("error");}}
    </div>
</div>
@stop

@section('scripts')

@stop