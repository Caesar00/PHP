<?php
function printRadio($apr,$item,$str)
{
	if(isset($apr[$item])&&$apr[$item]==$str)
	{
		echo "checked='checked'";
	}
}
function printRadioYes($apr,$item)
{
	if(isset($apr[$item])&&$apr[$item]!='')
	{
		echo "checked='checked'"; }
}
function printRadioNo($apr,$item)
{
	if(isset($apr[$item])&&$apr[$item]=='')
	{
		echo "checked='checked'";
	}
}
function printText($apr,$item)
{
	if(isset($apr[$item]))
	{
		echo $apr[$item];
	}
}
function showText($apr,$item)
{
	if(!isset($apr[$item])||$apr[$item]=='')
	{
		echo 'none';
	}
}
function tickcheckbox($str1,$str2)
{
	$pos = strpos($str1,$str2);
	if($pos === false);
	else
		echo "checked='checked'";
}

function get_loc_info($str) {
    // tem file for storing cookie
    $cookie_jar = '/tmp/loc_cookie';

    if(!file_exists($cookie_jar)) {
        // save campus map's cookie
        $map_url = 'http://maps.murdoch.edu.au';
        $ch = curl_init($map_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
        $output = curl_exec($ch);
        curl_close($ch);

        // request data from murdoch map's api
        $ch = curl_init($map_url.'/call/autocomplete?term='.$str);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
        $page = curl_exec($ch);
        curl_close($ch);

        // save curl result to local file
        $fp = fopen($cookie_jar, 'w');
        fwrite($fp, $page);
        fclose($fp);
    }
    else {
        $page = file_get_contents($cookie_jar);
    }

    // save response html into php class
    return $page;
}
?>
