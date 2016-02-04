
    <section id="show_carousel">
			<h1 class="text-center"> Просмотр карусели </h1>
			
				<a href="<?php echo URL ?>admin/carousel/addcarousel" id="add_good" class="pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Добавить єлемент карусели</a> 
				
		<div class="clearfix"></div>

		<div class="table-responsive">
			 <table class="table table-striped">
				<tr>
					<th>Id</th>
                    <th>Илюстрация</th>
					<th>URL</th>
					<th colspan="2"></th>
				</tr>

			<?php foreach($carousel as $value): ?>
				<tr id="line<?php echo $value['id'] ?>">
					<td ><?php echo $value['id']  ?></td>
					<td align="center"><?php if($value['image']) :?> <img src="/../../uploads/carousel/<?php echo $value['image'] ?>" onerror="this.style.display='none'"><?php endif; ?></td>
					<td ><?php echo $value['url']  ?></td>

					<td><a class="btn btn-default" href="/admin/carousel/editecarousel?id=<?php  echo $value['id'] ?>" role="button">Редактировать</a></td>
					<td><button data-carousel_delete="<?php  echo $value['id'] ?>"> Удалить</button></td>

				</tr>

			<?php endforeach;  ?>

			</table>
		</div>

		<?php if(!$carousel) :?>
		<h1 class="text-center">За Вашим запросом ничего не найдено</h1>
		<?php endif; ?>
		
    </section><!--show_carousel-->
