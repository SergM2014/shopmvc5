<h2 class="text-center">Добавить слайд </h2>
<section id="for_add" class="col-sm-10 col-sm-offset-2">

		
	<h3 >Добавить изображение</h3>
		
			<img alt="" id="image_preview" class="thumb2" src=""/>
		   <form id="MyUploadForm"  enctype="multipart/form-data" method="post" >
		
			<input name="FileInput" id="FileInput" type="file" />
			<input type="button"  data-folder="slider" id="submit-btn" class="btn btn-success" value="Загрузить" />

            <input type="reset"  data-folder="slider" id="reset-btn"  class="btn btn-danger" value="Удалить" />
			<div id="output"></div>
			
		   </form>
			
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
			<label for="url" class="col-sm-2 control-label">URL <span class="remark">*</span></label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="url" id="url" maxlength="50" placeholder="Url"  title="Введите url адресс">
			</div>
		  </div>

	  
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-default" id="add_new_slider">Створити новый слайд</button>
			</div>
		  </div>
	</form>
