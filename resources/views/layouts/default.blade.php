<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title','my boke') - 新博客新精彩</title>
		<link rel="stylesheet" href="{{mix('css/app.css')}}">
		<!--script src="{{ mix('js/app.js') }}"></script-->
	</head>
	<body>
		@include('layouts._header')

		<div class="container">
			<div class="offset-md-1 col-md-10">
				@include('shared._messages')
				@yield('content')
				@include('layouts._footer')
			</div>
		</div>
		
		<script src="{{ mix('js/app.js') }}"></script>
	</body>
</html>
