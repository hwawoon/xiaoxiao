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

    $('.artup').click(function(){
        var loObj = $(this);
        var artid = loObj.attr('art');
        //uped
        if(loObj.hasClass('up_c'))
        {
            var val = $("#rpoints"+artid).html();
            $("#rpoints"+artid).html(parseInt(val) - 1);
            $("#up"+artid).removeClass('up_c');
            $("#down"+artid).removeClass('down_c');
            $.getJSON(ROOT_PATH + "/vote/unlike",{"id":artid},function(data){
            });
        }
        //not
        else
        {
            var val = $("#rpoints"+artid).html();
            if($("#down"+artid).hasClass('down_c'))
            {
                $("#rpoints"+artid).html(parseInt(val) + 2);
            }
            else
            {
                $("#rpoints"+artid).html(parseInt(val) + 1);
            }
            $("#up"+artid).addClass('up_c');
            $("#down"+artid).removeClass('down_c');
            $.getJSON(ROOT_PATH + "/vote/like",{"id":artid},function(data){
            });
        }
    });

    $('.artdown').click(function(){
        var loObj = $(this);
        var artid = loObj.attr('art');
        //uped
        if(loObj.hasClass('down_c'))
        {
            var val = $("#rpoints"+artid).html();
            $("#rpoints"+artid).html(parseInt(val) + 1);
            $("#up"+artid).removeClass('up_c');
            $("#down"+artid).removeClass('down_c');
            $.getJSON(ROOT_PATH + "/vote/unlike",{"id":artid},function(data){
            });
        }
        //not
        else
        {
            var val = $("#rpoints"+artid).html();
            if($("#up"+artid).hasClass('up_c'))
            {
                $("#rpoints"+artid).html(parseInt(val) - 2);
            }
            else
            {
                $("#rpoints"+artid).html(parseInt(val) - 1);
            }
            $("#up"+artid).removeClass('up_c');
            $("#down"+artid).addClass('down_c');
            $.getJSON(ROOT_PATH + "/vote/dislike",{"id":artid},function(data){
            });
        }
    });
});