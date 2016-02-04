<?php
	class Admin_Controllers_Manufacturers  extends Lib_BaseController {
	
		function index(){
			$manufacturers.= "<ul id='manufacturer-tree'>";
			$manufacturers.='<li><a class="btn btn-warning" href="#"  data-id="0">Не указан</a>';
			$manufacturers.= Lib_Manufacturer::getInstance()->getManufacturerTree();
			
			$manufacturers.= "</ul>";

			$this->manufacturers=$manufacturers;
		
		}

		function addmanufacturer(){
			$id=Lib_Manufacturer::getInstance()->insertManufacturer();
			
			if($id){$response=array("msg"=>"новый производитель создан", "status"=>"success"); $this->id=$id;}
				else{$response=array("msg"=>"чтото пошло не так!", "status"=>"danger");}
				
			echo json_encode($response);
			exit();
		}
	
		
		function deletemanufacturer(){
			
			$mod2=Lib_Manufacturer::getInstance()->find_goods();

			if($mod2){
				$response=array("msg"=>"Производитель имеет товары! Удалить нельзя","case"=>"manufacturer has goods","status"=>"danger");	
				}
			else
				{ Lib_Manufacturer::getInstance()->deleteManufacturer();
				
				$response=array("msg"=>"Удален производитель № {$_POST['id_manufacturer_delete']}","status"=>"success");
				}	
			echo json_encode($response);

			exit();
		
		}
	
	
		function edit_manufacturer(){
			
			$manufacturer=Lib_Manufacturer::getInstance()->selectManufacturer();
			
			$this->manufacturer=$manufacturer;
		
		}
		
		
		function update_manufacturer(){
			$mod=Lib_Manufacturer::getInstance()->updateManufacturer();
			if($mod){$response=array("msg"=>"новый производитель ".$_POST['upmanufacturer']." изменен", "status"=>"success");}
				else{$response=array("msg"=>"чтото пошло не так!", "status"=>"danger");}
		
			echo json_encode($response);
		exit();
		}
	
	}
?>