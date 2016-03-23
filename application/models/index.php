<?php
//Модель вывода каталога
 class Application_Models_Index extends Lib_DateBase
  {	  
	function getSlider(){

$sql="SELECT * FROM slider ";

$stmt=$this->conn->query($sql);


$slider=$stmt->fetchAll(PDO::FETCH_ASSOC);

return $slider;
}
	
function getCarousel(){
$sql="SELECT * FROM carousel";	
$stmt=$this->conn->query($sql);
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}	


function isCarousel(){
$sql="SELECT carousel FROM background";
$stmt=$this->conn->prepare($sql);	
$stmt->execute();
$res=$stmt->fetch(PDO::FETCH_ASSOC);	
return $res;	
}

	
  }