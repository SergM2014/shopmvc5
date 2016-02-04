<?php

class Lib_Cache{
	
function write(){
	if($_SERVER['REQUEST_URI']!='/exit'){
	$cache_file=$_SERVER['DOCUMENT_ROOT'].'/cache/'.md5($_SERVER['REQUEST_URI']).'.tmp';
$file=fopen($cache_file,'w+');
flock($file, LOCK_EX);
fwrite($file,ob_get_contents());
flock($file, LOCK_UN);
fclose($file);
ob_end_flush();	
}
}



function read(){
	if($_SERVER['REQUEST_URI']!='/exit'){
$cache_file=$_SERVER['DOCUMENT_ROOT'].'/cache/'.md5($_SERVER['REQUEST_URI']).'.tmp';
if (file_exists($cache_file)&&(time()-filemtime($cache_file))<3600)
{
	exit(include($cache_file));
	}
else {
	ob_start();
	}
}
}

function readsql(){
$cache_file=$_SERVER['DOCUMENT_ROOT'].'/cache/'.md5($sql).'.tmp';	
if(file_exists($cache_file)&& (time()-filemtime($cache_file))<3600)
{
$handle=fopen($cache_file,'rb');
 $inhalt = fread($handle, filesize($fileName));
 fclose($handle);
 return unserialize($inhalt);	
}
else return null;
}

function writesql($inhalt){
$cache_file=$_SERVER['DOCUMENT_ROOT'].'/cache/'.md5($sql).'.tmp';	
$handle=fopen($cache_file,'w+');
flock($handle, LOCK_EX);
fwrite($handle,serialize($inhalt));
flock($hanle, LOCK_UN);
fclose($handle);
	
}

}
?>
