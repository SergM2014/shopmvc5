function indication(object,text)  
        {
			object.css('position', 'fixed');
			object.css('left', ($(window).width()-object.width())/2+ 'px');
			object.css('top',  ($(window).height()-object.height())/2+ 'px');
			
				var background="#FFC4FF";
				var bordercolor="#588a41";
			
				object.animate({ opacity: "show" }, "slow" );
				object.html(text); 
				object.css('background',background);
				object.css('border-color',bordercolor);			
				object.animate({ opacity: "hide" }, 5000 );
		}
		
			function isValidEmailAddress(emailAddress) {
var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
return pattern.test(emailAddress);
}

$(document).ready(function(){

    if($('html').height()< $(window).height()) {$('html').height('100%'); }

	
	$( '#gallery' ).jGallery( {
            mode: 'full-screen', // [ full-screen, standard, slider ]
            width: '100%', // (only for standard or slider mode)
            height: '600px', // (only for standard or slider mode)
            autostart: false, // (only for full-screen mode)
            autostartAtImage: 1,
            autostartAtAlbum: 1,
            canClose: true, // (only for full-screen mode)
            canResize: true,
            draggableZoom: true,
            canChangeMode: false,
            backgroundColor: '#000',
            textColor: '#fff',
            thumbnails: true,
            thumbnailsFullScreen: true,
            thumbType: 'image', // [ image | square | number ]
            thumbnailsPosition: 'bottom', // [ top | bottom | left | right ]
            reloadThumbnails: true, //Reload thumbnails when function jGallery() is called again for the same item
            thumbWidth: 100, //px
            thumbHeight: 100, //px
            thumbWidthOnFullScreen: 100, //px
            thumbHeightOnFullScreen: 100, //px
            canMinimalizeThumbnails: true,
            transition: 'moveToRight_moveFromLeft', // http://jgallery.jakubkowalczyk.pl/customize
            transitionWaveDirection: 'forward', // [ forward | backward ]
            transitionCols: 1,
            transitionRows: 5,
            showTimingFunction: 'linear', // [ linear | ease | ease-in | ease-out | ease-in-out | cubic-bezier(n,n,n,n) ]
            hideTimingFunction: 'linear', // [ linear | ease | ease-in | ease-out | ease-in-out | cubic-bezier(n,n,n,n) ]
            transitionDuration: '0.7s',
            zoomSize: 'fit', // [ fit | original | fill ] (only for full-screen or standard mode)
            title: true,
            slideshow: true,
            slideshowAutostart: false,
            slideshowCanRandom: true,
            slideshowRandom: false,
            slideshowRandomAutostart: false,
            slideshowInterval: '8s',
            preloadAll: false,
            appendTo: 'body', // selector (only for full-screen mode)
            disabledOnIE8AndOlder: true,
            initGallery: function() {},
            showPhoto: function() {},
            beforeLoadPhoto: function() {},
            afterLoadPhoto: function() {},
            showGallery: function() {},
            closeGallery: function() {}
        } );
	
   

   

   $('.slider1').bxSlider({
		slideWidth: 200,
		minSlides: 4,
		maxSlides: 8,
		slideMargin:20,
		//adaptiveHeight:true,
		pager:false
		
	  });

    var modal = $('.modal-body'),
        content = $('#content'),
        contacts = $('#contacts'),
        output = $('#output');



	//добавить один товар в корзину на странице продукта
    $('#add_one_product').click(function(e){
		e.preventDefault();
		var id=$(this).data('id');
		$.post(
            '/cart/',
            {id:id},
            function (data){
                 $('#cart_res').html(data);
            }
            );// конец гета
		});
	
	//блок заказов

    // нажимаем оформить заказ
	modal.on('click','#order',function(){
		modal.find('#order').hide('slow');
		modal.find('#order2').show('slow');
		modal.find('#busket').hide('slow');
		modal.find('#order1').show('slow');
		});

	//спрятать форму заказа в корзине
	modal.on('click','#order2',function(){
		modal.find('#order2').hide('slow');
		modal.find('#order').show('slow');
		modal.find('#order1').hide('slow');
		modal.find('#busket').show('slow');
		});

    //оновляем содержимое корзины
	modal.on('click','#up_cart',function(){
            var to_up = modal.find('#up_form').serialize();
            $.post(
                '/updateCart/',
                {to_up:to_up, ajax:true},
                function(data){
                    modal.html(data);
                    }
                );
            //меняем значение в строке быля корзыны
           $.post(
                '/cart/',
                function(data){
                $('#cart_res').html(data);
                }
              )
		});

//показываем корзину при клике на корзину
	$('#cart_res').on('click', '#show_busket', function(){
        $('#contacts').find('.check').tooltip('destroy');
            $.post(
                '/busket/',
                {ajax:true},
                function (data){
                modal.html(data);
                }
            )
	});

	//сделать заказ в корзине
	modal.on('click','#validateButton',function(e){
	    e.preventDefault();
	    if (validateForm(modal.find('.check'), 'order') === false) return false;

	    var order= modal.find('#form').serialize();
	    order+='&order=true';
		$.ajax({
            url:'/busket/',
            method: 'POST',
            data:order,
            success: function(data){
            modal.html(data);
            addtooltips();


            }
		});
		
			$.post(
                '/cart/',
                function(data){
                    $('#cart_res').html(data);
                    }
                )
	});

	
	//блок валидации формы
    function validateForm(inputs, type){

        var phone = $('#phone');
        var firstname= $('#firstname');
        var kcaptcha = $('#kcaptcha');
        var wishcontact = $('#wishescontact');
        var emailcontact = $('#emailcontact');
        var  comment = $('#comment');
		var valid= true;

	    inputs.tooltip('destroy');

        //проверка общих полей формы
               var val=firstname.val();
               if( val.length <3){
               firstname.parents('.form-group').addClass('has-error').removeClass('has-success');
                  firstname.tooltip({
                                 trigger:'manual',
                                 placement:'bottom',
                                 title:'введите не меньше 3 букв'
                                }).tooltip('show');
                  valid= false;
               }


                var val = kcaptcha.val();
               if( val.length <5){
               kcaptcha.parents('.form-group').addClass('has-error').removeClass('has-success');
                 kcaptcha.tooltip({
                                 trigger:'manual',
                                 placement:'right',
                                 title:'введите не меньше 5 знаков'
                                }).tooltip('show');
                  valid= false;
               }
        //конец проверки ощих полей формы

        //проверка формызаказа в корзине
        if(type==='order'){

            var val = phone.val();

            if( val.length <8){
                phone.parents('.form-group').addClass('has-error').removeClass('has-success');
                phone.tooltip({
                    trigger:'manual',
                    placement:'bottom',
                    title:'введите не меньше 8 цифр'

                }).tooltip('show');
                valid= false;
            }
        }
        //конец формы звказа в корзине

        //форма обратной связи
			if (type=='message'){
                    var val=wishcontact.val();
                       if( !val){
                       wishcontact.parents('.form-group').addClass('has-error').removeClass('has-success');
                          wishcontact.tooltip({
                                         trigger:'manual',
                                         placement:'bottom',
                                         title:'Напишите что нибуть'
                                        }).tooltip('show');
                          valid= false;
                       }

                       var val=emailcontact.val();
                       if( !isValidEmailAddress(val)){
                           emailcontact.parents('.form-group').addClass('has-error').removeClass('has-success');
                          emailcontact.tooltip({
                                         trigger:'manual',
                                         placement:'bottom',
                                         title:'введите правильный email'
                                        }).tooltip('show');
                          valid= false;
                       }
					}
        //конец формы обратной связи

        //Форма отклика на товар
            if (type=='comment'){
                       var val=firstname.val();
                       if( val.length <3){
                       firstname.parents('.form-group').addClass('has-error').removeClass('has-success');
                          firstname.tooltip({
                                         trigger:'manual',
                                         placement:'bottom',
                                         title:'введите не меньше 3 букв'
                                        }).tooltip('show');
                          valid= false;
                       }

                       var val=emailcontact.val();
                       if( !isValidEmailAddress(val)){
                       emailcontact.parents('.form-group').addClass('has-error').removeClass('has-success');
                          emailcontact.tooltip({
                                         trigger:'manual',
                                         placement:'bottom',
                                         title:'введите правильный email'
                                        }).tooltip('show');
                          valid= false;
                       }

                    var val=comment.val();
                       if( !val){
                           comment.parents('.form-group').addClass('has-error').removeClass('has-success');
                          comment.tooltip({
                                         trigger:'manual',
                                         placement:'bottom',
                                         title:'Напишите что нибуть'
                                        }).tooltip('show');
                          valid= false;
                       }

                        var val=kcaptcha.val();
                       if( val.length <5){
                       kcaptcha.parents('.form-group').addClass('has-error').removeClass('has-success');
                          kcaptcha.tooltip({
                                         trigger:'manual',
                                         placement:'right',
                                         title:'введите не меньше 5 знаков'
                                        }).tooltip('show');
                          valid= false;
                       }
                    }
            //конец формы отклика на товар
					
						   
		return valid;
	 }


	//добавляем тултипы
	function addtooltips(){
		 var errors= $('.form-horizontal').find('.has-error');
		 
		 var inputs = errors.find('.form-control');
		 inputs.tooltip('destroy');
//console.log(inputs);
	     $.each(inputs, function(index, val){
				      
		 var input =$(val);
		// var formGroup= input.parents('.form-group');
         var formGroup2 =input.closest('.form-group');

		 var label =formGroup2.find('label').text().toLowerCase();
		 var textError=label;   
  // console.log(label);
		input.tooltip({
						 trigger:'manual',
						 placement:'right',
						 title:textError
					}).tooltip('show');   
	     });
	}


    //удаление ошибок в полях ввода
    $('.container').on('keydown', '.form-control', function (){
						  $(this).tooltip('destroy').parents('.form-group').removeClass('has-error');
						   });


    //предпросмотр коментария
    $('#buttonpreview').click(function(e){
        e.preventDefault();

        $('#add_comment_form').find('.check').tooltip('destroy');

        var name = $('#firstname').val();
        var email = $('#emailcontact').val();
        var message=$('#comment').val();
        var bild=$('#preview>img').attr('src');

        $.post(
            'application/ajax/ajax.php',
            {name:name,email:email,message:message,bild:bild},
            function(data){
                $(".modal-body").html(data);
                $('#myModalLabel').html('');
            }
        );
    });


    //добавляем отклик на товар на странице product
    $('#add_comment_form').on('click','#add_comment', function(e){
        e.preventDefault();
        //проверяем пустые ли поля
        if (validateForm($('#add_comment_form').find('#form'), 'comment') === false) return false;
        var str=$('#form').serialize();//вносим данные инпутов формы в одну переменую

        $.ajax({
            url:'/application/ajax/comments.php/',
            type:'POST',
            dataType:'json',
            data: str,

            success: function(data){
                if(data.success){
                    indication($('#message_box'),data.success);
                    $('#add_comment_form').hide();
                    return false;
                }

                for(y in data)
                {
                    if(data[y]) {
                        $('#'+data[y]).closest('.form-group').addClass('has-error').removeClass('has-success');}
                }

                addtooltips();
            }

        })

    });


    //смена капчи при клике по ней
    $('body').on('click','#changekcaptcha', function(){

        $('body').find('#changekcaptcha img').attr('src', 'http://'+location.hostname+'/lib/kcaptcha/index.php?PHPSESSID=' + Math.random());

    });


    //нажимаем кнопку "написать нам"
	$('#write').click(function(){
	   $('#for_map').hide('slow');
	   $('#feedback').show('slow');
	   $(this).hide('slow');
	   $('#find_on_map').show('slow');
	 
	});

	//показать карту местности
	content.on('click','#find_on_map',function(){
	   $('#feedback').hide('slow');
	    content.find('#for_map').show('slow');
	    $(this).hide('slow');
	   $('#write').show('slow');
	});
	

	//отсылаем отзыв
    content.on('click','#sendmessage',function(e){
        e.preventDefault();

        if (validateForm(contacts.find('.check'), 'message') === false) return false;

        var message = contacts.serialize();

        $.ajax({
            url:'/application/ajax/message.php/',
            type: 'POST',
            dataType: 'json',
            data: message,
           success:	function(data) {
               if (data.success) {
                   indication($('#message_box'), data.success);
                   $('#feedback').hide();
                   $('#for_map').show();
                   return false;
               }

               if (response) {
                   for (y in response) {
                       if (response[y]) {
                           $('#' + response[y]).parents('.form-group').addClass('has-error').removeClass('has-success');
                       }
                   }
                 }
                addtooltips();
            }
            });
        });




	//нажимаем клавиши в окошке поиска
	$('#search').keyup(function(){

	var search=$(this).val();
		if(search !=''){
		$.post(
			'application/ajax/search.php/',
			{search: search},
			function(data){
                $('#search_res').removeClass('invisible').html(data);
		})
		}else{
            $('#search_res').addClass('invisible');
		}
	});

//серыть блок вывода результатов поиска при клике вне его
	$(document).click(function(e){
        var elem = $("#search_res"); if(e.target!=elem[0]&&!elem.has(e.target).length){ elem.addClass('invisible'); }
    });

	//при клике в окошке поиска выводитс подокошко с результатом
	$('#search_res').on('click','span', function(){
        $('#search_res').addClass('invisible');
	
	var id =$(this).data('id');

			$.post(
			'application/ajax/search.php/',
			{id:id},
			function(data){
                $('#show_res').removeClass('invisible').html(data);
                $('#show_res span').click(function(){ $('#show_res').addClass('invisible');});
            }
	
	        )
	});
	
//сортировка коментариев в чекбоксе
		 $("input[type='radio']").click(function(){

         var radio = $("input[type='radio']:checked").val();
	     $.post(
	             'application/ajax/list.php',
	             {order:radio},
	             function(data){
	                             $('#view').html(data);
	                           }
    	       )   
	    });
	
//пагинация
	  content.on ("click",".pagination span", function(){
        var checked=$('input:checked').val();
		
         var page=$(this).data('page');
         $.post(
                   'application/ajax/list.php',
				  {order:checked, page:page},
                   function(data){	
                                    $("#view").html(data);
                                }
				);
        });

	// this section is for comments загрузка изображения

		function progressHandler(event){

		var percent=Math.round((event.loaded/event.total)*100);
		
		$('.progress-bar').attr('aria-valuenow',percent).width(percent+"%").text(percent+"%");
		}
		
	function completeHandler(event){
		//_("output").innerHTML= event.target.responseText;
		output.html(event.target.responseText);
		$(".progress-bar").attr('aria-valuenow', 0).width("0%").text("0%");
		
		output.removeClass('invisible'); //hide submit button
		$('#submit-btn').addClass('invisible'); //hide submit button
		//$('#loading-img').hide(); //hide submit button
		
		$('.progress').delay( 1000 ).fadeOut(); //hide progress bar
		}
		
	function errorHandler(event){

		output.text('Upload Failed');
		}
		
	function abortHandler(event){
		//_("output").innerHTML="UPLOAD ABORTED";
		output.text('UPLOAD ABORTED');
		}	
		

		$('#submit-btn').click(function(){
		
		$('.progress').removeClass('invisible');
				var file=document.getElementById("FileInput").files[0];

		var formdata= new FormData();

		formdata.append("FileInput", file);
		
		var ajax=new XMLHttpRequest();
		ajax.upload.addEventListener("progress", progressHandler, false);
		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);
		ajax.open("POST", "/application/ajax/upload.php/");
		ajax.send(formdata);
		});


	$('#FileInput').change(function() {

	  var input = $(this)[0];
	  if ( input.files && input.files[0] ) {
		if ( input.files[0].type.match('image.*') ) {
		  var reader = new FileReader();
		  reader.onload = function(e) { $('#image_preview').attr('src', e.target.result); }
		  reader.readAsDataURL(input.files[0]);
		  output.removeClass('invisible').text('');
		  $('#reset-btn').removeClass('invisible');
		  $('#submit-btn').removeClass('invisible');
		}// else console.log('is not image mime type');
	  }// else console.log('not isset files data or files API not supordet');
        $('#pre_FileInput').addClass('invisible');
        $('#image_preview').removeClass('invisible');
	});
	
	
		
	$('#reset-btn').click(function(){

	$('#image_preview').attr('src','').addClass('invisible');
	$('#pre_FileInput').removeClass('invisible');
		 $.ajax({
               url:'/application/ajax/deleteimage.php/',
			   method:'POST',
			   data: {ajax:1},
               	success: function (data){
                 output.html(data);
				}
	         });
			 
  $('#submit-btn').addClass('invisible');
	$(this).addClass('invisible');
	});
	//end of the indicator
	
	
	
			



});

