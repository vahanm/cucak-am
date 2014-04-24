$(document).ready(function () {
    var opening = false;

    $('body').click(function () {
        if (!opening)
            $('#filtermenu').fadeOut();
        opening = false;
    });

    $("#filtermenu div").click(function () {
        setfilter($(this).attr('filtername'), $(this).attr('filtertypes'), $(this).attr('filtervalue'));
    });

    $('.content-item[filtername][filtertypes][filtervalue]')
    .removeClass('content-item')
    .addClass('content-filter')
    .click(function () {
        var filtername = $(this).attr('filtername');
        var filtertypes = $(this).attr('filtertypes');
        var filtervalue = $(this).attr('filtervalue');

        $('#filtermenu div').hide();

        if ($('.filter-container[filtername="' + filtername + '"]').length > 0) {
            $('#filtermenu-clr')
                .attr('filtername', filtername)
                .show();
        }

        if (filtertypes.indexOf('oeq') >= 0) {
            if ($('.filter-container[filtername="' + filtername + '"][filtertypes="' + filtertypes + '"][filtervalue="' + filtervalue + '"]').length == 0) {
                $('#filtermenu-oeq')
                    .attr('filtername', filtername)
                    .attr('filtervalue', filtervalue)
                    .show();
            }

            if ($('.filter-container[filtername="' + filtername + '"][filtertypes="ono"][filtervalue="' + filtervalue + '"]').length == 0) {
                $('#filtermenu-ono')
                    .attr('filtername', filtername)
                    .attr('filtervalue', filtervalue)
                    .show();
            }
        }
        if (filtertypes.indexOf('omn') >= 0) {
            if ($('.filter-container[filtername="' + filtername + '"][filtertypes="omn"][filtervalue="' + filtervalue + '"]').length == 0) {
                $('#filtermenu-omn')
                .attr('filtername', filtername)
                .attr('filtervalue', filtervalue)
                .show();
            }
        }
        if (filtertypes.indexOf('omx') >= 0) {
            if ($('.filter-container[filtername="' + filtername + '"][filtertypes="omx"][filtervalue="' + filtervalue + '"]').length == 0) {
                $('#filtermenu-omx')
                .attr('filtername', filtername)
                .attr('filtervalue', filtervalue)
                .show();
            }
        }
        if (filtertypes.indexOf('olk') >= 0) {

        }

        $('#filtermenu div span').text($(this).text());

        opening = true;

        $('#filtermenu').fadeIn('fast');
        $("#filtermenu").position({
            of: $(this),
            my: 'left top',
            at: 'left bottom',
            offset: '0 0',
            collision: 'flip flip'
        });

        //        if (filtertypes == 'oeq') {
        //            $('#filtermenu-clr')
        //                .attr('filtername', filtername)
        //                .show();

        //            $('#filtermenu-oeq')
        //                .attr('filtername', filtername)
        //    		    .attr('filtervalue', filtervalue)
        //                .show();

        //            $('#filtermenu-ono')
        //                .attr('filtername', filtername)
        //    		    .attr('filtervalue', filtervalue)
        //                .show();

        //            $('#filtermenu div span').text($(this).text());

        //            opening = true;


        //            $('#filtermenu').fadeIn('fast');
        //            $("#filtermenu").position({
        //                of: $(this),
        //                my: 'left top',
        //                at: 'left bottom',
        //                offset: '0 0',
        //                collision: 'flip flip'
        //            });

        //            return;
        //        }

        //        setfilter(filtername, filtertypes, filtervalue);
    });

    $("#filter_ShowHideFilters").click(function () {
        if ($("#filter_container_filters").css('display') == 'none') {
            $("#filter_container_filters").slideDown();
            $('#filter_advanced').val('1');
        } else {
            $("#filter_container_filters").slideUp();
            $('#filter_advanced').val('0');
        }
    });

    $("#filter_allow_alltransactions").change(function () {
        if ($("#filter_allow_alltransactions").is(':checked')) {
            $("#filter_priceforsale").slideUp("fast");
            $("#filter_priceforrent").slideUp("fast");
            $("#filter_priceforexchange").slideUp("fast");
            $("#filter_fordonation").slideUp("fast");
            $("#filter_forjob").slideUp("fast");
            $("#filter_forservice").slideUp("fast");
        }
    });

    $("#filter_allow_sale").change(function () {
        if ($("#filter_allow_sale").is(':checked')) {
            $("#filter_priceforsale").slideDown("fast");

            $("#filter_priceforrent").slideUp("fast");
            $("#filter_priceforexchange").slideUp("fast");
            $("#filter_fordonation").slideUp("fast");
            $("#filter_forjob").slideUp("fast");
            $("#filter_forservice").slideUp("fast");
        }
    });

    $("#filter_allow_rent").change(function () {
        if ($("#filter_allow_rent").is(':checked')) {
            $("#filter_priceforrent").slideDown("fast");

            $("#filter_priceforsale").slideUp("fast");
            $("#filter_priceforexchange").slideUp("fast");
            $("#filter_fordonation").slideUp("fast");
            $("#filter_forjob").slideUp("fast");
            $("#filter_forservice").slideUp("fast");
        }
    });

    $("#filter_allow_exchange").change(function () {
        if ($("#filter_allow_exchange").is(':checked')) {
            $("#filter_priceforexchange").slideDown("fast");

            $("#filter_priceforsale").slideUp("fast");
            $("#filter_priceforrent").slideUp("fast");
            $("#filter_fordonation").slideUp("fast");
            $("#filter_forjob").slideUp("fast");
            $("#filter_forservice").slideUp("fast");
        }
    });

    $("#filter_allow_donation").change(function () {
        if ($("#filter_allow_donation").is(':checked')) {
            $("#filter_fordonation").slideDown("fast");

            $("#filter_priceforsale").slideUp("fast");
            $("#filter_priceforrent").slideUp("fast");
            $("#filter_priceforexchange").slideUp("fast");
            $("#filter_forjob").slideUp("fast");
            $("#filter_forservice").slideUp("fast");
        }
    });

    $("#filter_allow_salary").change(function () {
        if ($("#filter_allow_salary").is(':checked')) {
            $("#filter_forjob").slideDown("fast");

            $("#filter_priceforsale").slideUp("fast");
            $("#filter_priceforrent").slideUp("fast");
            $("#filter_priceforexchange").slideUp("fast");
            $("#filter_fordonation").slideUp("fast");
            $("#filter_forservice").slideUp("fast");
        }
    });

    $("#filter_allow_payment").change(function () {
        if ($("#filter_allow_payment").is(':checked')) {
            $("#filter_forservice").slideDown("fast");

            $("#filter_priceforsale").slideUp("fast");
            $("#filter_priceforrent").slideUp("fast");
            $("#filter_priceforexchange").slideUp("fast");
            $("#filter_fordonation").slideUp("fast");
            $("#filter_forjob").slideUp("fast");
        }
    });

    $('input[name=post_price_rent_measure]').change(function () {
        $("#filter_minleaseterm").val($("#filter_slider_minleaseterm").slider("value"));
        $("#filter_minleaseterm_view").text($("#filter_slider_minleaseterm").slider("value") + ' ' + $('input[name=post_price_rent_measure]:checked + label').text());
    });

    $("#filter_slider_minleaseterm").slider({
        range: "min",
        value: 30, //<?php if($_POST['post_minleaseterm']) { echo $_POST['post_minleaseterm']; } else { echo 0; }; ?>,
        min: 0,
        max: 90,
        slide: function (event, ui) {
            $("#filter_minleaseterm").val(ui.value);
            $("#filter_minleaseterm_view").text(ui.value + ' ' + $('input[name=post_price_rent_measure]:checked + label').text());
        }
    });

    $("#filter_minleaseterm").val($("#filter_slider_minleaseterm").slider("value"));
    $("#filter_minleaseterm_view").text($("#filter_slider_minleaseterm").slider("value") + ' ' + $('input[name=post_price_rent_measure]:checked + label').text());


    //price_sale_contractual_bynegotiation
    $('[name="post_price_sale_contract"]').change(function () {
        if ($("#filter_price_sale_contractual_bynegotiation").is(':checked')) {
            $("#filter_priceforsalevalue").slideUp("fast");
        }
        else {
            $("#filter_priceforsalevalue").slideDown("fast");
        }
    });

    //price_rent_contractual_bynegotiation
    $('[name="post_price_rent_contract"]').change(function () {
        if ($("#filter_price_rent_contractual_bynegotiation").is(':checked')) {
            $("#filter_priceforrentvalue").slideUp("fast");
        } else {
            $("#filter_priceforrentvalue").slideDown("fast");
        }
    });


    $('#filter_searchsubmit, #filters-left-footer-submit').click(submitFilters);
    $('#filter_searchtext, #filter_container_filters input:text, .filter-input').keypress(function (e) {
        if (e.keyCode && e.keyCode == 13) {
            e.preventDefault();

            $('.filter-input').change();

            submitFilters(e);
        } else if ((typeof event != 'undefined') && event.which && event.which == 13) {
            event.preventDefault();

            $('.filter-input').change();

            submitFilters(e);
        }
    });

    $('#filter_additional_withimages').change(function () {
        advancedFilters['files'] = [{ type: 'olk', value: 'image', include: $(this).is(':checked') }];
    });

    if ($(window).width() > 1000) {
        $('#filter_searchtext').focus();
    }

    function split(val) {
        return val.split(/ \s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }

    function replaceLast(term, response) {
        var list = split(term);
        list[list.length - 1] = response;
        return list.join(' ');
    }

    $("#filter_searchtext")
    // don't navigate away from the field on tab when selecting an item
        .bind("keydown", function (event) {
            if (event.keyCode === $.ui.keyCode.TAB && $(this).data("autocomplete").menu.active) {
                event.preventDefault();
            }
        })
        .autocomplete({
            //minLength: 1,
            source: function (request, response) {
                $.getJSON("ajax/search.php", {
                    term: request.term
                }, function (r) {
                    response(r);
                });
            },
            search: function () {
                // custom minLength
                var term = this.value;
                if (term.length < 1) {
                    return false;
                }
            },
            focus: function () {
                // prevent value inserted on focus
                return false;
            },
            select: function (event, ui) {
                //var terms = split(this.value);
                //// remove the current input
                //terms.pop();
                //// add the selected item
                //terms.push(ui.item.value);
                //// add placeholder to get the comma-and-space at the end
                //terms.push("");
                //this.value = terms.join(" ");
                this.value = ui.item.value;
                return false;
            },
            open: function (event, ui) {
                
            }
        })
        /*.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            var a = $('<a>').text(item.label)
                            .append($('<span>').text('from ' + item.source).css({
                                                                        fontSize: '80%',
                                                                        float: 'right' 
                                                                    })
                    		);

            switch (item.source) {
                case 'cucak':
                    break;
                case 'google':
                    break;
        	}            
            
            return $('<li>').append(a).appendTo(ul);
        }*/;

    //$("#filter_searchtext")
    //// don't navigate away from the field on tab when selecting an item
    //    .bind("keydown", function (event) {
    //        if (event.keyCode === $.ui.keyCode.TAB && $(this).data("autocomplete").menu.active) {
    //            event.preventDefault();
    //        }
    //    })
    //    .autocomplete({
    //        //minLength: 1,
    //        source: function (request, response) {
    //            $.getJSON("ajax/search.php", {
    //                term: extractLast(request.term)
    //            }, function (r) {
    //                for (var i in r)
    //                    r[i].label = replaceLast(request.term, r[i].value)
    //                response(r);
    //            });
    //        },
    //        search: function () {
    //            // custom minLength
    //            var term = extractLast(this.value);
    //            if (term.length < 1) {
    //                return false;
    //            }
    //        },
    //        focus: function () {
    //            // prevent value inserted on focus
    //            return false;
    //        },
    //        select: function (event, ui) {
    //            var terms = split(this.value);
    //            // remove the current input
    //            terms.pop();
    //            // add the selected item
    //            terms.push(ui.item.value);
    //            // add placeholder to get the comma-and-space at the end
    //            terms.push("");
    //            this.value = terms.join(" ");
    //            return false;
    //        }
    //    });


    /* -------------------------------------------- TEST MODE --------- BEGIN ------------------------------ */

    $('#transaction-type-select').change(function() {
        //$('#' + $(this).find(':selected').attr('id')).change();

        $('#filter_priceforsale, #filter_priceforrent, #filter_priceforexchange, #filter_fordonation, #filter_forjob, #filter_forservice').slideUp('fast');

        var filterId = false;
        switch ($(this).find(':selected').attr('id')) {
            case 'filter_allow_sale':
                filterId = 'filter_priceforsale'
                break;
            case 'filter_allow_rent':
                filterId = 'filter_priceforrent'
                break;
            case 'filter_allow_exchange':
                filterId = 'filter_priceforexchange'
                break;
            case 'filter_allow_donation':
                filterId = 'filter_fordonation'
                break;
            case 'filter_allow_salary':
                filterId = 'filter_forjob'
                break;
            case 'filter_allow_payment':
                filterId = 'filter_forservice'
                break;
        }

        if (filterId !== false) {
            $('#' + filterId).slideDown("fast");
        }
    });

    /* -------------------------------------------- TEST MODE ---------  END  ------------------------------ */
});

function getValue(id) {
    return $('#filter_' + id).val();
}

function addfilterfor(filter, filtername, filtertype, filtervalue) {
    if (filter.length == 0) {
        filter += '?';
    } else {
        filter += '&';
    }

    filter += 'q' + filtername + filtertype + '=' + filtervalue;

    return filter;
}

function setfilter(filtername, filtertypes, filtervalue) {
    if (filtertypes == 'clr') {
        $('.filter-container[filtername="' + filtername + '"]').remove();

        return submitFilters();
    }

    $filter = $('.filter-container[filtername="' + filtername + '"]')
    if ($filter.length == 0) {
        $('<div></div>')
            .css('display', 'none')
            .addClass('filter-container')
            .attr('filtername', filtername)
            .attr('filtertypes', filtertypes)
            .attr('filtervalue', filtervalue)
            .appendTo($('#filter_forfilters .filtersctrl'));

        return submitFilters(1);
    } else {
        $filter = $('.filter-container[filtername="' + filtername + '"][filtertypes="' + filtertypes + '"]')
        if ($filter.length == 0) {
            $filter = $('.filter-container[filtername="' + filtername + '"][filtervalue="' + filtervalue + '"]')            
            if ($filter.length == 0) {
                
            } else {
                $filter.attr('filtertypes', filtertypes);
                return submitFilters(1);
            }
        } else {
            $filter.attr('filtervalue', filtervalue);
            return submitFilters(1);
        }
    }
}

function goToPage(page) {
    $('filter_page').val(page);

    submitFilters();
}

var advancedFilters = [];

function submitFilters(advanced) {
    if (advanced == undefined)
        advanced = 0;

    var filter = '';

    filtervalue = getValue('searchtext');
    if (filtervalue.length > 0)
        filter += '?s=' + filtervalue;

    filtervalue = getValue('author');
    if (filtervalue.length > 0)
        if (filter.length > 0)
            filter += '&author=' + filtervalue;
        else
            filter += '?author=' + filtervalue;

    filtervalue = getValue('cat');
    if (filtervalue.length > 0)
        if (filter.length > 0)
            filter += '&cat=' + filtervalue;
        else
            filter += '?cat=' + filtervalue;

    filtervalue = getValue('location');
    if (filtervalue > 0) {
        if (filtervalue % 100 != 0) {
            filter = addfilterfor(filter, 'item_location', 'omn', filtervalue);
            filter = addfilterfor(filter, 'item_location', 'omx', filtervalue);
        } else if (filtervalue % 10000 != 0) {
            filter = addfilterfor(filter, 'item_location', 'omn', filtervalue);
            filter = addfilterfor(filter, 'item_location', 'omx', parseInt(filtervalue) + 99);
        } else if (filtervalue % 1000000 != 0) {
            filter = addfilterfor(filter, 'item_location', 'omn', filtervalue);
            filter = addfilterfor(filter, 'item_location', 'omx', parseInt(filtervalue) + 9999);
        } else {
            filter = addfilterfor(filter, 'item_location', 'omn', filtervalue);
            filter = addfilterfor(filter, 'item_location', 'omx', parseInt(filtervalue) + 999999);
        }
    }

    if (getValue('advanced') == 1 || advanced) {

        switch ($('input[name="transactiontype"]:checked').val()) {
            case '1':
                filter = addfilterfor(filter, 'allow_sale', 'oeq', 1);
                break;
            case '2':
                filter = addfilterfor(filter, 'allow_rent', 'oeq', 1);
                break;
            case '3':
                filter = addfilterfor(filter, 'allow_exchange', 'oeq', 1);
                break;
            case '4':
                filter = addfilterfor(filter, 'allow_donation', 'oeq', 1);
                break;
            case '5':
                filter = addfilterfor(filter, 'allow_salary', 'oeq', 1);
                break;
            case '6':
                filter = addfilterfor(filter, 'allow_payment', 'oeq', 1);
                break;
        }

        switch ($('input[name="transactiontype"]:checked').val() || $('#filter_only_one').val()) {
            case '1':
                filtervalue = parseInt(parseInt(getValue('sale_price_min')) * parseFloat(getValue('sale_currency')));
                if (filtervalue > 0)
                    filter = addfilterfor(filter, 'sale_realprice', 'omn', filtervalue);

                filtervalue = parseInt(parseInt(getValue('sale_price_max')) * parseFloat(getValue('sale_currency')));
                if (filtervalue > 0)
                    filter = addfilterfor(filter, 'sale_realprice', 'omx', filtervalue);


                break;
            case '2':
                filtervalue = parseInt(parseInt(getValue('rent_price_min')) * parseFloat(getValue('rent_currency')) * parseFloat(getValue('rent_frequency')));
                if (filtervalue > 0)
                    filter = addfilterfor(filter, 'rent_realprice', 'omn', filtervalue);

                filtervalue = parseInt(parseInt(getValue('rent_price_max')) * parseFloat(getValue('rent_currency')) * parseFloat(getValue('rent_frequency')));
                if (filtervalue > 0)
                    filter = addfilterfor(filter, 'rent_realprice', 'omx', filtervalue);


                break;
            case '3':
                break;
            case '4':
                break;
            case '5':
                break;
            case '6':
                break;
        }
        
        $('.filter-container').each(function () {
            if (advancedFilters[$(this).attr('filtername')] == undefined) {
                filter = addfilterfor(filter, $(this).attr('filtername'), $(this).attr('filtertypes'), $(this).attr('filtervalue'));
            }
        });
        
        for(var key in advancedFilters) {
            var filters = advancedFilters[key];

            for(var index in filters) {
                var item = filters[index];
                if (item.include) {
                    filter = addfilterfor(filter, key, item.type, item.value);
                }
            }
        }
    }

    filtervalue = getValue('page');
    if (filtervalue.length > 0)
        if (filter.length > 0)
            filter += '&paged=' + filtervalue;
        else
            filter += '?paged=' + filtervalue;

    //document.location = 'http://cucak.am/' + filter;
    document.location = '/' + filter;
}
