<?php
	class Admin_Controllers_Products  extends Lib_BaseController {
	
		function index(){
			  $model=new Application_Models_Catalog;

			  
			$mod1=$model->getAdminContent();
			$mod2=$model->getAdminPageNumber();
		   
				
			$mod3=Lib_Category::getInstance()->getHierarchyCategory();
			$mod4=Lib_Category::getInstance()->getTitleCategory($mod3);
			$mod5= Lib_Manufacturer::getInstance()->getTitleManufacturer();
			
			
			$this->mod1=$mod1;
			$this->mod2=$mod2;
			$this->mod4=$mod4;
			$this->mod5=$mod5;
		
		}

        function addproduct(){
		
			//$model=new Application_Models_Catalog;
			$mod1=Lib_Category::getInstance()->getHierarchyCategory();
			$mod2=Lib_Category::getInstance()->getTitleCategory($mod1);
			$mod3= Lib_Manufacturer::getInstance()->getTitleManufacturer();
			
			$this->mod2=$mod2;
			$this->mod3=$mod3;
		}
		
		function savenewproduct(){
	     
			parse_str($_POST['str'], $insert);
		 
			$model=new Application_Models_Catalog;
			$mod1=$model->getlastId();
		
			$res= $model->insertProduct($insert);

			$mod1=$model->getlastId();
			
			if($res) { $response=array( "msg"=>"Товар з id {$mod1} створено", "status"=>"success");}
						else {$response=array( "msg"=>"Попытка слелать товар не удалась", "status"=>"danger");}
		
		
			if(is_array($insert['pictures']) || !empty($insert['pictures'])){
				$images=explode(",", $insert['pictures']);
				
				$img_array=array();
				foreach($images as $one){
				   $img_array[]='id_'.$mod1.'_'.$one;
					
				   rename($_SERVER['DOCUMENT_ROOT'].'/uploads/temporary/'.$one, $_SERVER['DOCUMENT_ROOT'].'/uploads/id_'.$mod1.'_'.$one);
				   rename($_SERVER['DOCUMENT_ROOT'].'/uploads/temporary/thumbnail/'.$one, $_SERVER['DOCUMENT_ROOT'].'/uploads/thumbnail/id_'.$mod1.'_'.$one);
				}
				
				}
				if($img_array){ $images=serialize($img_array); $model->addImages($images, $mod1);}
				
			echo json_encode($response);
			exit();//пра вильно если нет представления то и пишем на выход
	
		}
		
		
		function deleteproduct(){
		
			$model=new Application_Models_Catalog;
			$res=$model->deleteProduct();
			
			if($res){$response=array( "msg"=>"Товар с id {$_POST['id']} удален", "status"=>"success");}
			else{$response=array( "msg"=>"Товар не удалось удалить", "status"=>"danger");}
			
			echo json_encode($response);
			exit();
		}
		
		function editeproduct(){
		
			  $model=new Application_Models_Product;
			$mod1=$model->getProduct($_GET['id']);
		   
				
			$mod2=Lib_Category::getInstance()->getHierarchyCategory();
			$mod3=Lib_Category::getInstance()->getTitleCategory($mod2);
			$mod4= Lib_Manufacturer::getInstance()->getTitleManufacturer();
			
			
			$this->mod1=$mod1;
			
			$this->mod3=$mod3;
			$this->mod4=$mod4;		
			}
			
		
		function saveeditedproduct(){
		
			parse_str($_POST['str'], $update);
			
				if($update['pictures']){
				$images=explode(',', $update['pictures']);

				
				foreach($images as $key=>$value){
					
					$picture=explode('_', $value);
					if($picture[0]!='id' && !is_numeric($picture[1])){$value2='id_'.$update['id'].'_'.$value;}
						else $value2= $value;
					
					   rename($_SERVER['DOCUMENT_ROOT'].'/uploads/temporary/'.$value, $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$value2);
					   rename($_SERVER['DOCUMENT_ROOT'].'/uploads/temporary/thumbnail/'.$value, $_SERVER['DOCUMENT_ROOT'].'/uploads/thumbnail/'.$value2);

					$images[$key]=$value2;
				}
				$images=serialize($images);} else{ $images='';}
				
				
				$model=new Application_Models_Catalog;
					
				
				$res= $model->updateProduct($images, $update);
				
				if($res){$response=array( "msg"=>"Товар с id ".$update['id']." изменен", "status"=>"success");}
									else {$response =array("msg"=>"Чтото пошло не так", "status"=>"danger");}
					
				echo json_encode($response);
			 exit();
		}
			
	}
?>