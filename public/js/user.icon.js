$(function(){
    $("#uploadResizeBtn").bind("click",function(){
        $("#resizeForm").ajaxSubmit({
            beforeSubmit: function(){
                if($('#userSelectIcon').val() == "")
                {
                    alert("请选择上传图片！");
                    return false;
                }
            },
            dataType:'json',
            success:function(data)
            {
                if(data.uploadimg != undefined)
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

    $("#avatar_submit").click(function(){
        $("#saveAvatarForm").ajaxSubmit({
            dataType:'json',
            success:function(data)
            {
                alert(data.message);
            }
        });
    });
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
    if (parseInt($('#w').val())) return true;
    alert('请选择图片上合适的区域');
    return false;
}