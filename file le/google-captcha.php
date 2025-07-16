<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
<?php
    require_once 'recaptchalib.php';
    $reCaptcha = new ReCaptcha(RECAPTCHA_SECRECT_KEY);
    $response = null;
    
    if ($_POST['g-recaptcha-response']) {
        $response = $reCaptcha->verifyResponse(
          $_SERVER['REMOTE_ADDR'],
          $_POST['g-recaptcha-response']
      );
      
      if ($response != null && $response->success) {
          echo 'handle a successful';
      } else {
          echo $response->error;
      }
    }
?>
	<form action="?" method="POST">
          <div class="g-recaptcha" data-sitekey="your_site_key"></div>
          <br/>
          <input type="submit" value="Submit">
    </form>
</body>
</html>