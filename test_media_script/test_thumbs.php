<?php
//gen thumb
$ss = 100;
$commandThumb = "/usr/bin/ffmpeg -ss ".$ss." -i ".$input." -f image2 -vframes 1 -y ".$output;

exec($commandThumb, $output, $return);


echo $commandThumb;
echo "<br />";
echo "<pre>";
print_r($output);
echo "</pre>";
?>