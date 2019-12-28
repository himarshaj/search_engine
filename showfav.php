<!DOCTYPE html>
<html>

<head>
  <title>Poodle</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/mark.js/8.6.0/jquery.mark.min.js"></script>
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
   <table align="right"><br>
   <tr><td align="right"><form action="search.php" method="get" >
	<input type="text" size="40" name="keyword" ><input type="submit" name="sub" value="Explore" />
	</form>
   </td></tr></table>   
   <meta name="viewport" content="width=device-width, initial-scale=1.0">   
   <?php include "master.php"; ?>
   </head>
<body>


<style>
.snippet .blocks {
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

$doc_id = $_REQUEST["id"];

$params = [
    'index' => 'finaldata',
    'size'   => 1000,
    'from' => 0,    
      'body' => [
         'query' => [
            'bool' => [
               'should' => [
                  
                  ['match' => ['_id' => $doc_id ]] 
				  ]
            ]
         ]	 
      ]
  ];
  
$response = $client->search($params);
#print_r($response);
$output = ($response['hits']['hits']);

{
echo '<form action="savfav.php" method="get" ><br><div id="'.$output[0]['_id'].'" class="" >
		<a>Name: </a><a>'.$output[0]['_source']['BreedName'].'</a> 
		<br>
		<a>Group: </a><a>'.$output[0]['_source']['Group'].'</a>
		<br>
		<a>Temperament: </a><a>'.$output[0]['_source']['Temperment'].'</a>
		<br>
		<a>Popularity: </a><a>'.$output[0]['_source']['Popularity'].'</a>
		<a>, Intelligence: </a><a>'.$output[0]['_source']['Intelligence'].' </a>
		<br>
		<a>Can be also grouped as: </a><a>'.$output[0]['_source']['Group1'].' </a>
		<a>, With an average pup weight of: </a><a>'.$output[0]['_source']['Weight'].' </a>
		<a>and a price level: </a><a>'.$output[0]['_source']['Price'].' </a>		
		<br><br><a href="'.$output[0]['_source']['url'].'" >View more info </a>
		</div></form>' ; 
}
		
?>

</body>

</html>

				  
				  