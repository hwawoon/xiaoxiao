@extends('layouts.main')

@section('title', '头像设置 - 为生活添欢乐')

@section('styles')
{{ HTML::style('packages/jcrop/jquery.Jcrop-1390924906017.css') }}
{{ HTML::style('css/user.setting.css') }}
@stop

@section('header_type')
navbar-fixed-top
@stop

@section('content')
<div class="row">
    <div class="col-xs-3" id="sidebar" role="navigation">
        <div class="list-group">
            <a href="{{URL::to('/user/setting')}}" class="list-group-item">基本信息</a>
            <a href="{{URL::to('/user/setting/icon')}}" class="list-group-item active">头像设置</a>
            <a href="{{URL::to('/user/setting/security')}}" class="list-group-item">账号安全</a>
        </div>
    </div>
    <!--/span-->
    <div class="col-xs-9">
        <h3>头像设置</h3>
        <small>（请先上传图片，然后选定区域后保存即可完成头像上传功能）</small>
        <div style="padding: 20px 0px;">
            <form action="{{URL::to('/user/avatar/upload')}}" method="post" id="resizeForm" class="form-inline" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="userSelectIcon">上传头像：</label>
                    <input type="file" name="userSelectIcon" id="userSelectIcon" style="display: inline;"/>
                </div>
                <button type="button" class="" id="uploadResizeBtn">上传</button>
            </form>
        </div>
        <div class="row croparea">
            <fieldset>
            <div class="col-xs-6">
                <img src="{{URL::to('/img')}}/default.jpg" id="targetImage" width="300" height="280" />
            </div>
            <div class="col-xs-6">
                <div id="preview-pane">
                    <div class="preview-container">
                        <img src="{{URL::to('/')}}/{{Auth::user()->getAvatar()}}" id="thumnailImage" class="jcrop-preview"/>
                    </div>
                </div>
                <div style="padding-top: 30px;">
                    <form action="{{URL::to('/user/avatar/save')}}" method="post" id="saveAvatarForm" class="form-inline" enctype="multipart/form-data">
                        <input type="hidden" id="cropImgPath" name="cropImgPath"/>
                        <input type="hidden" id="x" name="x"/>
                        <input type="hidden" id="y" name="y"/>
                        <input type="hidden" id="w" name="w"/>
                        <input type="hidden" id="h" name="h"/>
                        <button type="submit" class="btn btn-success" id="avatar_submit">保存</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/span-->
</div>
@stop

@section('scripts')
{{ HTML::script('packages/jcrop/jquery.Jcrop-1390898781659.js') }}
{{ HTML::script('js/user.icon.js') }}
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