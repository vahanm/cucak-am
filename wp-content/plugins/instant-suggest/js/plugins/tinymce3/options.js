/**
 * Copyright (c) 2013 by InstantSuggest.com
 * Released under GPL2 License, see http://www.gnu.org/licenses/gpl-2.0.html
 * For contribution, see http://www.instantsuggest.com/contribution
 * For contacting, see http://www.instantsuggest.com/contact
 */
OptionsDialog={listeners:[],init:function(){var g=this,k=[],h=[],l=global.$IS.OptionsDialogModule.params.type?global.$IS.OptionsDialogModule.params.type:"keyword",n=function(b,a,c,e){var d=[],f=[],m="";c?(a=a.name+"_"+c+"_"+b.id,m=c===e?"":' style="display:none;"'):a=a.name+"_"+b.id;c="function"==typeof b.items?b.items():b.items||[];switch(b.type){case "text":f.push('<input type="text" id="'+a+'" value="'+b.getValue()+'" />');break;case "checkbox":c=b.getValue()?' checked="checked"':"";f.push('<input type="checkbox" id="'+
a+'"'+c+" />");break;case "select":f.push('<select id="'+a+'">');for(e=0;e<c.length;e++){var p=b.getValue()===c[e][1]?' selected="selected"':"";f.push('<option value="'+c[e][1]+'"'+p+">"+c[e][0]+"</option>")}f.push("</select>")}d.push('<table border="0" cellpadding="4" cellspacing="0" width="100%"'+m+">");d.push("<tr>");"checkbox"===b.type?d.push("<td>"+f.join("")+'<label for="'+a+'">'+b.label+"</label></td>"):(d.push('<td style="width:25%;"><label style="cursor:hand;" for="'+a+'">'+b.label+"</label></td>"),
d.push('<td style="width:75%;">'+f.join("")+"</td>"));d.push("</tr>");d.push("</table>");return d.join("")};global.$IS.PreferenceManager.each(function(b){var a=b.name+"_tab",c=b.name+"_panel",e=[],d=l===b.name?' class="panel current"':' class="panel"';k.push('<li id="'+a+'"'+(l===b.name?' class="current"':"")+"><span><a href=\"javascript:mcTabs.displayTab('"+a+"','"+c+'\');" onmousedown="return false;">'+b.displayName+"</a></span></li>");b.each(function(a){var c="function"==typeof a.dependencies?
a.dependencies():a.dependencies||{};e.push(n(a,b));for(var d in c)c[d].each(function(c){e.push(n(c,b,d,a.getValue()))})});h.push('<div id="'+c+'"'+d+">");h.push(e.join(""));h.push("</div>")});tinyMCEPopup.dom.setHTML(tinyMCEPopup.dom.select("div.tabs ul"),k.join(""));tinyMCEPopup.dom.setHTML(tinyMCEPopup.dom.select("div.panel_wrapper"),h.join(""));global.$IS.PreferenceManager.each(function(b){b.each(function(a){var c=document.getElementById(b.name+"_"+a.id);g.listeners.push(function(){a.setValue("checkbox"==
a.type?c.checked:c.value)});var e="function"==typeof a.dependencies?a.dependencies():a.dependencies||{},d=!1,f;for(f in e)d=!0,e[f].each(function(a){var c=document.getElementById(b.name+"_"+f+"_"+a.id);g.listeners.push(function(){a.setValue(c.value)})});d&&(c.onchange=function(a){var c=a?global.$IS.Event.getTarget(a):this,d;for(d in e)e[d].each(function(a){a=b.name+"_"+d+"_"+a.id;c.value==d?tinyMCEPopup.dom.setStyle(tinyMCEPopup.dom.getParent(a,"table"),"display",""):tinyMCEPopup.dom.setStyle(tinyMCEPopup.dom.getParent(a,
"table"),"display","none")})})})})},save:function(){for(var g=0;g<this.listeners.length;g++)this.listeners[g]();global.$IS.Event.fire("saveOptions",global.$IS.PreferenceManager.getAllOptionValues());tinyMCEPopup.close()}};
