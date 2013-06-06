<?php
$source = $_POST['source'];

//command MediaInfo
$commandMediainfo = '/usr/bin/mediainfo -f duration '.$source;
exec($commandMediainfo, $outputMediainfo, $statusMediainfo);
echo '<br /> MediaInfo Status : '.$statusMediainfo;
echo '<br /> MediaInfo Output <pre>';
print_r($outputMediainfo);
?>