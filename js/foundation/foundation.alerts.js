/*jslint unparam: true, browser: true, indent: 2 */(function(e,t,n,r){"use strict";Foundation.libs.alerts={name:"alerts",version:"4.2.2",settings:{speed:300,callback:function(){}},init:function(t,n,r){this.scope=t||this.scope;typeof n=="object"&&e.extend(!0,this.settings,n);if(typeof n!="string"){this.settings.init||this.events();return this.settings.init}return this[n].call(this,r)},events:function(){var t=this;e(this.scope).on("click.fndtn.alerts","[data-alert] a.close",function(n){n.preventDefault();e(this).closest("[data-alert]").fadeOut(t.speed,function(){e(this).remove();t.settings.callback()})});this.settings.init=!0},off:function(){e(this.scope).off(".fndtn.alerts")},reflow:function(){}}})(Foundation.zj,this,this.document);