
<html>
<head>
  <title>Poodle</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "master.php"; ?>

<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 90%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 120;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 12px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
  
 
</style>
</head>

<body>

<div class="sidenav">
 
 <a href='collections.php'>My Collection</a><br>  
 <a href='unamechange.php'>Change My Username</a><br>
 <a href='pwdchange.php'>Change My Password </a><br> 
 <a href='mobilechange.php'>Update My Mobile Number</a><br>
</div>


<footer
</body>
<script>document.getElementById("foot01").innerHTML = "<p>&copy;  " + new Date().getFullYear() + " Poodle.com | All rights reserved.</p>";
</script>
</html>