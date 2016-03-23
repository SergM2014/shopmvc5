<?php
 class Application_Models_Leftmenu extends Lib_DateBase
 {  
	function getleftMenu(){
	$sql="SELECT * FROM categories";
	//parent::__construct();
	$stmt=$this->conn->query($sql) ;
	$query=$stmt->fetchAll(PDO::FETCH_ASSOC);
	return $query;
	
}
 }

?>