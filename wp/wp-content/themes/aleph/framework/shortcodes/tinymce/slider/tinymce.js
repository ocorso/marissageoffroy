function insertShortcode(){var a;var c=document.getElementById("slider_type").value;var b=document.getElementById("slider_resize").value;a='<br />[slider layout="'+c+'" resize="'+b+'"]<br />';if(c==0){tinyMCEPopup.close()}if(window.tinyMCE){window.tinyMCE.execInstanceCommand("content","mceInsertContent",false,a);tinyMCEPopup.editor.execCommand("mceRepaint");tinyMCEPopup.close()}return};