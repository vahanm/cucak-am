$(document).ready(function () {
    //$ = jQuery;

    $cont = $('div#categoriesMenuContainer');
    $menu = $('.addnew_menu'); //$('.menu-item-414 ul:first').clone();

    $menu.find('a[href="#"]').removeAttr('href').css('cursor', 'pointer');

    //$menu.find('li ul').hide();
    //$menu.addClass('addmenu');

    //    $menu.find('li').each(function () {
    //        if ($(this).find('ul').length > 0)
    //            $(this).addClass('expandable');
    //    });

    //    $menu.find('.expandable').click(function () {
    //        $menu.find('li ul').slideUp(100);
    //        $(this).find('ul:first').slideDown();
    //    });

    //$res = $('<div></div>').css('width', '30%').append($menu);

    $menu.each(function() {
        $(this).menu();
    });
    
    $('div#categoriesMenuContainer > div').show();

    //$cont.append($res);
});