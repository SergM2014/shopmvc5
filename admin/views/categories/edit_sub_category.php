	<form id="edit_sub_category" class="form-horizontal">

		<h3 class="text-center">Изменения категории</h3>

	  <div class="form-group">
		<label for="new_sub_category" class="col-sm-2 control-label">Установить родительськую категорию</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control"  id="upsubtitle" value="<?php echo $category['cat_title']  ?>" placeholder="введите название категории" title="Введите название">
		  <input type="hidden" id="id" name="id" value="<?php echo $category['id'] ?>">
		</div>
	  </div>
       
	   
	   <div class="form-group">
		   <label for="new_sub_category" class="col-sm-2 control-label">Установить родительськую категорию</label>
			   <div class="col-sm-6">
				   <select class="form-control" id="parent_id" size="1"> 
				   <option selected value="<?php echo $category['parent_id'] ?>"> Оставить категорию как есть
				   <option  value="0"> Сделать категорию родительской
						
					<?php 
					echo $droplist;
					?>

					</select>
				</div>
        </div>   
		   
		   
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" id="update_sub_category" class="btn btn-default">Cохранить изменения</button>
		</div>
	  </div>
	</form>