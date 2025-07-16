<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<input type="file" accept="image/*" onchange="loadFile(event)">
<img id="output" width="200" />
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>

</body>
</html>