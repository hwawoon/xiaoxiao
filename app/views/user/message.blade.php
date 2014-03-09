@extends('layouts.main')

@section('title', '消息中心 - 为生活添欢乐')

@section('styles')
{{ HTML::style('css/user.message-1393607473253.css') }}
@stop

@section('header_type')
navbar-fixed-top
@stop

@section('content')
<div class="col-xs-8">
    <form action="{{action('MessageController@ingnoreMessages')}}">
    <div class="row page-title">
        <h3>消息中心
            <button class="btn btn-primary btn-sm" id="ignoreBtn" type="submit">忽略所有消息</button>
        </h3>
    </div>
    </form>
    <div class="row">
    @if(count($messages) == 0)
        <br>
        暂时没有任何消息！
    @endif
    @foreach($messages as $message)
        <div class="row message-row">
<!--            <a href="#" class="btn btn-default btn-xs">忽略</a>-->
<!--            &nbsp;&nbsp;-->
            {{$message->sender()->first()->name}} 回复了
            <a href="{{URL::to('/')}}/art/{{$message->article_id}}">
                {{$message->article()->first()->title}}
            </a>
            @if($message->comment_id != 0)
                中的评论
            @endif
            @if($message->read_flag == 0)
             <span class="newflag">新!</span>
            @endif
            &nbsp;&nbsp;
            <span class="daterow">{{date('Y年m月d日',strtotime($message->created_at))}}</span>
        </div>
    @endforeach
    {{ $messages->links() }}
    </div>
</div>

<div class="col-xs-4 rrecommend">
    @if(!empty($rarticles))
    <div class="row recomdhead">
        <span class="label label-warning">推荐一下</span>
    </div>
    <div class="row tags">
        @foreach ($rarticles as $article)
        <section>
            <div class="row tagtitle">
                <a href="{{URL::to('/art').'/'.$article->id}}" >
                    <span>
                        {{$article->title}}
                    </span>
                </a>
            </div>
            <div class="row">
                <a href="{{URL::to('/art').'/'.$article->id}}">
                    <img class="" src="{{URL::to('/')}}/{{$article->thumbpath}}" >
                </a>
            </div>
        </section>
        @endforeach
    </div>
    @endif
</div>
<div class="col-xs-12">
    @include('includes/cfooter')
</div>
@stop

@section('scripts')

@stop