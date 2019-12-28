<html>
<head>
	 <font face="AR CHRISTY" color="black" size="150">Poodle.com</font> 
     <link href="style.css" rel="stylesheet">
</head>

<body>

<div id="heading"></div>
<nav id="nav01"></nav>
<div id="main">


<?php


$email = $_GET["email"];
$reset_token = $_GET["reset_token"];

$servername="localhost";
$username="admin";
$pass="monarchs"; //admin password
$db="userlog";

$connection =new mysqli($servername,$username,$pass,$db);

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0)
{
 $user = mysqli_fetch_object($result);
 if ($user->reset_token == $reset_token)
  {
    ?>
	<form action="updatepwdb.php" method="post">
	<table cellpadding="6" border="0" align="center">
		<br><br><br><br><br><br>
		<tr><th>New Password:</th><td><input type="password" name="nwpwd"/></td></tr>
		 <input type="hidden" name="email" value="<?php echo $email; ?>">
		<input type="hidden" name="reset_token" value="<?php echo $reset_token; ?>">
		<tr><td></td><td><input type="submit" value="Change Password" /></td></tr>
		 
	</table>
	</form>

	<?php 
  }
 else
  {
  echo "Recovery email has been expired";
  }
}
else
{
    echo "Email does not exists";
}


?> 

<br><br><br><br><br><br>
</body>
<footer id="foot01"></footer>
</div>
<script src="script.js"></script>
</html>