<html>
<head>
  <title>Poodle</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<?php include "myprofile.php"; ?>
<style>    
 .main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}
</style>

</head>

<body>


<?php


$servername="localhost";
$username="admin";
$pass="monarchs"; //admin password
$db="userlog";

$connection =new mysqli($servername,$username,$pass,$db);

?>



<form action="updatepwdb.php" method="post">
<table cellpadding="6" border="0" align="center">
<br><br><br><br><br><br>
<tr><th>New Password:</th><td><input type="password" name="nwpwd"/></td></tr>
<tr><td></td><td><input type="submit" value="Change Password" /></td></tr>
		 
	</table>
	</form>

<br><br><br><br><br><br>


<footer id="foot01"></footer>
</div>
</body>
<script>document.getElementById("foot01").innerHTML = "<p>&copy;  " + new Date().getFullYear() + " Poodle.com | All rights reserved.</p>";
</script>

</html>