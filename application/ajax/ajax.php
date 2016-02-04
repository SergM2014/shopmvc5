<?php
session_start();
    include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
    $data=AppUser::cleanInput($_POST);

	 if ($_SESSION['bild']): ?>
	<h3>Аватар: </h3> <img src="<?php echo 'uploads/comments/'.$_SESSION['bild'] ?>" "width="70" height="80" class="img-responsive"/>
	<?php endif;		 
	?>

	<h3><strong>Имя: </strong></h3><p><?php echo $data['name'] ?></p>
	<h3><strong>отзыв: </strong></h3><p><?php echo $data['message'] ?></p>
	</br>
