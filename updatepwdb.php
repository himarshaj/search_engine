<html>
 <head>
	 <font face="AR CHRISTY" color="black" size="150">Poodle.com</font> 
     <link href="style.css" rel="stylesheet">
</head>

<body>

<div id="heading"></div>
<nav id="nav01"></nav>
<div id="main">

<br><br><br><br><br><br>

<?php

$servername="localhost";
$username="admin";
$pass="monarchs"; //admin password
$db="userlog";

$connection =new mysqli($servername,$username,$pass,$db);

$email = $_POST["email"];
$reset_token = $_POST["reset_token"];
$new_password = $_POST["nwpwd"];
$hash = password_hash($new_password, PASSWORD_BCRYPT);

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0)
{
    $user = mysqli_fetch_object($result);
    if ($user->reset_token == $reset_token)
    {
		
    	$sql = "UPDATE users SET password='$hash' WHERE email='$email' AND reset_token='$reset_token'";
    	mysqli_query($connection, $sql);

    	echo "Password has been changed. <a href='http://localhost/Poodle.com/login.php'> Please login</a> ";
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