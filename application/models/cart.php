<?php
//Модель вывода каталога
 class Application_Models_Cart extends Lib_DateBase
  {	  
	function getPrice($id){

$sql="SELECT price FROM products WHERE id=?";
try{
$stmt=$this->conn->prepare($sql);
$stmt->bindParam(1,$id, PDO::PARAM_INT);
 $stmt->execute();}
 catch(PDOException $e){die("Ошибка в cкюл запросе при выборе цени".$e->getMessage());}

$item_price=$stmt->fetchColumn();

return $item_price;
}
	
	
	
  }