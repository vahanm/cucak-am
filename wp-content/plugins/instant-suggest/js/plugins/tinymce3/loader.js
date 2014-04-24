/**
 * Copyright (c) 2013 by InstantSuggest.com
 * Released under GPL2 License, see http://www.gnu.org/licenses/gpl-2.0.html
 * For contribution, see http://www.instantsuggest.com/contribution
 * For contacting, see http://www.instantsuggest.com/contact
 */
var global=!window.frameElement&&window.dialogArguments||opener||parent||top;
(function(){var a=global.tinymce.baseURI.getURI(),b=encodeURIComponent(global.tinymce.majorVersion+"."+global.tinymce.minorVersion);document.write('<script type="text/javascript" src="'+a+"/tiny_mce_popup.js?ver="+b+'">\x3c/script>');document.write('<script type="text/javascript" src="'+a+"/utils/mctabs.js?ver="+b+'">\x3c/script>');a=location.href.replace(".html",".js");document.write('<script type="text/javascript" src="'+a+'">\x3c/script>')})();
