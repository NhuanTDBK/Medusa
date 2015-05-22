﻿<html>
	<head>
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/Nguyen_css_design.css') }}">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	   	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		@yield('script')
		<meta charset="utf-8"></meta>
		<title>Laravel Blog</title>
		
	</head>
	
	<body>
		<div id="banner" class="banner">
			<div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; width:100%; height:600px; z-index: -999998; position: absolute;">
				<img src="{{ URL::asset('assets/img/cover.jpg') }}" style="position: absolute; margin: 0px; padding: 0px; border: none; width:100%; height:600px; z-index: -999999; left: 0px;">
			</div>
			<!--<img style="z-index:-999999; width:100%; height:500px; margin-bottom:30px;" src="1.jpg" >-->
			<div class="banner-caption">
				<span style="font-size:40px;">Fly Your   </span>
				<span class="word-top" style="font-size:60px; color: #55acee;">Imagination</br></span>
				<span class="word-top" style="position:absolute; font-size:30px; left:2%;">Don't live a serious life. Let it Fun!</span>
			</div>
		</div>
		<header class="header fixed clearfix navbar navbar-fixed-top">
			<div class="col-md-1"></div>
			<div class="col-md-2">
				<span class="word-top"> Imagine</span>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-7">
				<ul class="nav navbar-nav">
					<li class="active"><a href={{ URL::to('/post/index')}}>Home</a></li>
					@if(Auth::check())
					<li><a href={{ URL::to('/'.Auth::user()->username.'/post/index')}}>Post</a></li>
					@endif
					<li><a href="">Contact</a></li>
					<li><a href="">About</a></li>
					@if(Auth::check())
					<li><a href={{ URL::to('/'.Auth::user()->username.'/backend')}}>Settings</a></li>
					<li>
						<a href="{{url(Auth::user()->username.'/backend')}}">{{Auth::user()->username}}
							@if(Session::has('avatar_link'))
							<img src="{{Session::get('avatar_link')}}"class="img-circle" style="height:28px; width:28px; margin-left: 15;" >
							@endif
						</a>
					</li>
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

					<div class="col-md-4 sidebar">
						<div class="panel panel-info">
							@yield('sidebar_post')
						</div>
					</div>

				</div>
			</div>
		</div>	
	<script>
	smoothScroll.init();
	</script>
	</body>
</html>