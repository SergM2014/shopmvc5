<?php
	class Admin_Controllers_About  extends Lib_BaseController {
	
		function index(){
         $model=new Application_Models_Admin;
         $about=$model->getAbout();
         $this->about=$about;		 
		}
		
		function saveabout(){
			$model=new Application_Models_Admin;
			$res=$model->updateAbout();
			if($res){
			$response=array("msg"=>"Текст сохранен" ,"status"=>"success");
			} else{$response=array("msg"=>"Текст по какой то причине не сохранен", "status"=>"danger");}
			echo json_encode($response);
			exit();
		}
	

	}
?>