<?php 
	$list_phone = $action->getList('list_phone', '', '', 'id', 'desc', '', '', '');
?>
<a href="javascript:void(0)" class="suntory-alo-phone suntory-alo-green" id="suntory-alo-phoneIcon" style="right: 0px; bottom: 100px;" datasqstyle="{&quot;top&quot;:null}" datasquuid="4c643075-c7e6-4adf-8841-746771cfb831" datasqtop="640" onclick="show_box_mobile()">
  <div class="suntory-alo-ph-circle"></div>
  <div class="suntory-alo-ph-circle-fill"></div>
  <div class="suntory-alo-ph-img-circle"><i class="fa fa-phone" style="float: none;"></i></div>
</a>

<!-- CSS Call -->

<style type="text/css">
.suntory-alo-phone {
  background-color: transparent;
  cursor: pointer;
  height: 120px;
  position: fixed;
  transition: visibility 0.5s ease 0s;
	-webkit-transition: visibility 0.5s ease 0s;
	-moz-transition: visibility 0.5s ease 0s;
  width: 120px;
  z-index: 20000000 !important;
}
.suntory-alo-ph-circle {
  animation: 1.2s ease-in-out 0s normal none infinite running suntory-alo-circle-anim;
  background-color: transparent;
  border: 2px solid rgba(30, 30, 30, 0.4);
  border-radius: 100%;
  height: 100px;
  left: 0px;
  opacity: 0.1;
  position: absolute;
  top: 0px;
  transform-origin: 50% 50% 0;
  transition: all 0.5s ease 0s;
  width: 100px;
}
.suntory-alo-ph-circle-fill {
  animation: 2.3s ease-in-out 0s normal none infinite running suntory-alo-circle-fill-anim;
  border: 2px solid transparent;
  border-radius: 100%;
  height: 70px;
  left: 15px;
  position: absolute;
  top: 15px;
  transform-origin: 50% 50% 0;
  transition: all 0.5s ease 0s;
  width: 70px;
}
.suntory-alo-ph-img-circle {
  border: 2px solid transparent;
  border-radius: 100%;
  height: 50px;
  left: 25px;
  opacity: 0.7;
  position: absolute;
  top: 25px;
  transform-origin: 50% 50% 0;
  width: 50px;
  text-align: center;
}
.suntory-alo-phone.suntory-alo-hover, .suntory-alo-phone:hover {
  opacity: 1;
}
.suntory-alo-phone.suntory-alo-active .suntory-alo-ph-circle {
  animation: 1.1s ease-in-out 0s normal none infinite running suntory-alo-circle-anim !important;
}
.suntory-alo-phone.suntory-alo-static .suntory-alo-ph-circle {
  animation: 2.2s ease-in-out 0s normal none infinite running suntory-alo-circle-anim !important;
}
.suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-circle, .suntory-alo-phone:hover .suntory-alo-ph-circle {
  border-color: #00aff2;
  opacity: 0.5;
}
.suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-circle, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-circle {
  border-color: #EB278D;
  opacity: 1;
}
.suntory-alo-phone.suntory-alo-green .suntory-alo-ph-circle {
  border-color: #bfebfc;
  opacity: 1;
}
.suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-circle-fill, .suntory-alo-phone:hover .suntory-alo-ph-circle-fill {
  background-color: rgba(0, 175, 242, 0.9);
}
.suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-circle-fill, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-circle-fill {
  background-color: #EB278D;
}
.suntory-alo-phone.suntory-alo-green .suntory-alo-ph-circle-fill {
  background-color: rgba(0, 175, 242, 0.9);
}
.suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-img-circle, .suntory-alo-phone:hover .suntory-alo-ph-img-circle {
  background-color: #00aff2;
}
.suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-img-circle, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-img-circle {
  background-color: #EB278D;
}
.suntory-alo-phone.suntory-alo-green .suntory-alo-ph-img-circle {
  background-color: #00aff2;
}
@keyframes suntory-alo-circle-anim {
  0% {
    opacity: 0.1;
    transform: rotate(0deg) scale(0.5) skew(1deg);
  }
  30% {
    opacity: 0.5;
    transform: rotate(0deg) scale(0.7) skew(1deg);
  }
  100% {
    opacity: 0.6;
    transform: rotate(0deg) scale(1) skew(1deg);
  }
}
@keyframes suntory-alo-circle-img-anim {
  0% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }
  10% {
    transform: rotate(-25deg) scale(1) skew(1deg);
  }
  20% {
    transform: rotate(25deg) scale(1) skew(1deg);
  }
  30% {
    transform: rotate(-25deg) scale(1) skew(1deg);
  }
  40% {
    transform: rotate(25deg) scale(1) skew(1deg);
  }
  50% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }
  100% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }
}
@keyframes suntory-alo-circle-fill-anim {
  0% {
    opacity: 0.2;
    transform: rotate(0deg) scale(0.7) skew(1deg);
  }
  50% {
    opacity: 0.2;
    transform: rotate(0deg) scale(1) skew(1deg);
  }
  100% {
    opacity: 0.2;
    transform: rotate(0deg) scale(0.7) skew(1deg);
  }
}
.suntory-alo-ph-img-circle i {
  animation: 1s ease-in-out 0s normal none infinite running suntory-alo-circle-img-anim;
  font-size: 30px;
  line-height: 50px;
  color: #fff;
}
@keyframes suntory-alo-ring-ring {
  0% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }
  10% {
    transform: rotate(-25deg) scale(1) skew(1deg);
  }
  20% {
    transform: rotate(25deg) scale(1) skew(1deg);
  }
  30% {
    transform: rotate(-25deg) scale(1) skew(1deg);
  }
  40% {
    transform: rotate(25deg) scale(1) skew(1deg);
  }
  50% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }
  100% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }

</style>


<div class="box-mobile" id="box-mobile-id" style="display: none;">
	<?php foreach ($list_phone as $item) { ?>
	<div class="item-mobile">
		<a href="tel:<?= preg_replace( '/[^0-9]/', '', $item['phone']) ?>" title="">
			<img src="/images/icons/item-phone.png" alt=""> <span><?= $item['name'] ?></span> <span><?= $item['phone'] ?></span>
		</a>
	</div>
  <div class="item-mobile" style="text-align: right;">
    <img src="/images/icons/skype.png" alt="" height="50">
    <img src="/images/zaloo.png" alt="" height="50">
    <img src="/images/mesd.png" alt="" height="50">
  </div>
	<?php } ?>
</div>

<style>
.box-mobile {
	position: fixed;
	right: 10px;
	bottom: 230px;
	z-index: 999999;
	background: #fff;
	padding: 5px;
	border: 1px solid #ccc;
	border-radius: 10px;
	box-shadow: 0px 00px 10px #888888;
	/*display: none;*/
}
.item-mobile a {
	background: #243a76;
	color: #fff;
	padding: 5px;
	display: flex;
  	align-items: center;
  	margin: 3px 0;
  	border-radius: 5px;
}
.item-mobile a span {
	margin: 5px;
}
.item-mobile a img {
	height: 50px;
	margin-right: 10px;
}
#box-mobile-id {
	/*display: none;*/
}
</style>

<script>
	function show_box_mobile () {
		var box = document.getElementById("box-mobile-id").style.display;
		// alert(box);
		if (box == 'none') {
			document.getElementById("box-mobile-id").style.display = 'block';
		} else {
			document.getElementById("box-mobile-id").style.display = 'none';
		}
	}
</script>