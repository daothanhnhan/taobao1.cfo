<div id="fb-root"></div>
<script type="text/javascript">
//<![CDATA[
window.fbAsyncInit = function() {
   FB.init({
     appId      : '237778183823450', // App ID
     channelURL : '', // Channel File, not required so leave empty
     status     : true, // check login status
     cookie     : true, // enable cookies to allow the server to access the session
     oauth      : true, // enable OAuth 2.0
     xfbml      : false  // parse XFBML
   });
};
// logs the user in the application and facebook
function login(){
FB.getLoginStatus(function(r){
     if(r.status === 'connected'){
            testAPI();
            // alert('connected');
            // window.location.href = 'fbconnect.php';
     }else{
        FB.login(function(response) {
                if(response.authResponse) {
              //if (response.perms)
              testAPI();
                    // window.location.href = 'fbconnect.php';
            } else {
              // user is not logged in
            }
     },{scope:'email'}); // which data to access from user profile
 }
});
}
// Load the SDK Asynchronously
(function() {
   var e = document.createElement('script'); e.async = true;
   e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
   document.getElementById('fb-root').appendChild(e);
}());
//]]>
</script>
<script>
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
      // alert(id);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         var bien = this.responseText;
         // alert(bien);
         if (bien == 'ok') {
          alert('Login thành công.');
          window.location.href = "/ma-otp";
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

<a href='#' onclick='login();'>Facebook Login</a>