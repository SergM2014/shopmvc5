		<section id="show_goods">
			<h2 class="text-center"> Просмотр списка единиц товара </h2>
			
				<a href="<?php echo URL ?>admin/products/addproduct" class="pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Добавить товар</a>

		<div class="clearfix"></div>

		<div class="table-responsive ">
			 <table class="table table-striped">
				<tr>
					<th>Id</th>
                    <th>Илюстрация</br>
					<select  id="get_picture" size="1" >
					<option selected value=""></option>
					<option value="with_picture">с илюстрациями </option>
					<option value="without_picture">без илюстраций </option>
					</select>
                    </th>
					
					<th>Автор</br>
					<select  id="get_author" size="1" >
					<option selected value=""></option>
					<option value="author_abc">по aлфавиту </option>
					<option value="author_cba">против алфавита </option>
					</select>
					</th>
					
					<th>Назва</br>
					<select  id="get_title" size="1">
					<option selected value=""></option>
					<option value="title_abc">по aлфавиту </option>
					<option value="title_cba">против алфавита </option>
					</th>
					
					<th>Категория</br>
					<select  id="category_id" size="1"> 
					<option selected value=""> Выбрать все категории
					<option  value="0"> Без категории
					<?php echo $mod4 ?>
					</select>
					
					</th>
					<th>Производитель<br>
					<select  id="manufacturer_id" size="1">
					<option selected value="">Выбрать всех
					<option value="0">Не указан
					<?php echo $mod5 ?>
					</select>
					</th>
					
					<th>Цена</br>
					<select  id="get_price" size="1">
					<option selected value=""></option>
					<option value="price_abc">по возрастанию </option>
					<option value="price_cba"> по убыванию </option>
					</select>
					</th>
					
					<th colspan="2">   <button type="button" id="make_choise" class="btn btn-warning btn-block">=> Сделать выбор</button></th>
				</tr>

			<?php foreach($mod1 as $value): 
			
			
			
			?>
				<tr id="line<?php echo $value['id'] ?>">
					<td ><?php echo $value['id']  ?></td>
					<td align="center"><?php if($value['images'][0]) :?> <img src="/../../uploads/thumbnail/<?php echo $value['images'][0] ?>" onerror="this.style.display='none'"><?php endif; ?></td>
					<td ><?php echo $value['author']  ?></td>
					<td ><?php echo $value['title']  ?></td>
					<td><?php echo $value['cat_title']  ?></td>
					<td><?php echo $value['manufacturer_title']  ?></td>
					<td ><?php echo $value['price']  ?></td>
					<td><a class="btn btn-default" href="/admin/products/editeproduct?id=<?php  echo $value['id'] ?>" role="button">Редактировать</a></td>
					<td><a class="btn btn-default" href="#" data-good_delete="<?php  echo $value['id'] ?>" data-good_title="<?php echo $value['title'] ?>"> Удалить</a></td>

				</tr>

			<?php endforeach;  ?>

			</table>
		</div><!--table-responsive-->


	<?php	if($mod2>1): 
		
		$page= (!isset($_POST['page'])) ? 1: $_POST['page'];
		
		?>
		<nav  class="col-sm-4 col-sm-offset-4">

             <ul class="pagination pagination-products" >

                <?php if($_POST['page']>1) : ?>
                 <li><a href="#" aria-label="Previous" data-page="1" data-order="<?php echo $_POST['order'] ?>"
                data-manufacturer_id="<?php echo $_POST['manufacturer_id'] ?>"  data-category_id="<?php echo $_POST['category_id'] ?>"
                data-picture="<?php echo $_POST['picture'] ?>"><span aria-hidden="true">&laquo;&laquo; 1</span> </a> </li>

                 <li><a href="#" aria-label="Previous" data-page="<?php echo($page-1) ?>" data-order="<?php echo $_POST['order'] ?>"
                data-manufacturer_id="<?php echo $_POST['manufacturer_id'] ?>"  data-category_id="<?php echo $_POST['category_id'] ?>"
                data-picture="<?php echo $_POST['picture'] ?>"><span aria-hidden="true">назад</span> </a> </li>

                <?php endif; ?>


                <?php
                $before=false;
                $after=false;
                for($i=1; $i<=$mod2; $i++) {

                    if($before==false){if($i<($_POST['page']-5) && $_POST['page']>1){?> <li class="disabled" ><a href="#">...</a></li> <?php  ; $before=true;}}

                    if($i>($_POST['page']-5) && $i<($_POST['page']+5) ){
                        ?> <li <?php if($_POST['page']== $i) echo 'class="active"'; ?>>
                        <a  href="#" data-page="<?php echo $i ?>" data-order="<?php echo $_POST['order'] ?>"
                        data-manufacturer_id="<?php echo $_POST['manufacturer_id'] ?>"  data-category_id="<?php echo $_POST['category_id'] ?>"
                        data-picture="<?php echo $_POST['picture'] ?>"
                        ><?php echo $i ?></a></li> <?php
                        }
                    if($after==false){if($i>($_POST['page']+5) && $_POST['page']<$mod2){?>  <li class="disabled"><a href="#">...</a></li> <?php  ; $after=true;}}

                } ?>


                <?php if($_POST['page']<$mod2): ?>
                <li> <a href="#" aria-label="Next" data-page="<?php echo ($page+1) ?>" data-order="<?php echo $_POST['order'] ?>"
                data-manufacturer_id="<?php echo $_POST['manufacturer_id'] ?>"  data-category_id="<?php echo $_POST['category_id'] ?>"
                data-picture="<?php echo $_POST['picture'] ?>"> <span aria-hidden="true">вперед</span></a></li>

                <li> <a href="#" aria-label="Next"data-page="<?php echo $mod2 ?>" data-order="<?php echo $_POST['order'] ?>"
                data-manufacturer_id="<?php echo $_POST['manufacturer_id'] ?>"  data-category_id="<?php echo $_POST['category_id'] ?>"
                data-picture="<?php echo $_POST['picture'] ?>"> <span aria-hidden="true"><?php echo $mod2 ?> &raquo;&raquo;</span></a></li>
                <?php endif; ?>

            </ul>
        </nav>

		<?php  endif; ?>
		<?php if(!$mod1) :?>
		<h2 class="text-center">За Вашим запросом ничего не найдено</h2>
		<?php endif; ?>
		
</section><!--show_goods-->