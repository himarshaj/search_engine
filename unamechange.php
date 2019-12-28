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

<form action="updateuname.php" method="post">
<table cellpadding="6" border="0" align="center">
<br><br><br><br><br><br>
<tr><th>New Username:</th><td><input type="text" name="nwuname"/></td></tr>
<tr><td></td><td><input type="submit" value="Change Username" /></td></tr>
		 
	</table>
	</form>
</div>

</body>

</html> 
