<?php

/**
 * @author 
 * @copyright 2016
 */
 
error_reporting(E_ALL);
ini_set('max_execution_time', 90000);

function ara($bas, $son, $yazi)
{
	@preg_match_all('/' . preg_quote($bas, '/') .
	'(.*?)'. preg_quote($son, '/').'/i', $yazi, $m);
	return @$m[1];
}

function url_get_contents ($Url) {
$auth = base64_encode('ab106968:LLpp3434');

$aContext = array(
    'http' => array(
        'proxy' => 'proxy.uyap.gov.tr:80',
        'request_fulluri' => true,
        'header' => "Proxy-Authorization: Basic $auth",
    ),
);
$cxContext = stream_context_create($aContext);

$sFile = file_get_contents("$Url", '', $cxContext);
//$sFile=mb_convert_encoding($sFile, "ISO-8859-9","UTF-8");
return $sFile;
}

function download_file($url,$filename){
$content = url_get_contents("$url");
//Store in the filesystem.
$fp = fopen("resimler/$filename", "w");
fwrite($fp, $content);
fclose($fp);
}

function sefurl($s) { 
  $tr = array('ş', 'Ş', 'ı', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'Ç', 'ç'); 
  $eng = array('s', 'S', 'i', 'I', 'g', 'G', 'u', 'U', 'o', 'O', 'C', 'c'); 
  $s = str_replace($tr, $eng, $s); 
  $s = preg_replace('@[^A-Za-z0-9\-_]+@i', " ", $s); 
  $s = trim($s); 
  $s = str_replace(' ', "-", $s); 
  for ($i = 0; $i <= 5; $i++) { 
    $s = str_replace("--", "-", $s); 
  } 
  return strtolower($s); 
}   


?>