<!DOCTYPE html>
<html>

<head>
  <title>Poodle</title>
  
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   
	<?php include "master.php"; ?>
   </head>
<body>

<?php 
if(isset($_GET['error']))
echo "<p id='error'>".$_GET['error']."</p>";
?>

<table align="center">
<br><br><br>
	<tr><form action="additem.php" method="post" ></tr>
    <tr><td>Breed: </td><td><input type="text" size="40" name="BreedName" ></td></tr>
	<tr><td>Main Group: </td><td><input type="text" placeholder="Working/Sporting/Herding/Terrier/Hound" size="40" name="Group" ></td></tr>	
	<tr><td>Other Groups: </td><td><input type="text" size="40" name="Group1" ></td></tr>
	<tr><td>Temperament: </td><td><input type="text" placeholder="Affectionate/Alert/Active/Friendly/Adaptable" size="40" name="Temperment" ></td></tr>
	<tr><td>Intelligence: </td><td><input type="text" placeholder="High/Medium/Low" size="40" name="Intelligence" ></td></tr>
	<tr><td>Popularity: </td><td><input type="text" placeholder="High/Medium/Low" size="40" name="Popularity" ></td></tr>
	<tr><td>Weight: </td><td><input type="text" placeholder="Kg" size="40" name="Weight" ></td></tr>
	<tr><td>Price: </td><td><input type="text" placeholder="High/Medium/Low" size="40" name="Price" ></td></tr>
	<tr><td></td><td><input type="submit" value="Add new item"></td></tr>
	<tr></form></tr>
	


</table>

</body>
</html>

