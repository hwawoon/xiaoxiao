<!DOCTYPE html>
<html lang="utf-8">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<br><br>
		您好，我们很乐于为您重设搞笑娃帐号。<br><br>
		如果该重设密码请求不是您提出的，则忽略该电子邮件。不用担心，您的帐号很安全。<br><br>
		如果该请求是您提出的，请按照下文说明操作。<br><br>
		单击下列链接以设置新密码：<br>
        <a href="{{ URL::to('password/reset', array($token)) }}">
                {{ URL::to('password/reset', array($token)) }}.
        </a><br><br>
        如果单击链接无结果，您可以将链接复制到浏览器窗口中或者直接将其输入。<br><br>

        此致，<br>
        搞笑娃
	</body>
</html>