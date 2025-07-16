<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<style>
a {
	position: fixed;
	right: 10px;
	bottom: 10px;
	/*width: 120px;*/
	/*height: 120px;*/
}
.suntory-alo-ph-circle {
    border-color: #bfebfc;
    opacity: 1;
}
.suntory-alo-ph-circle {
    animation: 1.2s ease-in-out 0s normal none infinite running suntory-alo-circle-anim;
    background-color: transparent;
    border: 2px solid rgba(30, 30, 30, 0.4);
    border-radius: 100%;
    height: 100px;
    left: -23px;
    opacity: 0.1;
    position: absolute;
    top: -22px;
    transform-origin: 50% 50% 0;
    transition: all 0.5s ease 0s;
    width: 100px;
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
</style>

<a href="">
	<div class="suntory-alo-ph-circle"></div>
	<img src="https://metalhanoi.biz.vn/wp-content/uploads/2024/03/zalo-icon.png" width="60">
</a>

</body>
</html>