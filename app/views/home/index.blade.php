@extends('home.layout.'.$theme)
@section('listing')
@foreach($posts as $post)
<div class="panel-heading">
		<h3 class="panel-title"><h2><a href="{{URL::to('post/'.$post['_id'])}}">{{$post->title}}</a></h2></h3>
</div>
<div>
		<p>Author: &nbsp; {{$post->username}} &nbsp; on {{$post->create_time}}</p>
</div>
<div class="panel-body">
			<p>
                @if(strlen($post->content)<400)
                {{$post->content}}
                @else
                {{substr($post->content,0,400)}}
                @endif
            </p>
			<a href="{{$post['_id']}}" style="">Read More...</a>
</div>
<div class="panel-footer">
			<span>
			@foreach($post['tags'] as $key => $tag)
			    <a href="">{{$tag}} &nbsp;</a>
			@endforeach
			</span>
</div>
@endforeach
@stop

@section('sidebar_post')
    <div class="panel-heading"> <h2>Bài mới</h2></div>
    <div class="panel-body">
	{{--  {{count($posts)}} --}}
	@if(count($posts) <=5)
		@foreach($posts as $post)
				<a href="{{URL::to('post').'/'.$post['_id']}}">{{$post->title}}</a><br>
				<img src="{{URL::asset("assets/img/0B8z8ereLRdjhZ1lCSEdvVVRHV00.jpg")}}" class="img-rounded" style=" margin-right:10px; width:60px; height:60px; float:left">
				
				<a href="{{URL::to('post').'/'.$post['_id']}}" style="float:right; ">Read More...</a><hr>
				@endforeach
	@else
		@foreach($posts as $post)
				<a href="{{URL::to('post').'/'.$post['_id']}}">{{$post->title}}</a><br>
				<img src="{{URL::asset("assets/img/0B8z8ereLRdjhZ1lCSEdvVVRHV00.jpg")}}" class="img-rounded" style=" margin-right:10px; width:60px; height:60px; float:left">
				
				<a href="{{URL::to('post').'/'.$post['_id']}}" style="float:right; ">Read More...</a><hr>
		@endforeach
    @endif
    </div>
@stop