<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		body {
  margin: 10px;
  font-size: 20px;
  font-family: Times, "Times New Roman", serif;
}

/* dd container */
.dropdown {
  display: inline-block;
  position: relative;
  outline: none;
  margin: 10px;
}

/* button */
.dropbtn {
  padding: 12px 16px;
  color: white;
  background-color: #861cb9;
  cursor: pointer;
  transition: 0.35s ease-out;
}

/* dd content */
.dropdown .dropdown-content {
  position: absolute;
  top: 50%;
  background-color: #f7f7f7;
  min-width: 120%;
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
  z-index: 100000;
  visibility: hidden;
  opacity: 0;
  transition: 0.35s ease-out;
}
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  display: block;
  text-decoration: none;
  transition: 0.35s ease-out;
}
.dropdown-content a:hover {
  background-color: #eaeaea;
}

/* show dd content */
.dropdown:focus .dropdown-content {
  outline: none;
  transform: translateY(20px);
  visibility: visible;
  opacity: 1;
}

.dropbtn:hover, .dropdown:focus .dropbtn {
  background-color: #691692;
}

/* mask to close menu by clicking on the button */
.dropdown .db2 {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  opacity: 0;
  cursor: pointer;
  z-index: 10;
  display: none;
}
.dropdown:focus .db2 {
  display: inline-block;
}
.dropdown .db2:focus .dropdown-content {
  outline: none;
  visibility: hidden;
  opacity: 0;
}
	</style>
</head>
<body>
<h3>Example 1. Dropdown menu. Pure CSS. Simple style.</h3>

<div class="dropdown" tabindex="1">
  <i class="db2" tabindex="1"></i>
  <a class="dropbtn"><i class="fa fa-address-book"></i> Dropdown 1</a>
   <div class="dropdown-content">
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="#">Contact</a>
   </div>
</div>

<div class="dropdown" tabindex="1">
  <i class="db2" tabindex="1"></i>
  <a class="dropbtn">Dropdown 2</a>
   <div class="dropdown-content">
      <a href="#">Blog</a>
      <a href="#">Plans</a>
      <a href="#">Partners</a>
   </div>
</div>
</body>
</html>