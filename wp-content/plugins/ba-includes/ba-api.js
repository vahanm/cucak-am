$(document).ready(function () {
    //$('input:radio').click(function (e) {
    //    var $this = $(this);
    //    if ($this.is(':checked')) {
    //        $this.removeAttr('checked');
    //    }
    //});

    //	$('.thumbnail').mouseenter(function () {
    //		if($(this).parent().parent().find('a[lightbox]:first').length > 0)
    //		    $(this).parent().parent().find('.magnifier-icon').fadeIn();
    //	});
    //    $('.thumbnail').mouseleave(function () {
    //		if($(this).parent().parent().find('a[lightbox]:first').length > 0)
    //		    $(this).parent().parent().find('.magnifier-icon').fadeOut('fast');
    //	});

    //$('.transaction-icon').mouseenter(function () {
    //    if ($(this).parent().find('a[lightbox]:first').length > 0)
    //        $(this).find('.magnifier-icon').fadeIn();
    //});

    //$('.transaction-icon').mouseleave(function () {
    //    if ($(this).parent().find('a[lightbox]:first').length > 0)
    //        $(this).find('.magnifier-icon').fadeOut('fast');
    //});

    $('.post.type-post').mouseenter(function () {
        if ($(this).find('a[lightbox]:first').length > 0)
            $(this).find('.magnifier-icon').stop(true).fadeIn();
    }).mouseleave(function () {
        if ($(this).find('a[lightbox]:first').length > 0)
            $(this).find('.magnifier-icon').stop(true).fadeOut('fast');
    });

    $('article.format-standard .thumbnail').click(function () {
        var lightbox = $(this).parents('article').find('a[lightbox]:first');
        if (lightbox.length > 0)
            lightbox.trigger('click');
        else
            document.location = $(this).parents('article').find('.post-titles .post-title a').attr('href');
    });

    //$('.transaction-icon').click(function () {
    //    if ($(this).parent().find('a[lightbox]:first').length > 0)
    //        $(this).parent().find('a[lightbox]:first').trigger('click');
    //    else
    //        document.location = $(this).parent().find('.post-titles .post-title a').attr('href');
    //});

    //$('.thumbnail').click(function () {
    //    document.location = $(this).parent().parent().find('.post-titles .post-title a').attr('href');
    //});

    if (document.all != undefined) {
        var ids = [];

        for (i = 0; i < document.all.length; i++) {
            tag = document.all(i);

            val = tag.id;

            if (val)
                if (!ids[val]) {
                    ids[val] = 1;
                } else {
                    if (val != 'searchform')
                        alert('Duplicated ID found: ' + val);
                }
        }
    }

    $('[freez]').each(function () {
        var element = $(this);
        var className = element.attr('freez');

        freezElement(element, className);
    });

    //freezElement($('.sidebar-post-info'), 'fixed-sidebar-post-info');
    //freezElement($('#itemprices_sidebar'));
    //freezElement($('header.post-header'), 'fixed-post-title');
    //freezElement($('footer.post-meta'));

    setTimeout(function () {
        $('.saved').slideUp(400, function () {
            $(this).remove();
        });
    }, 5000);
    

    $('.coming-soon').click(function(e) {
        e.preventDefault();
        alert('Coming Soon');
    });

    $('.dt-add-button').click(function (e) {
        var type = $(this).attr('type');

        $('.dt-add-control, .dt-add-button')
            .filter('[type!="' + type + '"]').removeClass('dt-add-active').end()
            .filter('[type="' + type + '"]').addClass('dt-add-active');
            
    });
});

function freezElement(element, className) {
    if (className)
        className = ' ' + (className + (($('#wpadminbar').length == 0) ? '' : ' ' + className + '-admin'));
    else
        className = '';

    className = ('fixed' + (($('#wpadminbar').length == 0) ? '' : ' fixed-admin')) + className;


    var startAt = 0;  //($('#wpadminbar').length == 0) ? 2 : 30;
    
    var theLoc = element.position().top - $('#top-nav').position().top - startAt;

    var win = $(window);

    function freezElementEvents() {
        if (win.width() < 1000 || win.height() < element.height() || win.height() < 400 || theLoc >= win.scrollTop()) {
            if (element.hasClass(className)) {
                element.removeClass(className);
            }
        } else {
            if (!element.hasClass(className)) {
                element.addClass(className);
            }
        }
    }

    $(window).scroll(freezElementEvents);
    $(window).resize(freezElementEvents);
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function scrollTo(el) {
    $(el).ScrollTo({
        duration: 500,
        easing: 'easeOutElastic'
    });
}

function updatePost(postId, editKey) {
    $.ajax({
        type: 'POST',
        url: '/ajax/update.php',
        data: { postId: postId, editKey: editKey },
        dataType: 'json',
        cache: false,
        success: function (data) {
            if (data) {
                if (data.error) {
                    errorMessage(data.error);
                } else if (data.info) {
                    errorMessage(data.info);
                } else {
                    errorMessage('Server error.');
                }
            } else {
                errorMessage('Connection or server error.');
            }
        },
        error: function (data) {
            errorMessage('Connection or server error.');
        }
    });
}

function privatePost(postId, editKey, visibility) {
    $.ajax({
        type: 'POST',
        url: '/ajax/private.php',
        data: { postId: postId, editKey: editKey, visibility: visibility },
        dataType: 'json',
        cache: false,
        success: function (data) {
            if (data) {
                if (data.error) {
                    errorMessage(data.error);
                } else if (data.info) {
                    errorMessage(data.info, true);
                } else {
                    errorMessage('Server error.');
                }
            } else {
                errorMessage('Connection or server error.');
            }
        },
        error: function (data) {
            errorMessage('Connection or server error.');
        }
    });
}

function updatePrice(postId, editKey, oldPrice, priceType) {
    var newPrice = prompt('New price', oldPrice);
    if (newPrice == null)
        return;

    $.ajax({
        type: 'POST',
        url: '/ajax/new-price.php',
        data: { postId: postId, editKey: editKey, newPrice: newPrice, priceType: priceType },
        dataType: 'json',
        success: function (data) {
            if (data) {
                if (data.error) {
                    errorMessage(data.error);
                } else if (data.info) {
                    errorMessage(data.info, true);
                } else {
                    errorMessage('Server error.');
                }
            } else {
                errorMessage('Connection or server error.');
            }
        },
        error: function (data) {
            errorMessage('Connection or server error.');
        }
    });
}

function errorMessage(message, refreshOnClose) {
    $('<div>').text(message).dialog({
        modal: true,
        resizable: false,
        title: 'cucak.am',
        width: 400,
        //height: 300,
        buttons: {
            Ok: function () {
                $(this).dialog("close");

                if (refreshOnClose)
                    document.location.reload();
            }
        }
    });
}

function get_random_color() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    var brightness = 0;
    var rndIndex;

    for (var i = 0; i < 6; i++) {
        rndIndex = Math.round(3 + Math.random() * 10); //Math.random() * 15
        color += letters[rndIndex];
        brightness += rndIndex * (i % 2 == 0 ? 16 : 0);
    }
    return { color: color, brightness: brightness / 768 };
}

function getHost() {
    var host = document.location.hostname;

    if (host.indexOf('cucak.am') == -1) {
        return host;
    } else {
        return 'cucak.am';
    }
}

var IE = (function () {
    "use strict";

    var ret, isTheBrowser,
        actualVersion,
        jscriptMap, jscriptVersion;

    isTheBrowser = false;
    jscriptMap = {
        "5.5": "5.5",
        "5.6": "6",
        "5.7": "7",
        "5.8": "8",
        "9": "9",
        "10": "10"
    };
    jscriptVersion = new Function("/*@cc_on return @_jscript_version; @*/")();

    if (jscriptVersion !== undefined) {
        isTheBrowser = true;
        actualVersion = jscriptMap[jscriptVersion];
    }

    ret = {
        isTheBrowser: isTheBrowser,
        actualVersion: actualVersion
    };

    return ret;
}());