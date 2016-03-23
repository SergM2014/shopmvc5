<?php

  class Admin_Controllers_Index  extends Lib_BaseController 
  {
	  
			
    function index() 
	{
		$model=new Application_Models_Admin;
		$time=$model->getdeleteTime();
		$current_time=time();
		if($current_time> ($time['time_of_clean']+86400 /*количество секунд в сутках*/)){
		$this->deleteRubish();
		$this->putTime();
		}
	}
		
	function putTime(){
	    $time=time();
		$model=new Application_Models_Admin;
		$model->putTime($time);
	
	
	}
	
	function deleteRubish(){
	
	   $formats=explode(',', VALID_FORMATS);
	   $valid_formats=array();
	   foreach($formats as $one){
	   $valid_formats[]=trim($one,' ');
	      }
	
		$searchdirectory=array('/uploads/', '/uploads/thumbnail/', '/uploads/slider/', '/uploads/carousel/', '/uploads/comments/');
		foreach($searchdirectory as $key=>$value){
			$dir=PATH_SITE.$value;
			$files=scandir($dir);
			array_shift($files);
			array_shift($files);
			$key=array();
			for($i=0; $i<sizeof($files); $i++)
			{
				if($files[$i]!='Thumbs.db' ){
				$name=strtolower($files[$i]);
                    list($txt, $ext) = explode(".", $name) ; // разбиваем на имя и формат
                    if(in_array($ext,$valid_formats))    // смотрим формат такой как мы разрешили?!
                    {

				$key[]=$value.$name;}
                }
			}
			if($value==='/uploads/'){
			$arr=$key; 
			
			}else{
			$arr=array_merge($arr, $key); ;
			}
			}
		
		$model=new Application_Models_Admin;
		$res=$model->getImages();
        

		$to_del=array_diff($arr, $res);
		
			if($to_del){
				foreach($to_del as $one){
				@unlink(PATH_SITE.$one);
				}
			}
			
		}	

		
 }	
		
   
  