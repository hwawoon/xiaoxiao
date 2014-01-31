$(function(){
    $("#uploadResizeBtn").bind("click",function(){
        $("#resizeForm").ajaxSubmit({
            beforeSubmit: function(){
                if($('#userSelectIcon').val() == "")
                {
                    var n = noty({
                        text        : "请选择上传图片！",
                        type        : "warning",
                        dismissQueue: false,
                        killer: true,
                        layout      : 'topCenter',
                        theme       : 'defaultTheme',
                        timeout: 2000
                    });
                    return false;
                }
            },
            dataType:'json',
            success:function(data)
            {
                if(data.state == 1)
                {
                    if(jcrop_api != null)
                    {
                        jcrop_api.destroy();
                    }

                    $('#cropImgPath').val(data.uploadimg);
                    $('#targetImage').attr("src",ROOT_PATH + "/temp/" + data.uploadimg);
                    $('#thumnailImage').attr("src",ROOT_PATH + "/temp/" + data.uploadimg);

                    $('#targetImage').Jcrop({
                            minSize: [50,50],
                            setSelect: [0,0,200,200],
                            onChange: updatePreview,
                            onSelect: updatePreview,
                            aspectRatio: 1
                        },
                        function(){
                            // Use the API to get the real image size
                            var bounds = this.getBounds();
                            boundx = bounds[0];
                            boundy = bounds[1];
                            // Store the API in the jcrop_api variable
                            jcrop_api = this;
                        });
                }
                else if(data.state == 0)
                {
                    var alertmsg = "";
                    if(data.type == 'validation')
                    {
                        var loMessage = JSON.parse(data.message);
                        alertmsg += loMessage.userSelectIcon.join('<br>');
                    }
                    else
                    {
                        alertmsg = data.message;
                    }

                    var n = noty({
                        text        : alertmsg,
                        type        : "error",
                        dismissQueue: false,
                        killer: true,
                        layout      : 'topCenter',
                        theme       : 'defaultTheme',
                        timeout: 2000
                    });
                }
            }
        });
    });

    // Create variables (in this scope) to hold the API and image size
    var jcrop_api,
        boundx,
        boundy,

    // Grab some information about the preview pane
    $preview = $('#preview-pane'),
    $pcnt = $('#preview-pane .preview-container'),
    $pimg = $('#preview-pane .preview-container img'),
    xsize = $pcnt.width(),
    ysize = $pcnt.height();

    function updatePreview(c)
    {
        if (parseInt(c.w) > 0)
        {
            var rx = xsize / c.w;
            var ry = ysize / c.h;

            $pimg.css({
                width: Math.round(rx * boundx) + 'px',
                height: Math.round(ry * boundy) + 'px',
                marginLeft: '-' + Math.round(rx * c.x) + 'px',
                marginTop: '-' + Math.round(ry * c.y) + 'px'
            });

            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        }
    }

});

function updateCoords(c)
{
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
}

function checkCoords()
{
    if (parseInt($('#w').val()))
    {
        return true;
    }
    var n = noty({
        text        : "请选择图片上合适的区域",
        type        : "alert",
        dismissQueue: false,
        killer: true,
        layout      : 'topCenter',
        theme       : 'defaultTheme',
        timeout: 2000
    });
    return false;
}