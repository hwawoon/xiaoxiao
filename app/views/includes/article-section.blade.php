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
                    <li><a class="tocomment" art="{{$article->id}}" href="{{action('ArticleController@getArticle',array('id'=>$article->id))}}">评论</a></li>
                @if(isset($del_display))
                    <li>
                        <form name="delform{{$article->id}}" id="delform{{$article->id}}" action="{{action('ArticleController@destroy')}}" method="post">
                            <input type="hidden" name="articleid" value="{{$article->id}}" />
                        </form>
                        <a class="del" art="{{$article->id}}" href="javascript:delArticle({{$article->id}});void(0);" title="删除？">删除</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    
</section>
@endforeach