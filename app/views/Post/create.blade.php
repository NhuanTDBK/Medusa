@extends('post.layout.master')
@section('header')
<div class="col-md-1"></div>
	<div class="col-md-2">
		<span class="word-top"></span>
	</div>
<div class="col-md-2"></div>
<div class="col-md-7">
	<ul class="nav navbar-nav">
		<li class="active"><a href={{ URL::to('/post/index')}}>Home</a></li>
		<li class="active"><a href={{ URL::to('/'.Auth::user()->username.'/post/index')}}>Post</a></li>
		<li class="active"><a href="">Contact</a></li>
		<li class="active"><a href="">About</a></li>
		<li class="active"><a href="">Tags</a></li>
		@if(isset(Auth::user()->username))
		<li><a href="">{{Auth::user()->username}}<img class="img-circle" style="height:28px; width:28px; margin-left: 15;" src="https://graph.facebook.com/{{Auth::user()->fbid}}/picture?type=large"></a></li>
	    @endif
	</ul>
</div>
@stop