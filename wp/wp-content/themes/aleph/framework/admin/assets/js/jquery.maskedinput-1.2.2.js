/// <reference path="../../../lib/jquery-1.2.6.js" />
/*
	Masked Input plugin for jQuery
	Copyright (c) 2007-2009 Josh Bush (digitalbush.com)
	Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license) 
	Version: 1.2.2 (03/09/2009 22:39:06)
*/
(function(c){var a=(c.browser.msie?"paste":"input")+".mask";var b=(window.orientation!=undefined);c.mask={definitions:{"9":"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"}};c.fn.extend({caret:function(f,d){if(this.length==0){return}if(typeof f=="number"){d=(typeof d=="number")?d:f;return this.each(function(){if(this.setSelectionRange){this.focus();this.setSelectionRange(f,d)}else{if(this.createTextRange){var g=this.createTextRange();g.collapse(true);g.moveEnd("character",d);g.moveStart("character",f);g.select()}}})}else{if(this[0].setSelectionRange){f=this[0].selectionStart;d=this[0].selectionEnd}else{if(document.selection&&document.selection.createRange){var e=document.selection.createRange();f=0-e.duplicate().moveStart("character",-100000);d=f+e.text.length}}return{begin:f,end:d}}},unmask:function(){return this.trigger("unmask")},mask:function(f,j){if(!f&&this.length>0){var g=c(this[0]);var i=g.data("tests");return c.map(g.data("buffer"),function(m,l){return i[l]?m:null}).join("")}j=c.extend({placeholder:"_",completed:null},j);var e=c.mask.definitions;var i=[];var k=f.length;var h=null;var d=f.length;c.each(f.split(""),function(l,m){if(m=="?"){d--;k=l}else{if(e[m]){i.push(new RegExp(e[m]));if(h==null){h=i.length-1}}else{i.push(null)}}});return this.each(function(){var u=c(this);var p=c.map(f.split(""),function(y,x){if(y!="?"){return e[y]?j.placeholder:y}});var s=false;var w=u.val();u.data("buffer",p).data("tests",i);function t(x){while(++x<=d&&!i[x]){}return x}function o(z){while(!i[z]&&--z>=0){}for(var y=z;y<d;y++){if(i[y]){p[y]=j.placeholder;var x=t(y);if(x<d&&i[y].test(p[x])){p[y]=p[x]}else{break}}}r();u.caret(Math.max(h,z))}function l(B){for(var z=B,A=j.placeholder;z<d;z++){if(i[z]){var x=t(z);var y=p[z];p[z]=A;if(x<d&&i[x].test(y)){A=y}else{break}}}}function q(y){var z=c(this).caret();var x=y.keyCode;s=(x<16||(x>16&&x<32)||(x>32&&x<41));if((z.begin-z.end)!=0&&(!s||x==8||x==46)){m(z.begin,z.end)}if(x==8||x==46||(b&&x==127)){o(z.begin+(x==46?0:-1));return false}else{if(x==27){u.val(w);u.caret(0,n());return false}}}function v(A){if(s){s=false;return(A.keyCode==8)?false:null}A=A||window.event;var x=A.charCode||A.keyCode||A.which;var C=c(this).caret();if(A.ctrlKey||A.altKey||A.metaKey){return true}else{if((x>=32&&x<=125)||x>186){var z=t(C.begin-1);if(z<d){var B=String.fromCharCode(x);if(i[z].test(B)){l(z);p[z]=B;r();var y=t(z);c(this).caret(y);if(j.completed&&y==d){j.completed.call(u)}}}}}return false}function m(z,x){for(var y=z;y<x&&y<d;y++){if(i[y]){p[y]=j.placeholder}}}function r(){return u.val(p.join("")).val()}function n(y){var C=u.val();var B=-1;for(var x=0,A=0;x<d;x++){if(i[x]){p[x]=j.placeholder;while(A++<C.length){var z=C.charAt(A-1);if(i[x].test(z)){p[x]=z;B=x;break}}if(A>C.length){break}}else{if(p[x]==C[A]&&x!=k){A++;B=x}}}if(!y&&B+1<k){u.val("");m(0,d)}else{if(y||B+1>=k){r();if(!y){u.val(u.val().substring(0,B+1))}}}return(k?x:h)}if(!u.attr("readonly")){u.one("unmask",function(){u.unbind(".mask").removeData("buffer").removeData("tests")}).bind("focus.mask",function(){w=u.val();var x=n();r();setTimeout(function(){if(x==f.length){u.caret(0,x)}else{u.caret(x)}},0)}).bind("blur.mask",function(){n();if(u.val()!=w){u.change()}}).bind("keydown.mask",q).bind("keypress.mask",v).bind(a,function(){setTimeout(function(){u.caret(n(true))},0)})}n()})}})})(jQuery);