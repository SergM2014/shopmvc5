<?php


 class Lib_Manufacturer   extends Lib_DateBase
 {
	 public $manufacturers;
	 protected static $instance; 
	 
	 
	 
	 function __construct(){
		 parent::__construct();
		$sql="SELECT * FROM manufacturer";	
		$stmt=$this->conn->query($sql);

		$this->manufacturers= $stmt->fetchAll(PDO::FETCH_ASSOC);
	//print_r ($this->manufacturers);
	}
	 
	 
	 public static function getInstance() {
		if (!is_object(self::$instance)) self::$instance = new self;
		return self::$instance;
    }
	 
	 
	 function insertManufacturer(){ 
		$manufacturer=AppUser::cleanInput($_POST['create_manufacturer']);

		$sql="INSERT INTO manufacturer (
			  manufacturer_title)
			 VALUES( ?)";
			
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $manufacturer, PDO::PARAM_STR);
			$stmt->execute();
            $res=$this->conn->lastInsertId(); 
			
        return $res;	
		}
		
	function find_goods(){
		$id=AppUser::cleanInput($_POST['id_manufacturer_delete']);
		
		$sql="SELECT  id FROM products WHERE manufacturer_id=? LIMIT 1";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		$res= $stmt->fetch(PDO::FETCH_ASSOC);
		
		return $res;
		}
		
	function deleteManufacturer(){
		$id=AppUser::cleanInput($_POST['id_manufacturer_delete']);
		$sql="DELETE FROM manufacturer WHERE id=?";
		
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();

		}
		
		
		function selectManufacturer(){
            $id=AppUser::cleanInput($_POST['id_manufacturer_edit']);
			
			$sql="SELECT * FROM manufacturer WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $id, PDO::PARAM_INT);
			$stmt->execute();
			$res= $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $res;
		}

	
	public function  getManufacturerTree(  )//выводится в админ меню при нажатии категория оперирует 
{
	 foreach($this->manufacturers as $manufacturer){
		 
			$print.=
			'<li><a class="btn btn-info" href="#" rel="ManufacturerTree" data-id="'.$manufacturer['id'].'">'.$manufacturer['manufacturer_title'].'</a>';
			$print.='</li>';
		
	 }
	 
	 return  $print;		 
	}
	
		public function  getManufacturerTree_Catalog(  )//выводится в админ меню при нажатии категория оперирует 
{
	 foreach($this->manufacturers as $manufacturer){
		 
			$print.=
			'<li><a href="/catalog?manufacturer_id='.$manufacturer['id'].'">'.$manufacturer['manufacturer_title'].'</a>';
			$print.='</li>';
		
	 }
	 
	 return  $print;		 
	}
	
	function updateManufacturer(){		
		$upmanufacturer= AppUser::cleanInput($_POST['upmanufacturer']);
		$id= AppUser::cleanInput($_POST['id']);	
		$sql="UPDATE manufacturer SET manufacturer_title=?  WHERE id=?";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1, $upmanufacturer, PDO::PARAM_STR);
		$stmt->bindValue(2, $id, PDO::PARAM_INT);
		$stmt->execute();
			
		return true;
	}



public function  getTitleManufacturer()//возвращает выпадающий список select с категориями;	
	{
			foreach($this->manufacturers as $manufacturer){
				$option.="<option value=".$manufacturer["id"].">";
				$option.= $manufacturer["manufacturer_title"];
				//$option.="</option>";
			}
		return $option;	
	}

	
	public function getManufacturers(){
	$sql="SELECT * FROM manufacturer";	
		$stmt=$this->conn->query($sql);

		$cat= $stmt->fetchAll(PDO::FETCH_ASSOC);	
		return $cat;
	}
		
 }
?>