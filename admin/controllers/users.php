<?php
	class Admin_Controllers_Users  extends Lib_BaseController {
	
		function index(){
			$model=new Application_Models_Admin;
	 
			$users=$model->getUsers();
			$this->users=$users;
			}

        function addUser(){	
		
        }		
		
		function saveUser(){
			$model=new Application_Models_Admin;
			$res=$model->insertUser();
			
			if($res){$response=array("msg"=>"Новый пользователь додан!", "status"=>"success");}else
			{$response=array("msg"=>"Не удалось додать нового пользователя", "status"=>"danger");}
			echo json_encode($response);
			exit();
		}

		
		function deleteUser(){

			$model=new Application_Models_Admin;
			$res=$model->deleteUser();
			if($res){$response=array("msg"=>"Пользователь удален!", "status"=>"success");}else
			{$response=array("msg"=>"Не удалось удалить пользователя", "status"=>"danger");}
			echo json_encode($response);
            exit();
		}
		
	function editUser(){
	
          $model=new Application_Models_Admin;
		  $user=$model->getOneUser();
          $this->user=$user;
		}
  
	 function updateUser(){
			$model=new Application_Models_Admin;
			$res=$model->updateUser();
			if($res){$response=array("msg"=>"Пользователь изменен!", "status"=>"success");}else
			{$response=array("msg"=>"Не удалось изменен пользователя", "status"=>"danger");}
			echo json_encode($response);
			exit();
	   }
		
	}
?>