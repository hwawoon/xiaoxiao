@extends('layouts.main')

@section('title', '消息中心 - 为生活添欢乐')

@section('styles')
{{ HTML::style('css/user.message.css') }}
@stop

@section('header_type')
navbar-fixed-top
@stop

@section('content')
<div class="col-xs-8">
    <form action="{{action('MessageController@ingnoreMessages')}}">
    <div class="page-title">
        <h3>消息中心
            <button class="btn btn-primary btn-sm" id="ignoreBtn" type="submit">忽略所有消息</button>
        </h3>
    </div>
    </form>
    <div>
        @if(count($messages) == 0)
            <br>
            暂时没有任何消息！
        @endif
        @foreach($messages as $message)
            <div class="row message-row">
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
<div class="col-xs-4">
    @include('includes.sidebar')
    @include('includes.hfooter')
</div>
@stop

@section('scripts')

@stop