<?php
if(array_key_exists("hash",$_REQUEST)) $ifhash = true;
else $ifhash = false;
$strona = file_get_contents("http://new.meteo.pl/komentarze/");
$strona = iconv ("ISO-8859-2","UTF-8",$strona);
$strona = stristr($strona, '<div style="padding: 15px;">');
$strona = substr($strona, 30);
$strona = stristr($strona, '</div>', true);
if ($ifhash) echo md5($strona);
else echo $strona;
?>
