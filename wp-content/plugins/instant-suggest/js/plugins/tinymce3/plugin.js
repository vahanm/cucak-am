/**
 * Copyright (c) 2013 by InstantSuggest.com
 * Released under GPL2 License, see http://www.gnu.org/licenses/gpl-2.0.html
 * For contribution, see http://www.instantsuggest.com/contribution
 * For contacting, see http://www.instantsuggest.com/contact
 */
(function(){"undefined"==typeof InstantSuggest||"undefined"==typeof tinymce||($IS.TinyMCE3Plugin=function(){},$IS.TinyMCE3Plugin.prototype.init=function(a,b){this.editor=a;this.url=b;var c=[$IS.OptionsDialogModule.buttonName,$IS.StartSelectionModule.buttonName,$IS.KeywordMenuModule.buttonName,$IS.KeywordResearchModule.buttonName,$IS.ArticleSearchModule.buttonName],e=function(){for(var b=",|,",a=0;a<c.length;a++)b+=c[a],a<c.length-1&&(b+=",");return b},f=function(b){if(0===$IS.Env.platform.indexOf("WordPress"))return"theme_advanced_buttons1";
for(var a,c="",h=1;a=b["theme_advanced_buttons"+h]?"theme_advanced_buttons"+h:"";h++)b["theme_advanced_buttons"+h+"_add"]&&(a="theme_advanced_buttons"+h+"_add"),c=a;return c},d=f(a.settings);d?a.settings[d]+=e():a.onBeforeRenderUI.add(function(b,a){b.theme&&b.theme.settings&&(d=f(b.theme.settings))?b.theme.settings[d]+=e():a.onAdd.add(function(a,h){if(a instanceof tinymce.ui.Toolbar){for(var e=!1,d=0;d<c.length;d++)if(!h.get(c[d])){var f=h.createButton(c[d],b.buttons[c[d]]);f&&(a.add(f),e=!0)}e&&
a.add(h.createSeparator())}})});this.addOptionsDialogModule();this.addStartSelectionModule();this.addEndSelectionModule();this.addKeywordMenuModule();this.addContentModule();this.addKeywordResearchModule();this.addArticleSearchModule()},$IS.TinyMCE3Plugin.prototype.addOptionsDialogModule=function(){var a=this,b=a.editor;b.addCommand($IS.OptionsDialogModule.commandName,function(){b.windowManager.open({url:a.url+"/options.html?ver="+$IS.version,width:710,height:380,inline:1,resizable:!1})});if(!b.plugins.inlinepopups&&
tinymce.plugins.InlinePopups){var c=new tinymce.plugins.InlinePopups(b,tinymce.PluginManager.urls.inlinepopups);b.plugins.inlinepopups=c;c.init&&c.init(b,tinymce.PluginManager.urls.inlinepopups)}b.addShortcut("ctrl+shift+o",$IS.OptionsDialogModule.buttonTitle,$IS.OptionsDialogModule.commandName);b.addButton($IS.OptionsDialogModule.buttonName,{title:$IS.OptionsDialogModule.buttonTitle,image:$IS.OptionsDialogModule.buttonIcon,cmd:$IS.OptionsDialogModule.commandName})},$IS.TinyMCE3Plugin.prototype.addStartSelectionModule=
function(){var a=this,b=a.editor;b.addCommand($IS.StartSelectionModule.commandName,function(){var c=b.dom.createRng(),e=b.selection.getRng(!0);"undefined"==typeof a.selectionRange&&b.selection.setContent("");c.setStart(e.startContainer,e.startOffset);a.selectionRange=c});b.addShortcut("ctrl+shift+s",$IS.StartSelectionModule.buttonTitle,$IS.StartSelectionModule.commandName);b.addButton($IS.StartSelectionModule.buttonName,{title:$IS.StartSelectionModule.buttonTitle,image:$IS.StartSelectionModule.buttonIcon,
cmd:$IS.StartSelectionModule.commandName})},$IS.TinyMCE3Plugin.prototype.addEndSelectionModule=function(){var a=this,b=a.editor;b.addCommand($IS.EndSelectionModule.commandName,function(c,e){if(a.selectionRange){var f=a.selectionRange,d=b.selection.getRng(!0);f.setEnd(d.endContainer,d.endOffset);b.selection.setRng(f);e&&e.call(b)}})},$IS.TinyMCE3Plugin.prototype.addKeywordMenuModule=function(){var a=this,b=a.editor,c,e,f=function(){e=!0;c||(d.call(this),c=setTimeout(d,200,this))},d=function(){c=null;
e&&(setTimeout(q,0,this),e=!1)},p=function(a){var c=a.getBookmark(),e=b.dom.create("span",{},"&#65279;"),d;a.getRng(!0).cloneRange().insertNode(e);d=e.getBoundingClientRect();e.parentNode.removeChild(e);c.keep=0;a.moveToBookmark(c);return{x:d.left,y:d.bottom}},q=function(){var c=b.selection,e=c.getContent({format:"text"}),d=tinymce.trim(e);if(!(d.length<$IS.keywordToolPreference.getOptionValue("minKeywordLength")||d.length>$IS.keywordToolPreference.getOptionValue("maxKeywordLength"))){var f=$IS.keywordProviderManager.getProvider(),
n=p(c),g=null,k;f.getSuggestions({keyword:tinymce.trim(e)},{async:!1,beforeSend:function(){k=c.getBookmark();g=b.dom.create("div",{contenteditable:!1});tinymce.DOM.setStyles(g,{position:"fixed",top:0,left:0,"z-index":9999,"background-color":"white",opacity:0.5,filter:"Alpha(opacity=50)",display:"block",width:"100%",height:"100%",cursor:"wait"});c.win.document.body.appendChild(g)},complete:function(){g&&(tinymce.DOM.setStyle(g,"cursor","text"),g.parentNode.removeChild(g),g=null);k&&(k.keep=0,c.moveToBookmark(k))},
success:function(c){$IS.Api.log(f,"m",c);if(0!=c.length){var d=b.selection,g=tinymce.DOM.getPos(b.getContentAreaContainer());a.menu=b.controlManager.createDropMenu($IS.pluginName,{offset_x:g.x,offset_y:g.y,constrain:1,keyboard_focus:!0});var l=function(){a.menu&&a.menu.hideMenu()},k=function(b){var c=a.menu.classPrefix+"ItemActive";b=$IS.Event.getTarget(b);tinymce.DOM.removeClass(a.menu.menuItems,c);tinymce.DOM.addClass(tinymce.DOM.get(b.id),c)},m=function(a){var c=$IS.Event.getKey(a);a=$IS.Tools.getTextContent($IS.Event.getTarget(a));
switch(c){case $IS.Event.KEY.S:c=$IS.keywordProviderManager.getProvider().getSearchUrl({keyword:a});window.open(c,"_blank");l();break;case $IS.Event.KEY.K:b.execCommand($IS.ContentDialogModule.commandName,!0,{type:"keyword",keyword:a});l();break;case $IS.Event.KEY.A:b.execCommand($IS.ContentDialogModule.commandName,!0,{type:"article",keyword:a}),l()}};a.menu.onShowMenu.add(function(){b.onMouseDown.add(l);b.onKeyDown.add(l);this.menuItems=tinymce.DOM.select("a[role=option]","menu_"+this.id);tinymce.each(a.menu.menuItems,
function(a){tinymce.DOM.bind(a,"focus",k);tinymce.DOM.bind(a,"keyup",m)})});a.menu.onHideMenu.add(function(){b.onMouseDown.remove(l);b.onKeyDown.remove(l);tinymce.each(a.menu.menuItems,function(a){a=tinymce.DOM.get(a.id);tinymce.DOM.unbind(a,"focus",k);tinymce.DOM.unbind(a,"keyup",m)});a.menu.menuItems=[];a.menu.removeAll();a.menu.destroy();a.menu=null;b.focus()});tinymce.each(c,function(b){a.menu.add({title:b,onclick:function(){d.setContent($IS.Tools.formatSuggestion(e,b))}})});a.menu.showMenu(n.x,
n.y);setTimeout(function(){a.menu.focus()},0)}}})}};b.onKeyUp.add(function(a,b){var c=$IS.Event.getKey(b);b.shiftKey&&(c==$IS.Event.KEY.LEFT||c==$IS.Event.KEY.RIGHT)&&$IS.keywordToolPreference.getOptionValue("enableKeySelectionMode")&&f.call(a)});b.onMouseUp.add(function(a,b){1===$IS.Event.getMouseButton(b)&&$IS.keywordToolPreference.getOptionValue("enableMouseSelectionMode")&&f.call(a)});b.addCommand($IS.KeywordMenuModule.commandName,function(){b.execCommand($IS.EndSelectionModule.commandName,!0,
f)});b.addShortcut("ctrl+shift+e",$IS.KeywordMenuModule.buttonTitle,$IS.KeywordMenuModule.commandName);b.addButton($IS.KeywordMenuModule.buttonName,{title:$IS.KeywordMenuModule.buttonTitle,image:$IS.KeywordMenuModule.buttonIcon,cmd:$IS.KeywordMenuModule.commandName})},$IS.TinyMCE3Plugin.prototype.addContentModule=function(){var a=this,b=a.editor;b.addCommand($IS.ContentDialogModule.commandName,function(c,e){b.windowManager.open({url:a.url+"/content.html?ver="+$IS.version,width:800,height:540,inline:1,
resizable:!1},e)})},$IS.TinyMCE3Plugin.prototype.addKeywordResearchModule=function(){var a=this.editor;a.addCommand($IS.KeywordResearchModule.commandName,function(){var b=tinymce.trim(a.selection.getContent({format:"text"}));b||(a.execCommand($IS.EndSelectionModule.commandName,!1),b=tinymce.trim(a.selection.getContent({format:"text"})));a.execCommand($IS.ContentDialogModule.commandName,!0,{type:"keyword",keyword:b})});a.addShortcut("ctrl+shift+k",$IS.KeywordResearchModule.buttonTitle,$IS.KeywordResearchModule.commandName);
a.addButton($IS.KeywordResearchModule.buttonName,{title:$IS.KeywordResearchModule.buttonTitle,image:$IS.KeywordResearchModule.buttonIcon,cmd:$IS.KeywordResearchModule.commandName})},$IS.TinyMCE3Plugin.prototype.addArticleSearchModule=function(){var a=this.editor;a.addCommand($IS.ArticleSearchModule.commandName,function(){var b=tinymce.trim(a.selection.getContent({format:"text"}));b||(a.execCommand($IS.EndSelectionModule.commandName,!1),b=tinymce.trim(a.selection.getContent({format:"text"})));a.execCommand($IS.ContentDialogModule.commandName,
!0,{type:"article",keyword:b})});a.addShortcut("ctrl+shift+a",$IS.ArticleSearchModule.buttonTitle,$IS.ArticleSearchModule.commandName);a.addButton($IS.ArticleSearchModule.buttonName,{title:$IS.ArticleSearchModule.buttonTitle,image:$IS.ArticleSearchModule.buttonIcon,cmd:$IS.ArticleSearchModule.commandName})},$IS.TinyMCE3Plugin.prototype.register=function(){var a=this,b=$IS.pluginName;tinymce.create("tinymce.plugins."+b,{init:function(b,c){a.init(b,c)}});var c=[];tinymce.plugins.InlinePopups||c.push({prefix:"plugins/",
resource:"inlinepopups",suffix:"/editor_plugin"+tinymce.suffix+".js"});tinymce.PluginManager.add(b,tinymce.plugins[b],c)},(new $IS.TinyMCE3Plugin).register())})();
