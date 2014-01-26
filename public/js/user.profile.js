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
        text: '亲，确认要删除吗？<br>删除后相关的评论都会被删除',
        layout: 'topCenter',
        buttons: [
            {
                addClass: 'btn btn-primary',
                text: '确定',
                onClick: function($noty) {
                    $noty.close();
                    noty({text: '你点击了确定按钮', type: 'success'});
            }
            },
            {
                addClass: 'btn btn-danger',
                text: '取消',
                onClick: function($noty) {
                $noty.close();
                noty({text: '你点击了取消按钮', type: 'error'});
            }
            }
        ]
    });
}