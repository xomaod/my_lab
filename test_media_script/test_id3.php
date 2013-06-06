<?php
require_once("getid3/getid3.php");
require_once("getid3/write.php");
//ID3 for audio
//intital id3 constract
$tagWriter = new getid3_writetags;
$getID3 = new getID3;

echo "<pre>";
print_r($getID3);
print_r($tagWriter);
echo "</pre>";
?>