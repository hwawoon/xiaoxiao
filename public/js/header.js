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
                $("#uploadModal").modal('hide');
                window.location.reload();
                alert(data.message);
            }
        });
    });
});

function validateUpload(formData, jqForm, options)
{
    if (!jqForm[0].title.value)
    {
        alert('请输入标题！');
        return false;
    }

    if (!jqForm[0].uploadImage.value)
    {
        alert('请选择上传文件！');
        return false;
    }

    return true;
}

function openLoginModal()
{
    $("#loginModal").modal();
}