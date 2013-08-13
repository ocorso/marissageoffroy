/* Used Yoast SEO as base, so most of the code below is LGPL */
function yst_clean( str ) { 
	if ( str == '' || str == undefined )
		return '';
	
	try {
		str = str.replace(/<\/?[^>]+>/gi, ''); 
		str = str.replace(/\[(.+?)\](.+?\[\/\\1\])?/, '');
	} catch(e) {}
	
	return str;
}

function ptest(str, p){
	str = yst_clean(str);
	str = str.toLowerCase();
	var r = str.match(p);
	if (r != null)
		return '<span class="good">Yes ('+r.length+')</span>';
	else
		return '<span class="wrong">No</span>';
}

function testFocusKw(){
	// Retrieve focus keyword and trim
	var focuskw = jQuery.trim(jQuery('#flow_seo_focuskw').val());
	focuskw = focuskw.toLowerCase();
	
	if(focuskw == ''){
		jQuery('#focuskwresults').empty();
		return;
	}
	
	var postname = jQuery('#editable-post-name-full').text();
	//var url = jQuery('#flow_seo_snippet .url').text().replace('%postname%', postname).replace('http://','');
	var url = jQuery('#flow_seo_snippet .url').text();
	//var url	= jQuery('#flow_seo_snippet .url').text();

	var desc = jQuery.trim(yst_clean(jQuery("#flow_seo_description").val()));
	if(desc == ''){ desc = jQuery.trim(yst_clean(jQuery("#content").val())); }
	if(desc.length > 156){
		var space = desc.lastIndexOf(" ", 153);
		desc = desc.substring(0, space).concat(' <strong>...</strong>');
	}
	
	p = new RegExp("(^|[ \s\n\r\t\.,'\(\"\+;!?:\-])"+focuskw+"($|[ \s\n\r\t.,'\)\"\+!?:;\-])",'gim');
	p2 = new RegExp(focuskw.replace(/\s+/g,"[-_\\\//]"),'gim');
	if (focuskw != '') {
		var html = '<p>Your focus keyword was found in:<br/>';
		html += 'Article Heading: ' + ptest(jQuery('#title').val(), p) + '<br/>';
		html += 'Page title: ' + ptest( jQuery('#flow_seo_snippet .title').text(), p ) + '<br/>';
		html += 'Page URL: ' + ptest(url, p2) + ' (this one is showing all occurences of a given string and does not distinguish words because URL structures may vary significantly)<br/>';
		html += 'Content: ' + ptest(jQuery('#content').val(), p) + '<br/>';
		html += 'Meta description: ' + ptest(desc, p);
		html += '</p>';
		jQuery('#focuskwresults').html(html);
	}
}

function updateTitle(force){
	if(jQuery("#flow_seo_title").val()){
		var title = jQuery("#flow_seo_title").val();
	}else{
		var title = jQuery("#flow_seo_snippet .default_title").text();
	}

	title = jQuery('<div />').html(title).text();

	title = yst_clean(title);
	title = jQuery.trim(title);

	var len = title.length;
	
	if(title.length > 70){
		var space = title.lastIndexOf(" ", 67);
		title = title.substring(0, space).concat(' <strong>...</strong>');
	}
	
	if(len > 70){
		len = '<span class="wrong">'+len+'</span>';
	}else{
		len = '<span class="good">'+len+'</span>';
	}

	title = boldKeywords(title, false);

	jQuery('#flow_seo_snippet .title').html(title);
	jQuery('#flow_seo_title-count').html(len);
	testFocusKw();
}

function updateDesc(desc){
	var desc = jQuery.trim(yst_clean(jQuery("#flow_seo_description").val()));
	var charactersInContent = false;

	if(desc == ''){
		desc = jQuery.trim(yst_clean(jQuery("#content").val()));
		charactersInContent = true;
	}
	
	var len = desc.length;
	
	if(desc.length > 156){
		var space = desc.lastIndexOf(" ", 153);
		desc = desc.substring(0, space).concat(' <strong>...</strong>');
	}
	
	if(len > 156 && charactersInContent){
		len = '<span class="wrong">'+len+' (characters in content area, not all will be used but it is fine)</span>';
	}else if(len > 156){
		len = '<span class="wrong">'+len+'</span>';
	}else if(len <= 156 && charactersInContent){
		len = '<span class="good">'+len+' (characters in content area)</span>';
	}else{
		len = '<span class="good">'+len+'</span>';
	}

	desc = boldKeywords(desc, false);

	jQuery('#flow_seo_description-count').html(len);
	jQuery("#flow_seo_snippet .desc span.content").html(desc);
	testFocusKw();
}

function updateURL(){
	var name = jQuery('#editable-post-name-full').text();
	//var url	= jQuery('#flow_seo_snippet .url').text().replace('%postname%', name).replace('http://','');
	var url	= jQuery('#flow_seo_snippet .url').text();
	url = boldKeywords(url, true);
	jQuery("#flow_seo_snippet .url").html(url);
	testFocusKw();
}

function boldKeywords(str, url){
	focuskw = jQuery.trim(jQuery('#flow_seo_focuskw').val());

	if(focuskw == ''){
		return str;
	}
		
	if(focuskw.search(' ') != -1){
		var keywords = focuskw.split(' ');
	}else{
		var keywords = new Array( focuskw );
	}
	for (var i=0;i<keywords.length;i++){
		var kw = yst_clean( keywords[i]);
		if(url){
			var kw 	= kw.replace(' ','-').toLowerCase();
			kwregex = new RegExp("([-/])("+kw+")([-/])?");
		}else{
			kwregex = new RegExp("(^|[ \s\n\r\t\.,'\(\"\+;!?:\-]+)("+kw+")($|[ \s\n\r\t\.,'\)\"\+;!?:\-]+)", 'gim');
		}
		str = str.replace(kwregex, "$1<strong>$2</strong>$3");
	}
	return str;
}

function updateSnippet(){
	updateURL();
	updateTitle();
	updateDesc();
	testFocusKw();
}

jQuery(document).ready(function(){
	jQuery('#flow_seo_title').keyup(function(){
		updateTitle();		
	});
	jQuery('#flow_seo_description').keyup(function(){
		updateDesc();
	});
	jQuery('#excerpt').keyup( function(){
		updateDesc();
	});
	jQuery('#flow_seo_title').on('change', function(){
		updateTitle();
	});
	jQuery('#flow_seo_description').on('change', function(){
		updateDesc();
	});
	jQuery('#flow_seo_focuskw').on('change keyup', function(){
		updateSnippet();
	});
	jQuery('#excerpt').on('change', function(){
		updateDesc();
	});
	jQuery('#content').on('change', function(){
		updateDesc();
	});
	jQuery('#tinymce').on('change', function(){
		updateDesc();
	});
	jQuery('#titlewrap #title').on('change', function(){
		updateTitle();
	});
	
	updateSnippet();
});