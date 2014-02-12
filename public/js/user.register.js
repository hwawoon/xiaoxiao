$(function () {
    $('#registerform').validate(
    {
        rules: {
            name: {
                required: true,
                remote: {
                    url: ROOT_PATH + "/nameChecker",
                    type: "get",
                    dataType: 'json',
                    data: {
                        'name': function () {
                            return $('#name').val();
                        }
                    }
                }
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: ROOT_PATH + "/emailChecker",
                    type: "get",
                    dataType: 'json',
                    data: {
                        'email': function () {
                            return $('#email').val();
                        }
                    }
                }
            },
            password: {
                required: true
            },
            password_confirmation: {
                required: true
            }
        },
        messages: {
            name: {
                required: "请输入您的尊称！",
                remote: '亲，这个尊称已经被占了！'
            },
            email: {
                required: "请输入Email地址！",
                email: "请输入正确的email地址",
                remote: '亲，该邮箱已经被占了！'
            },
            password: {
                required: "请输入密码"
            }
        }
    });
});