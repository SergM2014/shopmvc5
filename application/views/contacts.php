<div id="message_box"></div>

<div class="row">
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li class="active">Контакты</li>
		<div  id="cart_res"  class="pull-right"><img src="img/korzina.jpg" > 
		<a href="#" id="show_busket" data-toggle="modal" data-target=".bs-example-modal-lg" >Корзина</a>&nbsp;&nbsp;&nbsp;Количество товара:<span><?php echo (!$_SESSION['total_items']) ? 0: $_SESSION['total_items']  ?></span
		>&nbsp;&nbsp;&nbsp;На сумму:<span><?php echo (!$_SESSION['total_price']) ?  0 :  $_SESSION['total_price']  ?>грн</span></div><!--cart_res-->
	</ol>
</div>



<button type="button" id="write" class="btn btn-info pull-left">Написать нам</button>



<section id="feedback">
    <button type="button"  class="btn btn-primary" id="find_on_map" >Найти нас на карте</button>
    <h1 class="text-center">Обратная связь</h1>

    <fieldset>
		
		<form id="contacts" class="form-horizontal">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
						 <small> Поля отмеченые есть <span class="remark">*</span> обязательными </small>
				</div>
			</div>


			<div class="form-group  <?php if($error['firstname']){ ?> has-error <?php }; ?>">
			    <label for="firstname" class="col-sm-2 control-label">Введите Ваше Имя <span class="remark">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="firstname" class="form-control check" id="firstname" placeholder="Введите Ваше имя" maxlength="35" required />
                    </div>
			</div>

			<div class="form-group  <?php if($error['noemail']){ ?> has-error <?php }; ?> ">
				 <label for="emailcontact" class="col-sm-2 control-label">Email <span class="remark">*</span></label>
                     <div class="col-sm-8">
                         <input type = "email" name="emailcontact" class="form-control check" id="emailcontact" placeholder="Email" maxlength="25"  required />
                    </div>
			 </div>

			<div class="form-group <?php if($error['wishescontact']){ ?> has-error <?php }; ?> ">
				<label for="wishescontact" class="col-sm-2 control-label">Ваши пожелания <span class="remark">*</span></label>
					 <div class="col-sm-8">
						  <textarea  name="wishescontact" id="wishescontact" class="form-control check" rows="3" placeholder="Ваши пожелания" required></textarea>
					 </div>
			</div>

			 <div class="form-group ">	
				  <label for="changekcaptcha" class="col-sm-2 control-label"><small>Чтобы обновить кликните по капче</small></label>
					 <div class="col-sm-4">
						<div  id="changekcaptcha"><img src="<?php echo URL ?>lib/kcaptcha/index.php?<?php echo session_name()?>=<?php echo session_id()?>">
						</div>
					 </div>	 
			</div>

			<div class="form-group <?php if($error['kcaptcha']){ ?> has-error <?php }; ?> ">
				<label for="kcaptcha" class="col-sm-2 control-label"><small>Введите капчу <span class="remark">*</span></small></label>
					<div class="col-sm-2">
						 <input type="text" name="kcaptcha" class="form-control check" maxlength="8" id="kcaptcha" required />
				 </div>	 
			</div>	 

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					 <button type="submit" class="btn btn-success" id="sendmessage">Отправить письмо</button>
				</div>
			</div>
		</form>
	
	</fieldset>

</section><!--feedback-->


<div id="for_map" class="col-sm-8 col-sm-offset-2" <?php if(isset($massage['message'])) { ?>style="display:none;" <?php } ?>>
    <h3 class="text-center">  Наши координаты город почти герой Ржищив</h3>
    <div id="mymap" >
        <script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=J2uSrxXUvnKQ0xMHsSnB1kTC5uYC4Upq&width=600&height=450"></script>
    </div>
</div><!--for_map"-->
<div class="clearfix"></div>

