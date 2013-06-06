<?php
//Convert Audio
$command = 'yes y | /usr/local/bin/lame -h -b '.$size.' -m s '.$source.' '.$destination;

exec($command, $output, $return);


echo $command;
echo "<br />";
echo "<pre>";
print_r($output);
echo "</pre>";
?>