jQuery.validator.setDefaults({
    showErrors : function(errorMap, errorList)
    {
        $.each(this.successList, function(index, value) {
            return $(value).popover("destroy");//in there, I changed 'hide' to 'destroy'
        });
        return $.each(errorList, function(index, value) {
            var _popover;
            _popover = $(value.element).popover({
                trigger : "manual",
                container : "body",//please change it in your page
                content : value.message,
                placement : 'top'
            });
            return $(value.element).popover("show");
        });
    }
});

$(function () {
    $(window).bind("scroll", function () {
        var scrollTopNum = $(document).scrollTop(),
            returnTop = $("a.goto-top");
        (scrollTopNum > 400) ? returnTop.fadeIn("fast") : returnTop.fadeOut("fast");
    });

    $('#loginPanel *').click(function(e) {
        e.stopPropagation();
    });

    // 点击按钮后，滚动条的垂直方向的值逐渐变为0，也就是滑动向上的效果
    $("a.goto-top").click(function () {
        $('body,html').animate({scrollTop: 0}, 500);
        return false;
    });

    $(".loginbar").on("hidden.bs.dropdown", function(){
        $('.popover').hide();
    });

    $(".loginbar").on("show.bs.dropdown", function(){
        $('.popover').hide();
    });

    $('#loginForm').validate(
        {
            showErrors : function(errorMap, errorList)
            {
                $.each(this.successList, function(index, value) {
                    return $(value).popover("destroy");//in there, I changed 'hide' to 'destroy'
                });
                return $.each(errorList, function(index, value) {
                    var _popover;
                    _popover = $(value.element).popover({
                        trigger : "manual",
                        container : "body",//please change it in your page
                        content : value.message,
                        placement : 'right'
                    });
                    return $(value.element).popover("show");
                });
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
                    data: {"email":username,
                        "password":pwd,
                        "rememberme" : rememberme ,
                        '_token' : _token
                    },
                    success: function (data) {
                        if(data.state == 1)
                        {
                            window.location.reload();
                        }
                        else
                        {
                            var n = noty({
                                text        : "用户名或密码错误",
                                type        : "error",
                                dismissQueue: false,
                                killer: true,
                                layout      : 'topCenter',
                                theme       : 'defaultTheme',
                                timeout: 2000
                            });
                        }
                    },
                    error: function (data) {
                        var n = noty({
                            text        : "用户名或密码错误",
                            type        : "error",
                            dismissQueue: false,
                            killer: true,
                            layout      : 'topCenter',
                            theme       : 'defaultTheme',
                            timeout: 2000
                        });
                    }
                });
                return false;
            }
        });

    $("#uploadImageBtn").bind("click",function(){
        $("#uploadImageForm").ajaxSubmit({
            beforeSubmit: validateUpload,
            dataType:'json',
            beforeSend: loadingMessage("正在努力上传中..."),
            success:function(data)
            {
                if(data.state)
                {
                    $("#uploadModal").modal('hide');
                    $("#uploadImageForm")[0].reset();
                    window.location.href = data.url;
                }
                else
                {
                    var n = noty({
                        text        : data.message,
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
                    text        : "请重新上传！",
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

    $("#forwardImageBtn").bind("click",function(){
        $("#forwardImageForm").ajaxSubmit({
            beforeSubmit: validateForward,
            dataType:'json',
            beforeSend: loadingMessage("正在努力上传中..."),
            success:function(data)
            {
                if(data.state)
                {
                    $("#forwardModal").modal('hide');
                    $("#forwardImageForm")[0].reset();
                    window.location.href = data.url;
                }
                else
                {
                    var n = noty({
                        text        : data.message,
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

    $('#message_list').bind('click',function()
    {
        $loCount = $('#message_count').html();

        if($loCount == 0)
        {
            $(".msg_loading").html("暂时没有消息");
        }
        else
        {
            $.ajax({
                url: ROOT_PATH + "/message/notify",
                type: "get",
                dataType : 'json',
                success: function (data) {
                    var loHtml = '';
                    $.each(data,function(i,child)
                    {
                        loHtml +=
                            "<li class='message-preview'>" +
                            "<a href='"+ROOT_PATH+"/art/"+child.article_id+"'>" +
                            "<span class='msg_name'>"+child.sender.name+"</span>在" +
                            "<span class='msg_title'>"+child.article.title+"</span> 中回复了你 " +
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
        }
    });
});

function validateUpload(formData, jqForm, options)
{
    var state = 1;
    var message = '';
    if (!jqForm[0].title.value)
    {
        state = 0;
        message = '请输入标题！';
    }

    if (!jqForm[0].title.value.length > 200)
    {
        state = 0;
        message = '标题不能超过100字！';
    }

    if (!jqForm[0].uploadImage.value)
    {
        state = 0;
        message = '请选择上传文件！';
    }

    if(!state)
    {
        var n = noty({
            text        : message,
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

function validateForward(formData, jqForm, options)
{
    var state = 1;
    var message = '';
    if (!jqForm[0].title.value)
    {
        state = 0;
        message = '请输入标题！';
    }

    if (!jqForm[0].title.value.length > 200)
    {
        state = 0;
        message = '标题不能超过100字！';
    }

    if (!jqForm[0].forwardUrl.value)
    {
        state = 0;
        message = '请输入地址！';
    }

    if(!isUrl(jqForm[0].forwardUrl.value))
    {
        state = 0;
        message = '请输入正确的地址！';
    }

    if(!state)
    {
        var n = noty({
            text        : message,
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
    //open login form
    $('#loginShowBtn').trigger('click');
}

//validate url
function isUrl(s) {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
    return regexp.test(s);
}

/**
 * Created by mini on 14-1-13.
 */
function sinaweibo(titile, url, picpath)
{
    var _url = encodeURIComponent(url);
    var _assname = encodeURI("");//你注册的帐号，不是昵称
    var _appkey = encodeURI("123123123");//你从腾讯获得的appkey
    var _pic = encodeURI(picpath);//（例如：var _pic='图片url1|图片url2|图片url3....）
    var _t = "搞笑娃-为生活添欢乐 " + titile;//标题和描述信息
    if (_t.length > 120)
    {
        _t = _t.substr(0, 117) + '...';
    }
    _t = encodeURI(_t);

    var _u = 'http://v.t.sina.com.cn/share/share.php?url=' + _url + '&appkey=' + _appkey + '&pic=' + _pic + '&assname=' + _assname + '&title=' + _t;
    window.open(_u, '', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no');
}

function postToWb(titile, url, picpath)
{
    var _url = encodeURIComponent(url);
    var _assname = encodeURI("");//你注册的帐号，不是昵称
    var _appkey = encodeURI("123123123");//你从腾讯获得的appkey
    var _pic = encodeURI(picpath);//（例如：var _pic='图片url1|图片url2|图片url3....）
    var _t = "搞笑娃-为生活添欢乐 " + titile;//标题和描述信息
    if (_t.length > 120)
    {
        _t = _t.substr(0, 117) + '...';
    }
    _t = encodeURI(_t);

    var _u = 'http://share.v.t.qq.com/index.php?c=share&a=index&url=' + _url + '&appkey=' + _appkey + '&pic=' + _pic + '&assname=' + _assname + '&title=' + _t;
    window.open(_u, '', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no');
}

function loadingMessage($text)
{
    noty({
        text        : $text,
        type        : "warning",
        dismissQueue: false,
        killer: true,
        layout      : 'topCenter',
        theme       : 'defaultTheme'
    });
}