<?php

$model=new Application_Models_Admin;

	$model->deleteVisits();
	$in=$model->selectVisits();
	if(!$in){ $model->insertVisits();}
	if($in['quantity']==1){$model->updateVisits();}
	if($in['quantity']==2){exit("Зайдите на административную часть через 15 минут!");}


	$mod=$model->getAdmin();

	if($_POST['rememberme']!=''){
	Lib_Admincookies::getInstance()->setAdminCookies();
	}else {Lib_Admincookies::getInstance()->destroyCookies();
	}

	header("Location: /admin");
	exit;
?>