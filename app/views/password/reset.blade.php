@extends('layouts.main')

@section('title', '重置密码 - 为生活添欢乐')

@section('styles')
<style type="text/css">
.resetpage .panel {
    width: 500px;
    margin: 30px auto;
}
</style>
@stop

@section('header_type')
navbar-fixed-top
@stop

@section('content')
<div class="resetpage">
    <div class="panel panel-info">
        <div class="panel-heading">重置密码</div>
        <div class="panel-body">
            <div style="padding-bottom: 5px; color:red;">
              {{Session::get("error");}}
            </div>
            <form role="form" action="{{ action('RemindersController@postReset') }}" method="POST">
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="form-group">
                <label for="exampleInputEmail1">邮箱</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="邮箱">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">新密码</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="新密码">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">确认密码</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="确认密码">
              </div>
              <button type="submit" class="btn btn-default btn-primary btn-block">确定</button>
            </form>
        </div>
    </div>
</div>
@stop

@section('scripts')
@stop