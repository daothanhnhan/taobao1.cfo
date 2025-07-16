<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div id="demo">
	hello
</div>
<script>
function checkForWindowResize() {
    // console.log(`Screen width: ${window.innerWidth}`);

    if (window.innerWidth < 800) {
       // doSomethingForSmallScreens();
       document.getElementById('demo').innerHTML = 'nhỏ';
    }
    else {
    //    doSomethingForLargeScreens();
    	document.getElementById('demo').innerHTML = 'lớn';
    }
    document.getElementById('demo').innerHTML = window.innerWidth;
//     document.getElementById('demo').innerHTML = 'tuan';
}

window.addEventListener('resize', checkForWindowResize);
</script>
</body>
</html>