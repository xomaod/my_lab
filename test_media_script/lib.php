<?php
function curl($url, $params=array())
{
	echo '<br /> URL='.$url.'<br /><pre>';
	print_r($params);

	$ch = curl_init();
	$opts[CURLOPT_CONNECTTIMEOUT] = 10;
	$opts[CURLOPT_RETURNTRANSFER] = true;
	$opts[CURLOPT_TIMEOUT] = 60;
	//$opts[CURLOPT_HEADER] = 1;
	if($params)
	{
	$opts[CURLOPT_POSTFIELDS] = $params;
	}
	$opts[CURLOPT_URL] = $url;
	curl_setopt_array($ch, $opts);
	//curl_setopt($ch, CURLOPT_HTTPHEADER,array("Expect:"));
	$result = curl_exec($ch);
	$response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	echo '<br /><br />Response='.$response.'<br />';
	
	if($result === false)
	{
		$msgError = "Can't access web service. (".$url.")";
		curl_close($ch);
		throw new Exception($msgError, 100);
	}
	curl_close($ch);

return $result;
}
?>