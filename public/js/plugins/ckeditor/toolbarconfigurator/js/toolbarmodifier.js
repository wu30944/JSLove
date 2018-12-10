﻿(function(){function d(a,b){l.call(this,a,b);this.actualConfig=this.originalConfig=this.removedButtons=null;this.emptyVisible=!1;this.state="edit";this.toolbarButtons=[{text:{active:"Hide empty toolbar groups",inactive:"Show empty toolbar groups"},group:"edit",position:"left",cssClass:"button-a-soft",clickCallback:function(a,b){a[a.hasClass("button-a-background")?"removeClass":"addClass"]("button-a-background");this._toggleVisibilityEmptyElements();this.emptyVisible?a.setText(b.text.active):a.setText(b.text.inactive)}},
{text:"Add row separator",group:"edit",position:"left",cssClass:"button-a-soft",clickCallback:function(){this._addSeparator()}},{text:"Select config",group:"config",position:"left",cssClass:"button-a-soft",clickCallback:function(){this.configContainer.findOne("textarea").$.select()}},{text:"Back to configurator",group:"config",position:"right",cssClass:"button-a-background",clickCallback:function(){if("paste"===this.state){var a=this.configContainer.findOne("textarea").getValue();(a=d.evaluateToolbarGroupsConfig(a))?
this.setConfig(a):alert("Your pasted config is wrong.")}this.state="edit";this._showConfigurationTool();this.showToolbarBtnsByGroupName(this.state)}},{text:'Get toolbar \x3cspan class\x3d"highlight"\x3econfig\x3c/span\x3e',group:"edit",position:"right",cssClass:"button-a-background icon-pos-left icon-download",clickCallback:function(){this.state="config";this._showConfig();this.showToolbarBtnsByGroupName(this.state)}}];this.cachedActiveElement=null}var l=ToolbarConfigurator.AbstractToolbarModifier;
ToolbarConfigurator.ToolbarModifier=d;d.prototype=Object.create(ToolbarConfigurator.AbstractToolbarModifier.prototype);d.prototype.getActualConfig=function(){var a=l.prototype.getActualConfig.call(this);if(a.toolbarGroups)for(var b=a.toolbarGroups.length,c=0;c<b;c+=1)a.toolbarGroups[c]=d.parseGroupToConfigValue(a.toolbarGroups[c]);return a};d.prototype._onInit=function(a,b,c){c=!0===c;l.prototype._onInit.call(this,void 0,b);this.removedButtons=[];c?this.removedButtons=this.actualConfig.removeButtons?
this.actualConfig.removeButtons.split(","):[]:"removeBu" +
    "" +
    "ttons"in this.originalConfig?this.removedButtons=this.originalConfig.removeButtons?this.originalConfig.removeButtons.split(","):[]:(this.originalConfig.removeButtons="",this.removedButtons=[]);this.actualConfig.toolbarGroups||(this.actualConfig.toolbarGroups=this.fullToolbarEditor.getFullToolbarGroupsConfig());this._fixGroups(this.actualConfig);this._calculateTotalBtns();this._createModifier();this._refreshMoveBtnsAvalibility();this._refreshBtnTabIndexes();
"function"===typeof a&&a(this.mainContainer)};d.prototype._showConfigurationTool=function(){this.configContainer.addClass("hidden");this.modifyContainer.removeClass("hidden")};d.prototype._showConfig=function(){var a=this.getActualConfig(),b,c;if(a.toolbarGroups){b=a.toolbarGroups;for(var e=this.cfg.trimEmptyGroups,f=[],g=b.length,m=0;m<g;m++){var h=b[m];if("/"===h)f.push("'/'");else{if(e)for(var k=h.groups.length;k--;)0===d.getTotalSubGroupButtonsNumber(h.groups[k],this.fullToolbarEditor)&&h.groups.splice(k,
1);e&&0===h.groups.length||f.push(l.stringifyJSONintoOneLine(h,{addSpaces:!0,noQuotesOnKey:!0,singleQuotes:!0}))}}b="\n\t\t"+f.join(",\n\t\t")}a.removeButtons&&(c=a.removeButtons);a=['\x3ctextarea class\x3d"configCode" readonly\x3eCKEDITOR.editorConfig \x3d function( config ) {\n',b?"\tconfig.toolbarGroups \x3d ["+b+"\n\t];":"",c?"\n\n":"",c?"\tconfig.removeButtons \x3d '"+c+"';":"","\n};\x3c/textarea\x3e"].join("");this.modifyContainer.addClass("hidden");this.configContainer.removeClass("hidden");
this.configContainer.setHtml(a)};d.prototype._toggleVisibilityEmptyElements=function(){this.modifyContainer.hasClass("empty-visible")?(this.modifyContainer.removeClass("empty-visible"),this.emptyVisible=!1):(this.modifyContainer.addClass("empty-visible"),this.emptyVisible=!0);this._refreshMoveBtnsAvalibility()};d.prototype._createModifier=function(){function a(){b._highlightGroup(this.data("name"))}var b=this;l.prototype._createModifier.call(this);this.modifyContainer.setHtml(this._toolbarConfigToListString());
var c=this.modifyContainer.find('li[data-type\x3d"group"]');this.modifyContainer.on("mouseleave",function(){this._dehighlightActiveToolGroup()},this);for(var e=c.count(),f=0;f<e;f+=1)c.getItem(f).on("mouseenter",a);CKEDITOR.document.on("keypress",function(a){a=a.data.$.keyCode;a=32===a||13===a;var c=new CKEDITOR.dom.element(CKEDITOR.document.$.activeElement);c.getAscendant(function(a){return a.$===b.mainContainer.$})&&a&&"button"===c.data("type")&&c.findOne("input").$.click()});this.modifyContainer.on("click",
function(a){var c=a.data.$,e=new CKEDITOR.dom.element(c.target||c.srcElement);if(a=d.getGroupOrSeparatorLiAncestor(e)){b.cachedActiveElement=document.activeElement;if(e.$ instanceof HTMLInputElement)b._handleCheckboxClicked(e);else if(e.$ instanceof HTMLButtonElement&&(c.preventDefault?c.preventDefault():c.returnValue=!1,(c=b._handleAnchorClicked(e.$))&&"remove"==c.action))return;c=a.data("type");a=a.data("name");b._setActiveElement(c,a);b.cachedActiveElement&&b.cachedActiveElement.focus()}});this.toolbarContainer||
(this._createToolbar(),this.toolbarContainer.insertBefore(this.mainContainer.getChildren().getItem(0)));this.showToolbarBtnsByGroupName("edit");this.configContainer||(this.configContainer=new CKEDITOR.dom.element("div"),this.configContainer.addClass("configContainer"),this.configContainer.addClass("hidden"),this.mainContainer.append(this.configContainer));return this.mainContainer};d.prototype.showToolbarBtnsByGroupName=function(a){if(this.toolbarContainer)for(var b=this.toolbarContainer.find("button"),
c=b.count(),e=0;e<c;e+=1){var d=b.getItem(e);d.data("group")==a?d.removeClass("hidden"):d.addClass("hidden")}};d.parseGroupToConfigValue=function(a){if("separator"==a.type)return"/";var b=a.groups,c=b.length;delete a.totalBtns;for(var e=0;e<c;e+=1)b[e]=b[e].name;return a};d.getGroupOrSeparatorLiAncestor=function(a){return a.$ instanceof HTMLLIElement&&"group"==a.data("type")?a:d.getFirstAncestor(a,function(a){a=a.data("type");return"group"==a||"separator"==a})};d.prototype._setActiveElement=function(a,
b){this.currentActive&&this.currentActive.elem.removeClass("active");if(null===a)this._dehighlightActiveToolGroup(),this.currentActive=null;else{var c=this.mainContainer.findOne('ul[data-type\x3dtable-body] li[data-type\x3d"'+a+'"][data-name\x3d"'+b+'"]');c.addClass("active");this.currentActive={type:a,name:b,elem:c};"group"==a&&this._highlightGroup(b);"separator"==a&&this._dehighlightActiveToolGroup()}};d.prototype.getActiveToolGroup=function(){return this.editorInstance.container?this.editorInstance.container.findOne(".cke_toolgroup.active, .cke_toolbar.active"):
null};d.prototype._dehighlightActiveToolGroup=function(){var a=this.getActiveToolGroup();a&&a.removeClass("active");this.editorInstance.container&&this.editorInstance.container.removeClass("some-toolbar-active")};d.prototype._highlightGroup=function(a){this.editorInstance.container&&(a=this.getFirstEnabledButtonInGroup(a),a=this.editorInstance.container.findOne(".cke_button__"+a+", .cke_combo__"+a),this._dehighlightActiveToolGroup(),this.editorInstance.container&&this.editorInstance.container.addClass("some-toolbar-active"),
a&&(a=d.getFirstAncestor(a,function(a){return a.hasClass("cke_toolbar")}))&&a.addClass("active"))};d.prototype.getFirstEnabledButtonInGroup=function(a){var b=this.actualConfig.toolbarGroups;a=this.getGroupIndex(a);b=b[a];if(-1===a)return null;a=b.groups?b.groups.length:0;for(var c=0;c<a;c+=1){var e=this.getFirstEnabledButtonInSubgroup(b.groups[c].name);if(e)return e}return null};d.prototype.getFirstEnabledButtonInSubgroup=function(a){for(var b=(a=this.fullToolbarEditor.buttonsByGroup[a])?a.length:
0,c=0;c<b;c+=1){var e=a[c].name;if(!this.isButtonRemoved(e))return e}return null};d.prototype._handleCheckboxClicked=function(a){var b=a.getAscendant("li").data("name");a.$.checked?this._removeButtonFromRemoved(b):this._addButtonToRemoved(b)};d.prototype._handleAnchorClicked=function(a){a=new CKEDITOR.dom.element(a);var b=a.getAscendant("li"),c=b.getAscendant("ul"),e=b.data("type"),d=b.data("name"),g=a.data("direction"),m="up"===g?b.getPrevious():b.getNext(),h;if(a.hasClass("disabled"))return null;
if(a.hasClass("remove"))return b.remove(),this._removeSeparator(b.data("name")),this._setActiveElement(null),{action:"remove"};if(!a.hasClass("move")||!m)return{action:null};if("group"===e||"separator"===e)h=this._moveGroup(g,d);"subgroup"===e&&(h=b.getAscendant("li").data("name"),h=this._moveSubgroup(g,h,d));"up"===g&&b.insertBefore(c.getChild(h));"down"===g&&b.insertAfter(c.getChild(h));for(var k;b="up"===g?b.getPrevious():b.getNext();)if(this.emptyVisible||!b.hasClass("empty")){k=b;break}k||(k=
'[data-direction\x3d"'+("up"===g?"down":"up")+'"]',this.cachedActiveElement=a.getParent().findOne(k));this._refreshMoveBtnsAvalibility();this._refreshBtnTabIndexes();return{action:"move"}};d.prototype._refreshMoveBtnsAvalibility=function(){function a(a){var c=a.count();for(d=0;d<c;d+=1)b._disableElementsInList(a.getItem(d))}for(var b=this,c=this.mainContainer.find("ul[data-type\x3dtable-body] li \x3e p \x3e span \x3e button.move.disabled"),e=c.count(),d=0;d<e;d+=1)c.getItem(d).removeClass("disabled");
a(this.mainContainer.find("ul[data-type\x3dtable-body]"));a(this.mainContainer.find("ul[data-type\x3dtable-body] \x3e li \x3e ul"))};d.prototype._refreshBtnTabIndexes=function(){for(var a=this.mainContainer.find('[data-tab\x3d"true"]'),b=a.count(),c=0;c<b;c++){var e=a.getItem(c),d=e.hasClass("disabled");e.setAttribute("tabindex",d?-1:c)}};d.prototype._disableElementsInList=function(a){function b(a){return!a.hasClass("empty")}if(a.getChildren().count()){var c;this.emptyVisible?(c=a.getFirst(),a=a.getLast()):
(c=a.getFirst(b),a=a.getLast(b));if(c)var e=c.findOne('p button[data-direction\x3d"up"]');if(a)var d=a.findOne('p button[data-direction\x3d"down"]');e&&(e.addClass("disabled"),e.setAttribute("tabindex","-1"));d&&(d.addClass("disabled"),d.setAttribute("tabindex","-1"))}};d.prototype.getGroupIndex=function(a){for(var b=this.actualConfig.toolbarGroups,c=b.length,d=0;d<c;d+=1)if(b[d].name===a)return d;return-1};d.prototype._addSeparator=function(){var a=this._determineSeparatorToAddIndex(),b=d.createSeparatorLiteral(),
c=CKEDITOR.dom.element.createFromHtml(d.getToolbarSeparatorString(b));this.actualConfig.toolbarGroups.splice(a,0,b);c.insertBefore(this.modifyContainer.findOne("ul[data-type\x3dtable-body]").getChild(a));this._setActiveElement("separator",b.name);this._refreshMoveBtnsAvalibility();this._refreshBtnTabIndexes();this._refreshEditor()};d.prototype._removeSeparator=function(a){var b=CKEDITOR.tools.indexOf(this.actualConfig.toolbarGroups,function(b){return"separator"==b.type&&b.name==a});this.actualConfig.toolbarGroups.splice(b,
1);this._refreshMoveBtnsAvalibility();this._refreshBtnTabIndexes();this._refreshEditor()};d.prototype._determineSeparatorToAddIndex=function(){return this.currentActive?("group"==this.currentActive.elem.data("type")||"separator"==this.currentActive.elem.data("type")?this.currentActive.elem:this.currentActive.elem.getAscendant("li")).getIndex():0};d.prototype._moveElement=function(a,b,c){function e(a){return a.totalBtns||"separator"==a.type}c=this.emptyVisible?"down"==c?b+1:b-1:d.getFirstElementIndexWith(a,
b,c,e);return d.moveTo(c-b,a,b)};d.prototype._moveGroup=function(a,b){var c=this.getGroupIndex(b),c=this._moveElement(this.actualConfig.toolbarGroups,c,a);this._refreshMoveBtnsAvalibility();this._refreshBtnTabIndexes();this._refreshEditor();return c};d.prototype._moveSubgroup=function(a,b,c){b=this.getGroupIndex(b);b=this.actualConfig.toolbarGroups[b];var d=CKEDITOR.tools.indexOf(b.groups,function(a){return a.name==c});a=this._moveElement(b.groups,d,a);this._refreshEditor();return a};d.prototype._calculateTotalBtns=
function(){for(var a=this.actualConfig.toolbarGroups,b=a.length;b--;){var c=a[b],e=d.getTotalGroupButtonsNumber(c,this.fullToolbarEditor);"separator"!=c.type&&(c.totalBtns=e)}};d.prototype._addButtonToRemoved=function(a){if(-1!=CKEDITOR.tools.indexOf(this.removedButtons,a))throw"Button already added to removed";this.removedButtons.push(a);this.actualConfig.removeButtons=this.removedButtons.join(",");this._refreshEditor()};d.prototype._removeButtonFromRemoved=function(a){a=CKEDITOR.tools.indexOf(this.removedButtons,
a);if(-1===a)throw"Trying to remove button from removed, but not found";this.removedButtons.splice(a,1);this.actualConfig.removeButtons=this.removedButtons.join(",");this._refreshEditor()};d.parseGroupToConfigValue=function(a){if("separator"==a.type)return"/";var b=a.groups,c=b.length;delete a.totalBtns;for(var d=0;d<c;d+=1)b[d]=b[d].name;return a};d.getGroupOrSeparatorLiAncestor=function(a){return a.$ instanceof HTMLLIElement&&"group"==a.data("type")?a:d.getFirstAncestor(a,function(a){a=a.data("type");
return"group"==a||"separator"==a})};d.createSeparatorLiteral=function(){return{type:"separator",name:"separator"+CKEDITOR.tools.getNextNumber()}};d.prototype._toolbarConfigToListString=function(){for(var a=this.actualConfig.toolbarGroups||[],b='\x3cul data-type\x3d"table-body"\x3e',c=a.length,e=0;e<c;e+=1)var f=a[e],b="separator"===f.type?b+d.getToolbarSeparatorString(f):b+this._getToolbarGroupString(f);b+="\x3c/ul\x3e";return d.getToolbarHeaderString()+b};d.prototype._getToolbarGroupString=function(a){var b=
a.groups,c;c=""+['\x3cli data-type\x3d"group" data-name\x3d"',a.name,'" ',a.totalBtns?"":'class\x3d"empty"',"\x3e"].join("");c+=d.getToolbarElementPreString(a)+"\x3cul\x3e";a=b.length;for(var e=0;e<a;e+=1){var f=b[e];c+=this._getToolbarSubgroupString(f,this.fullToolbarEditor.buttonsByGroup[f.name])}return c+"\x3c/ul\x3e\x3c/li\x3e"};d.getToolbarSeparatorString=function(a){return['\x3cli data-type\x3d"',a.type,'" data-name\x3d"',a.name,'"\x3e',d.getToolbarElementPreString("row separator"),"\x3c/li\x3e"].join("")};
d.getToolbarHeaderString=function(){return'\x3cul data-type\x3d"table-header"\x3e\x3cli data-type\x3d"header"\x3e\x3cp\x3eToolbars\x3c/p\x3e\x3cul\x3e\x3cli\x3e\x3cp\x3eToolbar groups\x3c/p\x3e\x3cp\x3eToolbar group items\x3c/p\x3e\x3c/li\x3e\x3c/ul\x3e\x3c/li\x3e\x3c/ul\x3e'};d.getFirstAncestor=function(a,b){for(var c=a.getParents(),d=c.length;d--;)if(b(c[d]))return c[d];return null};d.getFirstElementIndexWith=function(a,b,c,d){for(;"up"===c?b--:++b<a.length;)if(d(a[b]))return b;return-1};d.moveTo=
function(a,b,c){var d;-1!==c&&(d=b.splice(c,1)[0]);a=c+a;b.splice(a,0,d);return a};d.getTotalSubGroupButtonsNumber=function(a,b){var c=b.buttonsByGroup["string"==typeof a?a:a.name];return c?c.length:0};d.getTotalGroupButtonsNumber=function(a,b){for(var c=0,e=a.groups,f=e?e.length:0,g=0;g<f;g+=1)c+=d.getTotalSubGroupButtonsNumber(e[g],b);return c};d.prototype._getToolbarSubgroupString=function(a,b){var c;c=""+['\x3cli data-type\x3d"subgroup" data-name\x3d"',a.name,'" ',a.totalBtns?"":'class\x3d"empty" ',
"\x3e"].join("");c+=d.getToolbarElementPreString(a.name);c+="\x3cul\x3e";for(var e=b?b.length:0,f=0;f<e;f+=1)c+=this.getButtonString(b[f]);return c+="\x3c/ul\x3e\x3c/li\x3e"};d.prototype._getConfigButtonName=function(a){var b=this.fullToolbarEditor.editorInstance.ui.items,c;for(c in b)if(b[c].name==a)return c;return null};d.prototype.isButtonRemoved=function(a){return-1!=CKEDITOR.tools.indexOf(this.removedButtons,this._getConfigButtonName(a))};d.prototype.getButtonString=function(a){var b=this.isButtonRemoved(a.name)?
"":'checked\x3d"checked"';return['\x3cli data-tab\x3d"true" data-type\x3d"button" data-name\x3d"',this._getConfigButtonName(a.name),'"\x3e\x3clabel title\x3d"',a.label,'" \x3e\x3cinput tabindex\x3d"-1"type\x3d"checkbox"',b,"/\x3e",a.$.getOuterHtml(),"\x3c/label\x3e\x3c/li\x3e"].join("")};d.getToolbarElementPreString=function(a){a=a.name?a.name:a;return['\x3cp\x3e\x3cspan\x3e\x3cbutton title\x3d"Move element upward" data-tab\x3d"true" data-direction\x3d"up" class\x3d"move icon-up-big"\x3e\x3c/button\x3e\x3cbutton title\x3d"Move element downward" data-tab\x3d"true" data-direction\x3d"down" class\x3d"move icon-down-big"\x3e\x3c/button\x3e',
"row separator"==a?'\x3cbutton title\x3d"Remove element" data-tab\x3d"true" class\x3d"remove icon-trash"\x3e\x3c/button\x3e':"",a,"\x3c/span\x3e\x3c/p\x3e"].join("")};d.evaluateToolbarGroupsConfig=function(a){return a=function(a){var c={},d;try{d=eval("("+a+")")}catch(f){try{d=eval(a)}catch(g){return null}}return c.toolbarGroups&&"number"===typeof c.toolbarGroups.length?JSON.stringify(c):d&&"number"===typeof d.length?JSON.stringify({toolbarGroups:d}):d&&d.toolbarGroups?JSON.stringify(d):null}(a)};
return d})();