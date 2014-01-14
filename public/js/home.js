"use strict";

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
                    var loArtcleNumber = XIAO.loadedCount;
                    $.ajax({
                        type: 'POST',
                        url: XIAO.getMoreUrl,
                        data: {'articleOffset':loArtcleNumber},
                        success: function(datas){
                            loadPageContent(loadingDatas)
                        },
                        dataType: 'json'
                    });
                }
            }
    });
});

function loadPageContent(loadingDatas)
{
    if(datas.length != 0)
    {
        XIAO.loadedCount = parseInt(loArtcleNumber) + datas.length;
        $.each(loadingDatas, function (i, data)
        {
            var loInsertHtml = '<section style="padding-bottom: 20px;">' +
                '<div class="row"><h2><a href="#" class="article_title">'+data.title+'</a></h2>' +
                '</div><div class="row">' +
                '<a href="#"><img class="img-responsive img-thumbnail" src="'+data.savepath
                +'" style="width: 100%;">' +
                '</a></div>' +
                '</section>';
            $("#home_articles").append(loInsertHtml);
        });
    }
    XIAO.loadingArticle = 0;
}

function articlePointUp(tartget,id)
{
    var curDom = $(tartget);
    $.ajax({
        url: ROOT_PATH + "/article/articlePointUp",
        type: "GET",
        data: {"id":id},
        dataType: "json",
        success: function (data) {
            if(data.state == 1)
            {
                var val = curDom.find(".article_up").html();
                curDom.find(".article_up").html(parseInt(val) + 1);
            }
            else
            {
                alert("评分失败，请反馈给管理员！");
            }
        },
        error: function (data) {
            alert("评分失败，请反馈给管理员！");
        }
    });
}

function articlePointDown(tartget,id)
{
    var curDom = $(tartget);
    $.ajax({
        url: ROOT_PATH + "/article/articlePointDown",
        type: "GET",
        data: {"id":id},
        dataType: "json",
        success: function (data) {
            if(data.state == 1)
            {
                var val = curDom.find(".article_down").html();
                curDom.find(".article_down").html(parseInt(val) + 1);
            }
            else
            {
                alert("评分失败，请反馈给管理员！");
            }
        },
        error: function (data) {
            alert("评分失败，请反馈给管理员！");
        }
    });
}