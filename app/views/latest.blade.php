<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <title>新鲜</title>
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
                    <h2><a href="{{URL::to('/article').'/'.$art->id}}" class="article_title">{{$art->title}}</a></h2>
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
<script type="text/javascript">
    var XIAO = {
        "loadingArticle" : 0
    };

    $(function (){

        $("#tags span").each(function(i,obj){
            if(i%5 == 0)
            {
                $(obj).css("font-size","14px");
                $(obj).addClass("label-primary");
            }
            else if(i%5 == 1)
            {
                $(obj).css("font-size","12px");
                $(obj).addClass("label-success");
            }
            else if(i%5 == 2)
            {
                $(obj).css("font-size","17px");
                $(obj).addClass("label-info");
            }
            else if(i%5 == 3)
            {
                $(obj).css("font-size","15px");
                $(obj).addClass("label-warning");
            }
            else if(i%5 == 4)
            {
                $(obj).css("font-size","19px");
                $(obj).addClass("label-danger");
            }
        });

        //滚动加载
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >=
                $('.containerbottom').offset().top + $('.containerbottom').height() )
            {
                if(XIAO.loadingArticle == 0)
                {
                    XIAO.loadingArticle = 1;
                    var loArtcleNumber = $('#articlenum').val();
                    $.ajax({
                        type: 'POST',
                        url: 'article/getmorelatest',
                        data: {'articleOffset':loArtcleNumber},
                        success: function(datas){
                            if(datas.length != 0)
                            {
                                $('#articlenum').val(parseInt(loArtcleNumber) + datas.length);
                                $.each(datas, function (i, data) {
                                    $("#home_articles").append('<section style="padding-bottom: 20px;">' +
                                        '<div class="row"><h2><a href="#" class="article_title">'+data.title+'</a></h2>' +
                                        '</div><div class="row">' +
                                        '<a href="#"><img class="img-responsive img-thumbnail" src="'+data.savepath
                                        +'" style="width: 100%;">' +
                                        '</a></div>' +
                                        '</section>');
                                });
                            }
                            XIAO.loadingArticle = 0;
                        },
                        dataType: 'json'
                    });
                }
            }
        });
    });
</script>
</body>
</html>