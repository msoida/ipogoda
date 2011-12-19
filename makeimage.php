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


function showerror($errortext)
{
header ("Content-type: image/png");
$string = $errortext;
$font   = 4;
$width  = ImageFontWidth($font) * strlen($string);
$height = ImageFontHeight($font);
 
$im = @imagecreate ($width,$height);
$background_color = imagecolorallocate ($im, 255, 255, 255); //white background
$text_color = imagecolorallocate ($im, 0, 0,0);//black text
imagestring ($im, $font, 0, 0,  $string, $text_color);
imagepng ($im);
}


//przygotowywanie adresu
if ($lat!=0 || $long!=0)
{
if ($model == "coamps") $gps = "http://www.meteo.pl/php/mgram_search.php?NALL=" . $lat . "&EALL=" . $long;
else $gps = "http://www.meteo.pl/um/php/mgram_search.php?NALL=" . $lat . "&EALL=" . $long;
	$headers = get_headers($gps, 1);
    if($headers[0] != "HTTP/1.1 301 Moved Permanently") showerror("Blad: Pozycja poza zasiegiem mapy");
    else $temp_q = parse_url($headers['location']);
if ($model == "coamps") $filename = "http://www.meteo.pl/metco/mgram_pict.php?" . $temp_q['query'];
else $filename = "http://www.meteo.pl/um/metco/mgram_pict.php?" . $temp_q['query'];
}
else
{
if ($model == "coamps") $filename = "http://www.meteo.pl/metco/mgram_pict.php?ntype=2n&row=151&col=91&lang=pl";
else $filename = "http://www.meteo.pl/um/metco/mgram_pict.php?ntype=0u&row=466&col=232&lang=pl";
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