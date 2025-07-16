<?php 
    if (isset($_POST['upload'])) {
        echo '<pre>';
        var_dump($_FILES);
        var_dump($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-language" content="en"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description"
          content="Image-Uploader is a simple jQuery Drag & Drop Image Uploader plugin made to be used in forms, withot AJAX."/>
    <meta name="keywords" content="image, upload, uploader, image-uploader, jquery, gallery, file, form, static"/>
    <meta name="author" content="Christian Bayer"/>
    <meta name="copyright" content="© 2019 - Christian Bayer"/>
    <meta property="og:url" content="https://christianbayer.github.io/image-uploader/"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Image-Uploader"/>
    <meta property="og:description"
          content="Image-Uploader is a simple jQuery Drag & Drop Image Uploader plugin made to be used in forms, withot AJAX."/>
    <meta property="og:image" content="https://github.githubassets.com/images/modules/logos_page/GitHub-Logo.png"/>

    <title>Image-Uploader</title>

    <link rel="stylesheet" href="dist/image-uploader.min.css">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap"
          rel="stylesheet">

    
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

            <button type="submit" name="upload">Submit and display data</button>

        </form>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="dist/image-uploader.min.js"></script>
<script>
    $(function () {
// $('.input-images-1').imageUploader();

    let preloaded = [
            {id: 'tuan', src: 'https://i.picsum.photos/id/433/500/500.jpg?hmac=g321d-nJorfMO78k2_lhSlyo9XzOjTlGvu8wt5mvn8M'},
            {id: '500.jpg', src: 'https://i.picsum.photos/id/433/500/500.jpg?hmac=g321d-nJorfMO78k2_lhSlyo9XzOjTlGvu8wt5mvn8M'},
           
        ];

        $('.input-images-1').imageUploader({
            preloaded: preloaded,
            imagesInputName: 'photos',
            preloadedInputName: 'old'
        });
});

</script>
</body>