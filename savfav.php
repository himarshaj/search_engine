<!DOCTYPE html>
<html>

<head>
  <title>Poodle</title>
    <table align="right"><br>
   <tr><td align="right"><form action="search.php" method="get" >
	<input type="text" size="40" name="keyword" ><input type="submit" name="sub" value="Explore" />
	</form>
    </td></tr></table>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <?php include "master.php"; ?>
</head>
<body>

<?php

session_start();
$doc_id = $_REQUEST["id1"];
$item = $_REQUEST["id2"];

$_SESSION["var"] = $doc_id ;

#echo $_SESSION["var"]; 
$servername="localhost";
$username="admin";
$pass="monarchs";
$db="userlog";

$conn=mysqli_connect($servername,$username,$pass,$db);

if($conn->connect_error){
	die("Connection failed:".$conn->connect_error);
  }
  
#else echo"Successfully connected to the database!<br>";  

if(empty($doc_id))
	echo "Failure to fetch doc id!<br>";  
    
else 
	{
	$uId = $_SESSION['uId'];
	$sql="SELECT * FROM favourites WHERE uname = '{$uId}' AND doc_id = '{$doc_id}' ";
	$result = $conn->query($sql);
	$rows = @ mysqli_num_rows($result);
	if ($rows>0) 
		{
		$row = mysqli_fetch_array($result);	
		$row_id = $row["id"];
		#$update=  "UPDATE favourites SET savetime = now(), doc_id = '{$doc_id}' WHERE id={$row_id}";		
		$update=  "UPDATE favourites SET savetime = now(), doc_id = '{$doc_id}' , item = '{$item}'  WHERE id={$row_id}";
		$result = $conn-> query($update);
		echo "Updated";
		echo "<a href='http://localhost/Poodle.com/collections.php'><br>Go to Collections <a/>";
		}
	else
		{
		#$add = "INSERT INTO favourites (uname, doc_id, item, savetime) VALUES ( '{$uId}' , '{$doc_id}' , 'null' , now() )";
		$add = "INSERT INTO favourites (uname, doc_id,item, savetime) VALUES ( '{$uId}' , '{$doc_id}' ,' {$item}' ,   now() )";
		$result = $conn-> query($add);
		echo "Saved";
		echo "<a href='http://localhost/Poodle.com/collections.php'><br>Go to Collections <a/>";		
		}
	}


?>

</body>
</html>