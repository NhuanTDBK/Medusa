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
            appId = data;
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
    }
    //    function statusChangeCallback(response) {
    //            console.log('statusChangeCallback');
    //            console.log(response);
    //            // The response object is returned with a status field that lets the
    //            // app know the current login status of the person.
    //            // Full docs on the response object can be found in the documentation
    //            // for FB.getLoginStatus().
    //            if (response.status === 'connected') {
    //                // Logged into your app and Facebook.
    //                testAPI();
    //            } else if (response.status === 'not_authorized') {
    //                // The person is logged into Facebook, but not your app.
    //                document.getElementById('status').innerHTML = 'Please log ' +
    //                'into this app.';
    //            } else {
    //                // The person is not logged into Facebook, so we're not sure if
    //                // they are logged into this app or not.
    //                document.getElementById('status').innerHTML = 'Please log ' +
    //                'into Facebook.';
    //            }
    //     }
    // }
</script>
<div align="center">
    <h2>Settings</h2>
</div>
<div class="col-xs-12">
  <h3 class="col-xs-12">Connected with Facebook</h3>
  <hr class="col-xs-12">

  <div align="left">
    <div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="true" data-auto-logout-link="true" onlogin="checkLoginState();"></div>
  </div>
    <div id="status">
  </div>
</div>
{{-- <div class="col-xs-12">
  <h3 class="col-xs-12">Account Infomation</h3>
  <hr class="col-xs-12">
  
    <input type="file" name="image" id="form-upload"/>
    <button id="btn-upload">Upload</button>
  <p id="#message"></p>
</div> --}}
<div class="col-xs-12">
  <h3 class="col-xs-12">Theme Setting</h3>
  <hr class="col-xs-12">
  <div class="col-xs-12">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item" id="concept1">
          <img src="{{url('assets/img/concept1.jpg')}}">
          <div class="carousel-caption">
            <h1>Free</h1>
            <h2>Phong cách thiên nhiên </h2>
            <a href="javascript:void(0)" class="btn-select btn btn-primary btn-lg" data-type="concept1"><h4>Select This</h4></a>
          </div>
        </div>

        <div class="item" id="concept2">
          <img src="{{url('assets/img/concept2.jpg')}}">
          <div class="carousel-caption">
            <h1>Sweet</h1>
            <h2>Phong cách trong sáng </h2>
            <a href="javascript:void(0)" class="btn-select btn btn-default btn-lg" data-type="concept2"><h4>Select This</h4></a>
          </div>
        </div>

        <div class="item" id="concept3">
          <img src="{{url('assets/img/concept3.jpg')}}">
          <div class="carousel-caption">
            <h1>Busy</h1>
            <h2>Phong cách bận rộn </h2>
            <a href="javascript:void(0)" class="btn-select btn btn-danger btn-lg" data-type="concept3"><h4>Select This</h4></a>
          </div>
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>    
  </div> 
</div>
	<script type="text/javascript">
    var selected = $("#{{Session::get('theme')}}");
    console.log("{{Session::get('theme')}}");
    selected.addClass('active');
    selected.find('.btn-select h4').html("Selected");  
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
    $("#myCarousel").on('click',".btn-select",function(){
      var select = $(this),
          type = select.data("type");
      $.ajax({
        url: "{{url('user/changetheme')}}",
        type: "POST",
        data: {theme: type},
        cache: false,
        success: function(data){
          if(data=="true") {
            $("#myCarousel").find('.btn-select h4').html('Select This');
            select.find('h4').html('Selected');
          }
        }
      });
    });
	</script>
@endsection