<?php
//cut song
$command_cut = "/usr/local/bin/ffmpeg -ss 00:00:10.00 -t 30 -i ".$source." -acodec copy ".$destination;

exec($command_cut, $output, $return);


echo $command_cut;
echo "<br />";
echo "<pre>";
print_r($output);
echo "</pre>";
?>