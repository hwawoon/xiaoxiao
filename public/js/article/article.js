/**
 * Created by kimi on 14-1-8.
 */
$(function(){
    $("#articleCommentBtn").bind("click",function(){
        $("#articleCommentForm").ajaxSubmit({
            dataType:'json',
            success:function(data)
            {
                if(null != data && data.length != 0 )
                {
                    data = data[0];
                    document.getElementById("articleCommentForm").reset();
                    //下面添加新评论
                    var loCount = $("#commentCount").html();
                    $("#commentCount").html(parseInt(loCount) + 1);
                    $("#articlereplies").prepend('<div class="row">' +
                        '<div class="useravatar">' +
                        '<img src="' + ROOT_PATH +
                        '/'+data.avatar+'" class="img-responsive img-thumbnail" style="width: 50px;"/>' +
                        '</div>' +
                        '<div class="userreply">' +
                        '<div style="padding-bottom: 1px;">' +
                        '<span style="color: #269abc;">' + data.name +
                        ' 发表于 '+data.created_at+'</span></div><div>' + data.content +
                        '</div></div> </div>');
                }
                else
                {
                    alert("评论失败，请稍后再试！");
                }
            }
        });
    });
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