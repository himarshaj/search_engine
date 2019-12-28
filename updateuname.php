<?php 


session_start();

$servername="localhost";
$username="admin";
$pass="monarchs";
$db="userlog";

// connect to the database
$conn=mysqli_connect($servername,$username,$pass,$db);

if($conn->connect_error){
	die("Connection failed:".$conn->connect_error);
  }
  
$uId="";

$uId= mysqli_real_escape_string($conn, $_POST['nwuname']);

$sql="UPDATE users SET uname = '$uId'";
 

if($conn->query($sql)==TRUE)
 {
	
	 echo"You have successfully changed your username<br>";
	 header('Location:./myprofile.php');
 }
 
?>








