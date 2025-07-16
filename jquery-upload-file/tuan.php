<?php 
	echo '<pre>';
	var_dump($_FILES);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link type="text/css" rel="stylesheet" href="dist/image-uploader.min.css">
</head>
<body>
	<form method="POST" name="form-example-1" id="form-example-1" enctype="multipart/form-data">

    <div class="input-field">
        <input type="text" name="name-1" id="name-1">
        <label for="name-1">Name</label>
    </div>

    <div class="input-field">
        <input type="text" name="description-1" id="description-1">
        <label for="description-1">Description</label>
    </div>

    <div class="input-field">
        <label class="active">Photos</label>
        <div class="input-images-1" style="padding-top: .5rem;"></div>
    </div>

    <button>Submit and display data</button>

</form>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="dist/image-uploader.min.js"></script>
<!-- <script src="http://taobao1.cafelink.org/jquery-upload-file/dist/image-uploader.min.js"></script> -->

<script>
$(function () {
	 $('.input-images-1').imageUploader({
        imagesInputName: 'photos',
        extensions: ['.jpg','.jpeg','.png','.gif','.svg'],
          mimes: ['image/jpeg','image/png','image/gif','image/svg+xml'],
          maxSize: undefined,
          maxFiles: 1,
    });
});
</script>
</body>
</html>