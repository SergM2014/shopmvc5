<?php
	class Admin_Controllers_Carousel  extends Lib_BaseController {
	
		function index(){
          $model=new Application_Models_Admin;  
		$carousel=$model->getCarousel();

		$this->carousel=$carousel;
		}
		
		function addcarousel(){
		}
		

        function addnewcarousel(){
	   
	        $model=new Application_Models_Admin;
	        $res=$model->addCarousel();
			if($res){
			$response=array("msg"=>"Новый элемент успешно добавлен", "status"=>"success");
			} else{
			$response=array("msg"=>"что-то пошло не так ", "status"=>"danger");
			}
			if($_SESSION['carousel']!=true) {$response['msg'].=' Добавте изображение для карусели!';
			
			}
			unset($_SESSION['carousel']);
			if($_POST['url']==false) $response['msg'].=' Добавте Url!';
			echo json_encode($response);
			exit();
			}
	    
		
		function updatecarousel(){
	       
		   $error='';
		   
		    if($_POST['src']== 'carousel'){$carousel= $_POST['img'];}
			elseif ($_SESSION['carousel']==true) {  $carousel=$_SESSION['carousel']; $carousel=explode('/',$carousel); $carousel=array_pop($carousel); }
			else {$error.=' Добавте изображение для карусели!';}
			
			if($_POST['url']==false) $error.=' Добавте Url!';
			
			if($error== false){
				$model=new Application_Models_Admin;
				$res=$model->updateCarousel($carousel);
				if($res){
					$response=array("msg"=>"Элемент успешно изменен ", "status"=>"success");
					}
            }
			else{
				$response=array("msg"=>"что-то пошло не так ".$error, "status"=>"danger");
				}
			
				unset($_SESSION['carousel']);
			echo json_encode($response);
			exit();
	    }
		
		
		function deletecarousel(){

			$model=new Application_Models_Admin;
			$res=$model->deleteCarousel();
			
			if($res){$response=array( "msg"=>"Элемент карусели с id {$_POST['id']} удален","status"=>"success");}
			else{$response=array("msg"=>"Удалить не удалось", "status"=>"danger");}
			
			echo json_encode($response);
            exit();
		}
		
			function editecarousel(){
	
        $model=new Application_Models_Admin;
		$mod1=$model->getCarouselItem($_GET['id']);

		$this->mod1=$mod1;
		}
	   
	   
	   function deleteimage(){
	 
	     @unlink($_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['carousel']);
			unset($_SESSION['carousel']);
			echo "Файл удален!";
	   exit();
	   }
	   
	   
	}
?>