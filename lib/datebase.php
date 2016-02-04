<?php

class Lib_DateBase {
	protected $conn;
    function __construct(){

        try{

        $this->conn = new PDO('mysql:dbname='.NAME_BD.';host='.HOST.'',USER,PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        if(DEBUG_MODE) $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {die("Ошибка соединения с базой или хостом:".$e->getMessage());}

        }
}
//new Lib_DateBase();
?>
