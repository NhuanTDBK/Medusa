@extends('backend.layout.master')
@section('listing')
<script>
     var appId = null;
     $.ajax(
          {
            type:"GET",
            url:"{{URL::asset('login/fb/appId')}}",
            success: function(data)
            {
                appId = data;
            }
          });
     window.fbAsyncInit = function() {
                  FB.init({
                      appId      : appId,
                      xfbml      : true,
                      version    : 'v2.3',
                      cookie     : true
                  });
              };
              (function(d, s, id){
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) {return;}
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/sdk.js";
                  fjs.parentNode.insertBefore(js, fjs);
              }(document, 'script', 'facebook-jssdk'));
</script>
<div class="row">
    <div class="col-lg-12">
      	<h2>Posts &nbsp;<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><a target="_blank" href="{{URL::to('post/create')}}">New Post</a></button></h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                  	<tr>
                        <th><input type="checkbox"></th>
                        <th>Tiêu đề</th>
                        <th>Loại</th>
                        <th>Người đăng</th>
                        <!-- <th>Like</th>-->
                        <th>Comment</th>
                        <!-- <th>Lượt xem</th>-->
                        <th>Ngày đăng</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr id="tr{{$post['_id']}}">
                        <td><input type="checkbox"></td>
                        <td>
                        	<p>{{$post->title}}</p>
                        	<ul class="list-inline">
                    			<li><a target="_blank" href='{{URL::to('post/update/'.$post['_id'])}}'>Chỉnh sửa</a></li>
                    			<li><a target="_blank" href='{{URL::to('post/'.$post['_id'])}}'>Xem</a></li>
                    			<li><a href='#' onclick="sharePostToFacebook('{{$post['_id']}}')" >Chia sẻ</a></li>
                    			<li><a id="delete" href='#' onclick="deletePost('{{$post['_id']}}')">Xóa</a></li>
                			</ul>
                        </td>
                        @if($post["type"]=="Draft")
                        <td>Bản nháp</td>
                        @else
                        <td>Bản chính</td>
                        @endif
                        <td><span>{{$post->username}}</span></td>
                        <td>{{$post["commentCount"]}}</td>
                        <td>@if(isset($post->updated_at))
                          {{$post->updated_time}}
                        @endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function deletePost(id)
    {
        $.ajax(
        {
            url:"{{URL::to('post/')}}/"+id,
            type:"DELETE",
            success: function(data)
            {
                    var name = "#tr"+id;
                    console.log(name);
                    $(name).fadeOut("normal", function() {
                            $(this).remove();
                        });
            }
        });
    }
    function sharePostToFacebook(id)
    {
        FB.ui({
            method: 'share',
            href: '{{URL::to('post/')}}/'+id
        }, function(response){
            console.log(response);
            if(response.error_code)
            {
                alert("Share khong thanh cong");
            }
            else{
                alert("Share thanh cong");
            }
     });
    }
</script>
@stop