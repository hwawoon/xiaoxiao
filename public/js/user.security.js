$(function(){
    $('#passwordForm').validate(
    {
        rules: {
            old_password: {
                required: true
            },
            new_password: {
                required: true
            },
            new_password_confirmation: {
                required: true,
                equalTo: "#new_password"
            }
        },
        messages: {
            old_password: {
                required: "请输入当前密码"
            },
            new_password: {
                required: "请输入新密码"
            },
            new_password_confirmation: {
                required: "请输入确认密码",
                equalTo: "两次输入密码不一致"
            }
        }
    });
});