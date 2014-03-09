@extends('layouts.main')

@section('title', '密码修改 - 为生活添欢乐')

@section('styles')
{{HTML::style('css/user.setting-1393436536639.css')}}
@stop

@section('header_type')
navbar-fixed-top
@stop

@section('content')
<div class="row">
    <div class="col-xs-3" id="sidebar" role="navigation">
        <div class="list-group">
            <a href="{{URL::to('/user/setting')}}" class="list-group-item">基本信息</a>
            <a href="{{URL::to('/user/setting/icon')}}" class="list-group-item ">头像设置</a>
            <a href="{{URL::to('/user/setting/security')}}" class="list-group-item active">账号安全</a>
        </div>
    </div>
    <!--/span-->
    <div class="col-xs-9">
        <h3>账号安全</h3>
        <div>
            <form id="passwordForm" method="post" class="settingfrm" action="{{action('UserController@updatePassword')}}">
                <div class="form-group">
                    <label for="inputName">当前密码</label>
                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="当前密码">
                </div>
                <div class="form-group">
                    <label for="inputEmail1">新密码</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="新密码">
                </div>
                <div class="form-group">
                    <label for="inputEmail1">确认密码</label>
                    <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="确认密码">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">保存</button>
                </div>
            </form>
        </div>
    </div>
    <!--/span-->
</div>
<div class="row">
    @include('includes/cfooter')
</div>
@stop

@section('scripts')
{{ HTML::script('js/user.security-1393435577198.js') }}
@if(Session::get('message'))
<script type="text/javascript">
    noty({
        text        : "{{Session::get('message')}}",
        type        : "information",
        dismissQueue: true,
        killer: true,
        layout      : 'topCenter',
        theme       : 'defaultTheme',
        timeout: 2000
    });
</script>
@endif
@stop