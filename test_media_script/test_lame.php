<?php
$source = $_POST['source'];
$dest = $_POST['dest'];
$size = $_POST['size'];

//Convert Audio
$command = 'yes y | /usr/local/bin/lame -h -b '.$size.' -m s '.$source.' '.$dest;

exec($command, $output, $return);


echo $command;
echo "<br />";
echo "<pre>";
print_r($output);
echo "</pre>";
?>