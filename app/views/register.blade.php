@extends('layouts.main')

@section('title', '注册 - 为生活添欢乐')

@section('styles')
{{ HTML::style('css/user.register.css') }}
@stop

@section('header_type')
navbar-static-top
@stop

@section('content')
<!-- Begin page content -->
<div class="row firstrow">
    <div class="col-xs-4">
    </div>
    <div class="col-xs-3">
        {{ HTML::image('img/logob.png') }}
    </div>
    <div class="col-xs-4 reghead">
        注册搞笑娃
    </div>
</div>
<div class="row">
    <form role="form" id="registerform" action="{{URL::to('/register')}}" method="post">
        <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
        <div class="col-xs-3">
            <div class="input-group">
                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                <input type="text" class="form-control" id="name" name="name" placeholder="昵称">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="input-group">
                <span class="input-group-addon"><i class='glyphicon glyphicon-envelope'></i></span>
                <input type="email" class="form-control" id="email" name="email" placeholder="邮箱">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="text" class="form-control" id="password" name="password" placeholder="密码">
            </div>
        </div>
        <div class="col-xs-1">
            <button class="btn btn-primary" type="submit" >注册</button>
        </div>
    </form>
</div>
@stop

@section('scripts')
{{ HTML::script('js/user.register.js') }}
@if($errors->has())
<script type="text/javascript">
    @foreach ($errors->all() as $error)
        noty({
            text        : "{{ $error }}",
            type        : "warning",
            dismissQueue: true,
            killer: true,
            layout      : 'topRight',
            theme       : 'defaultTheme',
            timeout: 2000
        });
    @endforeach
</script>
@endif
@stop