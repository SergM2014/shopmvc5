<?php 
   session_start();

  @unlink($_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['bild']);
  unset($_SESSION['bild']);
  echo 'Файл удален!';



?>