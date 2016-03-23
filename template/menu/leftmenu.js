/*
vertical dropdown menu
*/
$(document).ready(function(){
     //в цей массив добавляються цвета вложеных меню
	var color= ["#8EDFA", "#9191FF", "#F5F2D3","#92BC94"];


//open the submenu of categories at the click on menu item
   $('.menu_vert span').click(function(){
    //показіваем/убираем соседей/детей текущего елемента делаем его активным/неактивным
	  $(this).toggleClass("active");

     // показать властный детский список
        $(this).parent('li').children('ul').addClass("childrenshow");
        //убираем детей соседа
		$(this).parent('li').siblings('li').children('ul').removeClass("childrenshow");
		//убираем актив соседей
		$(this).parent('li').siblings('li').children('.item').removeClass("active");


		 //ищем количество вложеных списков
		var truck=$(this).parents('ul');
        //закрашиваем детский вложений список в какойто цвет
		
		 $(this).siblings('.childrenshow').find('.item').css("background-color", color[truck.length-1]);
    });//end click item


//redirecting to another page of the site on double click
    $('.item').dblclick(function(){
        var url=location.hostname;
        var url2=document.domain;
        document.location.href='/catalog?category_id='+$(this).data('id');
	})

//cliking menu show button it will be hidden and menu hide button will be shown
    $('#menu_button').click(function(){
        $(this).removeClass('visible-xs').addClass('hidden-xs');
        $('#menu_button_hide').removeClass('hidden-xs');
        $('#menu').addClass('show_menu');
    })
// clicking hide button it itself will be hidden and menu show button will be shown
    $('#menu_button_hide').click(function(){
        $(this).removeClass('visible-xs').addClass('hidden-xs');
        $('#menu_button').removeClass('hidden-xs').addClass('visible-xs');
        $('#menu').removeClass('show_menu');
    })

    //at the click  behind the menu items they will be hidden
    document.onclick = function(ev){
        if(document.body.clientWidth<768){
          var elem= ev.target;
            ev.stopPropagation();
           if(elem.classList.contains('menu-class') || elem.id === "menu_button") return false;

            $('#menu').removeClass('show_menu');
            $('#menu_button_hide').removeClass('visible-xs').addClass('hidden-xs');
            $('#menu_button').addClass('visible-xs').removeClass('hidden-xs');
        }
    }

})