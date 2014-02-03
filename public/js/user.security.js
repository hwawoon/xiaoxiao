$(function(){
    document.getElementById('passwordForm').reset();

    $('#passwordForm').validate(
    {
        rules: {
            old_password: {
                required: true,
                minlength: 6
            },
            new_password: {
                required: true,
                minlength: 6
            },
            new_password_confirmation: {
                required: true,
                minlength: 6,
                equalTo: "#new_password"
            }
        },
        messages: {
            old_password: {
                required: "请输入当前密码",
                minlength: jQuery.format("密码不能小于{0}个字 符")
            },
            new_password: {
                required: "请输入新密码",
                minlength: jQuery.format("密码不能小于{0}个字 符")
            },
            new_password_confirmation: {
                required: "请输入确认密码",
                minlength: "确认密码不能小于6个字符",
                equalTo: "两次输入密码不一致"
            }
        }
    });
});