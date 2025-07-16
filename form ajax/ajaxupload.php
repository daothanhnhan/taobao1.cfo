<?php



var_dump($_FILES);
die();
$validExtensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt'); // valid extensions

$path = 'uploads/'; // upload directory

if (isset($_POST['name']) || isset($_POST['email']) || isset($_POST['image'])) {

  $img = $_POST['image']['name'];

  $tmp = $_FILES['image']['tmp_name'];

  // Get the uploaded file's extension

  $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

  // Generate a unique file name using the rand() function

  $final_image = rand(1000, 1000000) . $img;

  // Check if the file format is valid

  if (in_array($ext, $validExtensions)) { 

    $path = $path . strtolower($final_image); 

    if (move_uploaded_file($tmp, $path)) {

      echo "<img src='$path' />";

      $name = $_POST['name'];

      $email = $_POST['email'];

      // Include the database configuration file

      include_once 'db.php';

      // Insert form data into the database

      $insert = $db->query("INSERT INTO uploading (name, email, file_name) VALUES ('".$name."', '".$email."', '".$path."')");

    } 

  } else {

    echo 'invalid';

  }

}

?>