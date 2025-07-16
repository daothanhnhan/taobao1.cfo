<?php 
  function base64url_encode($text) {
      $base64 = base64_encode($text);
      $base64 = trim($base64, "=");
      $base64url = strtr($base64, "+/", "-_");
      return $base64url;
  }

  function generate_state_param() {
      // a random 8 digit hex, for instance
      return bin2hex(openssl_random_pseudo_bytes(4));
  }

  function generate_pkce_codes() {
      $random = bin2hex(openssl_random_pseudo_bytes(32)); // a random 64-digit hex
      $code_verifier = base64url_encode(pack('H*', $random));
      $code_challenge = base64url_encode(pack('H*', hash('sha256', $code_verifier)));
      return array($code_verifier, $code_challenge);
  }

  // $state = generate_state_param();
  // var_dump($state);
  $state = '47a7dde1';
  // list($code_verifier, $code_challenge) = generate_pkce_codes();
    // var_dump($code_verifier);
    // var_dump($code_challenge);
  $code_verifier = 'pGiPZDGAk53p1uIonXdmbBbyKf29dfPFpzE3MgVLLOI';
  $code_challenge = 'KdDTfcyC858eQXq65--7zkmROCfb42ieSaVGXRX910k';
    $_SESSION['code_verifier'] = $code_verifier;
?>
<script>
  // This is called with the results from from FB.getLoginStatus().
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
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '237778183823450',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.0' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      // statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {

    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', {fields: 'email,name,last_name,birthday'}, function(response) {
      var json = JSON.stringify(response);
      console.log('Successful login for: ' + response.name);
      // document.getElementById('status').innerHTML =
      //   'Thanks for logging in, ' + json + '!';

      var id = response.id;
      var name = response.name;
      var email = response.email;
      // var phone = response.phone;
      // alert(phone);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         var bien = this.responseText;
         // alert(bien);
         if (bien == 'ok') {
          alert('Login thành công.');
          window.location.href = "/thong-tin-tai-khoan";
         } else if (bien == 'has') {
          alert('Xin lỗi, Email đã tồn tại.');
         } else {
          alert('Login lỗi');
         }
        }
      };
      xhttp.open("GET", "/functions/ajax/login-fb.php?id="+id+"&name="+name+"&email="+email, true);
      xhttp.send();
      
        });
  }
</script>
<style>
.page-dang-nhap .facebook {
	width: 40px;
}
</style>
<div class="container page-dang-nhap">
	<div class="row">
		<div class="col-md-6">
			<img src="/images/z4735649762448_0a8b20cde11d28ce76a0460c310ff623.jpg" alt="banner" style="width: 100%;">
		</div>
		<div class="col-md-6">
			<div class="box">
				<p class="text-1">Đăng nhập</p>
				<p class="text-2">Chào mừng bạn đến với Chợ Nhà TỐT.</p>
				<form action="" method="post">
			  	  <div class="form-group">
				    <label for="email">Số điện thoại:</label>
				    <input type="number" class="form-control" name="phone" id="email" required="">
				  </div>
				  <div class="form-group">
				    <label for="pwd">Mật khẩu:</label>	
				    <input type="password" class="form-control" name="password" id="pwd" required="">
				  </div>
				  
				  <button type="submit" name="dang_nhap" class="btn btn-default">Đăng nhập</button>
				</form>
				<div>
					<img src="/images/fb_icon.png" class="facebook">
					<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
          </fb:login-button>
          <a href="/login-go.html"><img src="/images/google.png" class="facebook"></a>
          <a target="_blank" href="https://oauth.zaloapp.com/v4/permission?app_id=343923244309538428&redirect_uri=https://chonhatot.com/login-zalo&code_challenge=<?= $code_challenge ?>&state=<?= $state ?>" title="">login zalo</a>
				</div>
				<a href="/dang-ky" class="text-3" title="">Đăng ký ngay</a>
			</div>
		</div>
	</div>
</div>