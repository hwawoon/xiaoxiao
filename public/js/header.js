$(function () {
    $(window).bind("scroll", function () {
        var scrollTopNum = $(document).scrollTop(),
            returnTop = $("a.goto-top");
        (scrollTopNum > 400) ? returnTop.fadeIn("fast") : returnTop.fadeOut("fast");
    });

    // 点击按钮后，滚动条的垂直方向的值逐渐变为0，也就是滑动向上的效果
    $("a.goto-top").click(function () {
        $('body,html').animate({scrollTop: 0}, 500);
        return false;
    });

    $('#loginForm').validate(
    {
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                $('#loginAlert strong').html(validator.errorList[0].message);
                validator.errorList[0].element.focus();
                $("#loginAlert").show();
            }
        },
        onkeyup: true,
        errorPlacement: function(error, element) {
        },
        rules: {
            inputLoginEmail: {
                required: true,
                email: true
            },
            inputLoginPassword: {
                required: true
            }
        },
        messages: {
            inputLoginEmail: {
                required: "请输入邮箱！",
                email: "请输入正确的邮箱！"
            },
            inputLoginPassword: {
                required: "请输入密码"
            }
        },
        submitHandler: function (form) {
            var username = $("#inputLoginEmail").val();
            var pwd = $("#inputLoginPassword").val();
            var rememberme = $(":input[name=rememberme][checked]").val();
            var _token = $("#_token").val();
            $.ajax({
                url: form.action,
                type: form.method,
                data: {"email":username,"password":pwd, "rememberme" : rememberme , '_token' : _token},
                success: function (data) {
                    if(data.state == 1)
                    {
                        window.location.reload();
                    }
                    else
                    {
                        $('#loginAlert strong').html("用户名或密码错误");
                        $("#loginAlert").show();
                    }
                },
                error: function (data) {
                    $('#loginAlert strong').html("用户名或密码错误");
                    $("#loginAlert").show();
                }
            });
            return false;
        }
    });

    $("#uploadImageBtn").bind("click",function(){
        $("#uploadImageForm").ajaxSubmit({
            beforeSubmit: validateUpload,
            dataType:'json',
            success:function(data)
            {
                if(data.state)
                {
                    $("#uploadModal").modal('hide');
                    window.location.href = data.url;
                }
                else
                {
                    var alertmsg = "";
                    if(data.type == 'function')
                    {
                        alertmsg = data.message;
                    }
                    else if(data.type == 'validation')
                    {
                        var lomsg = JSON.parse(data.message);
                        alertmsg += lomsg.uploadImage.join('<br>');
                        alertmsg += '<br>';
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

            },
            error:function(data)
            {
                var n = noty({
                    text        : "请重试！",
                    type        : "warning",
                    dismissQueue: false,
                    killer: true,
                    layout      : 'topCenter',
                    theme       : 'defaultTheme',
                    timeout: 2000
                });
            }
        });
    });

    $('#message_list').bind('click',function(){
        $loCount = $('#message_count').html();

        if($loCount == 0)
        {
            $(".msg_loading").html("无");
            return false;
        }

        $.ajax({
            url: ROOT_PATH + "/msg/getMessage",
            type: "get",
            dataType : 'json',
            success: function (data) {
                var loHtml = '';
                $.each(data,function(i,child){
                    loHtml += "<li class='message-preview'>" +
                        "<a href='"+ROOT_PATH+"/article/"+child.articleid+"'>" +
                        "<span class='msg_name'>"+child.from_username+"</span>回复了" +
                        "<span class='msg_title'>《"+child.title+"》</span>" +
                        "</a></li>";
                });
                $('.msg_loading').after(loHtml);
                $(".msg_loading").remove();
            },
            error: function (data) {
                var n = noty({
                    text        : "消息加载失败！",
                    type        : "alert",
                    dismissQueue: false,
                    killer: true,
                    layout      : 'topCenter',
                    theme       : 'defaultTheme',
                    timeout: 2000
                });
            }
        });
    });
});

function validateUpload(formData, jqForm, options)
{
    if (!jqForm[0].title.value)
    {
        var n = noty({
            text        : "请输入标题！",
            type        : "alert",
            dismissQueue: false,
            killer: true,
            layout      : 'topCenter',
            theme       : 'defaultTheme',
            timeout: 2000
        });
        return false;
    }

    if (!jqForm[0].uploadImage.value)
    {
        var n = noty({
            text        : "请选择上传文件！",
            type        : "alert",
            dismissQueue: false,
            killer: true,
            layout      : 'topCenter',
            theme       : 'defaultTheme',
            timeout: 2000
        });
        return false;
    }

    return true;
}

function openLoginModal()
{
    $("#loginModal").modal();
}