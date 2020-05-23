<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>注册且人链接</title>	
	</head>
	<body>
		<h1>感谢您在My_boke网站镜像注册！</h1>
		<p>
			请地哪家下面的链接完成注册！
			<a href="{{ route('confirm_email',$user->activation_token) }}">
				{{ route('confirm_email',$user->activation_token) }}
			</a>
		</p>
	
		<p>如果不是您本人的操作。请忽略次邮件。</p>
	</body>
</html>
   
