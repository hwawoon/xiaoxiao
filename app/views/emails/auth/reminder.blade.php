<!DOCTYPE html>
<html lang="utf-8">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>密码重置</h2>

		<div>
			点击链接重置密码
            <a href="{{ URL::to('password/reset', array($token)) }}">
                {{ URL::to('password/reset', array($token)) }}.
            </a>
		</div>
	</body>
</html>