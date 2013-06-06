<?php
//Handbrake

$source = $_POST['source'];
$dest = $_POST['dest'];
$quality = $_POST['quality'];
$vstat_name = $_POST['vstat_name'];

$commandHB = 'yes y | HandBrakeCLI -i '.$source.' -o '.$dest.' -e x264 -q 20.0 -a 1,1 -E faac,copy:ac3 -B 160,160 -6 dpl2,auto -R Auto,Auto -D 0.0,0.0 -f mp4 -Y '.$quality.' --loose-anamorphic -m -x cabac=0:ref=2:me=umh:bframes=0:weightp=0:8x8dct=0:trell is=0:subme=6 '.$vstat_name.' 2>&1';

exec($commandHB, $output, $return);

echo $commandHB;
echo "<br />";
echo "<pre>";
print_r($output);
echo "</pre>";

?>