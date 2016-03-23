<?php
     include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
    
	session_start();

     if(isset($_POST['order'])) {$order=$_POST['order'];} else {$order= 'data';}
     if(!isset($_POST['page'])){$page=1;} else {$page=$_POST['page'];}

     $model= new Application_Models_Product;
     $res=$model->getComments($_SESSION['id'],$order, $page);
     $number=$model->getNumber($_SESSION['id']);

     if(!empty($res)): 
	 
	 if (!isset($_POST['order']) && !isset($_POST['page'])) :
	 ?>
      	 <div id="radio">
             <b>сортировать по </b></br>
  
             <input  type="radio" name="radio" value="date"  checked="checked" >по дате
             <input  type="radio" name="radio" value="name">по имени
             <input  type="radio" name="radio" value="email">email
         </div><!--radio-->
         <div id="view">
       <?php endif;

			 foreach ($res as $val):
             ?> <div  class="clearfix"> <?php
                 if ($val['picture'] ==true): ?> <img src="<?php echo URL.'uploads/comments/'.$val['picture'] ; ?>" class="pull-left"/><?php endif; ?>
                 <p><?php echo $val['name']; ?></p>
                 <p><strong> Коментарий : </strong><?php echo htmlspecialchars_decode($val['comments'], ENT_QUOTES); ?></p>
                  <p><?php echo Language::rus_date("H:i j F Y ",  $val['date']); ?></p>
	    
             </div><!--clearfix-->


     <?php endforeach;

	 if($number > 1):?>
	   
	 
	              <div class="row">
				        <nav class="col-sm-4 col-sm-offset-4">

                                 <ul class="pagination">

                                    <?php if($page>1) : ?>
                                     <li><span data-page="1" aria-label="Previous"><span aria-hidden="true">&laquo;&laquo;</span>  </li>
                                     <li><span  data-page="<?php echo $page-1 ?>"aria-label="Previous"><span aria-hidden="true">&laquo;</span>  </li>

                                    <?php endif; ?>

                                    <?php for($i=1; $i<=$number; $i++) { ?> <li <?php if(!isset($page) and $i==1 or $page== $i) echo 'class="active"' ?>><span  data-page="<?php echo $i ?>" ><?php echo $i ?></span></li> <?php } ?>

                                    <?php if($page<$number): ?>
                                    <li> <span data-page="<?php echo $page+1 ?>" aria-label="Next"> <span aria-hidden="true">&raquo;</span></li>
                                    <li> <span  data-page="<?php echo $number ?>" aria-label="Next"> <span aria-hidden="true">&raquo;&raquo;</span></li>
                                    <?php endif; ?>

                                </ul>
                            </nav>

		         </div><!--row-->
		   
		  
	     <?php endif;
         if (!isset($_POST['order']) && !isset($_POST['page'])) :     ?>  </div><!-- view--> <?php endif;
	  else: ?>
	 <h3 class="text-center">Ишо нихто ничего не наваял Вы можете быть первыми !</h3>
     
<?php endif; ?>