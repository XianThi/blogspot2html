<?php

/**
 * @author 
 * @copyright 2016
 */
//header('Content-Type: text/html; charset=utf-8');

require_once("functions.php");

/**
 * SETTINGS 
 * 
 **/
$json_url="http://*.blogspot.com.tr/feeds/posts/default"; //blogspot json url without parameters
$page_num=3686; // max page count
/**
 * 
 * SETTINGS END 
 * 
 **/

//$makaleler=file_get_contents("json.json");
for ($j=1; $j<$page_num;$j++){
$parametre='?alt=json&start-index='.$j.'&max-results=1';
$makaleler=url_get_contents($json_url.$parametre);
$json = json_decode($makaleler, true);
$title=$json['feed']['entry'][0]['title']['$t'];
$title=sefurl($title);
$content=$json['feed']['entry'][0]['content']['$t'];
$content=str_replace('margin-left:','',$content);
$links=ara('src="','"',$content);
$i=0;
foreach($links as $link){
$ext=substr($link,-4);
$filename=$title."_".$i.$ext;
download_file($link,$filename);
$i++;
$content=str_replace("$link","resimler/$filename",$content);
}


$content= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'.$content;
ob_start();
echo $content;
file_put_contents("$title.html", ob_get_contents());
ob_end_clean();
}

?>