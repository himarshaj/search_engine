<!DOCTYPE html>
<html>

<head>
  <title>Poodle</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/mark.js/8.6.0/jquery.mark.min.js"></script>
   <script src = "https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
   <script>
    $(document).ready(function(){
    $(function() {
    var mark = function() 
	{
      var keyword = $("input[name='keyword']").val();
      $(".snippet").unmark({
        done: function() {
          $(".snippet").mark(keyword);
        }
      });
    };	
	$("input[name='keyword']").on("blur", mark);
    });
    });
   </script>
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

   <meta name="viewport" content="width=device-width, initial-scale=1.0">   
   <?php include "master.php"; ?>
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

$searchterm ="" ;

if(isset($_GET["keyword"]))
	#validate searchterm
    $searchterm = trim($_GET['keyword']); 
	#sanitize searchterm
    $searchterm = strip_tags($searchterm);
	
echo '<table align="right"><br>
   <tr><td align="right"><form id="labnol" action="search.php" method="get" >
	<input  id= "transcript" type="text" value="'.$searchterm.'"  size="40" name="keyword" >
	<img onclick="startDictation()" src="speaker.png" style="width:20px;height:20px;"/>
	<input type="submit" name="sub" value="Explore" />
	</form>
   </td></tr></table>   
   ';
   
if (empty($searchterm)){
	header('Location:./index.php?error=Please enter a keyword to search');
	exit();
}
	#print "<span>Please enter a keyword to search </span>";

   
else{
	$params = [
    'index' => 'finaldata',
    'size'   => 1000,
    'from' => 0,    
      'body' => [
         'query' => [
            'bool' => [
               'should' => [
                  
                  ['match' => ['BreedName' => "{$searchterm}"]],
                  ['match' => ['Group' => "{$searchterm}"]],
                  ['match' => ['Intelligence' => "{$searchterm}"]],
                  ['match' => ['Popularity' => "{$searchterm}"]],
                  ['match' => ['Temperment' => "{$searchterm}"]],
                  ['match' => ['Group1' => "{$searchterm}"]],
                  ['match' => ['Weight' => "{$searchterm}"]],
                  ['match' => ['Price' => "{$searchterm}"]]
               ]
            ]
         ]	 
      ]
  ];
  
$response = $client->search($params);

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
}	

#print_r($response);

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


</body>

</html>


