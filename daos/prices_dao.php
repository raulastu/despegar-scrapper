<?php
include_once $_SERVER['DOCUMENT_ROOT']."/dbaccess.php";

class Prices{

    function getHistory($name){
        $sql = "SELECT web_id, price, taxes, base, charges, min(`when`) `when` FROM price_history
        WHERE name = '".$name."'
        GROUP BY `web_id`
        ORDER BY `when` DESC";
        return getRowsInArray($sql);
    }
    function getAllHistory($name){
        $sql = "SELECT web_id, price, taxes, base, charges, `when` FROM price_history
        WHERE name = '".$name."'
        ORDER BY `when` DESC";
        return getRowsInArray($sql);
    }
}