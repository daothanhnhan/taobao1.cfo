<?php 
	include_once dirname(__FILE__) . "/database.php";
	include_once dirname(__FILE__) . "/library.php";
	include_once dirname(__FILE__) . "/action.php";

	$action = new action();

	$link = $action->getList('admin_link', '', '', 'id', 'desc', '', '', '');
  $link_count = count($link);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<table class="table">
    <thead>
      <tr>
        <th>Số thứ tự</th>
        <th>Link</th>
        
        <!-- <th>Email</th> -->
      </tr>
    </thead>
    <tbody>
      <?php 
      // $d = $link_count + 1;
      $d = 0;
      foreach ($link as $item) { 
      	$d++;
      ?>
      <tr>
        <td><?= $d ?></td>
        <td><a href="<?= $item['link'] ?>" target="_bank"><?= $item['link'] ?></a></td>
        
        <!-- <td>mary@example.com</td> -->
      </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>