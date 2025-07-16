<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
	function captcha () {
		if (isset($_POST['chay'])) {
			var_dump($_POST);
		}
	}
	captcha();
?>
<div class="row">
    <form class="col s12" method="post" action="" id="dmca-report-form" >
        <div class="row">
            <div class="input-field col s12">
                <input name="report_name" id="report_name" type="text" class="validate" value="tên">
                <label for="report_name">Your Name</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input name="report_email" id="report_email" type="email" class="validate" value="tuan@gmail.com">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input disabled value="" id="report_url" type="text" class="validate">
                <label for="report_url">Report URL</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea name="report_content" id="report_content" class="materialize-textarea">Note</textarea>
                <label for="report_content">Message</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <div id="g-recaptcha" data-callback="recaptchaCallback"></div>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="hidden" name="post_id" value="<?= $post->ID; ?>" />
                <input type="hidden" name="dmca_report_submit" value="1" />
                <button class="btn waves-effect waves-light disabled" id="submit-btn" type="submit" name="chay">
                    <i class="material-icons right">send</i>Send Request
                </button>
            </div>
        </div>
    </form>
</div>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>
<script>
// For captcha
var onloadCallback = function() {
    grecaptcha.render('g-recaptcha', {
        'sitekey' : '6LeyNOMnAAAAANoKRIIuoHEeO5a5nfX8SH3tKUxg'
    });
};
var recaptchaCallback = function () {
    let submit = document.getElementById('submit-btn')
    submit.classList.remove('disabled');
}
form = document.getElementById('dmca-report-form');
form.addEventListener('submit', function (e){
    if (grecaptcha && grecaptcha.getResponse().length !== 0) {
        this.submit();
    } else {
        alert('Please check captcha');
        e.preventDefault();
    }
    
})
</script>
<!-- key secrit -->
<!-- 6LeyNOMnAAAAAHPFZrhjXxSxBz0bYRCkgwNb5K4h -->
<!-- https://vinasupport.com/huong-dan-tich-hop-recaptcha-chong-spam-cua-google/ -->
<!-- https://www.google.com/u/0/recaptcha/admin/create -->
<!-- https://www.google.com/u/0/recaptcha/admin/ -->
</body>
</html>