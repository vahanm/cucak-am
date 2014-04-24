/* Author:
	Eduard Ghazanchyan
*/
	
	/* JSON DB loader */
	$(function() {
		var no_res = {
			en: 'No results match',
			ru: 'Нет результатов по запросу',
			am: 'Հետևյալ հարցմամբ արդյունք չկա'
		},
		add_other = {
			en: 'Add',
			ru: 'Добавить',
			am: 'Ավելացնել'
		},
		add_other2 = {
			en: ' this option',
			ru: ' этот вариант',
			am: ' այս տարբերակը'
		};
		add_other_placeholder = {
			en: 'search/add option',
			ru: 'искать/добавить',
			am: 'որոնել/ավելացնել'
		};
		
		$(".chzn-select").chosen({
			allow_single_deselect: true,
			no_results_text: no_res[currentLang],
			add_other_text: add_other[currentLang],
			add_other_text2: add_other2[currentLang]
		});
		$("#add-item-form .add-other").next().find(".chzn-search input").prop('placeholder', add_other_placeholder[currentLang]);
		
		$brand = $("#brand_select");
		if ($brand.length) {
			var db,
				opt = $brand.data('selected');
			switch ($brand.data("type")) {
				case "auto":
					db = baseUrl + 'public/js/db/auto.json';
					break;
				case "mobile":
					db = baseUrl + 'public/js/db/mobile.json';
					break;
			}
			$.getJSON(db,function(data) {
				var sel, exist = false;
				for(var i in data) {
					if (opt == i) {
						sel = "selected='selected'";
						exist = true;
					} else {
						sel = '';
					}
					$brand.append("<option "+sel+" value='"+i+"'>"+i+"</option>");
				}
				if (!exist && opt) {
					$brand.append("<option selected='selected' value='"+opt+"'>"+opt+"</option>");
				}			
				$brand
					.trigger("liszt:updated")
					.chosen().change(function() {
						var $sel = $("#model_select"),
							brand = $brand.val();
						$sel.empty();
						if (brand) {
							getASOC(brand,data);
						}
					}).trigger("change");
			});
		}
	});
	
	var auto_class = {
		Mercedes : ['A', 'B', 'C', 'E', 'G', 'ML', 'R', 'S', 'V'],
		BMW : [1, 3, 5, 6, 7, 8, 'M', 'X', 'Z']
	}

	function getASOC(val,data) {
		var brand = data[val];
		var $sel = $("#model_select"),
			opt = false;

		$sel.append("<option value=''></option>");
		if ($sel.hasClass('by-class') && (val == 'Mercedes' || val == 'BMW')) {
			$y = $('<optgroup label="By class"></optgroup>');
			for (var i in auto_class[val]) {
				$y.append("<option value='class_"+auto_class[val][i]+"'>"+auto_class[val][i]+" - class</option>");
			}
			$sel.append($y);
			$x = $('<optgroup label="By model"></optgroup>');
			$sel.append($x);
		} else {
			$x = $sel;
		}

		if ( $sel.data('selected') ) {
			opt = $sel.data('selected');
			$sel.removeData('selected');
		}
		var sel, exist = false;
		for (var i in brand) {
			if (opt == brand[i]['value']) {
				sel = "selected='selected'";
				exist = true;
			} else {
				sel = '';
			}
			$x.append("<option "+sel+" value='"+brand[i]['value']+"'>"+brand[i]['value']+"</option>");
		}
		if (!exist && opt) {
			$x.append("<option selected='selected' value='"+opt+"'>"+opt+"</option>");
		}
		$sel.trigger("liszt:updated");
	}

	var MAX_FILES = 8, CURRENT_FILES = 0;
	/* other functions */
	$(function() {
		
		/* pseudo HTML5 placeholder element */
		jQuery.support.placeholder = false;
		test = document.createElement('input');
		if('placeholder' in test) jQuery.support.placeholder = true;

		if(!$.support.placeholder) { 
			var active = document.activeElement;
			$(':text').focus(function () {
				if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
					$(this).val('').removeClass('hasPlaceholder');
				}
			}).blur(function () {
				if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
					$(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
				}
			});
			$(':text').blur();
			$(active).focus();
			$('form').submit(function () {
				$(this).find('.hasPlaceholder').each(function() { $(this).val(''); });
			});
		}
	
		/* icons shadow */
		$(".nav-shadow li").append('<img class="shadow" src="'+baseUrl+'public/img/icons-shadow.png" width="74" height="31" alt="" />');
		$(".nav-shadow li").hover(function() {
			var e = this;
			$(e).find("a").stop().animate({ marginTop: "-14px" }, 250, function() {
				$(e).find("a").animate({ marginTop: "-10px" }, 250);
			});
			$(e).find("img.shadow").stop().animate({ width: "80%", height: "20px", marginLeft: "8px", opacity: 0.25 }, 250);
		},function(){
			var e = this;
			$(e).find("a").stop().animate({ marginTop: "4px" }, 250, function() {
				$(e).find("a").animate({ marginTop: "0px" }, 250);
			});
			$(e).find("img.shadow").stop().animate({ width: "100%", height: "27px", marginLeft: "0", opacity: 1 }, 250);
		});
		
		$(".nav-shadow-big li").append('<img class="shadow-big" src="'+baseUrl+'public/img/big_shadow.png" width="91" height="38" alt="" />');
		$(".nav-shadow-big li").hover(function() {
			var e = this;
			$(e).find("a").stop().animate({ marginTop: "-14px" }, 250, function() {
				$(e).find("a").animate({ marginTop: "-10px" }, 250);
			});
			$(e).find("img.shadow-big").stop().animate({ width: "80%", height: "20px", marginLeft: "8px", opacity: 0.25 }, 250);
		},function(){
			var e = this;
			$(e).find("a").stop().animate({ marginTop: "4px" }, 250, function() {
				$(e).find("a").animate({ marginTop: "0px" }, 250);
			});
			$(e).find("img.shadow-big").stop().animate({ width: "100%", height: "27px", marginLeft: "0", opacity: 1 }, 250);
		});
		
		/* shadowbox */
		Shadowbox.init({continuous: true});
		
		/* hover image change */
		$("#item-images .small-image").hover(function() {
			var src = $(this).find("img").prop("src");
				href = $(this).find("a").prop("href");
			// alert(src);
			if ( src.indexOf('noimage') == -1 ) {
				$("#item-images .big-image a").prop("href",href);
				$("#item-images .big-image img").prop("src",src);
				Shadowbox.setup();
			}
		},function(){});
		
		/* results view type lines/blocks */
		$("#results-container .orderChange").click(function(event) {
			event.preventDefault();
			$("#results-container .orderChange").removeClass("current");
			var order = $(this).addClass("current").data("order");
			$("#results-container").prop("class",order+"-view");
			setCookie("viewType",order+"-view",1);
		});
		
		/* generate descriptions and toggle options */
		$(".hidden-head").each(function() {
			var $that = $(this),
				descShort = '',
				options = $that.next("div");
			options.toggle().find("p label").each(function() {
				descShort += (descShort == '') ? '' : ', ';
				descShort += $(this).html().split(':')[0];
			});
			var block = document.createElement("div");
			block.className = "moreInfoBlock";
			block.innerHTML = descShort;
			$that.click(function() {
				$(block).toggle();
				options.toggle();
			}).after(block);
		});
		
		/* region changer */
		var yerevan = {
			en: ['Ajapnyak','Arabkir','Avan','Davtashen','Erebuni','Kanaker-Zeytun','Kentron','Malatia-Sebastia','Nork-Marash','Nor Nork','Nubarashen','Shengavit'],
			ru: ['Ачапняк','Арабкир','Аван','Давташен','Эребуни','Канакер-Зейтун','Центр','Малатия-Себастия','Норк Мараш','Нор Норк','Нубарашен','Шенгавит'],
			am: ['Աջափնյակ','Արաբկիր','Ավան','Դավթաշեն','Էրեբունի','Քանաքեռ-Զեյթուն','Կենտրոն','Մալաթիա-Սեբաստիա','Նորք-Մարաշ','Նոր Նորք','Նուբարաշեն','Շենգավիթ']
		},
		yerevan = yerevan[currentLang];
		var region = {
			en: ['Aragatsotn','Ararat','Armavir','Gegharkunik','Lori','Kotayk','Shirak','Syunik','Vayots Dzor','Tavush'],
			ru: ['Арагацотн','Арарат','Армавир','Гегаркуник','Лори','Котайк','Ширак','Сюник','Вайоц Дзор','Тавуш'],
			am: ['Արագածոտն','Արարատ','Արմավիր','Գեղարքունիք','Լոռի','Կոտայք','Շիրակ','Սյունիք','Վայոց Ձոր','Տավուշ']
		},
		region = region[currentLang];
		var zzz = $(".change_region:checked");
		init_region(zzz);
		$(".change_region").change(function() {
			init_region($(this));
		});
		function init_region(zzz) {
			var x = $("#region_type_selector");
			x.empty();
			if(zzz.val() == 2) {
				x.empty();
				for(var i in region) {
					j = parseInt(i) + 1;
					var sel = (x.data("selected") == j) ? 'selected="selected"' : '';
					x.append("<option "+sel+" value="+j+">"+region[i]+"</option>");
				}
			}
			else {
				for(var i in yerevan) {
					j = parseInt(i) + 1;
					var sel = (x.data("selected") == j) ? 'selected="selected"' : '';
					x.append("<option "+sel+" value="+j+">"+yerevan[i]+"</option>");
				}
			}
			x.trigger("liszt:updated");
		}
		
		/* model/make other changer */
/*		var current_region_aa = "Երևան";
		var region_aa = $("#region_type_selector");
		region_aa.change(function() {
			current_region_aa = region_aa.find("option:selected").text()
			searchLocation(current_region_aa, $(this).val());
		});*/
		
		$("#searchMapField").keyup(function() {
			searchLocation(current_region_aa, $(this).val());
		});
		
		/* conditional price */
		$("#price_dogovor, #i_conditional").change(function() {
			$("#price_to_hide, #price_to_show").toggle();
			$("#price_to_hide input.toxer").val('');
		});
		
		/* option changer */
		var $optBut = $(".option-button"),
			$hidden = $(".option-hidden");
		$optBut.click(function(event) {
			event.preventDefault();
			var $that = $(this);
			if ( !$that.hasClass('active') ) {
				$optBut.removeClass('active');
				$that.addClass('active');
				$hidden.toggle();						
			}
		});
		
		/* image preview in search results */
		screenshotPreview();
			
		/* rate parser and currency viewer */
		var currency = $("span.currency");
		if (currency.length) {
			$.getJSON(baseUrl+'am/ajax/rate', function(data) {
				currency.hover(function (e) {
					$("body").append("<div id='currency_block'></div>");
					var price = $(this).data('value');
					var html = '';
					for(var i in data) {
						html += "<p>"+number_format(price/data[i],0,',',' ') + ' ' +i+"</p>";
					}
					$("#currency_block")
						.html(html)
						.css("top",(e.pageY - xOffset) + "px")
						.css("left",(e.pageX + yOffset) + "px")
						.fadeIn("fast");
					
				}, function() {
					$("#currency_block").remove();
				});	
				
			});
		}
		
		/* add/edit form currency ratio */
		var $c_ratio = $("#currency-ratio");
		if ($c_ratio.length) {
			$.getJSON(baseUrl+'am/ajax/rate', function(data) {
				$c_ratio.find('option').each(function () {
					var $that = $(this),
						c_name = $that.text();
					if (c_name in data) {
						$that.val(data[c_name]);
					}
				});
			});
		}
		
		/* form submit/validation handler, automatic file uploader on submit */
		$("#add-item-form").bind('submit', function (event) {
			event.preventDefault();
			if (validate($(this))) {

				var $form = $(this);
				if ($("#captcha").length) {
					checkCaptcha($form, event);
				} else if ($('.image-container').length) {
					checkEditForm($form, event);
				} else {
					if ($('#uploader').length) {
						var uploader = $('#uploader').pluploadQueue();
						if(uploader.files.length == 0) {
							$form.unbind( event );
							$form.submit();
						} else {
							uploader.start();
						}
						uploader.bind('UploadComplete',function () {
							$form.unbind( event );
							$form.submit();
						});
					} else {
						$form.unbind( event );
						$form.submit();
					}
				}
			}
		});
		
		/* mark current favorites, add/remove them on click */
		var $favs = $(".favorite_button"),
			favURL = baseUrl+'am/ajax/favorite',
			$favRes = $(".ajax-upd-favs p");
		
		if ($favs.length && $(".infoLineMail").length) {
			$.getJSON( favURL, function (data) {
				if (data.status == 'ok') {
					$favRes.html(data.total);
					$favs.each(function() {
						var $that = $(this);
						for (var i in data.favs) {
							if (data.favs[i] == $that.data("id")) {
								$that.addClass('active');
								break;
							}
						}
					});
				}
			});

			$favs.bind('click', function (event) {
				event.preventDefault();
				var $that = $(this);
				$.post( favURL, { 'id': $that.data('id') },
					function(data){
						var status = data.status;
						if (status == 'add') {
							$that.addClass('active');
							$favRes.html(data.total);
						} else if (status == 'remove') {
							$that.removeClass('active');
							$favRes.html(data.total);
						}
					} , "json"
				);
			});
		}
		
		/* check new emails */
		var $mailRes = $(".ajax-upd-mail p"),
			mailURL = baseUrl+'am/ajax/checkMail';
		
		if ($mailRes.length) {
			$.getJSON( mailURL, function (data) {
				if (data.status == 'ok') {
					$mailRes.html(data.new);
				}
			});
		}
		
		/* set search view order if saved in cookies */
		var $resCon = $("#results-container");
		if ($resCon.length) {
			var vt = getCookie("viewType");
			if (vt == 'block-view') {
				$(".orderChange").each(function() {
					var $that = $(this);
					$that.removeClass('current');
					if ($that.data('order') == 'block') {
						$that.addClass('current');
					}
				});
				$resCon.prop("class",vt);
			}
		}
		
		/* per page logic for search */
		if ($(".perPageChanger").length) {
			var uri = document.location.href,
				patt = /\/pp:\d*/;
			if (patt.test(uri)) {
				id = uri.match(patt)[0].split(':')[1];
				$(".perPageChanger a").removeClass('current');
				$(".perPageChanger a").each(function() {
					if ($(this).data('value') == id) {
						$(this).addClass('current');
					}
				});
			}
			
			$(".perPageChanger a").click( function(e) {
				e.preventDefault();
				processPageURL( $(this).data('value') );
			});
		}
		
		/* order by logic for search */
		if ($("#order-by").length) {
			var uri = document.location.href,
				patt = /\/order:\d*/;
			if (patt.test(uri)) {
				id = uri.match(patt)[0].split(':')[1];
				$("#order-by option:selected").each(function() {
					$(this).removeAttr('selected');
				});
				$("#order-by")[0].selectedIndex = id;
				$("#order-by").trigger("liszt:updated");
			}
			
			$("#order-by").change(function() {
				$("#order-by option:selected").each(function () {
					processOrderURL( $(this).val() );
				});
			});
		}

		/* captcha functions */
		$("#reload-captcha").click(function(e) {
			e.preventDefault();
			reCaptcha();
		});
		
		function reCaptcha() {
			var sesID = 'haha';
			$(".captchaImg  img").remove();
			$(".captchaImg").append("<img src='"+baseUrl+"am/captcha/?PHPSESSID="+sesID+"&date="+new Date()+"' />");
		}
		
		/* vip slider */
		if ( $('#slider1').length ) {
			$('#slider1').tinycarousel({  
				axis: 'y', 
				interval: 200, 
				intervaltime: 8000 
			});
			var kw_set = {
				max : 170,
				spacing : 0,
				duration: 120
			};
			$('.kwicks1').kwicks(kw_set);
			$('.kwicks2').kwicks(kw_set);
		}
		
		/* view/get line slider */
		if ($('#slider-code')) {
			$('#slider-code').tinycarousel({
				display: 2,
				axis: 'x',
				/*interval: 200, */
				/*intervaltime: 3000 */
			});
		}

		/* add/remove other field on select change */
		$(".with-other").each(function() {
			var $that = $(this);
			$that.append("<option></option>");
			$that.change(function() {
				var name = $that.attr("name");
				$that.removeAttr("name");
			});
		});
		
		/* toggle advanced search */
		$('.adv-search-but a').click(function(e) {
			e.preventDefault();
			$('.adv-search-but a,.adv-search-but span,.search-to-hide').toggle();
		});
		
		/* following bubbles */
		var $sidebar   = $(".sell-description");
		if ($sidebar.length) {
			var $window    = $(window),
				offset     = $sidebar.offset(),
				topPadding = 25;

			$window.scroll(function() {
				if ($window.scrollTop() > offset.top) {
					$sidebar.stop().animate({
						marginTop: (($window.scrollTop() - offset.top + topPadding) > 405 ) ? 405 : ($window.scrollTop() - offset.top + topPadding)
					});
				} else {
					$sidebar.stop().animate({
						marginTop: 0
					});
				}
			});
		}
		
		/* add number plus */
		$('.sec-tel-plus').bind('click', function(event) {
			event.preventDefault();
			$(".sec-tel").css('display','block');
			$(this).css('display','none');
		});

		/* required hider */
		$("#i_action").change(function() {
			if ($(this).val() == 1) return;
			var x = [	'input[name="distance"]',
						'select[name="year"]',
						'select[name="transmission"]',
						'select[name="fuel"]',
						'select[name="tax"]'	];
			$(x.join(", ")).each(function () {
				$el = $(this);
				$el.toggleClass("required_field");
				if ($el.is("select")) {
					$el.next("div").find("a:first-child").removeClass("error");
				} else {
					$el.removeClass("error");
				}
			});
		});
		
		/* category changer */
		if ($("#category-changer").length) {
			$("#category-changer").change(function() {
				var url = baseUrl + currentLang + '/search/items/cat:' + $(this).val();
				document.location = url;
			});
		}
		
		/* last viewed */
		$('#navigation li').stop().animate({'marginLeft':'-85px'},1000);
		$('#navigation > li').hover(
			function () {
				$(this).stop().animate({'marginLeft':'-2px'},200);
			},
			function () {
				$(this).stop().animate({'marginLeft':'-85px'},200);
			}
		);
		
		/* image editing */
		$('.image-container .remove').click(function (e) {
			e.preventDefault();
			var $parent = $(this).parent();
			var url = baseUrl + currentLang + '/plupload/remove/' + $parent.data('name');
			$.get(url, function(data) {
				if (data == 'ok') $parent.remove();
				$('.add-new-container').css('display', 'block');
			});
		});
		
		/* general image */
		var radioButtons = $(".image-container .main_image");
		radioButtons.change(function () {
			var selectedIndex = radioButtons.index(radioButtons.filter(':checked'));
			$("#general_image").val(selectedIndex + 1);
		});
		
	});


function checkEditForm($form, event) {
	
	if ($('#add-container').length) {
		if(uploader.files.length == 0) {
			$('.image-container .main_image').removeAttr('name');
			$form.unbind( event );
			$form.submit();
		} else {
			uploader.start();
		}
		uploader.bind('UploadComplete',function () {
			$('.image-container .main_image').removeAttr('name');
			$form.unbind( event );
			$form.submit();
		});
	} else {
		$('.image-container .main_image').removeAttr('name');
		$form.unbind( event );
		$form.submit();
	}
}
function checkCaptcha($form, event) {
	return $.post( baseUrl + 'am/captcha/check',{keystring: $("#captcha").val()} ,function(data) {
		if (data == 'ok') {		
			if ($('#uploader').length) {
				if(uploader.files.length == 0) {
					$form.unbind( event );
					$form.submit();
				} else {
					uploader.start();
				}
				uploader.bind('UploadComplete',function () {
					$form.unbind( event );
					$form.submit();
				});
			} else {
				$form.unbind( event );
				$form.submit();
			}
		} else {
			$("#captcha").addClass("error");
		}
	});
}	
	
function processPageURL(ppData) {
	var uri = document.location.href,
		patt = /\/pp:\d*/;
	if (patt.test(uri)) {
		document.location.href = uri.replace(patt, '/pp:' + ppData);
	} else {
		if (uri.charAt(uri.length - 1) != '/') {
			uri += '/';
		}
		document.location.href = uri + 'pp:' + ppData;
	}
}

function processOrderURL(ppData) {
	// alert(ppData);
	var uri = document.location.href,
		patt = /\/order:\d*/;
	if (patt.test(uri)) {
		document.location.href = uri.replace(patt, '/order:' + ppData);
	} else {
		if (uri.charAt(uri.length - 1) != '/') {
			uri += '/';
		}
		document.location.href = uri + 'order:' + ppData;
	}
}

/* set/get cookie interface */	
function setCookie(c_name,value,exdays){
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name){
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++){
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name){
			return unescape(y);
		}
	}
}
function eraseCookie(name) {
	setCookie(name,"",-1);
}

/* form clientside validation */
function validate($elem) {
	var valid = true,
		move = false;
	$elem.find(".required_field").each(function () {
		var $that = $(this);
		if ($that.is("select")) {
			if ($that.find("option:selected").length && $that.find(":selected").val() != '') {
				$that.next("div").find("a:first-child").each(function () {
					$(this).removeClass( "error" );
				});
			} else {
				$that.next("div").find("a:first-child").each(function () {
					valid = false;
					if (!move) {
						$(this).goTo();
						move = true;
					}
					$(this).addClass( "error" );
				});			
			}
		} else if ($that.is("input") || $that.is("textarea")) {
			if ($that.val() == '') {
				valid = false;
				if (!move) {
					$(this).goTo();
					move = true;
				}
				$that.addClass( "error" );
			} else if ($that.hasClass( "email" ) && !isValidEmailAddress($that.val())) {
				$that.addClass( "error" );
			} else {
				$that.removeClass( "error" );
			}
		}
	});
	return valid;
}
function isValidEmailAddress(emailAddress) {
	var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
}
$(function() {
		$('.pop-up-link').click(function(event) {
			event.preventDefault();
			$('.pop-up-link').next().css({"display" : "none"});
			$(this).next()
				.css({
					"position" : "fixed",
					"top" :  '50%',
					"left" : '50%',
					"margin-top" : -70, 
					"margin-left" : -70 
				})
				.fadeIn(500);
		});
		
		$(".close").click(function (e) {
			e.preventDefault();
			$('.pop-up-link').next().fadeOut(500);
		});
		
		$(".pop-up-link-user .favorite_button").click(function (e) {
			e.preventDefault();
			var $popup = $('.popup');
			$popup.fadeIn(500);

			$popup.find(".close").click(function (e) {
				e.preventDefault();
				$popup.fadeOut(500);
			});
		});
		
		$(".vip_button, #vipAds").click(function (e) {
			e.preventDefault();
			$(".smsBox").css("position","absolute");
			var $popup = $('.popup1');
			$popup.fadeIn(500);
			
			$popup.find(".close").click(function (e) {
				e.preventDefault();
				$(".smsBox").css("position","static");
				$popup.fadeOut(500);
			});
		});
	});