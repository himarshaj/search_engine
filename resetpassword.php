<html>
<head>
  <title>Poodle</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "master.php"; ?>
   </head>
<body>


<form action="forget.php" method="post"> 
	<table cellpadding="6" border="0" align="center">
		<br><br><br><br><br><br>
		<tr><th>Email:</th><td><input type="text" name="mail" placeholder= "Enter the email address you used for signup" size="35"/></td></tr>
		<tr><td></td><td><input type="submit" value="Reset Password"/></td></tr>
	</table>
</form> 


<footer id="foot01"></footer>
</body>
<script>document.getElementById("foot01").innerHTML = "<p>&copy;  " + new Date().getFullYear() + " Poodle.com | All rights reserved.</p>";
</script>
</html>