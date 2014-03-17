@foreach ($articles as $article)
<div class="artsection" style="width: 630px;">
    <div class="col-xs-10">
        <div class="row artnav">
            <a href="{{URL::to('/art').'/'.$article->id}}" class="art-title">
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
        <div>
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
            <div style="float: left;width: 50px;line-height: 50px;font-size: 16px;font-weight: bold;margin-right: 10px;">分享到</div>
            <div class="bdsharebuttonbox" style="margin-top: -5px;">
                <a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a>
                <a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a>
                <a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a>
                <a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a>
                <a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a>
                <a href="#" class="bds_more" data-cmd="more"></a>
            </div>
            <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
        </div>
    </div>
    <div class="col-xs-2">
        <div>
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
    
</div>
@endforeach