<?php 
	if (isset($_POST['fname'])) {
	var_dump($_POST);
}
?>
<!DOCTYPE html>
<html>
<body>

<h1>The form attribute</h1>

<form action="" method="post" id="form1">
  <label for="fname">First name:</label>
  <input type="text" id="fname" name="fname"><br><br>
  <input type="submit" value="Submit">
</form>

<p>The "Last name" field below is outside the form element, but still part of the form.</p>

<label for="lname">Last name:</label>
<input type="text" id="lname" name="lname" form="form1">

</body>
</html>
