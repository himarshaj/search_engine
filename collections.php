<html>

<head>
  <title>Poodle</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php include "myprofile.php"; ?> 
   
<style>    
 .main 
 {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
 }
</style>
</head>

<body>
<div class="main">

</div>

</body>

<?php

session_start();

$doc_id = $_SESSION['var']; 
$servername="localhost";
$username="admin";
$pass="monarchs";
$db="userlog";

$conn=mysqli_connect($servername,$username,$pass,$db);

if($conn->connect_error){
	die("Connection failed:".$conn->connect_error);
  }
  
#else echo"Successfully connected to the database!<br>";  

$uId = $_SESSION['uId'];
$sql="SELECT * FROM favourites WHERE uname = '{$uId}'";
$result = $conn->query($sql);
$n = @ mysqli_num_rows($result);
if ($n>0) 
	{
	 echo " 
			<table align=\"center\" border=\"2\" ><br><br><br>
			<tr>
			<th>SN</th><th>Saved Time</th><th>Dog Breed</th><th>Edit</th>			
			</tr>
		  ";	
			for ($i=1; $i<= $n; $i++){
			$rows = @ mysqli_fetch_array($result);		
			$doc = $rows["doc_id"];
			$time = $rows["savetime"];
			$dog = $rows["item"]; 
			echo ' <tr>
			<td>'.$i.'</td>
			<td>'.$time.' </td>
			<td><a href="showfav.php?id='.$doc_id.'"> '.$dog.'</a></td> 
			<td><a href="removfav.php?id='.$doc_id.'">  Remove  </a></td> 
			</tr>
				
		  '; 
	      }
	      echo "</table>"; 
	}
else
	{
     echo "No saved items"	;
	}
?>	
</html>