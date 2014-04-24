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
	$('#showMorePartnersButton').click(function () {
		if (tilesAnimationTimer)
			clearTimeout(tilesAnimationTimer);

		$('.cat-item-comp').stop(true, true);
		$('.comp-container div a.cat-item-comp').appendTo($('.comp-container'));
		$(this).slideUp('slow');
		$('.comp-container').animate({ height: 400 });
		$('.cat-item-comp').fadeIn();
	});

	$('.cat-item-container')
        .mouseenter(function () {
        	$(this).find('.sub-arrow').stop(true, true).fadeTo('slow', 0.5);
        })
        .mouseleave(function () {
        	$(this).find('.sub-arrow').stop(true, true).fadeOut('slow');
        });
	$('.sub-arrow').click(function () {
		$('.main-cats').fadeOut('slow');
		$('.cat-section').append($(this).siblings('.sub-categories-popup').clone(true).toggleClass('sub-categories-popup sub-cats').fadeIn());
	});

	switchTiles_begin_v3();
});

var tilesAnimationTimer = false;

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
