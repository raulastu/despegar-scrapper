<?php
include_once 'dbaccess.php';
include_once 'email.php';

if(!isset($_GET['name'])){
    echo "name par not present";
    die;
}

$name = $_GET['name'];
$data = getRowsInArray("SELECT url FROM scrap WHERE name = '$name'");
$temp = $data[0];
$url = $temp['url'];
if($url==null)
    die;
//$url = $ddata['url'];

//echo $url;

//$url = 'http://www.despegar.com.pe/shop/flights/data/search/roundtrip/lim/sao/2013-08-27/2013-09-01/1/0/0/TOTALFARE/ASCENDING/NA/NA/NA/NA/NA';
//    $url = 'https://api.github.com/users/'.$userGHId.'/repos';
//    $url = 'https://api.github.com/user/repos?access_token=577706b24c3264a6acfaff3795fab579060bd0c7';
//
//    echo $url;
$curl = curl_init();

// Set some options - we are passing in a useragent too here

curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));

$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);
// // $result value is json {access_token: ACCESS_TOKEN}


$arr = json_decode($resp);



$prices = $arr->result->data->items;
//$price1 = $prices->itinerariesBox->itinerariesBoxPriceInfoList[0]->total->fare->raw;
//echo sizeof($prices);
$min = 1000000;
$bestBase = $min;
$bestCharges = $min;
$bestTaxes = $min;
$minId = "";
for ($i=0;$i<sizeof($prices);$i++){
    $raw = $prices[$i]->itinerariesBox->itinerariesBoxPriceInfoList[0]->total->fare->raw;
//    $taxes = $prices[$i]->itinerariesBox->itinerariesBoxPriceInfoList[0]->total->taxes->raw;
    $taxes = $prices[$i]->itinerariesBox->itinerariesBoxPriceInfoList[0]->total->taxes->raw;
    $charges = $prices[$i]->itinerariesBox->itinerariesBoxPriceInfoList[0]->total->charges->raw;
    $base = $prices[$i]->itinerariesBox->itinerariesBoxPriceInfoList[0]->adult->baseFare->raw;
    $id =  $prices[$i]->id;
    if($raw<$min){
        $minId=$id;
        $min=$raw;
        $bestTaxes=$taxes;
        $bestBase =$base ;
        $bestCharges=$charges;
    }

    echo $raw." ".($raw-($base+$charges))." (".$base."+".$charges.")</br>";
}

runQuery("INSERT INTO price_history(name , web_id, price, taxes, base, charges)
    VALUES ('".$name."', '".$minId."', '".$min."',".$bestTaxes.",".$bestBase.",".$bestCharges.")");
echo mysql_errno(conecDb());


$isBest = true;

$data = getRowsInArray("SELECT price FROM bests WHERE name = '".$name."'");
print_r($data);
for($i=0;$i<sizeof($data);$i++){
    $var = $data[$i];
    echo "</br>".intval($var['price'])." ";
    echo intval($min)."</br>";
    if(intval($var['price']) <= intval($min)){
        $isBest=false;
        break;
    }
}

if($isBest){
    $sql = "INSERT INTO bests (name, web_id, price) values ('$name', '$id', ".$min.")";
    mysql_query($sql,conecDb());
    $subject = "new best! ".$min;
    sendEmail('erreauele@gmail.com',$subject);
}
//$price = $data['price'];
//print_r($prices);