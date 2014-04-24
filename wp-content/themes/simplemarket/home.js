//							top: '-=5',
//							height: '+=10',
//							left: '-=5',
//							width: '+=10'
/*
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
*/

$(document).ready(function () {
    //$('#showMorePartnersButton').click(function () {
    //	if (tilesAnimationTimer)
    //		clearTimeout(tilesAnimationTimer);

    //	$('.cat-item-comp').stop(true, true);
    //	$('.comp-container div a.cat-item-comp').appendTo($('.comp-container'));
    //	$(this).slideUp('slow');
    //	$('.comp-container').animate({ height: 400 });
    //	$('.cat-item-comp').fadeIn();
    //});

    //$('.cat-item-container')
    //    .mouseenter(function () {
    //    	$(this).find('.sub-arrow').stop(true, true).fadeTo('slow', 0.5);
    //    })
    //    .mouseleave(function () {
    //    	$(this).find('.sub-arrow').stop(true, true).fadeOut('slow');
    //    });
    //$('.sub-arrow').click(function () {
    //	$('.main-cats').fadeOut('slow');
    //	$('.cat-section').append($(this).siblings('.sub-categories-popup').clone(true).toggleClass('sub-categories-popup sub-cats').fadeIn());
    //});

    switchTiles_begin_v5();

    if (false && $('.site-slides').length == 1)
        slide_show_begin_v1();
});

var tilesAnimationTimer = false;
var tiles = [];
var activeTileIndex = -1;

function switchTiles_begin_v5() {
    $('.cat-item-comp').each(function() {
        if ($('.tile-slide:not(.tile-slide-main)', this)/*.hide()*/.length > 0) {
            tiles.push(this);
        }
    });
    
    for (i in tiles) {
        setTimeout(switchTiles_v5, 3000 + i * 500);
    }
}

function switchTiles_v5() {
    var activeTile = tiles[(activeTileIndex = (activeTileIndex + 1) % tiles.length)];

    //if ($('.tile-slide-post:not(.used)', activeTile).length == 0) {
    //    $('.tile-slide', activeTile).removeClass('used');
    //}

    var tile1, tile2;
    tile1 = $('.tile-slide:first', activeTile);

    //tile1 = $('.tile-slide-main', activeTile);

    //if (tile1.is(':visible')) {
    //    tile2 = $('.tile-slide-post:not(.used):first', activeTile).addClass('used');
    //} else {
    //    tile2 = tile1;
    //    tile1 = $('.tile-slide-post:visible', activeTile);
    //}

    if (!tile1.next().is('.tile-slide-main')) {
        var col = get_random_color();
        tile1.next().css({ backgroundColor: col.color, color: (col.brightness > 0.5) ? '#000' : '#fff' });
    }

    tile1.animate({ height: 0, top: -120, easing: 'easeOutExpo' }, 700, function () {
        if ($(this).is('.tile-slide-main')) {
            $(this).insertAfter($('.tile-slide:visible:eq(2)', activeTile)).css({ top: 0, height: 120 });
        } else {
            $(this).appendTo(activeTile).css({ top: 0, height: 120 });
        }
    });
    
    setTimeout(switchTiles_v5, 2500 + 3000 * Math.random());
    //setTimeout(switchTiles_v5, 2500 + 2000 * Math.random());

    //$('.tile-slide:not(.used):first', activeTile).addClass('used').effect('slide', { direction: 'up', mode: 'hide', easing: 'easeOutExpo' }, 500, function () {
    //    $('.tile-slide:not(.used):first', activeTile).addClass('used').effect('slide', { direction: 'down', mode: 'show', easing: 'easeOutExpo' }, 1000, function () {
    //        $(this).removeClass('used');
    //        tilesAnimationTimer = setTimeout(switchTiles_v5, 1);
    //    });
    //});
}

function switchTiles_begin_v4() {
    $('.cat-item-comp').each(function() {
        if ($('.tile-slide:not(.tile-slide-main)', this).hide().length > 0) {
            tiles.push(this);
        }
    });
    
    if (tiles.length > 0) {
        setTimeout(switchTiles_v4, 3000);
        setTimeout(switchTiles_v4, 3500);
        //setTimeout(switchTiles_v4, 4000);
    }
}

function switchTiles_v4() {
    var activeTile = tiles[(activeTileIndex = (activeTileIndex + 1) % tiles.length)];

    if ($('.tile-slide-post:not(.used)', activeTile).length == 0) {
        $('.tile-slide', activeTile).removeClass('used');
    }

    var tile1, tile2;

    tile1 = $('.tile-slide-main', activeTile);

    if (tile1.is(':visible')) {
        tile2 = $('.tile-slide-post:not(.used):first', activeTile).addClass('used');
    } else {
        tile2 = tile1;
        tile1 = $('.tile-slide-post:visible', activeTile);
    }

    tile1.effect('slide', { direction: 'up', mode: 'hide', easing: 'easeOutExpo' }, 500, function () {
        tile2.effect('slide', { direction: 'down', mode: 'show', easing: 'easeOutExpo' }, 1000, function () {
        });
    });
    
    setTimeout(switchTiles_v4, 2500 + 3000 * Math.random());
    //setTimeout(switchTiles_v4, 2500 + 2000 * Math.random());

    //$('.tile-slide:not(.used):first', activeTile).addClass('used').effect('slide', { direction: 'up', mode: 'hide', easing: 'easeOutExpo' }, 500, function () {
    //    $('.tile-slide:not(.used):first', activeTile).addClass('used').effect('slide', { direction: 'down', mode: 'show', easing: 'easeOutExpo' }, 1000, function () {
    //        $(this).removeClass('used');
    //        tilesAnimationTimer = setTimeout(switchTiles_v4, 1);
    //    });
    //});
}

function switchTiles_begin_v3() {
    var tiles = $('.cat-item-comp');
    if (tiles.length > 3) {
        tiles.filter(':gt(2)').hide();
    }

    tiles.attr('locked', 0)
        .mouseenter(function () {
            $(this).attr('locked', 1);
        })
        .mouseleave(function () {
            $(this).attr('locked', 0);
        });

    tilesAnimationTimer = setTimeout(switchTiles_v3, 10000);
}

function switchTiles_v3() {
    var tileShow = $('.cat-item-comp:hidden');
    var tileHide = $('.cat-item-comp[locked!=1]:visible');

    var r;
    r = Math.floor((1000 * Math.random()) % tileShow.length);
    tileShow = tileShow.filter(':eq(' + r + ')');

    r = Math.floor((1000 * Math.random()) % tileHide.length);
    tileHide = tileHide.filter(':eq(' + r + ')');

    //document.title = r;
    //if (r > 2) alert('Out of range');
    if (tileShow.length == 1 && tileHide.length == 1) {
        tileShow.insertAfter(tileHide);

        tileHide.fadeOut(300, function () {
            tileShow.fadeIn(600, function () {
                tilesAnimationTimer = setTimeout(switchTiles_v3, 3000);
            });
        });
    }
}

function switchTiles_begin_v2() {
    tilesAnimationTimer = setTimeout(switchTiles_v3, 5000);
}

function switchTiles_v2() {
    $('.cat-item-comp:last').css('width', 0).css('opacity', 0).insertBefore('.cat-item-comp:first').animate({ width: 222, opacity: 1, duration: 800 });
    $('.cat-item-comp:eq(3)').css('opacity', 1).animate({ width: 0, opacity: 0, duration: 2000 });

    tilesAnimationTimer = setTimeout(switchTiles_v2, 5000);
}

function switchTiles_begin_v1() {
    var tiles = $('.cat-item-comp');
    if (tiles.length > 3) {
        tiles.filter(':gt(2)').hide();
    }

    tilesAnimationTimer = setTimeout(switchTiles_v3, 5000);
}

function switchTiles_v1() {
    var tileShow = $('.cat-item-comp:hidden:first');
    var tileHide = $('.cat-item-comp:visible:last');

    tileHide.slideUp('slow', function () {
        tileShow.slideDown('slow');
    });

    /*
    var tiles = $('.cat-item-comp');
    tiles.filter(':eq(2)').slideUp('slow', function () {
        tiles.filter(':eq(3)').slideDown('slow');
    });
    */
    tilesAnimationTimer = setTimeout(switchTiles_v1, 5000);
}

//$('.site-slides').animate({ 'background-position-x' : -4000, 'background-position-y' : -3500 }, 20000)
function slide_show_begin_v1() {
    $('.slide-slide-1').css({ display: 'block', 'left':    0, 'top':    0 });
    $('.slide-slide-2').css({ display: 'block', 'left':  200, 'top':  150 });
    $('.slide-slide-3').css({ display: 'block', 'left':  850, 'top':  800 });
    $('.slide-slide-4').css({ display: 'block', 'left': 1100, 'top': 1150 });

    tilesAnimationTimer = setTimeout(slide_show_v1, 2000);
}

function slide_show_v1() {
    var h = 70, w = 950;
    var t = 200, l = 1500;

    $('.slide-slide-1').animate({ 'left': -l, 'top': -t }, { duration: 1000, easing: 'easeInOutQuint' }, function () {
        //$(this).css({ display: 'block', 'left': 0, 'top': 0 });
    });
    $('.slide-slide-2').animate({ 'left': 0, 'top': -1 * h }, { duration: 1000, easing: 'easeInOutQuint' });
    $('.site-slides').animate({ 'background-position-x': -200, 'background-position-y': -150 }, { duration: 4000, easing: 'easeOutExpo', complete: function (e) {
            $('.slide-slide-2').animate({ 'left': -l, 'top': -t }, { duration: 1000, easing: 'easeOutExpo', complete: function () {
                    $(this).css({ display: 'block', 'left': l, 'top': t });
                }
            });
            $('.slide-slide-3').animate({ 'left': 0, 'top': -2 * h }, { duration: 1000, easing: 'easeInOutQuint' });
            $('.site-slides').animate({ 'background-position-x': -850, 'background-position-y': -800 }, { duration: 4000, easing: 'easeOutExpo', complete: function (e) {
                    $('.slide-slide-3').animate({ 'left': -l, 'top': -t }, { duration: 1000, easing: 'easeInOutQuint', complete: function () {
                            $(this).css({ display: 'block', 'left': l, 'top': t });
                        }
                    });
                    $('.slide-slide-4').animate({ 'left': 0, 'top': -3 * h }, { duration: 1000, easing: 'easeInOutQuint' });
                    $('.site-slides').animate({ 'background-position-x': -1100, 'background-position-y': -1150 }, { duration: 4000, easing: 'easeOutExpo', complete: function (e) {
                        $('.slide-slide-4').animate({ 'left': -l, 'top': -t }, { duration: 1000, easing: 'easeInOutQuint', complete: function () {
                                    $(this).css({ display: 'block', 'left': 1100, 'top': 1150 });
                                }
                            });
                            $('.slide-slide-1').animate({ 'left': 0, 'top': -0 * h }, { duration: 1000, easing: 'easeInOutQuint' });
                            $('.site-slides').animate({ 'background-position-x': -1550, 'background-position-y': -1650 }, { duration: 4000, easing: 'easeOutExpo', complete: function (e) {
                                    slide_show_v1();
                                }
                            });
                        }
                    });
                }
            });
        }
    });
}
