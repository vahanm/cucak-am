$(document).ready(function () {
// Sliders -- BEGIN
    $('d[filterSliderList]').each(function () {
        var id = $(this).find('d[name]').text();

        var min = parseInt($(this).find('d[min]').text());
        var max = parseInt($(this).find('d[max]').text());

        var text = $(this).find('d[text]').text();
        var format = $(this).find('d[format]').text();
        var textAll = $(this).find('d[textAll]').text();
        var textMore = $(this).find('d[textMore]').text();
        var textUpTo = $(this).find('d[textUpTo]').text();

        var minVal = parseInt($(this).find('d[minVal]').text());
        var maxVal = parseInt($(this).find('d[maxVal]').text());

        var fulllist = $(this).find('d[fulllist]');

        var label = $('#' + id + '_view');

        setTextForValues(minVal, maxVal, minVal != min, maxVal != max);

        $('#slider_' + id).slider({
            range: true,
            values: [minVal, maxVal],

            min: min,
            max: max,
            slide: function (event, ui) {
                var minValue = ui.values[0];
                var maxValue = ui.values[1];
                var minInclude = ui.values[0] != min;
                var maxInclude = ui.values[1] != max;

                setTextForValues(minValue, maxValue, minInclude, maxInclude);

                advancedFilters[id] = [
                            { type: 'omn', value: minValue, include: minInclude },
                            { type: 'omx', value: maxValue, include: maxInclude }
                                                    ];

            } // slide: function
        }); // $slider

        function setTextForValues(minValue, maxValue, minInclude, maxInclude) {
            if (!minInclude && !maxInclude)
                label.text(textAll);
            else if (minValue == maxValue)
                label.text(
                                getTextFor(maxValue).replace('%s', maxValue)
                            );
            else if (!minInclude && maxInclude)
                label.text(
                                textUpTo.replace('%s', getTextFor(maxValue).replace('%s', maxValue))
                            );
            else if (minInclude && !maxInclude)
                label.text(
                                textMore.replace('%s', getTextFor(minValue).replace('%s', minValue))
                            );
            else
                label.text(
                                format.replace('%1', getTextFor(minValue)
                                        .replace('%s', minValue))
                                      .replace('%2', getTextFor(maxValue)
                                        .replace('%s', maxValue))
                                      .replace('%v1', minValue)
                                      .replace('%v2', maxValue)
                            );
        }

        function getTextFor(index) {
            var val = fulllist.find('d[key="' + index + '"]');

            if (val.length == 1)
                return val.text();
            else
                return text;
        }
    });
// Sliders -- END

    $('.weekdays .weekdays-day').click(function () {
        $(this).toggleClass('weekdays-day-selected');
    }).click(recalculateWeekDays);

    $('.weekdays-specials-everyday').click(function () {
        $(this).siblings('.weekdays').find('.weekdays-day').addClass('weekdays-day-selected');
    }).click(recalculateWeekDays);

    $('.weekdays-specials-workweek').click(function () {
        $(this).siblings('.weekdays').find('.weekdays-day-workweek').addClass('weekdays-day-selected');
    }).click(recalculateWeekDays);

    $('.weekdays-specials-weekend').click(function () {
        $(this).siblings('.weekdays').find('.weekdays-day-weekend').addClass('weekdays-day-selected');
    }).click(recalculateWeekDays);

    $('.weekdays-specials-unselect').click(function () {
        $(this).siblings('.weekdays').find('.weekdays-day').removeClass('weekdays-day-selected');
    }).click(recalculateWeekDays);
    
    $('#container_filebox .button-remove-file').live('click', function () {
        $(this).parent().remove();

        resetUploadedFilesInfo();
    });
    
    makeImagesAsSortable();

    $('.helper-datepicker').each(function (index, helper) {
        var days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        var year = $('.helper-datepicker-select-year', helper);
        var month = $('.helper-datepicker-select-month', helper);
        var day = $('.helper-datepicker-select-day', helper);
        var selected = $('.helper-datepicker-selected-1', helper);

        year.change(setDaysCount);
        month.change(setDaysCount);

        function setDaysCount() {
            var y = parseInt(year.val());
            var m = parseInt(month.val());
            var d = parseInt(day.val());

            var daysCount = days[m - 1] + (m == 2 && y % 4 == 0 ? 1 : 0);

            day.find('option:gt(26)').show().slice(daysCount - 27, 4).hide();

            if (d > daysCount) {
                day.val(daysCount);
            }
        }

        $(year).add(month).add(day).change(function () {
            selected.attr('checked', 'checked');
        });
    });
});

function resetUploadedFilesInfo() {
    if ($('#att input:radio:checked').length == 0) {
        $('#att input:radio:first').attr('checked', 'checked');
    }

    var val = '';

    $('#container_filebox .file-json').each(function () {
        val += $(this).text().trim();
    });

    $('#container_filebox #attfiles').val(val);
}

function makeImagesAsSortable() {
    var mover = $('<div class="ba-mover-top"><div>═════</div></div>');
    $('#container_filebox').find('#att').sortable({
        //placeholder: "grid-row-highlight",
        distance: 5,
        handle: '.ba-mover-top',
        items: 'div[id^="att_"]',
        stop: function (a, b) {
            resetUploadedFilesInfo();
        }
        //start: startSorting,
    }).find('div[id^="att_"]:not(:has(.ba-mover-top))').each(function (index, element) {
        $(element).addClass('ba-movable').prepend(mover.clone());
    });
}

function recalculateWeekDays(e) {
    var value = 0;
    $(this).closest('.weekdays').find('.weekdays-day-selected').each(function (index, element) {
        value += parseInt($(element).attr('value'));
    });
    $(this).closest('.weekdays').siblings('input').val(value);
}



////////////////////////////////////////////////////////////////////////////////////////////////////////////
////// WIDGETS ////// BEGIN ////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////


$(function() {
    $.widget('cucak.ba_slider', {
      // default options
      options: {
      	type: 'list',
      	min: 0,
			max: 100,
			items: [],
			value: 50,
			input: '%input%',
			view: '%view%',
			text: '%text%',
			class: 'c-helper-slider',
			
        // callbacks
        change: null,
		},
		
		// the constructor
      _create: function() {
          this._refresh();
             
			if (this.element.slider('value') > this.options.min) {
				this.options.view.text(this.options.items[this.element.slider('value') - o.min]);
			} else {
				this.options.input.val('');
				this.options.view.text(o.items[0]);
			} // if
      },
 
      // called when created, and later when changing options
      _refresh: function() {			
      	this.element
          // add a class for theming
          .addClass('c-helper-slider')
          // prevent double click to select text
          .disableSelection()
          .slider({
					range: 'min',
					value: this.options.value,
					min: this.options.min,
					max: this.options.max,
					slide: function( event, ui ) {
						if (ui.value > this.options.min) {
							this.options.input.val( ui.value );
						} else {
							this.options.input.val( '' );
						}
						this.options.view.text(this.options.items[ui.value - this.options.min]);
					}
				});
      },
      // events bound via _on are removed automatically
      // revert other modifications here
      _destroy: function() { 
        this.element
          .removeClass(this.class)
          .enableSelection()
          .slider('destroy');
      },
 
      // _setOptions is called with a hash of all options that are changing
      // always refresh when changing options
      _setOptions: function() {
        // _super and _superApply handle keeping the right this-context
        this._superApply( arguments );
        this._refresh();
      },
 
      // _setOption is called for each individual option that is changing
      _setOption: function( key, value ) {
        this._super( key, value );
      }
	});
});
    /*  	
$.ok =  function(o) {
	o.slider.slider({
		range: 'min',
		value: o.value,
		min: o.min,
		max: o.max,
		slide: function( event, ui ) {
			if (ui.value > o.min) {
				o.input.val( ui.value );
			} else {
				o.input.val( '' );
			}
			o.view.text(o.items[ui.value - o.min]);
		}
	});
}
*/


////////////////////////////////////////////////////////////////////////////////////////////////////////////
////// WIDGETS //////  END  ////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////