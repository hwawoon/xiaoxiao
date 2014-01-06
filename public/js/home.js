"use strict";

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
                        url: 'article/getmore',
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