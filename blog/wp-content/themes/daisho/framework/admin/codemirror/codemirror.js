jQuery(document).ready(function(){
	if(document.getElementById("custom_css_style")){
		var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("custom_css_style"), {
			//value: "",
			//mode:  "htmlmixed",
			//mode:  "javascript",
			mode:  "css",
			//theme: "ambiance",
			theme: "default",
			smartIndent: false,
			lineNumbers: true,
			lineWrapping: true,

			onCursorActivity: function() {
				myCodeMirror.setLineClass(hlLine, null, null);
				hlLine = myCodeMirror.setLineClass(myCodeMirror.getCursor().line, null, "activeline");
				myCodeMirror.matchHighlight("CodeMirror-matchhighlight");
			},
			onChange: function() {
				if(myCodeMirror){
					var current_value = myCodeMirror.getValue();
					document.getElementById("custom_css_style").innerHTML = current_value;
				}
			},
		  
			//closeTagEnabled: false, // Set this option to disable tag closing behavior without having to remove the key bindings.
			//closeTagIndent: false, // Pass false or an array of tag names to override the default indentation behavior.
			
			extraKeys: {
				"'>'": function(cm) { cm.closeTag(cm, '>'); },
				"'/'": function(cm) { cm.closeTag(cm, '/'); },
				"F11": function(cm) {
					setFullScreen(cm, !isFullScreen(cm));
				},
				"Esc": function(cm) {
					if (isFullScreen(cm)) setFullScreen(cm, false);
				},
			},

			/*
			// extraKeys is the easier way to go, but if you need native key event processing, this should work too.
			onKeyEvent: function(cm, e) {
				if (e.type == 'keydown') {
					var c = e.keyCode || e.which;
					if (c == 190 || c == 191) {
						try {
							cm.closeTag(cm, c == 190 ? '>' : '/');
							e.stop();
							return true;
						} catch (e) {
							if (e != CodeMirror.Pass) throw e;
						}
					}
				}
				return false;
			},
			*/
		});
		var hlLine = myCodeMirror.setLineClass(0, "activeline");

		//CodeMirror.commands["selectAll"](myCodeMirror);
		
		function getSelectedRange() {
			return { from: myCodeMirror.getCursor(true), to: myCodeMirror.getCursor(false) };
		}
		autoFormatSelection = function () {
			var range = getSelectedRange();
			myCodeMirror.autoFormatRange(range.from, range.to);
		}
		commentSelection = function(isComment) {
			var range = getSelectedRange();
			myCodeMirror.commentRange(isComment, range.from, range.to);
		}
		
		/* FULLSCREEN UPON HITTING F11 */
		function isFullScreen(cm) {
			return /\bCodeMirror-fullscreen\b/.test(cm.getWrapperElement().className);
		}
		function winHeight() {
			return window.innerHeight || (document.documentElement || document.body).clientHeight;
		}
		function setFullScreen(cm, full) {
			var wrap = cm.getWrapperElement(), scroll = cm.getScrollerElement();
			if (full) {
				wrap.className += " CodeMirror-fullscreen";
				scroll.style.height = winHeight()-30 + "px";
				document.documentElement.style.overflow = "hidden";
			} else {
				wrap.className = wrap.className.replace(" CodeMirror-fullscreen", "");
				scroll.style.height = "";
				document.documentElement.style.overflow = "";
			}
			cm.refresh();
		}
		CodeMirror.connect(window, "resize", function() {
			var showing = document.body.getElementsByClassName("CodeMirror-fullscreen")[0];
			if (!showing) return;
			showing.CodeMirror.getScrollerElement().style.height = winHeight()-30 + "px";
		});
	}
});
var commentSelection = function(isComment){};
var autoFormatSelection = function(){};