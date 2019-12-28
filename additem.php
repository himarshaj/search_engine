<!DOCTYPE html>
<html>

<head>
  <title>Poodle</title>
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   
	<?php include "master.php"; ?>
   </head>
<body>

<?php
require 'vendor/autoload.php';
use Elasticsearch\ClientBuilder;

$hosts = [
    'localhost:9200'     
];

$client = ClientBuilder::create()->setHosts($hosts)->build();

$id = substr($firstname,0,1). rand(1001,5000);


$BreedName ="" ;
$Group ="" ;
$Group1 ="" ;
$Temperment ="" ;
$Intelligence ="" ;
$Popularity ="" ;
$Weight ="" ;
$Price ="" ;


if(isset($_POST["BreedName"]))
	$BreedName = trim($_POST['BreedName']); 
	$BreedName = strip_tags($BreedName);
if(isset($_POST["Group"]))
	$Group = trim($_POST['Group']); 
	$Group = strip_tags($Group);
if(isset($_POST["Group1"]))
	$Group1 = trim($_POST['Group1']); 
	$Group1 = strip_tags($Group1);
if(isset($_POST["Temperment"]))
	$Temperment = trim($_POST['Temperment']); 
	$Temperment = strip_tags($Temperment);
if(isset($_POST["Intelligence"]))
	$Intelligence = trim($_POST['Intelligence']); 
	$Intelligence = strip_tags($Intelligence);
if(isset($_POST["Popularity"]))
	$Popularity = trim($_POST['Popularity']); 
	$Popularity = strip_tags($Popularity);
if(isset($_POST["Weight"]))
	$Weight = trim($_POST['Weight']); 
	$Weight = strip_tags($Weight);
if(isset($_POST["Price"]))
	$Price = trim($_POST['Price']); 
	$Price = strip_tags($Price);	
	
	
if (empty($BreedName)){
	header("Location:./newitem.php?error=First name can't be empty");
	exit();
	}
    
else{
	$params = [	'index' => 'dogs',
				'id' => $id,
				'body' => [
				'BreedName' => $BreedName,
				'Group' => $Group,
				'Group1' => $Group1,
				'Temperment' => $Temperment,
				'Intelligence' => $Intelligence,
				'Popularity' => $Popularity, 
				'Weight' => $Weight,
				'Price' => $Price ]
			];	

$response = $client->index($params);
echo "<br><br><br>" ;
echo "New item added succesfully! ";
#print_r($firstname);
#print_r(htmlspecialchars($response));

}
	


?>
</body>
</html>

