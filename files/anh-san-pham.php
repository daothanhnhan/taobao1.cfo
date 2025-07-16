
<!DOCTYPE html>
<html>
<head>
	<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="css/style.css">
    <!-- Image Popup JS -->
    <script src="js/jquery.image-popup.js"></script>
	<!-- Demo CSS -->
	<link rel="stylesheet" href="css/demo.css">
  <link rel="stylesheet" type="text/css" href="css/zoom.css">
<style>
.img {
    display: inline-block;
    width: 10%;
}
.img span {
    font-size: 30px;
    float: right;
    font-weight: bold;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include_once dirname(__FILE__) . "/../functions/database.php";
  include_once dirname(__FILE__) . "/../functions/library.php";
  include_once dirname(__FILE__) . "/../functions/action.php";

  $action = new action();
  $list_product = $action->getList('product', '', '', 'product_id', 'desc', '', '', '');
  $pro_arr = array();
  foreach ($list_product as $item) {
    $pro_arr[] = $item['product_img'];
  }
  // var_dump($pro_arr);
//////////////////
$filenameArray = [];
// echo dirname(realpath(__FILE__)).'/../images/';
$handle = opendir(dirname(realpath(__FILE__)).'/../images/');
        while($file = readdir($handle)){
          // echo $file;
            if($file !== '.' && $file !== '..'){
              if (!in_array($file, $pro_arr)) {

                array_push($filenameArray, "/images/$file");
              }
            }
        }

// echo json_encode($filenameArray);
// echo '<pre>';
// var_dump($filenameArray);
$limit = 200;
$star = 0;
$end = $limit;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  $star = $limit * ($page-1);
  $end = $limit * ($page);
} else {
  $page = 1;
}

for ($i=$star;$i<$end;$i++) {
    echo '<div class="img">';
    echo '<span>&times;</span>';
  // echo '<img src="'.$filenameArray[$i].'" style="width:100%" data-action="zoom" >';
	echo '<img src="/images/'.$pro_arr[$i].'" style="width:100%" data-action="zoom" >';
    echo '</div>';
}
?>
<ul class="pagination">
  <li><a href="index.php?page=1">1</a></li>
  <li><a href="index.php?page=2">2</a></li>
  <li><a href="index.php?page=3">3</a></li>
  <li><a href="index.php?page=4">4</a></li>
  <li><a href="index.php?page=5">5</a></li>
</ul>
<br>
<ul class="pagination">
  <li><a href="index.php?page=<?= $page-1 ?>">Pre</a></li>
  <li><a href="index.php?page=<?= $page+1 ?>">Next</a></li>
</ul>
<script>
$("span").click(function(){
  // alert("The paragraph was clicked.");
  $(this).css('display', 'none');
  var img = $( this ).next().attr('src');
  // alert(img);
  $.get("ajax.php?link="+img, function(data, status){
    // alert("Data: " + data + "\nStatus: " + status);
  });
});
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="js/zoom.js"></script>
</body>
</html>
