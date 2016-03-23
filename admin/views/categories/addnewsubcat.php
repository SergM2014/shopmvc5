	<form id="add_new_subcat" class="form-horizontal">

		<h3 class="text-center">Добавить новую подкатегорию</h3>

	  <div class="form-group">
		<label for="new_sub_category" class="col-sm-2 control-label">Название категории</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control"  id="new_sub_category" placeholder="введите название категории" title="Введите название">
		  <input type="hidden" id="parent_id" value="<?php echo $_POST['parent_id'] ?>" >
		</div>
	  </div>


	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" id="add_sub_category_submit" class="btn btn-default">Добавить новую unter категорию</button>
		</div>
	  </div>
	</form>