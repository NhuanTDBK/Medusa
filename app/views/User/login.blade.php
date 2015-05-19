<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Bootstrap Login Form</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
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

        function checkLoginState() {
            FB.login(function(response){
                if(response.status === "connected"){
                    //Đã login FB và Login app, lấy FB ID
                    var fbid=response.authResponse.userID;
                    $.ajax({
                          type: "POST",
                          url: "{{URL::asset('user/loginwithfb')}}",
                          data: {response:response},
                          cache: false,
                          success: function(data){
                            if(data) {
                              //alert(data);
                              var href = window.location.href;
                              var configHref = href.replace('login',data+'/backend')
                              window.location=configHref;
                            }
                            else alert("Tài khoản FB chưa đc Sync");}});
                }else if(response.status === "no_authorized"){
                    //Đã login facebook nhưng chưa login app
                      console.log("Chua login app");
                }else{
                    //Chưa login cả FB và app
                      console.log("Chua login bat ki thu gi");
                }
            },{
                scope: 'public_profile,email',
                auth_type: 'rerequest'
        });}
      </script>
	</head>
	<body style="background-image: url('gaussian-blur-abstract-hd-wallpaper-1920x1200-10432.jpg')">
	<div id="fb-root"></div>

<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Login</h1>
          <h1>
              {{--<fb:login-button scope="public_profile,email" size="xlarge" onlogin="checkLoginState();"> Login by Facebook--}}
              {{--</fb:login-button>--}}
          </h1>
      </div>
      <div class="modal-body">
          <form id="login-form" class="form col-md-12 center-block" method="post" action="<?php echo URL::to('/login');?>">
            <div class="form-group">
              <input name="user_input" type="text" class="form-control input-lg" placeholder="Username or Email">
            </div>
            <div class="form-group">
              <input name="password" type="password" class="form-control input-lg" placeholder="Password">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Sign In</button>
              <span class="pull-right">
                {{HTML::link('register','Register')}}
              </span>
              <span><a href="#">Need help?</a></span>
            </div>
            <div class="form-group">
              @if(Session::has('success'))
              <span>
                  {{Session::get('success')}}
              </span>
              @endif
            </div>
          </form>

      </div>
      <div class="modal-footer">
         
      </div>
  </div>
  </div>

  <script type="text/javascript">
    $('#login-form').validate({
      rules:{
        email:{
          required:true,
          email:true
        },
        password:{
          required:true,
          minlength: 6
        }
      },
      messages:{
        email:{
          required: "Vui lòng nhập email",
          email: "Vui lòng nhập đúng định dạng email"
        },
        password:{
          required: "Vui lòng nhập mật khẩu",
          minlength: "Mật khẩu phải 6 kí tự trở lên"
        }
      }
    })
  </script>
</div>
	<!-- script references -->
	</body>
</html>