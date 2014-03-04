@extends('layouts.main')

@section('title', '个人主页 - 为生活添欢乐')

@section('styles')
{{ HTML::style('css/user.profile.css') }}
@stop

@section('header_type')
navbar-fixed-top
@stop

@section('content')
<div class="jumbotron">
    <p>
        <img src="{{URL::to('/')}}/{{Auth::user()->avatar}}" class="img-circle" style="width: 100px;"/>
    </p>
    <p>{{Auth::user()->name}}</p>
    <p class="lead">{{Auth::user()->introduction}}</p>
</div>
<div id="timeliner">
    @foreach($articles as $article)
    <div class="item">
        <div>
            <div class="title">
                @if(Auth::user()->id == $article->user_id)
                <form name="delform{{$article->id}}" id="delform{{$article->id}}" action="{{action('ArticleController@destroy')}}" method="post">
                    <input type="hidden" name="articleid" value="{{$article->id}}" />
                    <button type="button" onclick="delArticle({{$article->id}});void(0);" class="close" title="删除">&times;</button>
                    <a href="{{URL::to('/art').'/'.$article->id}}">
                        {{$article->title}}<br>
                        {{$article->created_at}}
                    </a>
                </form>
                @else
                    <a href="{{URL::to('/art').'/'.$article->id}}">
                        {{$article->title}}<br>
                        {{$article->created_at}}
                    </a>
                @endif
            </div>
            <div>
                <a href="{{URL::to('/art').'/'.$article->id}}">
                    <img class="img-responsive img-thumbnail" src="{{URL::to('/')}}/{{$article->imgpath}}" />
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@stop

@section('scripts')
{{ HTML::script('packages/jquery.masonry.min.js')}}
{{ HTML::script('js/user.profile.js') }}
@stop