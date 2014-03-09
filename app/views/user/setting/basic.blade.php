@extends('layouts.main')

@section('title', '基本信息 - 为生活添欢乐')

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
            <a href="{{URL::to('/user/setting')}}" class="list-group-item active">基本信息</a>
            <a href="{{URL::to('/user/setting/icon')}}" class="list-group-item ">头像设置</a>
            <a href="{{URL::to('/user/setting/security')}}" class="list-group-item">账号安全</a>
        </div>
    </div>
    <!--/span-->
    <div class="col-xs-9">
            <h3>基本信息</h3>
        <div>
            <form role="form" class="settingfrm" id="basicForm" action="{{URL::to('/user/basic/save')}}" method="post">
                <div class="form-group">
                    <label for="inputName">尊称</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{Auth::user()->name}}" placeholder="尊称" disabled />
                    <!--                        <span class="help-block">建议使用实名、或您常用的昵称注册</span>-->
                </div>
                <div class="form-group">
                    <label for="inputEmail1">一句话介绍</label>
                    <textarea class="form-control" rows="3" name="introduction" id="introduction" placeholder="让人们认识你">{{Auth::user()->introduction}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">保存</button>
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
<script type="text/javascript">
    $(function(){
        $("#basicForm").validate({
            rules: {
                username: {
                    required: true
                },
                introduction: {
                    maxlength: 200
                }
            },
            messages:{
                username:{
                    required:'用户名不能为空'
                },
                introduction:{
                    maxlength:'自我介绍不能超过200个字'
                }
            }
        });
    });
</script>
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