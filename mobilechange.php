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
<div class="main">

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
<tr><th>New Mobile Number:</th><td><input type="number" name="nwmob"/></td></tr>
<tr><td></td><td><input type="submit" value="Update Mobile Number" /></td></tr>
		 
	</table>
	</form>

<br><br><br><br><br><br>
</div>

</body>

</html> 
