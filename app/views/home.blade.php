<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <title>热门</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/header.css') }}
    {{ HTML::style('css/home.css') }}
</head>
<body>
<!-- Wrap all page content here -->
<div id="wrap">
    @include('header');
    <!-- Begin page content -->
    <div class="container">
        <div class="col-sm-7" id="home_articles">
            @foreach ($articles as $art)
            <section style="padding-bottom: 20px;">
                <div class="row">
                    <h3><a href="{{URL::to('/article').'/'.$art->id}}" class="article_title">{{$art->title}}</a></h3>
                </div>
                <div class="row" style="padding-bottom: 5px;">
                    <div style="display: inline;float: left; padding-right: 10px;margin-top: 5px;">
                        <a href="{{URL::to('/article').'/'.$art->id}}" class="artileparam">{{$art->up - $art->down}}分</a>
                        <a href="{{URL::to('/article').'/'.$art->id}}" class="artileparam">{{$art->comments}}评论</a>
                    </div>
                    <div style="display: inline;float: left;">
                        <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#"
                                                                                                          class="bds_qzone"
                                                                                                          data-cmd="qzone"
                                                                                                          title="分享到QQ空间"></a><a
                                href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq"
                                                                                                   data-cmd="tqq"
                                                                                                   title="分享到腾讯微博"></a><a
                                href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#"
                                                                                                    class="bds_t163"
                                                                                                    data-cmd="t163"
                                                                                                    title="分享到网易微博"></a><a
                                href="#" class="bds_kaixin001" data-cmd="kaixin001" title="分享到开心网"></a><a href="#"
                                                                                                          class="bds_sqq"
                                                                                                          data-cmd="sqq"
                                                                                                          title="分享到QQ好友"></a>
                        </div>
                        <script>
                            window._bd_share_config = {
                                "common": {
                                    "bdSnsKey": {},
                                    "bdUrl" : "{{URL::to('/article').'/'.$art->id}}",
                                    "bdText": "搞笑哇！{{$art->title}}",
                                    "bdMini": "2",
                                    "bdSign": "on",
                                    "bdMiniList": false,
                                    "bdPic": "{{URL::to('/')}}/{{$art->savepath}}",
                                    "bdStyle": "1",
                                    "bdSize": "16"
                                },
                                "share": {}
                            };
                            with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=86835285.js?cdnversion=' + ~(-new Date() / 36e5)];
                        </script>
                    </div>
                </div>
                <div class="row">
                    <a href="{{URL::to('/article').'/'.$art->id}}">
                        <img class="img-responsive img-thumbnail" src="{{URL::to('/')}}/{{$art->savepath}}" style="width: 100%;">
                    </a>
                </div>
            </section>
            @endforeach
        </div>
        <div class="col-sm-5" style="padding: 30px; text-align: center; position: fixed; left: 57%; top: 6%; width: 35%;">
            <h4>推荐</h4>
            <div class="row" style="padding: 5px;">
                <div class="row" id="tags">
                @foreach ($rarticles as $art)
                    <a href="#"><span class="label">{{$art->title}}</span></a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{$articlenum}}" id="articlenum" />
    <div class="containerbottom"></div>
</div>
@include("footer")
{{ HTML::script('js/home.js') }}
</body>
</html>