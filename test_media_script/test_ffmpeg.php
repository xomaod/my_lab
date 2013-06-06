<?php
//gen thumb
$ss = $_POST['ss'];
$source = $_POST['source'];
$dest = $_POST['dest'];

$commandThumb = "/usr/local/bin/ffmpeg -ss ".$ss." -i ".$source." -f image2 -vframes 1 -y ".$dest;

/*
if(file_exists('/data/cms/contents/contents/new_cms/11/pictures/0213/06-05-2013/p17s9tlds716ckb78t7213ku13if3.jpg')){
	echo "file exists";
}else{
	echo "no file";
}
*/

exec($commandThumb, $outputThumb, $statusThumb);


echo '<br /> Command : '.$commandThumb;
echo '<br /> Status Code : '.$statusThumb;
if($statusThumb == 0){
	echo '<br /> Status : Thumbnails Generated';
}
echo '<br /> Output <pre>';
print_r($outputThumb);
?>