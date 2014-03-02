@extends('layouts.main')

@section('title', '关于搞笑娃')

@section('header_type')
navbar-fixed-top
@stop

@section('content')
<div class="row">
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">关于搞笑娃</h2>
            <p>我是KimHwawoon</p>
            <p>这网站名字么，我有个小屁孩，天天痛并快乐着，就起了这么个名字《搞笑娃》</p>
            <p>php代码基于Laravel4框架开发的，真心觉得这个框架很方便啊！</p>
            <p>前端框架使用bootstrap3，就是twitter那个，也很不错</p>
            <p>kimhwawoon@gmail.com</p>
            <p><a href="https://github.com/kimhwawoon/xiaoxiao" target="_blank">搞笑娃 on GitHub</a></p>
            <p>如果网站内容有侵权行为，请立即通知我！</p>
        </div><!-- /.blog-post -->

        <div class="blog-post">
            <h2 class="blog-post-title">意见</h2>
            <p>所有内容都有个人开发，如果有任何的改进意见，就反馈给我吧，目前就是发邮件了</p>
            <p><a href="mailto:kimhwawoon@gmail.com" title="我会认真处理每一个反馈">kimwhawoon@gmail.com</a></p>
        </div><!-- /.blog-post -->
    </div><!-- /.blog-main -->
@stop