<html>
<head>
  <title>Poodle</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src = "https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
	<?php include "master.php"; ?>
   </head>
<body>
<script>
  function startDictation() {
    if (window.hasOwnProperty('webkitSpeechRecognition')) {
      var recognition = new webkitSpeechRecognition();
      recognition.continuous = false;
      recognition.interimResults = false;
      recognition.lang = "en-US";
      recognition.start();
      recognition.onresult = function(e) {
        document.getElementById('transcript').value
                                 = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('labnol').submit();
      };
      recognition.onerror = function(e) {
        recognition.stop();
      }
    }
  }
</script>
<style>
.snippet .p {
display: block;
  background-color: #e6e9ed;
  color: black;
}

<style>
/* Style The Dropdown Button */
.dropbtn {
  background-color: #3299a8;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}


/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #3299a8;
}
</style>

</style>

<div class="container" align= "center">


<div class="row" id="filter" align="left">
		<form id="labnol" action="advanced_search.php" method= "post">
		
		<table><br><br>
			<tr>
			<td><div class="dropdown" >
				<select name="Group">
					<option value="" class="dropbtn" >Select Group</option>
					<option value="Working" class="dropdown-content">Working</option>
					<option value="Sporting" class="dropdown-content">Sporting</option>
					<option value="Herding" class="dropdown-content">Herding</option>					
					<option value="Terrier" class="dropdown-content">Terrier</option>
					<option value="Hound" class="dropdown-content">Hound</option>
				</select>
			</td></div>
			</tr>
			<tr>
			<tr><td><div class="dropdown">
				<select name="Temperment" >
					<option value="" class="dropbtn">Select Temperament</option>
					<option value="Affectionate" class="dropdown-content">Affectionate</option>
					<option value="Alert" class="dropdown-content">Alert</option>
					<option value="Active" class="dropdown-content">Active</option>
					<option value="Friendly" class="dropdown-content">Friendly</option>
					<option value="Adaptable" class="dropdown-content">Adaptable</option>
				</select>
			</td></div></tr><tr>
			<td><div class="dropdown">
				<select name="Intelligence">
					<option value="" class="dropbtn">Select Intelligence</option>
					<option value="HighI" class="dropdown-content">High</option>
					<option value="MediumI" class="dropdown-content">Medium</option>
					<option value="LowI" class="dropdown-content">Low</option>
				</select>
			</td></div></tr>
			<tr>
			<td><div class="dropdown">
				<select name="Popularity">
					<option value="" class="dropbtn">Select Popularity</option>
					<option value="HighPo" class="dropdown-content">High</option>
					<option value="MediumPo" class="dropdown-content">Medium</option>
					<option value="LowPo" class="dropdown-content">Low</option>
				</select>
			</td></div class="dropdown"></tr>
			<tr>
			<td><div class="dropdown">
				<select name="Price" >
					<option value="" class="dropbtn">Select Price</option>
					<option value="HighPr" class="dropdown-content">High</option>
					<option value="MediumPr" class="dropdown-content">Medium</option>
					<option value="LowPr" class="dropdown-content">Low</option>
				</select>
			</td></div></tr>
			<input id= "transcript" size="60" class="form-control" type="text" placeholder="Search" name="keyword1" />
			<img onclick="startDictation()" src="speaker.png" style="width:20px;height:20px;"/>
			<button type="submit" >Explore</button>
		</table>	
		</form>
	</div>

	
</div>

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
$selected4 = "";
$selected5 = "";
$searchterm1 ="" ;


if(isset($_POST["keyword1"]))
	#validate searchterm
    $searchterm1 = trim($_POST['keyword1']); 
	#sanitize searchterm
    $searchterm1 = strip_tags($searchterm1);

if(isset($_POST['Group']))
    $selected1 = trim($_POST['Group']); 
    $selected1 = strip_tags($selected1);
	
if(isset($_POST['Temperment']))
    $selected2 = trim($_POST['Temperment']); 
    $selected2 = strip_tags($selected2);

if(isset($_POST['Intelligence'])){
    $selected3 = trim($_POST['Intelligence']); 
    $selected3 = strip_tags($selected3);}

if(isset($_POST['Popularity'])){
    $selected4 = trim($_POST['Popularity']); 
    $selected4 = strip_tags($selected4);}
	
if(isset($_POST['Price'])){
    $selected5 = trim($_POST['Price']); 
    $selected5 = strip_tags($selected4);}	

$match_string = ("$searchterm1 $selected1 $selected2 $selected3 $selected4 $selected5");

$params = [
    'index' => 'finaldata',
    'size'   => 1000,    
      'body' => [
         'query' => [
            'bool' => [
               'should' => [
                  
                  ['match' => ['BreedName' => "{$match_string}"]],
                  ['match' => ['Group' => "{$match_string}"]],
                  ['match' => ['Intelligence' => "{$match_string}"]],
                  ['match' => ['Popularity' => "{$match_string}"]],
                  ['match' => ['Temperment' => "{$match_string}"]],
                  ['match' => ['Group1' => "{$match_string}"]],
                  ['match' => ['Weight' => "{$match_string}"]],
                  ['match' => ['Price' => "{$match_string}"]]
               ]
            ]
         ],  
      ]
  ];
  
$response = $client->search($params);


#print_r($response);

$output_n = sizeof($response['hits']['hits'],0);

if($output_n==0)
{
	echo "No results found, Please try again";
}
	
$time = ((int)($response['took'])/1000);
$output = ($response['hits']['hits']);


echo "You are looking for: ";
print_r($searchterm);
echo "<br>";
print_r($time);
echo " seconds to display ";
print_r($output_n);
echo " matches";

if(isset($_SESSION['uId']))
{ 

echo '<div id="listId" class = "snippet" style = "margin-bottom: 10%;">
     <ul class="list">';

	 
  
for ($i=0; $i<$output_n; $i++)
	{
		#echo "$output[$i]['_id']" ;
		echo '<form action="savfav.php" method="get" ><br><a href = "savfav.php?id1='.$output[$i]['_id'].'&id2='.$output[$i]['_source']['BreedName'].'">Save Record<div id="'.$output[$i]['_id'].'" class="p" >
		<a>Name: </a><a>'.$output[$i]['_source']['BreedName'].'</a> 
		<br>
		<a>Group: </a><a>'.$output[$i]['_source']['Group'].'</a>
		<br>
		<a>Temperament: </a><a>'.$output[$i]['_source']['Temperment'].'</a>
		<br>
		<a>Popularity: </a><a>'.$output[$i]['_source']['Popularity'].'</a>
		<a>, Intelligence: </a><a>'.$output[$i]['_source']['Intelligence'].' </a>
		<br>
		<a>Can be also grouped as: </a><a>'.$output[$i]['_source']['Group1'].' </a>
		<a>, With an average pup weight of: </a><a>'.$output[$i]['_source']['Weight'].' </a>
		<a>and a price level: </a><a>'.$output[$i]['_source']['Price'].' </a>		
		<br><br><a href="'.$output[$i]['_source']['url'].'" >View more info </a>
		</div></form>' ; 
	} 

echo '</ul><div class = "page_list" >
  <ul class="pagination"></ul></div>
</div>' ;

}

else 
{ 

echo "<br><br><a href=login.php >Log in</a><a> to your account to save search results to your profile! </a>";
echo "<a> Don't have an account yet? </a><a href=login.php >Sign up</a><a> here first..</a>";
echo '<div id="listId" class = "snippet" style = "margin-bottom: 10%;">
     <ul class="list">';
	 
  
for ($i=0; $i<$output_n; $i++)
	{
		echo '<br><div id="'.$output[$i]['_id'].'" class="p" >
		<a>Name: </a><a>'.$output[$i]['_source']['BreedName'].'</a> 
		<br>
		<a>Group: </a><a>'.$output[$i]['_source']['Group'].'</a>
		<br>
		<a>Temperament: </a><a>'.$output[$i]['_source']['Temperment'].'</a>
		<br>
		<a>Popularity: </a><a>'.$output[$i]['_source']['Popularity'].'</a>
		<a>, Intelligence: </a><a>'.$output[$i]['_source']['Intelligence'].' </a>
		<br>
		<a>Can be also grouped as: </a><a>'.$output[$i]['_source']['Group1'].' </a>
		<a>, With an average pup weight of: </a><a>'.$output[$i]['_source']['Weight'].' </a>
		<a>and a price level: </a><a>'.$output[$i]['_source']['Price'].' </a>
		<br><br><a href="'.$output[$i]['_source']['url'].'" >View more info</a>
		</div>';
	} 

echo '</ul><div class = "page_list" >
  <ul class="pagination"></ul></div>
</div>' ;

}


?>

<script>
  var options = {
    valueNames: [ 'name', 'category' ],
    page: 10,
	innerWindow: 2, // How many pages should be visible on each side of the current page. innerWindow: 2 ,  … 3 4 5 6 7
	outerWindow: 2, // How many pages should be visible on from the beginning and from the end of the pagination. outerWindow: 2,  1 2 … 4 5 6 7 8 … 11 12
    pagination: true
	
  };

  var listObj = new List('listId', options);
  
</script>


<footer id="foot01"></footer>
</body>
<script>document.getElementById("foot01").innerHTML = "<p>&copy;  " + new Date().getFullYear() + " Poodle.com | All rights reserved.</p>";
</script>
</html>