$(function (){
    //滚动加载
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >=
            $('.containerbottom').offset().top + $('.containerbottom').height() )
            {
                if(XIAO.loadingArticle == 0 && XIAO.getMoreUrl != "")
                {
                    XIAO.loadingArticle = 1;
                    var loArtcleNumber = XIAO.loadedCount;
                    $.getJSON(XIAO.getMoreUrl,{'articleOffset':loArtcleNumber},function(dts){
                        if(dts.length != 0)
                        {
                            XIAO.loadedCount = parseInt(loArtcleNumber) + dts.length;
                            var loInsertHtml = _.template($("#articleTpl").html(), {'datas':dts});
                            $("#home_articles").append(loInsertHtml);
                        }
                        XIAO.loadingArticle = 0;
                    });
                }
            }
    });
});