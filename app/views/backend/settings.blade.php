@extends('backend.layout.master')
@section('listing')
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '379361542266786',
            xfbml      : true,
            version    : 'v2.3'
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
<div align="center">
<fb:login-button scope="public_profile,email" onlogin="checkLoginState();" size="xlarge">
</fb:login-button>
</div>
<div id="status">
</div>
@endsection