<html>
	<head>
		<meta charset="utf-8"></meta>
		<title>Laravel Blog</title>
		<link rel="stylesheet" type="text/css" href="https://googledrive.com/host/0B8z8ereLRdjhdUF5dVVyV0JsdXc">
		<link rel="stylesheet" type="text/css" href="https://googledrive.com/host/0B8z8ereLRdjhMHM2cmZPWE1IVW8">
		<script src="smooth-scroll-master/dist/js/bind-polyfill.js"> </script>
		<script src="smooth-scroll-master/dist/js/smooth-scroll.js"> </script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="https://googledrive.com/host/0B8z8ereLRdjhTUxYQWhpbHQtcE0"></script>
		
		@yield('script')
		
	</head>
	
	<body>
		<div id="word-top"><span style="font-size: 60px;
			color: #FF613C;">Everyone Deserves</span><hr><span style="font-size: 30px;
			color: white;">You have your own life. Dont be another!</span>
		</div>
		<div id="img-top"></div>
		<!-- header-->
		<header class="navbar navbar-inverse navbar-static-top">
		<div class="col-md-4">		
		</div>
		<div class="col-md-8">
		<ul class="nav navbar-nav">
			<li class="active"><a href={{ URL::to('/post/index')}}>Home</a></li>
			@if(Auth::check())
			<li><a href={{ URL::to('/'.Auth::user()->username.'/post/index')}}>Post</a></li>
			@endif
			<li><a href="">Contact</a></li>
			<li><a href="">About</a></li>
			<li><a href="">Tags</a></li>
			@if(Auth::check()and isset(Auth::user()->fbid))
			<li><a href="">{{Auth::user()->username}}<img class="img-circle" style="height:28px; width:28px; margin-left: 15;" src="https://graph.facebook.com/{{Auth::user()->fbid}}/picture?type=large"></a></li>
		    @endif
		</ul>
		</div>
		</header>

		<!--main-->
		<div id="main">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
					<div class="post">
						<div class="panel panel-default">
							@yield('listing')
						</div>
					</div>
					</div>
					<!-- end col-md8-->

					<div class="col-md-4 sidebar">
						<div class="panel panel-info">
							@yield('sidebar_post')
						</div>
					</div>

				</div>
			</div>
		</div>
	</body>
	<script>
	smoothScroll.init();
	</script>
</html>