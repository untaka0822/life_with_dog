<?php 

$json = file_get_contents('http://linkdata.org/api/1/rdf1s9i/%E7%8A%AC%E3%81%AE%E7%A8%AE%E9%A1%9E_rdf.json');
$decode_data = json_decode($json, true);

echo '<pre>';
var_dump($decode_data);
echo '</pre>';


 ?>