/**
 * Copyright (c) 2013 by InstantSuggest.com
 * Released under GPL2 License, see http://www.gnu.org/licenses/gpl-2.0.html
 * For contribution, see http://www.instantsuggest.com/contribution
 * For contacting, see http://www.instantsuggest.com/contact
 */
(function(){"undefined"==typeof InstantSuggest||"undefined"==typeof CKEDITOR||CKEDITOR.dialog.add($IS.OptionsDialogModule.dialogName,function(){var k=function(a,b,d,c){var h="",h=d?b.name+"_"+d+"_"+a.id:b.name+"_"+a.id;b="function"==typeof a.items?a.items():a.items||[];return{type:a.type,id:h,label:a.label,labelLayout:"horizontal",widths:["25%","75%"],items:b,onLoad:function(){d!==c&&this.getElement().getParent().hide()},setup:function(){this.setValue(a.getValue(),!0)},commit:function(){a.setValue(this.getValue())}}},
e=[];$IS.PreferenceManager.each(function(a){var b=a.name+"_tab",d=[];a.each(function(c){var b=k(c,a);d.push(b);var f="function"==typeof c.dependencies?c.dependencies():c.dependencies||{},e=!1,g;for(g in f)e=!0,f[g].each(function(b){d.push(k(b,a,g,c.getValue()))});e&&(b.onChange=function(){var b=this,d=this.getDialog(),c;for(c in f)f[c].each(function(e){e=a.name+"_"+c+"_"+e.id;b.getValue()===c?d.getContentElement(a.name+"_tab",e).getElement().getParent().show():d.getContentElement(a.name+"_tab",e).getElement().getParent().hide()})})});
e.push({id:b,label:a.displayName,elements:d})});return{title:$IS.OptionsDialogModule.dialogTitle,width:690,height:300,resizable:!1,contents:e,buttons:[CKEDITOR.dialog.okButton,CKEDITOR.dialog.cancelButton,{type:"button",id:"help",label:"Help",title:"Go to help on $IS.com",onClick:function(){window.open($IS.helpLink,"_blank")}}],onShow:function(){this.setupContent();this.selectPage(($IS.OptionsDialogModule.params.type?$IS.OptionsDialogModule.params.type:"keyword")+"_tab")},onOk:function(){this.commitContent();
$IS.Event.fire("saveOptions",$IS.PreferenceManager.getAllOptionValues())}}})})();
