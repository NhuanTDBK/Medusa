@extends('backend.layout.master')
@section('listing')
<div id="fb-root"></div>
<script>
    var appId = null;
      $.ajax(
      {
        type:"GET",
        url:"{{URL::asset('login/fb/appId')}}",
        async:false,
        success: function(data)
        {
            appId = JSON.parse(data);
            console.log(appId);
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

    function checkLoginState() {
            FB.login(function(response){
                if(response.status === "connected"){
                    //nếu trạng thái trả về là kết nối
                    var fbid=response.authResponse.userID;//lấy facebook ID
                    console.log(fbid);
                    $('input[name="fbid"]').val(fbid);
                    //$("#div.fbpic").append('<img src="https://graph.facebook.com/'+fbid+'/picture?type=large"/>');//link ảnh avatar FB
                    // xử lý ajax: lưu fbid vào CSDL
                    $.ajax({
                        type: "POST",
                        url: "{{URL::asset('user/syncfb')}}",
                        data: {fbid: fbid},
                        cache: false,
                        success: function(data){
                            if(data) {
                                alert("Sync thành công");
                            }
                            else alert("Lỗi");
                        }
    });
                }else if(response.status === "no_authorized"){
                    //Đã login facebook nhưng chưa login app
                }else{
                    //Chưa login cả FB và app
                }
            },{
                scope: 'public_profile,email,publish_actions'
            });
//             FB.api('/me/feed', 'post', {
//                              message:'my_message',
//                                  link:"https://developers.facebook.com/docs/php/gettingstarted/4.0.0",
//
//                              name: 'Heelo',
//                              description: 'description'
//
//                         },function(data) {
//                              console.log(data);
//                         });
        }
       function statusChangeCallback(response) {
               console.log('statusChangeCallback');
               console.log(response);
               // The response object is returned with a status field that lets the
               // app know the current login status of the person.
               // Full docs on the response object can be found in the documentation
               // for FB.getLoginStatus().
               if (response.status === 'connected') {
                   // Logged into your app and Facebook.
                   testAPI();
               } else if (response.status === 'not_authorized') {
                   // The person is logged into Facebook, but not your app.
                   document.getElementById('status').innerHTML = 'Please log ' +
                   'into this app.';
               } else {
                   // The person is not logged into Facebook, so we're not sure if
                   // they are logged into this app or not.
                   document.getElementById('status').innerHTML = 'Please log ' +
                   'into Facebook.';
               }
        }

</script>
<div align="center">
    <h2>Settings</h2>
</div>
<h3>Connected with Facebook</h3>
<div align="left">
<div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="true" data-auto-logout-link="true" onclick="checkLoginState"></div>
</div>
<div id="status">
</div>
<h3>Cover</h3>

		<input type="file" name="image" id="form-upload"/>
		<button id="btn-upload">Upload</button>
	<p id="#message"></p>
	<script type="text/javascript">
		$("#btn-upload").on('click',function(){
			$("#message").html('');

			var datas = $(':file').prop('files')[0];
			var data =new FormData();
			data.append("image",datas);
			var url = "{{URL::asset('user/changecover')}}";
			$.ajax({
				url: url,
				type: "POST",
				data: data,
				cache: false,
				processData:false,
				success: function(data){
					$("#message").html(data);
				}
			});
		});
	</script>
@endsection