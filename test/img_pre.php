<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> -->
    <!-- <script src="https://rawgit.com/andrewng330/PreviewImage/master/preview.image.min.js"></script> -->
    <!-- <script src="http://code.jquery.com/jquery.min.js"></script> -->


    <!-- <script type="text/javascript" src="https://chonhatot.com/admin/js/action_query_ajax.js"></script> -->
    <script type="text/javascript">


$(function(){


    $("#fileUpload").on('change', function() {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder");
        image_holder.empty();
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++){
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image"
                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                 }
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });

    
})


    </script>
</head>
<body>
<div id="wrapper">
                <input id="fileUpload" type="file" name="fileUpload1"/>
                <br />
                <div id="image-holder">
                    
                </div>
            </div> 
</body>
</html>