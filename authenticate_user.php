<html>
<body>
<?php
include 'master.php';
$email=$_POST['email'];
$name=$_POST['uId'];
$passd=$_POST['pwd'];
$servername="localhost";
$username="admin";
$pass="monarchs";
$db="userlog";
$conn=new mysqli($servername,$username,$pass,$db);
if($conn->connect_error)
{
	die("Connection failed:".$connect_error."<br>");
}
else echo"Successfully connected to the database!<br>";

if(isset($_POST['g-recaptcha-response'])){
$captcha=$_POST['g-recaptcha-response'];}

if(!$captcha){
    header('Location:./login.php?error=Captcha Not Verified, Please Check');
    exit();
        }
$secretKey = "6LeNucEUAAAAAHUiE8ChOsEMDBJ7A96uspDHj5Jt";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        if($responseKeys["success"]) {	
		
$sql="SELECT password FROM users WHERE uname='$name'";
$result=$conn->query($sql);
$res="";
if($result->num_rows>0)
{
while($rows=$result->fetch_assoc())
  {
	  $res=$rows["password"];
  }
if(password_verify($passd, $res))
{
	echo "<br><br>You are logged in";
	session_start();
	$_SESSION['email']=$email;
	$_SESSION['pwd']=$pass;
	$_SESSION['uId']=$name;
	$SID= session_id();
	header('Location:./index.php');	
	exit();
}
else
{	
	header('Location:./login.php?error=wrong password');
    exit();
}
}
else 
{
	header('Location:./login.php?error=incorrect username<br>if you are new click <a href="signup.php">here</a>');
    exit();
}

		}
		
else {
                echo '<h2>You are robot !</h2>';
        }
				
$conn->close();
  ?>
</body>
</div>
</html>