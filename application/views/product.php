<nav class="row">
    <ol class="breadcrumb ">
      <li><a href="/">Главная</a></li>
      <li><a href="/catalog">Каталог</a></li>
      <?php echo (AppUser::getAricleforerunner()); ?>
        <div  id="cart_res"  class="pull-right"><img src="img/korzina.jpg" >
        <a href="#" id="show_busket" data-toggle="modal" data-target=".bs-example-modal-lg" >Корзина</a>&nbsp;&nbsp;&nbsp;Количество товара:<span><?php echo (!$_SESSION['total_items']) ? 0: $_SESSION['total_items']  ?></span
        >&nbsp;&nbsp;&nbsp;На сумму:<span><?php echo (!$_SESSION['total_price']) ?  0 :  $_SESSION['total_price']  ?>грн</span></div><!--cart_res-->
	</ol>
</nav>


 <div id="gallery">
    <div class="album" data-jgallery-album-title="Album 1">

        <?php if($mod1['images']==true) {$images=unserialize($mod1['images']);
         foreach($images as $image): ?>
            <a href="<?php echo URL  ?>uploads/<?php  echo $image ?>"> <img class="pics" src="uploads/<?php  echo $image ?>"
              data-jgallery-bg-color="#3e3e3e" data-jgallery-text-color="#fff" onerror="this.style.display='none'" /> </a>
        <?php endforeach; }?>
    </div>
</div>



<div class="product wrapgood">
    <h4 >Автор: </h4> <p><?php echo $mod1['author'] ?></p>
    <h4 >Название: </h4><?php echo $mod1['title'] ?>
    <h4>Описание: </h4><?php echo $mod1['description'] ?>
    <h4>Цена: </h4><?php echo $mod1['price'] ?> грн.
	</br></br>
    <?php if($mod['manufacturer']){ ?><h4>Производитель: </h4><?php echo $mod1['manufacturer'] ?><?php }
    
     if(isset($url[1]) && isset( $url[2])){
?>
    <a href="<?php echo URL ?>goods/<?php echo $url[1]  ?>/<?php echo $url[2] ?>">вернуться в каталог:</a>
    <?php }
    ?>
    
    <button type="button" id="add_one_product" data-id="<?php echo $mod1['id'] ?>" class="btn btn-success">Добавить в корзину</button>
</div><!-- wrapgood-->

<?php  include $_SERVVER['DOCUMENT_ROOT'].'/application/ajax/list.php' ;?>

<section id="add_comment_form">

   <fieldset>
       <legend >Добавить коментарий</legend>

        <form id="formUpload" method="post" enctype="multipart/form-data" action="application/ajax/upload.php" class="clearfix">
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label"><span class="glyphicon glyphicon-download-alt"></span> Додать аватар</label>
                     <div class="col-sm-8 clearfix">
                            <img alt="" id="image_preview" class="thumb invisible" src=""/>
                           <form id="MyUploadForm"  enctype="multipart/form-data" method="post" >

                                <div id="pre_FileInput"><input name="FileInput" id="FileInput" type="file" /></div>

                                <div  id="submit-btn" class="invisible right"><input type="button"  class="btn btn-success " value="Загрузить" /></div>
                                <div id="reset-btn" class="invisible right"> <input type="reset" class="btn btn-danger " value="Удалить" /></div>
                                <div id="output" class="right"></div>

                           </form>

                            <div class="progress invisible">
                              <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                0%
                              </div>

                            </div>

                    </div><!--col-sm-8 clearfix-->
                </div><!--form-group-->
        </form>


        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                     <small>Поля позначеные <span class="remark">*</span> есть обязательными </small>
            </div>
        </div>

        <form id="form" class="form-horizontal" >

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">Имя<span class="remark">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="firstname" class="form-control check" id="firstname" placeholder="Введите имя" maxlength="25" />
                </div>
            </div>


            <div class="col-sm-10 col-sm-offset-2">
                <small class="remark" >Email не будет опубликован </small>
            </div>


            <div class="form-group ">
                 <label for="emailcontact" class="col-sm-2 control-label">Email <span class="remark">*</span></label>
                 <div class="col-sm-8">
                     <input type = "email" name="emailcontact" class="form-control check" id="emailcontact" placeholder="Email" maxlength="25" />
                </div>
            </div>


            <div class="col-sm-10 col-sm-offset-2">
                     <small> Можете использовать множество разных тегов </small>
            </div>

            <div class="form-group ">
                <label for="comment" class="col-sm-2 control-label">Коментарий <span class="remark">*</span></label>
                 <div class="col-sm-8">
                      <textarea  name="comment" id="comment" class="form-control check" rows="3" placeholder="Введите Ваш коментарий"></textarea>
                 </div>
            </div>

             <div class="form-group">
                  <label for="changekcaptcha" class="col-sm-2 control-label"><small>Кликните чтобы обновить капчу</small></label>
                 <div class="col-sm-4">
                    <div  id="changekcaptcha"><img src="<?php echo URL ?>lib/kcaptcha/index.php?<?php echo session_name()?>=<?php echo session_id()?>">
                    </div>
                 </div>
            </div>

            <div class="form-group ">
                <label for="kcaptcha" class="col-sm-2 control-label"><small>Введите капчу <span class="remark">*</span></small></label>
                <div class="col-sm-2">
                     <input type="text" name="kcaptcha" class="form-control check" id="kcaptcha"/><span></span>
                 </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">

                     <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg" id="buttonpreview">Предпросмотр</button>
                     <button type="submit" class="btn btn-success" id="add_comment">Добавить коментарий</button>
                </div>
            </div>
        </form>
	
   </fieldset> 
  
</section><!-- for_form-->