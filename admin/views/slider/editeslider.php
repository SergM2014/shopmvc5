<h2 class="text-center">Изменить элемент слайдера </h2>
<section id="for_edit" class="col-sm-10 col-sm-offset-2">

		
	<h3 >Изменить изображение</h3>
		
			<img alt="" id="image_preview" class="thumb" src="/../../<?php echo UPLOAD.'slider/'.$mod1['image'] ?>"/>
		   <form id="MyUploadForm"  enctype="multipart/form-data" method="post" >
		
			<input name="FileInput" id="FileInput" type="file" <?php if($mod1['image']==true) { echo 'style="display:none"';} ?> />
			<input type="button"  id="submit-btn" class="btn btn-success" data-folder="slider" value="Загрузить"  />

            <input type="reset"  id="reset-btn" data-folder="slider" class="btn btn-danger" value="Удалить" <?php if($mod1['image']==true) {echo 'style="display:block"';} ?> />
			<div id="output"></div>
			
		   </form></br>
			
			<div class="progress">
			  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
				0%
			  </div>
			</div>			
				
				
</section><!-- for_add -->

	<form class="form-horizontal" >
		<div class="col-sm-10 col-sm-offset-2">
			 Поля позначение <span class="remark fa-lg">*</span> есть обязательными
			</div>
		  <div class="form-group">
			<label for="url" class="col-sm-2 control-label"> Измените URL <span class="remark">*</span></label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="url" id="url" maxlength="50" placeholder="Url"  title="Введите url адресс" value="<?php echo $mod1['url'] ?>">
			</div>
		  </div>

	  
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-default" id="sub_edited_slider" data-id="<?php  echo $mod1['id'] ?>">Редактировать элемент слайдера</button>
			</div>
		  </div>
	</form>
