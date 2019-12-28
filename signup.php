<html>
<head>
  <title>Poodle</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "master.php"; ?>	
	<script src='https://www.google.com/recaptcha/api.js' async defer></script>
   </head>

<body>
<p id="error">* Required fields</p>

 <?php 
if(isset($_GET['error']))
echo "<p id='error'>".$_GET['error']."</p>";
?>

<div id="main">
	<table border="0" cellpadding="6" align="center">
	<form action="signup_process.php" enctype="multipart/form-data" method="post">
		
		<tr><td>Name:</td><td><input type="text" name="name" size="60"/><span id="error">*</span></td></tr>  
		<tr><td></td></tr>	
		<tr><td>Email:</td><td><input type="text" name="email" size="60" /><span id="error">*</span></td></tr>
		<tr><td></td></tr>
		<tr><td>Mobile:</td><td><input type="number" name="phone" placeholder="+1 xxxxxxxxxx" /><span id="error">*</span></td></tr>
		<tr><td></td></tr>
		<tr><td>Username:</td><td><input name="username" type="text" size="45" /><span id="error">*</span></td></tr> 
		<tr><td></td></tr>
		<tr><td>Password:</td><td><input name="password" type="password" size="45" /><span id="error">*</span></td></tr> 
		<tr><td></td></tr>
		<tr><td>Re-Type Password:</td><td><input name="repassword" type="password" size="45" /><span id="error">*</span></td></tr> 
		<tr><td></td><td><input name="reg" type="submit" value="Sign up" />  <input type="reset" value="Start again"/></td></tr>
		<tr><td></td><td>Already a member ?<a href="login.php"> Sign in here </a> </tr>
		<tr><td></td><td><div class="g-recaptcha" data-sitekey="6LeNucEUAAAAAD-AUGZdmaEpdCDdOUuMnCDWNrww"></div></td></tr>
	</form>
	</table>
	
	

</body>
<footer id="foot01"></footer>
</div>
</body>
<script>document.getElementById("foot01").innerHTML = "<p>&copy;  " + new Date().getFullYear() + " Poodle.com | All rights reserved.</p>";
</script>
