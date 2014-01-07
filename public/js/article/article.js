/**
 * Created by kimi on 14-1-8.
 */
$(function(){

});

function articlePointUp(id)
{
    $.ajax({
        url: ROOT_PATH + "/article/articlePointUp",
        type: "GET",
        data: {"id":id},
        dataType: "json",
        success: function (data) {
            if(data.state == 1)
            {
                var val = $("#article_up").html();
                $("#article_up").html(parseInt(val) + 1);
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

function articlePointDown(id)
{
    $.ajax({
        url: ROOT_PATH + "/article/articlePointDown",
        type: "GET",
        data: {"id":id},
        dataType: "json",
        success: function (data) {
            if(data.state == 1)
            {
                var val = $("#article_down").html();
                $("#article_down").html(parseInt(val) + 1);
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