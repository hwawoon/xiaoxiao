"use strict";

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
                    $.ajax({
                        type: 'POST',
                        url: XIAO.getMoreUrl,
                        data: {'articleOffset':loArtcleNumber},
                        success: function(datas){
                            if(datas.length != 0)
                            {
                                XIAO.loadedCount = parseInt(loArtcleNumber) + datas.length;
                                $.each(datas, function (i, data)
                                {
                                    var loInsertHtml = getLoadingPage(data);
                                    $("#home_articles").append(loInsertHtml);
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

String.prototype.template = function(obj)
{
    return this.replace(/\$\w+\$/gi, function(matchs)
    {
        var returns = obj[matchs.replace(/\$/g, "")];
        return (returns + "") == "undefined"? "": returns;
    });
}

function getLoadingPage(data)
{
    data.points = data.up - data.down;
    var insertTempl = $('#section_template').val();
    insertTempl = insertTempl.template(data);
    return insertTempl;
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