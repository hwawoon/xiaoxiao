@extends('layouts.main')

@section('title', '搞笑娃 - 为生活添欢乐')

@section('keywords', '搞笑娃,为生活添欢乐')

@section('description', '搞笑娃,为生活添欢乐')

@section('styles')
{{ HTML::style('css/home-1393578883826.css') }}
@stop

@section('header_type')
navbar-fixed-top
@stop

@section('content')
<div class="row">
    <div class="col-xs-8" id="home_articles">
        @foreach ($articles as $article)
        <section class="artsection">
            <div class="col-xs-10">
                <div class="row dnav">
                    <a href="{{URL::to('/art').'/'.$article->id}}" class="article_title">
                        <span class="tnav">{{$article->title}}</span>
                    </a>
                </div>
                <div class="row nav-point">
                    <a href="{{URL::to('/art').'/'.$article->id}}" class="artileparam btn btn-default btn-xs">
                        <span id="rpoints{{$article->id}}">{{$article->points}}</span>分
                    </a>
                    <a href="{{URL::to('/art').'/'.$article->id}}" class="artileparam btn btn-default btn-xs">
                        {{$article->comments}}评论
                    </a>
                </div>
                <div class="row">
                    @if($article->gif)
                    <div class="gif-container">
                        <div class="img-static">
                            <a href="javascript:void(0);">
                                <img class="" src="{{URL::to('/')}}/{{$article->screenshot}}" style="width: 100%;">
                                <span class="play">GIF</span>
                            </a>
                        </div>
                        <div class="img-animated" style="display: none;">
                            <a href="javascript:void(0);">
                                <img class="" src="{{URL::to('/')}}/{{$article->imgpath}}" style="width: 100%;">
                            </a>
                        </div>
                    </div>
                    @else
                    <a href="{{URL::to('/art').'/'.$article->id}}">
                        <img class="" src="{{URL::to('/')}}/{{$article->imgpath}}" style="width: 100%;">
                    </a>
                    @endif
                </div>
                <div class="row artshare">
                    <a href="javascript:void(0)" onclick="sinaweibo('{{$article->title}}','{{URL::to('/art') . '/' . $article->id }}','{{URL::to('/').'/'.$article->imgpath}}');return false;" class="btn btn-danger" title="分享到新浪微博" target="_blank" >
                        分享到新浪微博
                    </a>
                    <a href="javascript:void(0)" onclick="postToWb('{{$article->title}}','{{URL::to('/art') . '/' . $article->id }}','{{URL::to('/').'/'.$article->imgpath}}');return false;" class="btn btn-primary"  title="分享到腾讯微博" target="_blank" >
                        分享到腾讯微博
                    </a>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="row">
                    <ul class="vertical-vote">
                        @if (Auth::check())
                            @if(!empty($article->state))
                                @if($article->state == 1)
                                <li><a class="up up_c artup" id="up{{$article->id}}" art="{{$article->id}}" href="javascript:void(0);" title="赞">赞</a></li>
                                <li><a class="down artdown" id="down{{$article->id}}" art="{{$article->id}}" href="javascript:void(0);" title="踩">踩</a></li>
                                @else
                                <li><a class="up artup" id="up{{$article->id}}" art="{{$article->id}}" href="javascript:void(0);" title="赞">赞</a></li>
                                <li><a class="down down_c artdown" id="down{{$article->id}}" art="{{$article->id}}" href="javascript:void(0);" title="踩">踩</a></li>
                                @endif
                            @else
                                <li><a class="up artup" id="up{{$article->id}}" art="{{$article->id}}" href="javascript:void(0);" title="赞">赞</a></li>
                                <li><a class="down artdown" id="down{{$article->id}}" art="{{$article->id}}" href="javascript:void(0);" title="踩">踩</a></li>
                            @endif
                        @else
                        <li><a class="up" href="javascript:openLoginModal();" title="赞">赞</a></li>
                        <li><a class="down" href="javascript:openLoginModal();" title="踩">踩</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </section>
        @endforeach
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
</div>
<div class="containerbottom"></div>
@stop

@section('scripts')
<script type="text/javascript">
    var XIAO =
    {
        "loadingArticle" : 0,
        "getMoreUrl" : "{{$getmore}}",
        "loadedCount" : "{{$articlenum}}"
    };
</script>
{{ HTML::script('packages/underscore.min.js') }}
{{ HTML::script('js/home-1394021928221.js') }}
<script id="articleTpl" type="text/template">
    <%_.each(datas, function(item) {%>
        <section class="artsection">
            <div class="col-xs-10">
                <div class="row dnav">
                    <a href="{{URL::to('/art')}}/<%=item.id%>" class="article_title">
                        <span class="tnav"><%=item.title%></span>
                    </a>
                </div>
                <div class="row nav-point">
                    <a href="{{URL::to('/art')}}/<%=item.id%>" class="artileparam btn btn-default btn-xs">
                        <span id="rpoints<%=item.id%>"><%=item.points%></span>分
                    </a>
                    <a href="{{URL::to('/art')}}/<%=item.id%>" class="artileparam btn btn-default btn-xs">
                        <%=item.comments%>评论
                    </a>
                </div>
                <div class="row">
                    <a href="{{URL::to('/art')}}/<%=item.id%>">
                        <img class="" src="{{URL::to('/')}}/<%=item.imgpath%>" style="width: 100%;">
                    </a>
                </div>
                <div class="row artshare">
                    <a href="javascript:void(0)" onclick="sinaweibo('<%=item.title%>','{{URL::to('/art')}}/<%=item.id%>','{{URL::to('/')}}/<%=item.imgpath%>');return false;" class="btn btn-danger" title="分享到新浪微博" target="_blank" >
                        分享到新浪微博
                    </a>
                    <a href="javascript:void(0)" onclick="postToWb('<%=item.title%>','{{URL::to('/art')}}<%=item.id%>'','{{URL::to('/')}}/<%=item.imgpath%>');return false;" class="btn btn-primary"  title="分享到腾讯微博" target="_blank" >
                        分享到腾讯微博
                    </a>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="row">
                    <ul class="vertical-vote">
                    <% if (typeof(item.state) != "undefined") { %>
                        <li><a class="up" href="javascript:openLoginModal();" title="赞">赞</a></li>
                        <li><a class="down" href="javascript:openLoginModal();" title="踩">踩</a></li>
                    <% }else { %>
                        <% if(item.state == 1) {%>
                            <li><a class="up up_c artup" id="up<%=item.id%>" art="<%=item.id%>" href="javascript:void(0);" title="赞">赞</a></li>
                            <li><a class="down artdown" id="down<%=item.id%>" art="<%=item.id%>" href="javascript:void(0);" title="踩">踩</a></li>
                        <% }else { %>
                            <li><a class="up artup" id="up<%=item.id%>" art="<%=item.id%>" href="javascript:void(0);" title="赞">赞</a></li>
                            <li><a class="down down_c artdown" id="down<%=item.id%>" art="<%=item.id%>" href="javascript:void(0);" title="踩">踩</a></li>
                        <% } %>
                    <% } %>    
                    </ul>
                </div>
            </div>
        </section>
    <%});%>
</script>
@stop