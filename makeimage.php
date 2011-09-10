<?php
//            COPYRIGHT BY
//                   MICHAŁ SOIDA, 2010
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


//przygotowywanie adresu
if ($lat!=0 || $long!=0)
{
exit("ERROR: Trying to change coordinates. Not possible in this version.");
}
else
{
if ($model == "coamps") $filename = "http://new.meteo.pl/metco/mgram_pict.php?ntype=2n&row=151&col=91&lang=pl";
else $filename = "http://new.meteo.pl/um/metco/mgram_pict.php?ntype=0u&row=466&col=232&lang=pl";
}

//pobieranie obrazka
$obr_orig = imagecreatefrompng($filename);
$size = getimagesize($filename);
$origw = $size[0];
$origh = $size[1];


//przerabianie obrazka
//wymiary ekranu:
//320 x 480
if ($origw > 480)
{
$newh = 480*$origh/$origw;
$obrazek = imagecreatetruecolor(480, $newh);
imagecopyresampled($obrazek, $obr_orig, 0, 0, 0, 0, 480, $newh, $origw, $origh);
}
else
{
$obrazek = imagecreatetruecolor($origw, $origh);
imagecopyresized($obrazek, $obr_orig, 0, 0, 0, 0, $origw, $origh, $origw, $origh);
}
header("Content-Type: image/PNG");
imagepng($obrazek);
?>