<?php 
	// var_dump($_SESSION['step_1']);
	$nation = $action->getList('nation', '', '', 'name', 'asc', '', '', '');

    $old_date = $_SESSION['step_1']['date'];
    $next_due_date = date('Y-m-d', strtotime($old_date. ' +29 days'));
    // echo $next_due_date;
    $airport = $action->getDetail('airport_name', 'id', $_SESSION['step_1']['airport_name'])['name'];
?>
<style>
.tab-step {
    margin-left: auto;
    margin-right: auto;
    width: 70%;
    /*border-bottom: 3px #df1f26 solid;*/
}
.tab-booking {
    float: left;
    width: 100%!important;
}
.tab-booking li {
    width: 33%;
    padding: 0px;
    height: 100px;
    font-size: 19px!important;
    text-align: center;
    padding-top: 35px!important;
    background: white;
    margin: 0px;
    font-family: 'Source Sans Pro', sans-serif!important;
    font-weight: 100;
    color: #a1a1a1;
}
.tab-booking li.active {
    /* background-color: #065689; */
    color: white;
    height: 115px;
    font-weight: bold;
}
.numberTitle {
    display: block;
}
.tab-booking li span.numberTitle {
    width: 30px;
    border-radius: 35px;
    margin-left: auto;
    border: 1px solid #cfcfcf;
    margin-right: auto;
}
.tab-booking li.active span.numberTitle {
    background-color: #055788;
    width: 30px;
    border-radius: 35px;
    margin-left: auto;
    margin-right: auto;
    border: 1px solid #055788;
}
.tab-booking li.active span.stepTitle {
    color: #065b91;
}
#icon-play-left {
    position: absolute;
    border-top: 2px dotted #839199;
    width: 26%;
    left: 20%;
    margin-top: 48px;
}
#span-icon-left {
    position: absolute;
    left: 50%;
    top: -9px;
    color: red;
    background-color: #fff;
}
#icon-play-right {
    position: absolute;
    border-top: 2px dotted #839199;
    width: 26%;
    left: 53%;
    margin-top: 48px;
}
#span-icon-right {
    position: absolute;
    left: 50%;
    top: -9px;
    color: red;
    background-color: #fff;
}

.page-step-2 {
	background-color: #f2f6f9;
    padding-bottom: 40px;
    padding-top: 30px;
    clear: both;
}
.page-step-2 .title {
	color: #065689;
	font-weight: bold;
	margin-bottom: 20px;
}
.page-step-2 .photo-left img {
	width: 200px;
}
.page-step-2 .photo-right img {
	width: 80%;
}

.page-step-2 .next {
    border: 0;
    background: #e86d71;
    border-radius: 30px;
    padding: 10px 20px;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
}
.page-step-2 .step-1 {
	padding: 10px 20px;
	border-radius: 30px;
	border: 1px solid black;
	color: #000;
	display: inline-block;
	font-size: 20px;
	font-weight: bold;
}
.page-step-2 .upload-file {
	margin: auto;
}

.page-step-2 .box-info {
    border: 1px solid #b6c7cf;
    border-radius: 15px;
    background: #fff;
    padding: 20px;
    font-size: 15px;
}
.page-step-2 .box-info .left {
    font-weight: bold;
}
.page-step-2 .box-info .right {
    color: #055788;
}
.page-step-2 .box-info .main {
    font-weight: bold;
    color: #055788;
    font-size: 18px;
}
.page-step-2 .box-info .box-sub {
    margin-bottom: 10px;
}
</style>
<script src="https://rawgit.com/andrewng330/PreviewImage/master/preview.image.min.js"></script>
<div class="tab-step hidden-xs" style="position: relative;">
        <h1 class="text-center" style="font-size: 24px;color: #333333;margin: 48px 0; font-weight: bold;">Vietnam Visa Online Application</h1>
        <ul class="tab-booking">
            <!--26120220 - Edited by Hieudzai - 3/8/2018-->
            <li class="active col-lg-4">
                <span class="numberTitle">1</span>
                <span class="stepTitle">Visa Options</span>
            </li>
            <li class="active col-lg-4">
                <span class="numberTitle">2</span>
                <span class="stepTitle">Applicant Detail</span>
            </li>
            <li class="col-lg-4"><span class="numberTitle">3</span>
                <span class="stepTitle">Review &amp; Finalize</span>
            </li>
            <!--26120220 - End edit-->
            <div id="icon-play-left" style=""><span id="span-icon-left" style="" class="glyphicon glyphicon-play"></span></div>
            <div id="icon-play-right" style=""><span id="span-icon-right" style="" class="glyphicon glyphicon-play"></span></div>
        </ul>
    </div>
<?php for ($i=1; $i<=$_SESSION['step_1']['number_applicant']; $i++) { ?>
<div class="page-step-2">
	<div class="container">
		<p class="title">APPLICANT <?= $i ?> INFORMATION</p>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
				    <label for="email">Passport Number<span style="color: red;">*</span></label>
				    <input type="text" class="form-control" id="email" name="passport_number[]" form="form-step-2" required="" placeholder="Exactly as per passport">
				  </div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
				    <label for="email">Nationality<span style="color: red;">*</span></label>
				    
				    <select name="nation[]" class="field_nationality free_nationality form-control selectpicker" form="form-step-2" data-live-search="true" tabindex="-98" required="">

                        <option value="">Select country</option>
                        <?php foreach ($nation as $item) { ?>
                        <option value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>
				  </div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
				    <label for="email">Applicant's Fullname <span style="color: red;">*</span></label>
				    <input type="text" class="form-control" name="name[]" id="email" form="form-step-2" placeholder="Exactly as per passport" required="">
				  </div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
				    <label for="email">Date of birth<span style="color: red;">*</span></label>
				    <input type="date" class="form-control" id="email" name="birthday[]" form="form-step-2" required="">
				  </div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
				    <label for="email">Passport expiry date<span style="color: red;">*</span></label>
				    <input type="date" class="form-control" id="email" name="expiry_date[]" form="form-step-2" required="">
				  </div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
				    <label for="email">Religion<span style="color: red;">*</span></label>
				    <select name="religion[]" class="field_religion free_religion form-control selectpicker col-lg-12 col-md-12 col-sm-12 col-xs-12" data-live-search="true" tabindex="-98" required="" form="form-step-2">
                        <option value="">Select religion</option>
	                    <option value="christian-Christian" data-religion="christian-Christian">Christian</option>
	                    <option value="islamic-Islamic" data-religion="islamic-Islamic">Islamic</option>
	                    <option value="hinduism-Hinduism" data-religion="hinduism-Hinduism">Hinduism</option>
	                    <option value="buddhism-Buddhism" data-religion="buddhism-Buddhism">Buddhism</option>
	                    <option value="other-Other" data-religion="other-Other">Other</option>
	                </select>
				  </div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 photo-left">
				<p class="text-center">Portrait photography (.jpg, .jpeg, .png) <span style="color: red;">*</span></p>
				<div class="text-center">
					<img src="https://booking.vietnam-visa.com/public/images/avatar_daidien.jpg" alt="portrait" id="photo_portrait_<?= $i ?>">
						<input type="file" name="portrait[]" class="upload-file" id="portrait_<?= $i ?>" accept=".png, .jpg, .jpeg" required="" form="form-step-2">
				</div>
			</div>
			<div class="col-md-6 photo-right">
				<p class="text-center">Portrait photography (.jpg, .jpeg, .png) <span style="color: red;">*</span></p>
				<div class="text-center">
					<img src="https://booking.vietnam-visa.com/public/images/avatar_hochieu.jpg" alt="passport" id="photo_passport_<?= $i ?>">
						<input type="file" name="passport[]" class="upload-file" id="passport_<?= $i ?>" accept=".png, .jpg, .jpeg" required="" form="form-step-2">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<br>
				    <label for="email">Your tentative address in Vietnam</label>
				    <input type="text" class="form-control" id="email" name="address[]" form="form-step-2">
				  </div>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<div class="page-step-2">
    <div class="container">
        <div class="box-info">
            <div class="row">
                <div class="col-md-6 text-left">REVIEW YOUR ORDER</div>
                <div class="col-md-6 text-right">Current total fees: $<?= $_SESSION['step_1']['number_applicant']*50 ?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="row box-sub">
                        <div class="col-xs-6 left">Number of applicants:</div>
                        <div class="col-xs-6 right"><?= $_SESSION['step_1']['number_applicant'] ?> applicants</div>
                    </div>
                    <div class="row box-sub">
                        <div class="col-xs-6 left">Type of visa:</div>
                        <div class="col-xs-6 right">1 month single entry</div>
                    </div>
                    <div class="row box-sub">
                        <div class="col-xs-6 left">Purpose of visa:</div>
                        <div class="col-xs-6 right"><?= $_SESSION['step_1']['type_visa']==1 ? 'Tourist (E-visa)' : 'Business' ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row box-sub">
                        <div class="col-xs-5 left">Arrival date:</div>
                        <div class="col-xs-7 right"><?= date('M-d-Y', strtotime($_SESSION['step_1']['date'])) ?></div>
                    </div>
                    <div class="row box-sub">
                        <div class="col-xs-5 left">Exit date:</div>
                        <div class="col-xs-7 right"><?= date('M-d-Y', strtotime($next_due_date)) ?></div>
                    </div>
                    <div class="row box-sub">
                        <div class="col-xs-5 left">Arrival airport:</div>
                        <div class="col-xs-7 right"><?= $airport ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row box-sub">
                        <div class="col-xs-5 left">Visa service fee:</div>
                        <div class="col-xs-7 text-right main">$45 x <?= $_SESSION['step_1']['number_applicant'] ?> persons = $<?= $_SESSION['step_1']['number_applicant']*45 ?></div>
                    </div>
                    <div class="row box-sub">
                        <div class="col-xs-5 left">Processing time:</div>
                        <div class="col-xs-7 right">Normal (guaranteed 3-5 working days)</div>
                        <div class="col-xs-12 text-right main">
                            $5 x <?= $_SESSION['step_1']['number_applicant'] ?> persons = $<?= $_SESSION['step_1']['number_applicant']*5 ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="" id="form-step-2" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<button type="submit" id="select" class="hidden">Select</button>
</form>

<div class="container page-step-2" style="background-color: #fff;">
    <div class="row">
        
        <div class="col-md-6">
            <div class="img_All_Visa" style="padding-left: 15px;">
                <img src="https://booking.vietnam-visa.com/public/images/anhvisa/Master-card.png" alt="">
                <img src="https://booking.vietnam-visa.com/public/images/anhvisa/PayPal.png" alt="">
                <img src="https://booking.vietnam-visa.com/public/images/anhvisa/Visa.png" alt="">
                <img src="https://booking.vietnam-visa.com/public/images/anhvisa/JCB.png" alt="">
                <img src="https://booking.vietnam-visa.com/public/images/anhvisa/UnionPay.png" alt="">
                <img src="https://booking.vietnam-visa.com/public/images/anhvisa/American.png" alt="">
                <img src="https://booking.vietnam-visa.com/public/images/anhvisa/Discover.png" alt="">
            </div>
        </div>
        <div class="col-md-3">
            <a href="/step-1" class="step-1"><i class="fa fa-chevron-left"></i> Previous step</a>
        </div>
        <div class="col-md-3">
            <button class="next" type="button" onclick="next2()">Next step <i class="fa fa-chevron-right"></i></button>
        </div>

    </div>
</div>

<script>
	function next2 () {
		document.getElementById("select").click();
	}
</script>
<script type="text/javascript">
    $("#form-step-2").submit(function (e) {

        e.preventDefault();

        var form = $(this);

        var formData = new FormData(this);

        var url = "/functions/ajax/form-step-2.php";

        // $("#cafe-loading").show();
// alert('step-2');
        $.ajax({

            type: "POST",

            url: url,

            data: formData, // serializes the form's elements.

            success: function (data)

            {

                //alert(data); // show response from the php script.

                window.location.href = "/step-3";

            },

            complete: function () {

                // $("#cafe-loading").hide();

            },
	        cache: false,
	        contentType: false,
	        processData: false

        });

    });
</script>
<script>
<?php for ($i=1; $i<=$_SESSION['step_1']['number_applicant']; $i++) { ?>
portrait_<?= $i ?>.onchange = evt => {
  const [file] = portrait_<?= $i ?>.files
  if (file) {
    photo_portrait_<?= $i ?>.src = URL.createObjectURL(file)
  }
}

passport_<?= $i ?>.onchange = evt => {
  const [file] = passport_<?= $i ?>.files
  if (file) {
    photo_passport_<?= $i ?>.src = URL.createObjectURL(file)
  }
}
<?php } ?>
</script>