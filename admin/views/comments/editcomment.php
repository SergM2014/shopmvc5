<section id="for_form">
  
   <fieldset>
   <legend >Редактировать коментарий</legend>
  
        <form id="myformUpload" method="post" enctype="multipart/form-data" action="application/ajax/upload.php">
		<div class="form-group">
		<label for="file" class="col-sm-2 control-label"><span class="glyphicon glyphicon-download-alt"></span> Додать аватар</label>
		     <div class="col-sm-8 ">
                   			<img alt="" id="image_preview" class="thumb" src="/./../uploads/comments/<?php echo $comment['picture'] ?>"/>
						   <form id="MyUploadForm"  enctype="multipart/form-data" method="post" >
						
							<input name="FileInput" id="FileInput" type="file" />
							<input type="button"  id="submit-btn" data-folder="comments" class="btn btn-success" value="Загрузить" />

							<input type="reset"  id="reset-btn" data-folder="comments" class="btn btn-danger" value="Удалить" />
							<div id="output"></div>
							
						   </form></br>
							
							<div class="progress">
							  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
								0%
							  </div>
							</div>
			</div>	   
   
                   
			  
	    </div>		  
        </form>
		
        <div class="clearfix"></div>
    
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                 <small>Поля позначеные <span class="remark">*</span> есть обязательными </small>
            </div>
        </div>
	
        <form id="form" class="form-horizontal" >
 
            <div class="form-group ">
                <label for="firstname" class="col-sm-2 control-label">Имя<span class="remark">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="firstname" class="form-control check" id="firstname" placeholder="Введите имя" maxlength="25" value="<?php echo $comment['name'] ?>" title="Введите имя" />
                </div>
            </div>

            <div class="form-group  <?php if(isset($error['noemail'])) echo 'has-error'; ?>">
                 <label for="emailcontact" class="col-sm-2 control-label">Email <span class="remark">*</span></label>
                         <div class="col-sm-8">
                             <input type = "email" name="emailcontact" class="form-control check" id="emailcontact" placeholder="Email" maxlength="25" value="<?php echo $comment['email'] ?>" title="Введите email"/>
                        </div>
             </div>


        <div class="row">
             <div class="col-sm-8 col-sm-offset-2">
                 <small> Можете использовать множество разных тегов </small>
            </div>
        </div>

        <div class="form-group">
            <label for="comment" class="col-sm-2 control-label">Коментарий <span class="remark">*</span></label>
                 <div class="col-sm-8">
                      <textarea  name="comment" id="comment" class="form-control check" rows="3" placeholder="Введите Ваш коментарий" title="Напишите что нибудь"><?php echo $comment['comments'] ?></textarea>
                 </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">

                 <button type="submit" class="btn btn-success" data-id="<?php echo $comment['id'] ?>" id="editcomment">Изменить коментарий</button>
            </div>
        </div>

        </form>
	
   </fieldset> 
  
</section><!-- for_form-->