@extends('layouts.main')

@section('title', '页面找不到 - 为生活添欢乐')

@section('header_type')
navbar-static-top
@stop

@section('styles')
<style type="text/css">
    .bs-callout-warning {
        background-color: #fcf8f2;
        border-color: #f0ad4e;
    }
    .bs-callout {
        margin: 20px 0;
        padding: 20px;
        border-left: 3px solid #eee;
</style>
@stop

@section('content')
<div class="bs-callout bs-callout-warning">
    <h4>对不起，您的页面无法找到！</h4>
    <p>您访问的页面已经不存在，如果有任何疑问，请反馈给我们！</p>
</div>
@stop