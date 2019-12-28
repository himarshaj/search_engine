<?php 

echo $page = isset($_GET['page']) ? (int)$_GET['page'] :1;
$perPage = isset($_GET['perpage']) && $_GET['perpage']<=50 ? (int)$_GET['perpage'] :10;


$response 

?>