<?php

include_once $_SERVER['DOCUMENT_ROOT']."/daos/prices_dao.php";
$name = $_GET['name'];
if(!isset($_GET['name']) || $_GET['name']=='null'){
    $name ='sao';
}
$opt = $_GET['v'];


$pricesDAO = new Prices();
if($opt=='all'){
    $history = $pricesDAO->getAllHistory($name);
}else{
    $history = $pricesDAO->getHistory($name);
}
header('Content-Type: application/json');
echo json_encode(array("data"=>$history));
