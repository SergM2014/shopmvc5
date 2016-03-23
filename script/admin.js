    //alert function
function bs_indication(specialclass, text){
	$('.container').find('.alert').remove();
	$('.container').prepend('<div class="alert alert-'+specialclass+'"> <span class="close" data-dismiss="alert">×</span><h4 class="text-center">'+text+'</h4></div>');
	$('.container').find('.alert').css({'top':'170px', 'position':'fixed', 'width':$('.container').width()+'px','z-index':'1000'  });
	}
 
 
 $(document).ready(function(){
    // check if html is lower then window
    if($('html').height()< $(window).height()) {$('html').height('100%'); }

    //custom form validation
    function validateForm(form){
    var inputs=form.find('.form-control');
    valid= true;
    inputs.tooltip('destroy');

     $.each(inputs, function(index, val){

                       var input =$(val),//отрымуем обьект
                       val= input.val(),//выбираем з нього val
                       formGroup= input.parents('.form-group'),
                       label =formGroup.find('titel').text().toLowerCase(),
                       textError=label;

                      if(val.length===0){
                          formGroup.addClass('has-error').removeClass('has-success');
                          input.tooltip({
                                         trigger:'manual',
                                         placement:'bottom',
                                         title:textError
                                        }).tooltip('show');
                          valid= false;
                       }else{
                             formGroup.addClass('has-success').removeClass('has-error');
                            }
                       });
    return valid;
	 }

     //input form will be cleaned from error-classes
     $('#admincontent').on('keydown', '.form-control', function (){
                      $(this).tooltip('destroy').parents('.form-group').removeClass('has-error');
                       }
            );
				  

	
		//вывод меню*******************
	//*****************************
	//output of the context menu at click on the category tree item
	$('#admincontent').on("click",'a[rel=CategoryTree]', function(){
			var id=$(this).data('id');
			var title=$(this).text();
			var parent_id=$(this).data('parent_id');

			var offset1=$(this).offset();
			var top=Math.round(offset1.top)+15;
			var left=Math.round(offset1.left);

			$.post(
			'/admin/ajax/contextmenu.php/',
			{id:id, title:title, parent_id:parent_id,categories: true},
			function(data){
				$('#contextMenu').css('position','absolute');
				$('#contextMenu').html(data).show();
				});
			
			if((122 +top )> $('.container').height()){

                top=$('.container').height()-122;
                }
			$('#contextMenu').css({'top': top+'px','left':left+100+'px'});
		});
		
		
	//hide the context menu at the click out off container
	$(document).click(function(e){
		 var elem = $("#contextMenu"); if(e.target!=elem[0]&&!elem.has(e.target).length){ elem.hide(''); } 
		})			

	
    $('#contextMenu').on("click",'a[rel=delete_category]', function(){
				var res=confirm("Уверены, что хотите категорию?");
				if(!res){return false;}

				var id=$(this).data('delete');
				$('#contextMenu').hide().html('');
				$.ajax({
					url:'/admin/categories/deletecat/',
					method:'POST',
					dataType: 'json',
					data:{ajax:1,id_cat_delete:id},
					success: function (data){
						     if(data.success){
						    $('#admincontent').find('[data-id="'+id+'"]').closest('li').remove();
							
						      }
						  bs_indication(data.status ,data.msg);
						  
				      }
				    })
				});
				
			
	$("#admincontent").on("click","#add_main_cat",function(){
		$("#show_category").hide();
		$("#add_category_form").show();	
		});
	
	
	$("#admincontent").on("click","#add_category_submit",function(e){
		e.preventDefault();
        var create_category=$("#new_category").val();
			
        if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
			
          $.ajax({
                url:'/admin/categories/addmain/',
                method:'POST',
                dataType: 'json',
                data:{ajax:1, create_category:create_category},
                success: function(data){
                  $.post(
                    '/admin/categories/index/',
                    {ajax:1},
                    function(data){
                        $("#admincontent").html(data);
                    })

                    bs_indication(data.status, data.msg);
                     }
            });
		
	});
	

	$('#contextMenu').on("click",'a[rel=creat_new_category]', function(){
		$('#contextMenu').hide();
		var parent_id=$(this).data('id');
			
			 $.ajax({
               url:'/admin/categories/addnewsubcat/',
			   method:'POST',
			   data: {ajax:1, parent_id:parent_id},
                success: function(data){
                 $('#admincontent').html(data);
                }				
	         })
	
	});
	
	
	//sendin post data to create sucategoru

	$("#admincontent").on("click","#add_sub_category_submit",function(e){
	    e.preventDefault();
		var id=$('#parent_id').val();
		var create_sub_category=$("#new_sub_category").val();
		var parent_id=$("#parent_id").val();
		 if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;

	
		  $.ajax({
			url:'/admin/categories/add_sub_category/',
			method: 'POST',
			dataType: 'json',
			data:{ajax:1, create_sub_category:create_sub_category,parent_id:parent_id},
			success: function(data){
				 $.ajax({
					   url:'/admin/categories/index/',
					   method:'POST',
					   data: {ajax:1},
						success: function(data){
						 $('#admincontent').html(data);
						}				
					 })

	            $("#add_new_subcat").hide();	
			    $("#show_category").show();			
			
		        bs_indication(data.status ,data.msg);                 
				}
		})
		
	})
			
	
	$('#contextMenu').on("click",'a[rel=edit_category]', function(){
		  $('#contextMenu').hide();
		   var id=$(this).data('id');
		   
			$.post(
			 '/admin/categories/edit_sub_category/',
			 {ajax:1,id_cat_edit:id},
			function(data){
			$("#admincontent").html(data);	
			})
	});
	
	
	$("#admincontent").on("click","#update_sub_category",function(e){
	    e.preventDefault();
		var title=$("#upsubtitle").val();
		var parent_id=$("#parent_id").val();
		
		var id=$("#id").val();
		
		 if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
			$.ajax({
			url:'/admin/categories/updatecategory/',
			method: 'POST',
			dataType:'json',
			data:{ajax:1,uptitle:title, upparent_id:parent_id,id:id},
			success: function(data){
			
				  $.post(
					'/admin/categories/index/',
					{ajax:1},
					function(data){
					$("#admincontent").html(data);
					
					
					})
			bs_indication(data.status, data.msg);					
				}
			})
	});
	
	
	$('#contextMenu').on("click",'a[rel=cansel_context]', function(){$('#contextMenu').hide();});
	
	//конец редактирования категорий
	//**************************************************************************************************************
	//*************************************************************************************************************
	
	
	

	
		$('#admincontent').on("click",'a[rel=ManufacturerTree]', function(){
			var id=$(this).data('id');
			var title=$(this).text();
			var parent_id=$(this).data('parent_id');

			var offset1=$(this).offset();
			var top=Math.round(offset1.top)+15;
			var left=Math.round(offset1.left);


			$.post(
			'/admin/ajax/contextmenu.php/',
			{id:id, title:title, parent_id:parent_id,manufacturers: true},
			function(data){
			
				$('#contextMenu').css('position','absolute');
				if(($('#contextMenu').height() +top )> $('.container').height()){
				top=$('.container').height()-$('#contextMenu').height();
				}
				
				$('#contextMenu').css({'top': top+'px','left':left+125+'px'});
				$('#contextMenu').html(data).show();
			})
		});
		
		
	
		$("#admincontent").on("click","#add_manufacturer",function(){	
		$("#show_manufacturer").hide();
		$("#add_manufacturer_form").show();	
		});
	
	
	
		$("#admincontent").on("click","#add_manufacturer_submit",function(e){
			e.preventDefault();
	
	           if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
	
			var create_manufacturer=$("#new_manufacturer").val();
			
			$.ajax({
               url:'/admin/manufacturers/addmanufacturer/',
			   method:'POST',
			   dataType: 'json',
			   data: {ajax:1, create_manufacturer:create_manufacturer},
               success: function(data){
				  $.post(
						'/admin/manufacturers/index/',
						{ajax:1},
						function(data){
						$("#admincontent").html(data);
					})

				 	bs_indication(data.status, data.msg);
                }				
	         })
		
		});
	
	
	
	$('#contextMenu').on("click",'a[rel=delete_manufacturer]', function(){
		
			var res=confirm("Уверены, что хотите производителя?");
			if(!res){return false;}	
			
			var id=$(this).data('delete');
			$('#contextMenu').hide();
			$.ajax({
				url:'/admin/manufacturers/deletemanufacturer/',
				method: 'POST',
				dataType: 'json',
				data:{ajax:1,id_manufacturer_delete:id},
				success: function (data){

						 if(data.status=="success"){
							$('#admincontent').find('[data-id="'+id+'"]').closest('li').remove();
						  }
					  
					  bs_indication(data.status, data.msg);
				  }
				})
			});
			
				
	$('#contextMenu').on("click",'a[rel=edit_manufacturer]', function(){
	   $('#contextMenu').hide();
	   var id=$(this).data('id');
	   
		$.post(
		 '/admin/manufacturers/edit_manufacturer',
		 {ajax:1,id_manufacturer_edit:id},
		  function(data){
		 $("#admincontent").html(data);	
		 })
	});
	
	
	
	$("#admincontent").on("click","#update_manufacturer_sub",function(e){
	    e.preventDefault();
		
		if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
		 
		var title=$("#upmanufacturer").val();
		
		var id=$("#id").val();
		
		
		$.ajax({
			url:'/admin/manufacturers/update_manufacturer/',
			method: 'POST',
			dataType: 'json',
			data:{ajax:1,upmanufacturer:title,id:id},
			success: function(data){
				if(data.status =="success"){
					  $.post(
							'/admin/manufacturers/index/',
							{ajax:1},
							function(data){
							$("#admincontent").html(data);
							})	
						}
				 bs_indication(data.status, data.msg);		
				}
		
		 })

	});			
	//конец с производителями*******************************
//*********************************************************************************	
	

	

	
	$('#admincontent').on('click','#get_author option', function(){
		$('#admincontent').find('#get_title').val('');
		$('#admincontent').find('#get_price').val('');
	})
	
	$('#admincontent').on('click','#get_title option', function(){
		$('#admincontent').find('#get_author').val('');
		$('#admincontent').find('#get_price').val('');
	})
	
	$('#admincontent').on('click','#get_price option', function(){
		$('#admincontent').find('#get_title').val('');
		$('#admincontent').find('#get_author').val('');
	})
	
	
    $('#admincontent').on('click','#make_choise', function(){
		var author=$('#get_author').val();
		var title= $('#get_title').val();
		var price= $('#get_price').val();
		var category_id=$('#category_id').val();
		var manufacturer_id=$('#manufacturer_id').val();
		var picture=$('#get_picture').val();
		
		if(author) var order= author;
		if(title) var order=title;
		if(price) var order= price;
	   
		
		
		$.ajax({
				   url:'/admin/products/index/',
				   method:'POST',
				   data: {ajax:1,order:order, category_id:category_id, manufacturer_id:manufacturer_id,picture:picture},
					success: function(data){
					 $('#admincontent').html(data);
					}				
				 })

    })

	$('#admincontent').on('click','.pagination-products a', function(){
		var order=$(this).data('order');
		var manufacturer_id=$(this).data('manufacturer_id');
		var category_id=$(this).data('category_id');
		var picture=$(this).data('picture');
		var page= $(this).data('page');
		
			$.ajax({
				   url:'/admin/products/index/',
				   method:'POST',
				   data: {ajax:1,order:order, category_id:category_id, manufacturer_id:manufacturer_id,picture:picture, page:page},
					success: function(data){
					 $('#admincontent').html(data);
					}				
				 })
	});

	
	
   $('#admincontent').on('click', '#add_new_product', function(e){
	   e.preventDefault();
	   
	   if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
	   
	   var img_array= new Array();
	   $(".preview a").each(function(){img_array.push($(this).attr("title"))})

	   
	   var str=$('.form-horizontal').serialize();
	 
		str+='&pictures='+img_array;
		 $.ajax({
			url:'/admin/products/savenewproduct/',
			method:'POST',
			dataType: 'json',
			data: {str:str, img_array:img_array},
			success: function(data){
				if(data.status=="success"){
						$.ajax({
							url:'/admin/products/index/',
							method: 'POST',
							data:{ajax:1},
							success: function(data){
							$('#admincontent').html(data);
							}
						})
					}
					
					
					bs_indication(data.status, data.msg)
					}		
		 })

   });

    $('#admincontent').on('click', '[data-good_delete]', function(){
		var res=confirm("Уверены, что хотите единицу товара?");
		if(!res){return false;}	
	
	    var id=$(this).data('good_delete');
		     $.ajax({
				url:'/admin/products/deleteproduct/',
				method:'POST',
				dataType: 'json',
				data: {id:id},
				success: function(data){
				 
						if(data.status== "success"){
						$('#line'+id).hide();
						
						 bs_indication(data.status,data.msg)
						 }
						}
				})
	})


	$('#admincontent').on('click', '#edit_product', function(e){
		   e.preventDefault();
	 //  var img_array= new Array();
        var img_array=[];
	  
		 $(".name a").each(function(){img_array.push($(this).attr("title"))})
	   
	   var str=$('.form-horizontal').serialize();
	 
		str+='&ajax=1&pictures='+img_array;

		$.ajax({
			url:'/admin/products/saveeditedproduct/',
			method:'POST',
			dataType: 'json',
			data: {str:str},
			
			success: function(data){
				if(data.status == "success"){
					$.ajax({
						url:'/admin/products/index/',
						method: 'POST',
						data:{ajax:1},
						success: function(data){
						$('#admincontent').html(data);
						}
					})
					}
					bs_indication(data.status, data.msg)
					}
			})
 
    })
		

		
	//progressbar indicator	
   

	function progressHandler(event){

		var percent=Math.round((event.loaded/event.total)*100);
		$('.progress-bar').attr('aria-valuenow',percent).width(percent+"%").text(percent+"%");
		}
		
	function completeHandler(event){
		
		$('#output').html(event.target.responseText);
		$(".progress-bar").attr('aria-valuenow', 0).width("0%").text("0%");
		
		$('#output').show(); //hide submit button
		$('#submit-btn').hide(); //hide submit button
		
		
		$('.progress').delay( 1000 ).fadeOut(); //hide progress bar
		}
		
	function errorHandler(event){
		
		$('#output').text('Upload Failed');
		}
		
	function abortHandler(event){
		
		$('#output').text('UPLOAD ABORTED');
		}	
		
		
		$('#admincontent').on('click', '#submit-btn', function(){
		var folder=$(this).data('folder');
		$('.progress').show();
		 $('#FileInput').hide();
		var file=document.getElementById("FileInput").files[0];

		var formdata= new FormData();

		formdata.append("FileInput", file);
		
		var ajax=new XMLHttpRequest();
		ajax.upload.addEventListener("progress", progressHandler, false);
		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);
	
		ajax.open("POST", "/admin/ajax/upload.php?folder="+folder);
		ajax.send(formdata);
		});
		
	
	$('#admincontent').on('change', '#FileInput', function(){
	
	  var input = $(this)[0];
	  if ( input.files && input.files[0] ) {
		if ( input.files[0].type.match('image.*') ) {
		  var reader = new FileReader();
		  reader.onload = function(e) { $('#image_preview').attr('src', e.target.result); }
		  reader.readAsDataURL(input.files[0]);
		  $('#output').hide();
		  $('#reset-btn').show();
		  $('#FileInput').hide();
		
		  $('#submit-btn').show();
		}// else console.log('is not image mime type');
	  }// else console.log('not isset files data or files API not supordet');
	});
	
	
	$('#admincontent').on('click','#reset-btn',function(){
		var folder=$(this).data('folder');
		$('#image_preview').attr('src','');
		$('#FileInput').show();
		 $.ajax({
             
			   url:'/admin/'+folder+'/deleteimage/',
			   method:'POST',
			   data: {ajax:1},
               	success: function (data){
                 $('#output').html(data);

				}				
	
	         });
			 
		$('#submit-btn').hide();
		$(this).hide();
		$('#FileInput').show();
	});
	//end of the image upload



	
	$('#admincontent').on('click', '#add_new_carousel', function(e){
		   e.preventDefault();
	 if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
			
     var url=$('#url').val();
	   $.ajax({
	     url:'admin/carousel/addnewcarousel/',
		 method:'POST',
		 dataType: 'json',
		 data:{ajax:1, url:url},
		success: function(data){
			if(data.status=="success"){
					$.ajax({
						url:'/admin/carousel/index/',
						method: 'POST',
						data:{ajax:1},
						success: function(data){
						$('#admincontent').html(data);
						}
					})
				}
					 bs_indication(data.status, data.msg);
					
					}

	   })
    })

	
	    $('#admincontent').on('click', '[data-carousel_delete]', function(){
			var res=confirm("Уверены, что хотите удалить элемент карусели?");
			if(!res){return false;}	

			var id=$(this).data('carousel_delete');
			 $.ajax({
				url:'/admin/carousel/deletecarousel/',
				method:'POST',
				dataType: 'json',
				data: {id:id},
				success: function(data){
				
					if(data.status== "success"){$('#line'+id).hide();}
					bs_indication(data.status, data.msg);			 
						}		
		 })
	})
	
		$('#admincontent').on('click', '#sub_edited_carousel', function(e){
			   e.preventDefault();
			if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
				
			 var id=$(this).data('id');		
			 var url=$('#url').val();
			 var src= $('#image_preview').attr('src');
			 src=src.split('/');
			 var img= src[5];
			
			 src=src[4];
			 
		   $.ajax({
			 url:'admin/carousel/updatecarousel/',
			 method:'POST',
			 dataType:'json',
			 data:{ajax:1, url:url, id:id, src:src, img:img},
			 success: function(data){	
				if(data.status=='success'){
						$.ajax({
							url:'/admin/carousel/index/',
							method: 'POST',
							data:{ajax:1},
							success: function(data){
							$('#admincontent').html(data);
							}
						})
					}
					 bs_indication(data.status, data.msg);
						
						}

		   })
		})
	


			 
	
	$('#admincontent').on('click', '#add_new_slider', function(e){
		   e.preventDefault();
	 if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
			
		var url=$('#url').val();
		var response;
	    $.ajax({
	     url:'admin/slider/addnewslider/',
		 method:'POST',
		 dataType: 'json',
		 data:{ajax:1, url:url},
			success: function(data){

				console.log(data.status);
				console.log(data.msg);
				 bs_indication(data.status, data.msg);
				if(data.status== "success"){
						$.ajax({
							url:'/admin/slider/index/',
							method: 'POST',
							data:{ajax:1},
							success: function(data){
							$('#admincontent').html(data);
							}
						})
						}
			}
	    })

    })
	
	
	$('#admincontent').on('click', '[data-slider_delete]', function(){
		var res=confirm("Уверены, что хотите удалить элемент слайдера?");
		if(!res){return false;}	
			var id=$(this).data('slider_delete');
			
			$.ajax({	
				url:'/admin/slider/deleteslider/',
				method:'POST',
				dataType: 'json',
				data: {id:id},
				success: function(data){ if(data.status== "success"){$('#line'+id).hide();}
					
					bs_indication(data.status, data.msg);
					 
				}		
			})
	})
	
	
	
	$('#admincontent').on('click', '#sub_edited_slider', function(e){
	   e.preventDefault();
		if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
			
		 var id=$(this).data('id');		
		 var url=$('#url').val();
		 var src= $('#image_preview').attr('src');
		 src=src.split('/');
		 var img= src[5];
		 src=src[4];
		
	    $.ajax({
	     url:'admin/slider/updateSlider/',
		 method:'POST',
		 dataType:'json',
		 data:{ajax:1, url:url, id:id, src:src, img:img},
		 success: function(data){
		 
		 if(data.status="success"){
					$.ajax({
						url:'/admin/slider/index/',
						method: 'POST',
						data:{ajax:1},
						success: function(data){
						$('#admincontent').html(data);
						}
					})
					}
					  bs_indication(data.status, data.msg);
					}

	     })
    })
	
	

    var massiv=['get_author','get_email', 'get_data', 'get_article'];	
	
		
	$('#admincontent').on('click','#get_author option', function(){
			for (var i in massiv){
			if(massiv[i]!="get_author"){$('#admincontent').find('#'+massiv[i]).val('');}
			}
		})
		
	$('#admincontent').on('click','#get_email option', function(){
			for (var i in massiv){
			if(massiv[i]!="get_email"){$('#admincontent').find('#'+massiv[i]).val('');}
			}
		})
		
	$('#admincontent').on('click','#get_data option', function(){
			for (var i in massiv){
			if(massiv[i]!="get_data"){$('#admincontent').find('#'+massiv[i]).val('');}
			}
		})
		
	$('#admincontent').on('click','#get_article option', function(){
			for (var i in massiv){
			if(massiv[i]!="get_article"){$('#admincontent').find('#'+massiv[i]).val('');}
			}
		})
	
	
	
	$('#admincontent').on('click','#make_choise_comments', function(){
	
        for (var i = 0; i < massiv.length; i++)
            {
            var val=$('#'+massiv[i]).val();

             if($('#'+massiv[i]).val()!=='') {var order=$('#'+massiv[i]).val();
                var item= massiv[i];
                var text=$('#'+massiv[i]+' option:selected').text();
                break;
             }
            }

            var published=$('#published').val();
            var changed=$('#changed').val();
            var picture=$('#get_picture').val();


            $.ajax({
                       url:'/admin/comments/index/',
                       method:'POST',
                       data: {ajax:1,order:order, picture:picture, published:published, changed:changed},
                        success: function(data){
                          $('#admincontent').html(data);
                        if(picture){ $('#get_picture [value='+picture+']').attr('selected', 'selected');}
                        if(published) $('#published [value='+published+']').attr('selected', 'selected');
                        if(changed)  $('#changed [value='+changed+']').attr('selected', 'selected');
                          $('#'+item+' [value='+order+']').attr('selected', 'selected');
                        }
                     })

		});
		
		
		
		
		$('#admincontent').on('click', '#to_publish', function(){
			
				for (var i = 0; i < massiv.length; i++)
			{
				var val=$('#'+massiv[i]).val();
				 if($('#'+massiv[i]).val()!=='') {var order=$('#'+massiv[i]).val();
					var item= massiv[i];
					var text=$('#'+massiv[i]+' option:selected').text();
					break;
				 }			
			}
			
			var published=$('#published').val();
			var changed=$('#changed').val();
			var picture=$('#get_picture').val();
		
			
				 // var selectedItems = new Array();
                    var selectedItems=[];
					  $('input:checkbox:checked').each(function(){
					  selectedItems.push($(this).data('good'));	
					   })
					   
		   if(!$.isEmptyObject(selectedItems)){
				$.ajax({
					   url:'/admin/comments/publish/',
					   method:'POST',
					   data: {selectedItems:selectedItems}
					 })

				$.ajax({
					   url:'/admin/comments/index/',
					   method:'POST',
					   data: {ajax:1,order:order, picture:picture, published:published, changed:changed},
						success: function(data){
						  $('#admincontent').html(data);
						if(picture) $('#get_picture [value='+picture+']').attr('selected', 'selected');
						if(published) $('#published [value='+published+']').attr('selected', 'selected');
						if(changed)  $('#changed [value='+changed+']').attr('selected', 'selected');
						$('#'+item+' [value='+order+']').attr('selected', 'selected');
					   
					bs_indication('success','коментарии с id  '+selectedItems+' опубликованы');
					
					 }
			})
			}
		})		
		
		
    
	$('#admincontent').on('click', '#to_unpublish', function(){
		
			for (var i = 0; i < massiv.length; i++)
		{
			var val=$('#'+massiv[i]).val();
			
			 if($('#'+massiv[i]).val()!=='') {var order=$('#'+massiv[i]).val();
				var item= massiv[i];
				var text=$('#'+massiv[i]+' option:selected').text();
				break;
			 }			
		}
		
		var published=$('#published').val();
		var changed=$('#changed').val();
		var picture=$('#get_picture').val();
	
		
		      var selectedItems = new Array();
				  $('input:checkbox:checked').each(function(){
				  selectedItems.push($(this).data('good'));	
				   })
				   
				      if(!$.isEmptyObject(selectedItems)){
		    
		$.ajax({
				   url:'/admin/comments/unpublish/',
				   method:'POST',
				   data: {selectedItems:selectedItems}
							
				 })
				 

		
		$.ajax({
				   url:'/admin/comments/index/',
				   method:'POST',
				   data: {ajax:1,order:order, picture:picture, published:published, changed:changed},
					success: function(data){
					  $('#admincontent').html(data);
				if(picture) $('#get_picture [value='+picture+']').attr('selected', 'selected');
				if(published) $('#published [value='+published+']').attr('selected', 'selected');
			    if(changed)  $('#changed [value='+changed+']').attr('selected', 'selected');
				$('#'+item+' [value='+order+']').attr('selected', 'selected');
					  
					  if(selectedItems)	bs_indication('success','коментарии с id  '+selectedItems+' спрятаны');
					}				
				 })
	        }
		})
		
		
		$('#admincontent').on('click', '#to_delete', function(){
			var res=confirm("Уверены, что хотите удалить коментарий?");
				if(!res){return false;}	
				for (var i = 0; i < massiv.length; i++)
			{
				var val=$('#'+massiv[i]).val();
				
				 if($('#'+massiv[i]).val()!=='') {var order=$('#'+massiv[i]).val();
					var item= massiv[i];
					var text=$('#'+massiv[i]+' option:selected').text();
					break;
				 }			
			}
			
			var published=$('#published').val();
			var changed=$('#changed').val();
			var picture=$('#get_picture').val();
		
			
				  var selectedItems = new Array();
					  $('input:checkbox:checked').each(function(){
					  selectedItems.push($(this).data('good'));	
					   })
					   
						  if(!$.isEmptyObject(selectedItems)){
				 
			$.ajax({
					   url:'/admin/comments/delete/',
					   method:'POST',
					   data: {selectedItems:selectedItems}
								
					 })
					 

			
			$.ajax({
					   url:'/admin/comments/index/',
					   method:'POST',
					   data: {ajax:1,order:order, picture:picture, published:published, changed:changed},
						success: function(data){
						  $('#admincontent').html(data);
					if(picture) $('#get_picture [value='+picture+']').attr('selected', 'selected');
					if(published) $('#published [value='+published+']').attr('selected', 'selected');
					if(changed)  $('#changed [value='+changed+']').attr('selected', 'selected');
					$('#'+item+' [value='+order+']').attr('selected', 'selected');
						  
						  if(selectedItems)	bs_indication('success','коментарий с id  '+selectedItems+' удален');
						}				
					 })
				}
		})
		
		
		
		
		$('#admincontent').on('click', '#to_edit', function(){
		
		      var selectedItems = new Array();
				  $('input:checkbox:checked').each(function(){
				  selectedItems.push($(this).data('good'));	
				   })
				 
		if( selectedItems.length>1){
		bs_indication('success','выберите какой-то один комментарий!');
		return false;
		}
		
		$.ajax({
				   url:'/admin/comments/editComment/',
				   method:'POST',
				   data: {ajax:1,selectedItems:selectedItems},
					success: function(data){
					  $('#admincontent').html(data);
					}				
				 })
		
		
		})
		
	$('#admincontent').on('click', '#editcomment', function(e){
		   e.preventDefault();
		if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
			
		for (var i = 0; i < massiv.length; i++)
			{
				var val=$('#'+massiv[i]).val();
				
				 if($('#'+massiv[i]).val()!=='') {var order=$('#'+massiv[i]).val();
					var item= massiv[i];
					var text=$('#'+massiv[i]+' option:selected').text();
					break;
				 }			
			}
		
		var published=$('#published').val();
		var changed=$('#changed').val();
		var picture=$('#get_picture').val();
			
			
			
		 var id=$(this).data('id');	
         var name=$('#firstname').val();
		 var email=$('#emailcontact').val();		 
		 var comments=$('#comment').val();
	   $.ajax({
	     url:'/admin/comments/updateComment/',
		 method:'POST',
		 data:{ id:id, name:name, email:email,comments:comments}
	   })
	  
	   		$.ajax({
				   url:'/admin/comments/index/',
				   method:'POST',
				   data: {ajax:1},
					success: function(data){
					  $('#admincontent').html(data);
				if(picture) $('#get_picture [value='+picture+']').attr('selected', 'selected');
				if(published) $('#published [value='+published+']').attr('selected', 'selected');
			    if(changed)  $('#changed [value='+changed+']').attr('selected', 'selected');
				$('#'+item+' [value='+order+']').attr('selected', 'selected');
					 	bs_indication('success','коментарий с id  '+id+' изменен');
					}				
				 })
	   
   } )
   
   
   	$('#admincontent').on('click','.pagination-comments a', function(){
	
	
		for (var i = 0; i < massiv.length; i++)
		{
			var val=$('#'+massiv[i]).val();
			
			 if($('#'+massiv[i]).val()!=='') {var order=$('#'+massiv[i]).val();
				var item= massiv[i];
				var text=$('#'+massiv[i]+' option:selected').text();
				break;
			 }			
		}
		
		var published=$('#published').val();
		var changed=$('#changed').val();
		var picture=$('#get_picture').val();
	
	
		var picture=$(this).data('picture');
		var page= $(this).data('page');
	
		$.ajax({
               url:'/admin/comments/index/',
			   method:'POST',
			   data: {ajax:1, page:page},
                success: function(data){
                 $('#admincontent').html(data);
					if(picture){ $('#get_picture [value='+picture+']').attr('selected', 'selected');}
					if(published) $('#published [value='+published+']').attr('selected', 'selected');
					if(changed)  $('#changed [value='+changed+']').attr('selected', 'selected');
					$('#'+item+' [value='+order+']').attr('selected', 'selected');
				 
                }				
	         })
	
	
	});
	
	//USERS******************************
//*****************************
		
		$('#admincontent').on('click','#add_user', function(){
	   $.ajax({
               url:'/admin/users/addUser/',
			   method:'POST',
			   data: {ajax:1},
                success: function(data){
                 $('#admincontent').html(data);
                }				
	         })
			
		});
		
	
		$('#admincontent').on('click', '#add_new_user', function(e){
		   e.preventDefault();
		if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
		
		var name=$('#name').val();
		var password=$('#password').val();
		var role=$('#role').val();
		
			   $.ajax({
               url:'/admin/users/saveUser/',
			   method:'POST',
			   dataType: 'json',
			   data: {name:name, password:password, role:role},
                success: function(data)
		           {
					 if(data.status== 'success'){
						 $.ajax({
								   url:'/admin/users/index/',
								   method:'POST',
								   data: {ajax:1},
									success: function(data)
									{
									 $('#admincontent').html(data);
									
									}				
								})
					
						}
						bs_indication(data.status, data.msg);
						
		            }				
	         })

		})
		

		$('#admincontent').on('click','#delete_user', function(){
		
		var res=confirm("Уверены, что хотите удалить пользователя?");
		if(!res){return false;}	

		id=$(this).data('delete');
		   $.ajax({
				   url:'/admin/users/deleteUser/',
				   method:'POST',
				   dataType: 'json',
				   data: {id:id},
					success: function(data){

						 if(data.status=='success'){
							 $.ajax({
									   url:'/admin/users/index/',
									   method:'POST',
									   data: {ajax:1},
										success: function(data)
										{
										 $('#admincontent').html(data);
									
										}				
									})
							} 
							bs_indication(data.status, data.msg);	
					}				
				 })
	
		});
		
		
		$('#admincontent').on('click','#edit_user', function(){
			id=$(this).data('edit');
		
			  $.ajax({
					   url:'/admin/users/editUser/',
					   method:'POST',
					   data: {ajax:1, id:id},
						success: function(data){ $('#admincontent').html(data);}
		        })
		});
		
		
		$('#admincontent').on('click',"#password2",function() {
		$('#edit_password').addClass('form-control').show();
		})
		
		$('#admincontent').on('click',"#password1",function() {
		$('#edit_password').removeClass('form-control').hide();
		$(this).parents('.form-group').removeClass('has-error');
		
		})
		
		
		$('#admincontent').on('click','#sub_edited_user', function(e){
				e.preventDefault();
				
				if (validateForm($('#admincontent').find('.form-horizontal')) === false) return false;
				
				var id=$(this).data('id');
			   var login=$('#edit_login').val();
			   var password=$('#edit_password').val();
			   var role=$('#role').val();
			   if(!password) var password='';
				
				
				  $.ajax({
               url:'/admin/users/updateUser/',
			   method:'POST',
			   dataType: 'json',
			   data: {id:id,login:login, password:password, role:role},
                success: function(data)
		           {

					 if(data.status='success'){
						 $.ajax({
								   url:'/admin/users/index/',
								   method:'POST',
								   data: {ajax:1},
									success: function(data)
									{
									 $('#admincontent').html(data);
									
									}				
								})
					
						} 
						bs_indication(data.status, data.msg);
		            }				
	         })
		})
		
		
		

		$('#admincontent').on('click','#saveabout', function(){
		
		for (instance in CKEDITOR.instances) {
           CKEDITOR.instances[instance].updateElement();
           }

		  var text=$('#editor1').val();
		  		 $.ajax({
				   url:'/admin/about/saveabout/',
				   method:'POST',
				   dataType:'json',
					data: {ajax:1, text:text},
					success: function(data)
					{
					 bs_indication(data.status, data.msg); 
					}				
				})
		});

	
});