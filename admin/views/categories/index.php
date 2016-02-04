	<div id="show_category" class="col-sm-6 col-sm-offset-3" >

		<h2>Редактор категорий</h2>
		 <div id="category-editor"> 

			<header class="category-header">
			<a href="#" id="add_main_cat"  >  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;&nbsp;Добавть родительськую категорию</a>
			</header>

			<?php echo $categories; ?>
		</div>
	</div>


	
		<form id="add_category_form" class="form-horizontal">

		<h3 class="text-center">Добавить новую категорию</h3>

	  <div class="form-group">
		<label for="new_category" class="col-sm-2 control-label">Название категории</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control"  id="new_category" placeholder="введите название категории" title="Введите название">
		</div>
	  </div>


	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" id="add_category_submit" class="btn btn-default">Добавить новую родительськую категорию</button>
		</div>
	  </div>
	</form>