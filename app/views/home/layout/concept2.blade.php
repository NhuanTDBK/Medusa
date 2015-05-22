<html>
	<head>
		<meta charset="utf-8"></meta>
		<title>Laravel Blog</title>
		<link rel="stylesheet" type="text/css" href="https://googledrive.com/host/0B8z8ereLRdjhWkFKVVFHNHE3Rzg">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="https://googledrive.com/host/0B8z8ereLRdjhTUxYQWhpbHQtcE0"></script>
		
		@yield('script')
		<style>
			.label-primary {
			  font-size: 12 !important;
			}
			.panel-info {
			 border-color: white !important; 
			}
			.panel-info>.panel-heading {
			 background-color: white !important; }
			.panel-default{
			  border-color: white !important;
			}
			.panel-footer{
			background-color:white !important;
			}
			.panel-default>.panel-heading{
			    background-color:white !important;
			}
			.container {
			width: 1170px;
			}
			.row {
			margin-right: -15px;
			margin-left: -15px;
		}
		</style>
	</head>
	<body >
	<div id ="header">
		<ul>
		<li><a data-scroll class="blogname" href="#main"><b>What About Today?</b> </a></li>
		</ul>		
	</div>
	<header class="navbar navbar-default navbar-static-top">
		<div class="col-md-4">	
		<img src="b-w.jpg" class="img-circle" style=" width:40; height:40;">		
		<span class="text"><b>log</b></span>
		</div>
		<div class="col-md-8">
			<ul class="nav navbar-default navbar-nav">
				<li class="active"><a href={{ URL::to('/post/index')}}>Home</a></li>
				@if(Auth::check())
				<li><a href={{ URL::to('/'.Auth::user()->username.'/post/index')}}>Post</a></li>
				<li><a href={{ URL::to('/'.Auth::user()->username.'/backend')}}>Settings</a></li>
				@endif
				<li><a href="">Contact</a></li>
				<li><a href="">About</a></li>
			
				@if(Auth::check()and isset(Auth::user()->fbid))
				<li><a href="">{{Auth::user()->username}}<img class="img-circle" style="height:28px; width:28px; margin-left: 15;" src="https://graph.facebook.com/{{Auth::user()->fbid}}/picture?type=large"></a></li>
			    @endif
			</ul>
		</div>
	</header>
	
	<div id="main" class="menubody">
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
	</body>
	<script>
	smoothScroll.init();
	</script>
</html>