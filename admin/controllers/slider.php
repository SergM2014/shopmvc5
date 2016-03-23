<?php
	class Admin_Controllers_Slider  extends Lib_BaseController {
	
		function index(){
			$model=new Application_Models_Admin;  
			$slider=$model->getSlider();

			$this->slider=$slider;
			}
		
		function addSlider(){
		}
		

        function addnewSlider(){
	 
	        $model=new Application_Models_Admin;
	        $res=$model->addnewslider();
			if($res){
			$response=array("msg"=>"Новый элемент успешно добавлен", "status"=>"success");
			} else{
			$response=array("msg"=>"что-то пошло не так ", "status"=>"danger");
			}
			if($_SESSION['slider']!=true) $response['msg'].=' Добавте изображение для Слайдера!';
			unset($_SESSION['slider']);
			if($_POST['url']==false) $response['msg'].=' Добавте Url!';
			
			echo json_encode($response);
			
			exit();
			}
	    
		
		function updateSlider(){
				       
		    $error='';
		   
		    if($_POST['src']== 'slider'){$slider= $_POST['img'];}
			elseif ($_SESSION['slider']==true) {  $slider=$_SESSION['slider']; $slider=explode('/',$slider); $slider=array_pop($slider); }
			else {$error.=' Добавте изображение для карусели!';}
			
			if($_POST['url']==false) $error.=' Добавте Url!';
			
			if($error== false){
				$model=new Application_Models_Admin;
				$res=$model->updateSlider($slider);
				if($res){ $response=array("msg"=>"Элемент успешно изменен ", "status"=>"success");}
				}
			else{ $response=array("msg"=>"что-то пошло не так ".$error, "status"=>"danger");}
			
				unset($_SESSION['slider']);
			echo json_encode($response);
			exit();
	    }
	    
		
		
		function deleteSlider(){

			$model=new Application_Models_Admin;
			$res=$model->deleteSlider();
			
			if($res){$response=array( "msg"=>"Элемент слайдера с id {$_POST['id']} удален", "status"=>"success");}
			else{$response=array( "msg"=>"Элемент слайдера удалить не удалось", "status"=>"danger");}
			
			echo json_encode($response);
            exit();
		}
		
		function editeSlider(){
	
			$model=new Application_Models_Admin;
			$mod1=$model->getSliderItem($_GET['id']);

			$this->mod1=$mod1;
			}
	   
	   
	   function deleteImage(){
	 
	     @unlink($_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['slider']);
			unset($_SESSION['slider']);
			echo "Файл удален!";
	   exit();
	   }
	   
	   
	}
?>