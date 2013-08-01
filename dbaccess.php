<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

function runQuery($insertSt){
//    echo $insertSt;
    mysql_query($insertSt, conecDb());
    return true;
}
function getRowsInArray($query){
//    echo $query;
    $result = mysql_query($query, conecDb());
//    checkForError();
    $arr=array();
    $arrIndex=0;
    while($r = mysql_fetch_array($result, MYSQL_ASSOC)){
        $arr[$arrIndex]=$r;
        $arrIndex++;
    }
    return $arr;
}
function conecDb(){

    $host_db = "localhost";
    $usuario_db = "root";
    $clave_db = "root";
    $nombre_db = "raulooo_despscrap";

    $db_link = mysql_connect($host_db, $usuario_db, $clave_db) or die ('Ha fallado la conexión con el servidor: '.mysql_error());;
    mysql_select_db($nombre_db) or die ('Error al seleccionar la Base de Datos: '.mysql_error());
    return $db_link;
}


?>