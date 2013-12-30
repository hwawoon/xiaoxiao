//错误消息定制
$(document).ready(function() {
    jQuery.validator.setDefaults({
        errorPlacement: function(error, element) {
            // if the input has a prepend or append element, put the validation msg after the parent div
            if(element.parent().hasClass('input-prepend') || element.parent().hasClass('input-append')) {
                error.insertAfter(element.parent());
                // else just place the validation message immediatly after the input
            } else {
                error.insertAfter(element);
            }
        },
        showErrors: function(errorMap, errorList) {

            // Clean up any tooltips for valid elements
            $.each(this.validElements(), function (index, element) {
                var $element = $(element);

                $element.data("title", "") // Clear the title - there is no error associated anymore
                    .removeClass("error")
                    .tooltip("destroy");
            });

            // Create new tooltips for invalid elements
            $.each(errorList, function (index, error) {
                var $element = $(error.element);

                $element.tooltip("destroy") // Destroy any pre-existing tooltip so we can repopulate with new tooltip content
                    .data("title", error.message)
                    .addClass("error")
                    .tooltip(); // Create a new tooltip based on the error messsage we just set in the title
            });
        },
        errorElement: "small", // contain the error msg in a small tag
        wrapper: "div", // wrap the error message and small tag in a div
        highlight: function(element) {
            $(element).closest('.control-group').addClass('error'); // add the Bootstrap error class to the control group
        },
        success: function(element) {
            $(element).closest('.control-group').removeClass('error'); // remove the Boostrap error class from the control group
        }
    });
});

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

    $("#btnLogin").click(function(){
        var username = $("#inputLoginEmail").val();
        var pwd = $("#inputLoginPassword").val();
        $.ajax({
            type: "POST",
            url: "user/doLogin",
            data: {"email":username,"password":pwd},
            success: function () {
                document.location.reload();
            },
            error: function () {
                alert('failed');
            }
        });
//        $('#loginForm').validate(
//            {
//                rules: {
//                    inputLoginEmail: {
//                        required: true,
//                        email: true
//                    },
//                    inputLoginPassword: {
//                        required: true
//                    }
//                },
//                messages: {
//                    inputLoginEmail: {
//                        required: "请输入Email地址！",
//                        email: "请输入正确的email地址！"
//                    },
//                    inputLoginPassword: {
//                        required: "请输入密码"
//                    }
//                },
//                submitHandler: function (form) {
//                    var username = $("#inputLoginEmail").val();
//                    var pwd = $("#inputLoginPassword").val();
//                    $.ajax({
//                        type: "POST",
//                        url: "user/doLogin",
//                        data: {"email":username,"password":pwd},
//                        success: function () {
//                            document.windows.reload();
//                        },
//                        error: function () {
//                            alert('failed');
//                        }
//                    });
//                    return false;
//                }
//            });
    });



});