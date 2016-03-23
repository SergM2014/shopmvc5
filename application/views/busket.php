
<?php 
 if(isset($success)) : ?>
<h1 class="bg-success text-center">Спасибо за заказ мы свяжемся с вами в течении 10 минут!</h1>

<?php else: ?>

<section id="busket"<?php if(isset($_POST['order']) ): ?>style="display:none"<?php endif; ?>>

	<?php if($_SESSION['cart']): ?>
	<h2 class="text-center">Корзина</h2>
	<!-- <form  method="post" action="/updateCart/">-->
	<form id="up_form" class="clearfix">
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
				<tr>
				<th>Автор</th>
				<th>Товар</th>
				<th>Цена товара</th>
				<th>К-во</th>
				<th>Сумма</th>
				</tr>
				</thead>
				
				<tbody>
				<?php
				$model=new Application_Models_Product;
				$model->show($_SESSION['cart']);
				?>
				<tr>
				<th></th>
				<th></th>
				<th></th>
				<th class="remark">Итого:</th>
				<th class="remark"><?php echo $_SESSION['total_price'] ?> грн</th>
				
				</tr>
				</tbody>
			</table>
		</div>
	
	 <button type="button" id="up_cart" class="btn btn-info pull-right">Обновить корзину</button>
	</form>

	<button type="button" id="order" class="btn btn-success">+Оформить заказ</button>

	<?php else: ?> <h2 class="text-center">Корзина пуста</h2> <?php endif; ?>

</section><!--busket-->



	
	

<section id="order1" <?php if(isset($_POST['order']) ): ?>style="display:block"<?php endif; ?> >

	<button type="button" id="order2" class="btn btn-danger">Закрыть форму заказ</button>

    <fieldset>

        <form id="form" class="form-horizontal">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                         <small> Поля отмеченые есть <span class="remark">*</span> обязательными </small>
                </div>
            </div>

            <div class="form-group">
            <label for="lastame" class="col-sm-2 control-label">Введите Вашу фамилию</label>
                <div class="col-sm-8">
                    <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Введите Вашу фамилию" maxlength="30" value="<?php if(isset($order['lastname'])) echo $order['lastname']; ?>"/>
                </div>
            </div>

            <div class="form-group  <?php if(isset($error['firstname'])) echo 'has-error'; ?>">
            <label for="firstname" class="col-sm-2 control-label">Введите Ваше Имя <span class="remark">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="firstname" class="form-control check" id="firstname" placeholder="Введите Ваше имя" maxlength="30" value="<?php if(isset($order['firstname'])) echo $order['firstname']; ?>" required />
                </div>
            </div>

            <div class="form-group">
            <label for="secondame" class="col-sm-2 control-label">Введите Ваше отчество</label>
                <div class="col-sm-8">
                    <input type="text" name="secondname" class="form-control" id="secondename" placeholder="Введите Ваше отчество" maxlength="30" value="<?php if(isset($order['secondname'])) echo $order['secondname']; ?>"/>
                </div>
            </div>

            <div class="form-group">
                 <label for="email" class="col-sm-2 control-label">Email </label>
                         <div class="col-sm-8">
                             <input type = "email" name="email" class="form-control" id="email" placeholder="Email" maxlength="25" value="<?php if(isset($order['email'])) echo $order['email']; ?>"/>
                        </div>
             </div>

            <div class="form-group  <?php if(isset($error['phone'])) echo 'has-error'; ?>">
            <label for="phone" class="col-sm-2 control-label">Введите Ваш телефон<span class="remark">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="phone" class="form-control check" id="phone" placeholder="Введите Ваш телефон" maxlength="15" value="<?php if(isset($order['phone'])) echo $order['phone']; ?>" required />
                </div>
            </div>



            <div class="form-group">
            <label for="adress" class="col-sm-2 control-label">Введите адресс доставки</label>
                <div class="col-sm-8">
                        <textarea  name="adress" id="adress" class="form-control" rows="3" placeholder="Введите адрес доставки"><?php if(isset($order['adress'])) echo $order['adress']; ?></textarea>
                </div>
            </div>

            <div class="form-group ">
                <label for="wishes" class="col-sm-2 control-label">Ваши пожелания</label>
                     <div class="col-sm-8">
                          <textarea  name="wishes" id="wishes" class="form-control" rows="3" placeholder="Ваши пожелания"><?php if(isset($order['wishes'])) echo $order['wishes']; ?></textarea>
                     </div>
            </div>

             <div class="form-group">
                  <label for="changekcaptcha" class="col-sm-2 control-label"><small>Чтобы обновить кликните по капче</small></label>
                     <div class="col-sm-4">
                        <div  id="changekcaptcha"><img src="<?php echo URL ?>lib/kcaptcha/index.php?<?php echo session_name()?>=<?php echo session_id()?>">
                        </div>
                     </div>
            </div>

            <div class="form-group  <?php if(isset($error['kcaptcha'])) echo 'has-error'; ?>">
                <label for="kcaptcha" class="col-sm-2 control-label"><small>Введите капчу <span class="remark">*</span></small></label>
                    <div class="col-sm-2">
                         <input type="text" name="kcaptcha" class="form-control check" maxlength="8" id="kcaptcha" required />
                 </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">


                     <button type="submit" class="btn btn-success" id="validateButton">Сделать заказ</button>
                </div>
            </div>
        </form>

    </fieldset>

</section> <!-- order1-->
<?php endif; ?>	

