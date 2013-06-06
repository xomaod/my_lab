<?php
$source = $_POST['source'];
$dest = $_POST['dest'];

//Convert Audio
$command = '/usr/local/bin/ffmpeg -i '.$source.' -c:a libfaac -q:a 100 '.$dest;

exec($command, $output, $return);

echo $command;
echo "<br />";
echo "<pre>";
print_r($output);
print_r($return);
echo "</pre>";
?>