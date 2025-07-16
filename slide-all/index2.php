<!DOCTYPE html>
<html>
<head>
	<title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="./slick/slick.css" />
	<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/prism.css" />
  <style>
    @media (max-width: 768px) {
      .center .slick-center h3 {
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    -webkit-transform: scale(1);
    /* color: #e67e22; */
    opacity: 1;
    transform: scale(1);
}
    }

  </style>
</head>
<body>
  <section class="blue">
	<h2>Center Mode</h2>
			<div class="slider center">
				<div>
					<h3>1</h3>
				</div>
				<div>
					<h3>2</h3>
				</div>
				<div>
					<h3>3</h3>
				</div>
				<div>
					<h3>4</h3>
				</div>
				<div>
					<h3>5</h3>
				</div>
				<div>
					<h3>6</h3>
				</div>
			</div>
			<pre><code class="language-javascript">
$('.center').slick({
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 3,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});
				</code></pre>
			</section>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="./slick/slick.js"></script>
	<!-- <script type="text/javascript" src="js/scripts.js"></script> -->
	<!-- <script type="text/javascript" src="js/prism.js"></script> -->
	<!-- <script type="text/javascript">
		var disqus_shortname = 'slickcarousel';

		(function () {
			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		})();
	</script> -->
	<script>
				$('.center').slick({
  centerMode: true,
  centerPadding: '260px',
  slidesToShow: 1,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '240px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});
			</script>
</body>
</html>