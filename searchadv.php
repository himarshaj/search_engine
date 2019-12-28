<!DOCTYPE html>
<html>

<head>
  <title>Poodle</title>
   <table align="right"><br>
   <tr><td align="right"><form action="search.php" method="get" >
	<input type="text" size="40" name="keyword" ><input type="submit" value="Explore" />
	</form>
   </td></tr></table>
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   
	<?php include "master.php";
	include "advanced_search.php";
	?>
   </head>
<body>

<style>
.snippet .p {
display: block;
  background-color: #e6e9ed;
  color: black;
}

</style>

<?php
require 'vendor/autoload.php';
use Elasticsearch\ClientBuilder;

$hosts = [
    'localhost:9200'     
];

$client = ClientBuilder::create()->setHosts($hosts)->build();

$selected1 = "";
$selected2 = "";
$selected3 = "";
$searchterm1 ="" ;

if(isset($_GET["keyword1"]))
	#validate searchterm
    $searchterm1 = trim($_GET['keyword1']); 
	#sanitize searchterm
    $searchterm1 = strip_tags($searchterm1);

if(isset($_POST['gender']))
    $selected1 = trim($_POST['gender']); 
    $selected1 = strip_tags($selected1);
	
if(isset($_POST['city']))
    $selected2 = trim($_POST['city']); 
    $selected2 = strip_tags($selected1);

if(isset($_POST['state']))
    $selected2 = trim($_POST['state']); 
    $selected2 = strip_tags($selected1);

echo $searchterm1;
echo $selected1;
echo $selected2;
echo $selected3;	


?>
</body>
</html>

