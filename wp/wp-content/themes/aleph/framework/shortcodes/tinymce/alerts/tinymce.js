function insertShortcode(){var b;var c=document.getElementById("alert_type").value;var f=document.getElementById("alert_content").value;var e=document.getElementById("alert_block").value;var d=document.getElementById("alert_close").value;var a=document.getElementById("alert_fade").value;b='<br />[alert type="'+c+'" block="'+e+'" fade="'+a+'" close="'+d+'"]'+f+"[/alert]<br />";if(c==0){tinyMCEPopup.close()}if(window.tinyMCE){window.tinyMCE.execInstanceCommand("content","mceInsertContent",false,b);tinyMCEPopup.editor.execCommand("mceRepaint");tinyMCEPopup.close()}return};