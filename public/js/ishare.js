/**
 * Created by mini on 14-1-13.
 */
function sinaweibo(titile, url, picpath)
{
    var _url = encodeURIComponent(url);
    var _assname = encodeURI("");//你注册的帐号，不是昵称
    var _appkey = encodeURI("123123123");//你从腾讯获得的appkey
    var _pic = encodeURI(picpath);//（例如：var _pic='图片url1|图片url2|图片url3....）
    var _t = "搞笑哇！ " + titile;//标题和描述信息
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
    var _t = "搞笑哇！ " + titile;//标题和描述信息
    if (_t.length > 120)
    {
        _t = _t.substr(0, 117) + '...';
    }
    _t = encodeURI(_t);

    var _u = 'http://share.v.t.qq.com/index.php?c=share&a=index&url=' + _url + '&appkey=' + _appkey + '&pic=' + _pic + '&assname=' + _assname + '&title=' + _t;
    window.open(_u, '', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no');
}