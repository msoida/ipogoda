<?php
//            COPYRIGHT BY
//                   MICHAŁ SOIDA, 2010
//     Creative Commons Uznanie autorstwa -
//     - Użycie niekomercyjne - Na tych samych warunkach 3.0 Polska
// http://creativecommons.org/licenses/by-nc-sa/3.0/pl/legalcode
//
header("Content-Type: image/PNG");
if(array_key_exists("model",$_REQUEST)) $model = $_REQUEST["model"];


if ($model == "coamps") $filename = "http://new.meteo.pl/metco/mgram_pict.php?ntype=2n&row=151&col=91&lang=pl";
else $filename = "http://new.meteo.pl/um/metco/mgram_pict.php?ntype=0u&row=466&col=232&lang=pl";

$obr_orig = imagecreatefrompng($filename);
$size = getimagesize($filename);
$origw = $size[0];
$origh = $size[1];

//320 x 480
if ($origw > 480)
{
$newh = 480*$origh/$origw;
$obrazek = imagecreatetruecolor(480, $newh);
//imagecopyresampled($obrazek, $obr_orig, 0, 0, 0, 29, 480, $newh, $origw, 280);
imagecopyresampled($obrazek, $obr_orig, 0, 0, 0, 0, 480, $newh, $origw, $origh);
}
else
{
$obrazek = imagecreatetruecolor($origw, $origh);
//imagecopyresized($obrazek, $obr_orig, 0, 0, 0, 29, $origw, 280, $origw, 280);
imagecopyresized($obrazek, $obr_orig, 0, 0, 0, 0, $origw, $origh, $origw, $origh);
}

//imagetruecolortopalette($obrazek,0,256);

//imagecolorset($obrazek, imagecolorclosest($obrazek,211,233,251), 255, 255, 255);
//imagecolorset($obrazek, imagecolorclosest($obrazek,249,233,230), 255, 255, 255);
//imagecolorset($obrazek, imagecolorclosest($obrazek,255,251,240), 255, 255, 255);
//imagecolorset($obrazek, imagecolorclosest($obrazek,252,254,252), 255, 255, 255);
//imagecolorset($obrazek, imagecolorclosest($obrazek,228,226,228), 255, 255, 255); //szary
//imagecolorset($obrazek, imagecolorclosest($obrazek,220,222,220), 255, 255, 255);
//imagecolorset($obrazek, imagecolorclosest($obrazek,132,190,228), 132, 206, 255); //ciemnoniebieski

//imagecolorset($obrazek, imagecolorexact($obrazek,248,235,229), 255, 255, 255);


//imagepalettetotruecolor($obrazek);
function imagepalettetotruecolor(&$img)
    {
        if (!imageistruecolor($img))
        {
            $w = imagesx($img);
            $h = imagesy($img);
            $img1 = imagecreatetruecolor($w,$h);
            imagecopy($img1,$img,0,0,0,0,$w,$h);
            $img = $img1;
        }
    }


//imagecolortransparent($obrazek, imagecolorallocate($obrazek,255,255,255));



imagepng($obrazek);
?>