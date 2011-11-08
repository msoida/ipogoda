<?php
//            COPYRIGHT BY
//                   MICHAŁ SOIDA, 2011
//     Creative Commons Uznanie autorstwa -
//     - Użycie niekomercyjne - Na tych samych warunkach 3.0 Polska
// http://creativecommons.org/licenses/by-nc-sa/3.0/pl/legalcode
//
if(array_key_exists("model",$_REQUEST)) $model = $_REQUEST["model"];
else $model = "um";
if(array_key_exists("lat",$_REQUEST)) $lat = $_REQUEST["lat"];
else $lat = 0;
if(array_key_exists("long",$_REQUEST)) $long = $_REQUEST["long"];
else $long = 0;
if(array_key_exists("hash",$_REQUEST)) $ifhash = true;
else $ifhash = false;
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = "makeimage.php?model={$model}&lat={$lat}&long={$long}";
$adres = "http://$host$uri/$extra";
$obrazek = file_get_contents($adres);
$obr64 = "data:image/PNG;base64," . base64_encode($obrazek);
if ($ifhash) echo md5($obr64);
else echo $obr64;
?>