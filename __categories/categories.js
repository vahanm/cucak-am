//							top: '-=5',
//							height: '+=10',
//							left: '-=5',
//							width: '+=10'

$(document).ready(function () {
    $('.cat-back-img').mouseenter(function () {
        $(this).parent().find('.cat-icons').stop(true, true).slideDown('slow');
        $(this).parent().find('.cat-icons img, .cat-icons a').stop(true, true).fadeIn('slow');
        //$(this).stop(true, true).slideUp('slow');
        $(this).stop(true, true).animate({ opacity: 0.2 });
    });
    $('.cat-cont').mouseleave(function () {
        $(this).find('.cat-icons').stop(true, true).slideUp('slow');
        $(this).find('.cat-icons img, .cat-icons a').stop(true, true).fadeOut('slow');
        //$(this).find('.cat-back-img').stop(true, true).slideDown('slow');
        $(this).find('.cat-back-img').stop(true, true).animate({ opacity: 1 });
    });
});
