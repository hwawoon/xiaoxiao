$(function () {
    $(window).load(function () {
        $('#timeliner').masonry({
            itemSelector: '.item'
        });
    });
});

function delArticle(id)
{
    noty({
        text: '<span class="dcfm">亲，确认要删除吗？<br>删除后相关的评论都会被删除哦</span>',
        layout: 'center',
        buttons: [
            {
                addClass: 'btn btn-primary',
                text: '确定',
                onClick: function($noty) {
                    document.getElementById("delform"+id).submit();
                }
            },
            {
                addClass: 'btn btn-danger',
                text: '取消',
                onClick: function($noty) {
                    $noty.close();
                }
            }
        ]
    });
}