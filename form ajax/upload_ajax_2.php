<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Ajax File Upload with jQuery and PHP - Nestify</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <script src="js/script.js"></script> -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-8">
<h1><a href="#" target="_blank"><img src="logo.png" width="80px"/>Ajax File Uploading with Database MySql</a></h1>
<hr>
<form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="name">NAME</label>
<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" >
</div>
<div class="form-group">
<label for="email">EMAIL</label>
<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" >
</div>
<input id="uploadImage" type="file" accept="image/*" name="image">
<div id="preview"><img src="filed.png"></div><br>
<input class="btn btn-success" type="submit" value="Upload">
</form>
<div id="err"></div>
<hr>
<p><a href="https://www.nestify.io" target="_blank"><b>www.nestify.io</b></a></p>
</div>
</div>
</div>
<script>
// Create a jQuery event listener for the submit event of the form
$("#form").on('submit', function(e) {
  e.preventDefault();

  // Submit the form data to the server using jQuery AJAX
  $.ajax({
    url: "ajaxupload.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function() {
      // $("#err").fadeOut();
    },
    success: function(data) {
      // if (data == 'invalid') {
      //   $("#err").html("Invalid File!").fadeIn();
      // } else {
      //   $("#preview").html(data).fadeIn();
      //   $("#form")[0].reset(); 
      // }
      alert(data);
    },
    error: function(e) {
      // $("#err").html(e).fadeIn();
    }          
  });
});
</script>
</body>
</html>