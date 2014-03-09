@extends('layouts.main')

@section('title', '关于搞笑娃 - 为生活添欢乐')

@section('header_type')
navbar-fixed-top
@stop

@section('content')
<div class="row">
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">关于搞笑娃</h2>
            <p>在这里大家一起分享有趣图片，为生活增添一份笑容，清扫心中的雾霾，快乐每一天！</p>
            <p>网站代码托管在GitHub，想要的就拿走吧</p>
            <p><a href="https://github.com/kimhwawoon/xiaoxiao" target="_blank">搞笑娃 on GitHub</a></p>
            <p>如果网站内容有侵权行为，请立即通知我！</p>
        </div><!-- /.blog-post -->

        <div class="blog-post">
            <h2 class="blog-post-title">意见</h2>
            <p>所有内容都是个人开发，如果有任何的改进意见，就告诉给我吧，目前就是发邮件了</p>
            <p><a href="mailto:kimhwawoon@gmail.com" title="我会认真处理每一个反馈的">kimwhawoon@gmail.com</a></p>
        </div><!-- /.blog-post -->


        <div class="blog-post">
            <h2 class="blog-post-title">条款</h2>
            <p>不要发布下列违法信息： </p>
            <p>(1)反对宪法所确定的基本原则的；  </p>
            <p>(2).危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的</p>
            <p>(3).损害国家荣誉和利益的；  </p>
            <p>(4).煽动民族仇恨、民族歧视，破坏民族团结的； </p>
            <p>(5).破坏国家宗教政策，宣扬邪教和封建迷信的； </p>
            <p>(6).散布谣言，扰乱社会秩序，破坏社会稳定的；  </p>
            <p>(7).散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的； </p>
            <p>(8).侮辱或者诽谤他人，侵害他人合法权益的； </p>
            <p>(9).含有法律、行政法规禁止的其他内容的。</p>
        </div><!-- /.blog-post -->
    </div><!-- /.blog-main -->
</div>
<div class="row">
    @include('includes/cfooter')
</div>
@stop