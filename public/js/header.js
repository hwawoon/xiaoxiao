$(function () {
    $(window).bind("scroll", function () {
        var scrollTopNum = $(document).scrollTop(),
            returnTop = $("a.goto-top");
        (scrollTopNum > 0) ? returnTop.fadeIn("fast") : returnTop.fadeOut("fast");
    });

    // 点击按钮后，滚动条的垂直方向的值逐渐变为0，也就是滑动向上的效果
    $("a.goto-top").click(function () {
        $('body,html').animate({scrollTop: 0}, 500);
        return false;
    });

    $('#loginForm').validate(
    {
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
                required: "请输入Email地址！",
                email: "请输入正确的email地址！"
            },
            inputLoginPassword: {
                required: "请输入密码"
            }
        },
        submitHandler: function (form) {
            var username = $("#inputLoginEmail").val();
            var pwd = $("#inputLoginPassword").val();
            var rememberme = $(":input[name=rememberme][checked]").val();
            $.ajax({
                url: form.action,
                type: form.method,
                data: {"email":username,"password":pwd, "rememberme" : rememberme},
                success: function (data) {
                    if(data.state == 1)
                    {
                        window.location.reload();
                    }
                    else
                    {
                        $("#loginAlert").show();
                        window.setTimeout(function() { $("#loginAlert").slideUp(600); }, 2000);
                    }
                },
                error: function (data) {
                    $("#loginAlert").show();
                    window.setTimeout(function() { $("#loginAlert").slideUp(600); }, 2000);
                }
            });
            return false;
        }
    });

});