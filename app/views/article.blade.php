@extends('layouts.main')

@section('title')
{{$article->title}}
@stop

@section('styles')
{{ HTML::style('css/article.css') }}
@stop

@section('header_type')
navbar-static-top
@stop

@section('content')
<div class="artcontent">
    <div class="col-xs-7">
        <div class="row atitle">
            {{$article->title}}
        </div>
        <div class="row points">
            <a href="#" class="artileparam btn btn-default btn-xs">
                <span id="article_points">{{$article->points}}</span>分
            </a>
            <a href="#commentArea" class="artileparam btn btn-default btn-xs">{{$article->comments}}评论</a>
        </div>
    </div>
    <div class="sharetoolbar">
        <div class="col-xs-7">
            <div class="row acomment">
                <div class="sharediv">
                    <a href="javascript:void(0)" onclick="sinaweibo('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->imgpath}}');return false;" class="btn btn-danger" title="分享到新浪微博" target="_blank" >
                        分享到新浪微博
                    </a>
                    <a href="javascript:void(0)" onclick="postToWb('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->imgpath}}');return false;" class="btn btn-primary" title="分享到腾讯微博" target="_blank" >
                        分享到腾讯微博
                    </a>
                </div>
                <div class="apoint horizontal-vote">
                    @if (Auth::check())
                        @if(!empty($vote))
                            @if($vote->state == 1)
                                <span><a class="up up_c" id="up" href="javascript:void(0);"  onclick="articlePointUp({{$article->id}});void(0);">赞</a></span>
                                <span><a class="down" id="down" href="javascript:void(0);" onclick="articlePointDown({{$article->id}});void(0);">踩</a></span>
                            @else
                                <span><a class="up" id="up" href="javascript:void(0);"  onclick="articlePointUp({{$article->id}});void(0);">赞</a></span>
                                <span><a class="down down_c" id="down" href="javascript:void(0);" onclick="articlePointDown({{$article->id}});void(0);">踩</a></span>
                            @endif
                        @else
                            <span><a class="up" id="up" href="javascript:void(0);"  onclick="articlePointUp({{$article->id}});void(0);">赞</a></span>
                            <span><a class="down" id="down" href="javascript:void(0);" onclick="articlePointDown({{$article->id}});void(0);">踩</a></span>
                        @endif
                    @else
                    <span><a class="up" href="javascript:openLoginModal();">赞</a></span>
                    <span><a class="down" href="javascript:openLoginModal();">踩</a></span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="row pagerline">
                @if(!empty($previous))
                <a href="{{URL::to('/')}}/art/{{$previous->id}}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-arrow-left"></i>上一页
                </a>
                @else
                <a href="#" class="btn btn-primary" disabled="disabled">
                    <i class="glyphicon glyphicon-arrow-left"></i>上一页
                </a>
                @endif
                &nbsp;&nbsp;
                @if(!empty($next))
                <a href="{{URL::to('/')}}/art/{{$next->id}}" class="btn btn-success">
                    下一页<i class="glyphicon glyphicon-arrow-right"></i>
                </a>
                @else
                <a href="#" class="btn btn-success" disabled="disabled">
                    下一页<i class="glyphicon glyphicon-arrow-right"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xs-7">
        <section>
            <div class="row">
                <a href="javascript:void(0)">
                    <img class="" src="{{URL::to('/')}}/{{$article->imgpath}}" style="width: 100%;">
                </a>
            </div>
            <div class="row" id="commentArea">
                <div style="margin-bottom: 0px; margin-top: 0px; border-bottom: 1px solid #eeeeee;">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#">全部评论(<span id="commentCount">{{$article->comments}}</span>)</a></li>
                    </ul>
                </div>
            </div>
            <div class="row userreplydiv">
            </div>
            <div id="articlereplies" class="row">
                <input type="hidden" id="cur_article_id" value="{{$article->id}}" />
                <div id="cmtloading" style="height:100px;text-align:center;">
                  <span id="searching_spinner_center">
                    {{HTML::image('/img/ajax-loader.gif')}}
                  </span>
                </div>
            </div>
        </section>
    </div>

    <div class="col-xs-5 atags">
        <div class="row" id="recommend" style="padding-top: 10px;">
            @foreach ($rarticles as $forart)
            <section style="padding: 10px;">
                <div class="row" style="padding: 5px 0;">
                    <a href="{{URL::to('/article').'/'.$forart->id}}" style="text-decoration: none;color: #000000;">
                        <span class="rcmdtitle">{{$forart->title}}</span>
                    </a>
                </div>
                <div class="row">
                    <a href="{{URL::to('/art').'/'.$forart->id}}">
                        <img class="" src="{{URL::to('/')}}/{{$forart->thumbpath}}">
                    </a>
                </div>
            </section>
            @endforeach
        </div>
    </div>
</div>
@stop

@section('scripts')
{{ HTML::script('packages/underscore.js') }}
<script id="commentTpl" type="text/template">
    <div class="media">
        <a class="pull-left" href="#">
          <img src="{{URL::to('/')}}/<%=item.user.avatar%>" class="img-responsive img-thumbnail media-object" width="64px;" />
        </a>
        <div class="media-body" id="cmt_<%=item.id%>">
          <h4 class="media-heading"><%=item.user.name%></h4>
          <p><%=item.content%></p>
          <p>
                <%=item.created_at%>
                &nbsp;&nbsp;
                <a class="btn btn-default btn-xs cmtupsty"
                @if(Auth::check())
                href="javascript:void(0);" onclick="cmtup(this,'<%=item.id%>');"
                @else
                href='javascript:openLoginModal();'
                @endif
                >
                    <span class="glyphicon glyphicon-thumbs-up"></span> 顶(<span id='cmtup'><%=item.up%></span>)
                </a>
                <a class="btn btn-default btn-xs cmtupsty"
                @if(Auth::check())
                href="javascript:addReplyArea('<%=item.id%>');"
                @else
                href='javascript:openLoginModal();'
                @endif
                >
                    <span class="glyphicon glyphicon-edit"></span> 回复
                </a>

          </p>
        </div>
    </div>
</script>
<script id="replyTpl" type="text/template">
<form class="form-horizontal <%=data.classname%>" id="<%=data.formid%>" role="form" method="post" action="{{URL::to('/')}}/comment/add">
    <input type="hidden" name="articleId" value="{{$article->id}}" />
    <input type="hidden" name="articleAuthor" value="{{$article->user_id}}" />
    <input type="hidden" name="comment_id" value="<%=data.comment_id%>" />
    <div class="useravatar">
        @if(Auth::check())
        <img src="{{URL::to('/')}}/{{Auth::user()->getAvatar()}}" class="img-responsive img-thumbnail" style="width: 64px;"/>
        @else
        <img src="{{URL::to('/')}}/img/avatar.jpg" class="img-responsive img-thumbnail" style="width: 64px;"/>
        @endif
    </div>
    <div class="myreplay">
        <textarea class="form-control" name="myComment" rows="3" placeholder="最多100字"></textarea>
    </div>
    <div class="myreplybtn">
        @if(Auth::check())
        <button type="button" class="btn btn-default btn-sm" onclick="cmtreply('<%=data.formid%>');">发送</button>
        @else
        <a href="javascript:openLoginModal();" id="login" class="btn btn-default btn-sm">登录</a>
        @endif
    </div>
</form>
</script>
{{ HTML::script('js/article.js') }}
@stop