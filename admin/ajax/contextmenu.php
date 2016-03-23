<?php
if ($_POST['manufacturers']) $item='manufacturer';
if($_POST['categories']) $item='category';
?>

<ul >
	<li><a href="#" rel="edit_<?php echo $item ?>" data-id="<?php echo $_POST['id'] ?>"  data-title="<?php echo $_POST['title'] ?>" data-parent_id="<?php echo $_POST['parent_id'] ?>"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Редактировать</a></li>
		<?php if(isset($_POST['categories'])): ?>
	<li><a href="#" rel="creat_new_category"  data-id="<?php echo $_POST['id'] ?>"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Добавить дочернюю категорию</a></li><?php endif; ?>
		
	<li><a href="#" rel="delete_<?php echo $item ?>"  data-delete="<?php echo $_POST['id'] ?>"><span class="glyphicon glyphicon-trash" ></span>&nbsp;&nbsp;Удалить</a></li>
	<li style="border-top: gray 1px solid; margin-top:5px;"><a href="#" rel="cansel_context"><span class="glyphicon glyphicon-remove" ></span>&nbsp;&nbsp;Отмена</a></li>
</ul>
