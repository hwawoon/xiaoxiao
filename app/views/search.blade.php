<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
    <title>{{$pagetitle}}</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap-1390898781649.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header-1391708844091.css') }}
    {{ HTML::style('css/home-1390898781615.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<script type="text/javascript">
    var ROOT_PATH = "{{URL::to('/')}}";
    var XIAO =
    {
        "loadingArticle" : 0,
        "getMoreUrl" : "{{$getmore}}",
        "loadedCount" : "{{$articlenum}}"
    };
</script>
<body>
@include('header')

<textarea id="section_template" style="display: none;">
    <section class="artsection">
        <div class="col-xs-10">
            <div class="row dnav">
                <a href="{{URL::to('/article').'/'}}$id$" class="article_title">
                    <span class="tnav">$title$</span>
                </a>
            </div>
            <div class="row nav-point">
                <a href="{{URL::to('/article').'/'}}$id$" class="artileparam btn btn-default btn-xs">
                    <span id="rpoints$id$">$points$</span>分
                </a>
                <a href="{{URL::to('/article').'/'}}$id$" class="artileparam btn btn-default btn-xs">
                    $comments$评论
                </a>
            </div>
            <div class="row">
                <a href="{{URL::to('/article').'/'}}$id$">
                    <img class="" src="{{URL::to('/')}}/$savepath$" style="width: 100%;">
                </a>
            </div>
            <div class="row artshare">
                <a href="javascript:void(0)" onclick="sinaweibo('$title$','{{URL::to('/article').'/'}}$id$','{{URL::to('/').'/'}}$savepath$');return false;" class="btn btn-danger" title="分享到新浪微博" target="_blank" >
                    分享到新浪微博
                </a>
                <a href="javascript:void(0)" onclick="postToWb('$title$','{{URL::to('/article').'/'}}$id$','{{URL::to('/').'/'}}$savepath$');return false;" class="btn btn-primary"  title="分享到腾讯微博" target="_blank" >
                    分享到腾讯微博
                </a>
            </div>
        </div>
        <div class="col-xs-2">
            <div class="row">
                <ul class="vertical-vote">
                    @if (Auth::check())
                    <li><a class="up" id="up$id$" href="javascript:articlePointUp(this,$id$);void(0);" title="赞">赞</a></li>
                    <li><a class="down" id="down$id$" href="javascript:articlePointDown(this,$id$);void(0);" title="踩">踩</a></li>
                    @else
                    <li><a class="up" href="javascript:openLoginModal();" title="赞">赞</a></li>
                    <li><a class="down" href="javascript:openLoginModal();" title="踩">踩</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </section>
</textarea>
<!-- Wrap all page content here -->

<div class="container" id="maintext">
    <div class="row">
        <div class="col-xs-8" id="home_articles">
            @foreach ($articles as $article)
            <section class="artsection">
                <div class="col-xs-10">
                    <div class="row dnav">
                        <a href="{{URL::to('/article').'/'.$article->id}}" class="article_title">
                            <span class="tnav">{{$article->title}}</span>
                        </a>
                    </div>
                    <div class="row nav-point">
                        <a href="{{URL::to('/article').'/'.$article->id}}" class="artileparam btn btn-default btn-xs">
                            <span id="rpoints{{$article->id}}">{{$article->up - $article->down}}</span>分
                        </a>
                        <a href="{{URL::to('/article').'/'.$article->id}}" class="artileparam btn btn-default btn-xs">
                            {{$article->comments}}评论
                        </a>
                    </div>
                    <div class="row">
                        <a href="{{URL::to('/article').'/'.$article->id}}">
                            <img class="" src="{{URL::to('/')}}/{{$article->savepath}}" style="width: 100%;">
                        </a>
                    </div>
                    <div class="row artshare">
                        <a href="javascript:void(0)" onclick="sinaweibo('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="btn btn-danger" title="分享到新浪微博" target="_blank" >
                            分享到新浪微博
                        </a>
                        <a href="javascript:void(0)" onclick="postToWb('{{$article->title}}','{{URL::to('/article') . '/' . $article->id }}','{{URL::to('/').'/'.$article->savepath}}');return false;" class="btn btn-primary"  title="分享到腾讯微博" target="_blank" >
                            分享到腾讯微博
                        </a>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="row">
                        <ul class="vertical-vote">
                            @if (Auth::check())
                            <li><a class="up" id="up{{$article->id}}" href="javascript:articlePointUp(this,{{$article->id}});void(0);" title="赞">赞</a></li>
                            <li><a class="down" id="down{{$article->id}}" href="javascript:articlePointDown(this,{{$article->id}});void(0);" title="踩">踩</a></li>
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
                <span>推荐一下</span>
            </div>
            <div class="row tags">
                @foreach ($rarticles as $article)
                <section>
                    <div class="row tagtitle">
                        <a href="{{URL::to('/article').'/'.$article->id}}" >
                            <span>
                            @if(strlen($article->title) > 51)
                                {{substr($article->title, 0, 51)}}...
                            @else
                                {{$article->title}}
                            @endif
                            </span>
                        </a>
                    </div>
                    <div class="row">
                        <a href="{{URL::to('/article').'/'.$article->id}}">
                            <img class="" src="{{URL::to('/')}}/{{$article->thumbnailpath}}" >
                        </a>
                    </div>
                </section>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div> <!-- /container -->
<div class="containerbottom"></div>

@include('footer')
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap-1390898781657.js') }}
{{ HTML::script('packages/noty/packaged/jquery.noty.packaged.min.js')}}
{{ HTML::script('js/jquery.validate-1390898781640.js') }}
{{ HTML::script('js/jquery.form-1390898781635.js') }}
{{ HTML::script('js/header-1390898781631.js') }}
{{ HTML::script('js/home-1390898781632.js') }}
{{ HTML::script('js/ishare-1390898781634.js') }}
</body>
</html>