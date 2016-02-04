<?php
	class Admin_Controllers_Comments  extends Lib_BaseController {
	
		function index(){
          $model=new Application_Models_Comments;
 
		$comments=$model->getComments();
		$pagination=$model->getNumber();
     
		$this->comments=$comments;
		$this->pagination=$pagination;

		}

         function publish(){
			 $model=new Application_Models_Comments;
			if($_POST['selectedItems']){
			 foreach($_POST['selectedItems'] as $one){
			 
			 $model->publish($one);
			 }
			 }
			 
			 exit();
		}

         function unpublish(){
			 $model=new Application_Models_Comments;
			if($_POST['selectedItems']){
			 foreach($_POST['selectedItems'] as $one){
			 
			 $model->unpublish($one);
			 }
			 }
			 exit();
		}		
		

		
		function delete(){

			$model=new Application_Models_Comments;
			if($_POST['selectedItems']){
			 foreach($_POST['selectedItems'] as $one){
			 
			 $model->delete($one);
			 }
			 }
            exit();
		}
		
	function editComment(){
	
          $model=new Application_Models_Comments;
		  
		  if($_POST['selectedItems']){
		 
			 foreach($_POST['selectedItems'] as $one){
					$comment=$model->getOneComment($one);
			 }
			 $this->comment=$comment;
			 }
		}
		
	
		   function deleteImage(){
	 
	     @unlink($_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['comments']);
			unset($_SESSION['comments']);
			echo "Файл удален!";
	   exit();
	   }
	   
	   function updateComment(){
			$model=new Application_Models_Comments;
			$model->updateComment();
			
			exit();
	   }
		
	}
?>