<?php
$source = $_POST['source'];
$dest = $_POST['dest'];

//Convert Audio
$command = 'exiftool -b -ThumbnailImage '.$source.' > '.$dest;

exec($command, $output, $return);

echo $command;
echo "<br />";
echo "<pre>";
print_r($output);
print_r($return);
echo "</pre>";
?>