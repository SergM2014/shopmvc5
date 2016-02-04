<?php
	$menu=getMenu();
	$leftmenu=getleftMenu();


	function getMenu(){
		return Lib_Menu::getInstance()->getMenu();
		}
	
	function getleftMenu(){
		return Lib_Menu::getInstance()->getleftMenu();
		}
	
	
	class Log //логирование смені пароля
	{
		public static function write($message)
		{
		
			$f = fopen(PATH_SITE."/log.txt", "a");
			fwrite($f, $message); 
			fclose($f);
		}
	
	}
	
	?>