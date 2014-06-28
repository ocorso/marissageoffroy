(function() {  
    tinymce.create('tinymce.plugins.scgen', {  
        init : function(ed, url) {  

            ed.addCommand('Alerts', function() {
                ed.windowManager.open({
                        file : url + '/alerts/window.php',
                        width : 500 + ed.getLang('example.delta_width', 0),
                        height : 500 + ed.getLang('example.delta_height', 0),
                        inline : 1
                });
            });

            ed.addCommand('Buttons', function() {
                ed.windowManager.open({
                        file : url + '/buttons/window.php',
                        width : 500 + ed.getLang('example.delta_width', 0),
                        height : 650 + ed.getLang('example.delta_height', 0),
                        inline : 1
                });
            });

            ed.addCommand('Icons', function() {
                ed.windowManager.open({
                        file : url + '/icons/window.php',
                        width : 500 + ed.getLang('example.delta_width', 0),
                        height : 650 + ed.getLang('example.delta_height', 0),
                        inline : 1
                });
            });

            ed.addCommand('Columns', function() {
                ed.windowManager.open({
                        file : url + '/columns/window.php',
                        width : 500 + ed.getLang('example.delta_width', 0),
                        height : 150 + ed.getLang('example.delta_height', 0),
                        inline : 1
                });
            });

            ed.addCommand('Lists', function() {
                ed.windowManager.open({
                        file : url + '/lists/window.php',
                        width : 500 + ed.getLang('example.delta_width', 0),
                        height : 535 + ed.getLang('example.delta_height', 0),
                        inline : 1
                });
            });

            ed.addCommand('Quotes', function() {
                ed.windowManager.open({
                        file : url + '/quotes/window.php',
                        width : 500 + ed.getLang('example.delta_width', 0),
                        height : 535 + ed.getLang('example.delta_height', 0),
                        inline : 1
                });
            });

            ed.addCommand('Slider', function() {
                ed.windowManager.open({
                        file : url + '/slider/window.php',
                        width : 500 + ed.getLang('example.delta_width', 0),
                        height : 535 + ed.getLang('example.delta_height', 0),
                        inline : 1
                });
            });

            ed.addCommand('Tooltips', function() {
                ed.windowManager.open({
                        file : url + '/tooltips/window.php',
                        width : 500 + ed.getLang('example.delta_width', 0),
                        height : 535 + ed.getLang('example.delta_height', 0),
                        inline : 1
                });
            });

            ed.addCommand('Tabs', function() {
                ed.windowManager.open({
                        file : url + '/tabs/window.php',
                        width : 500 + ed.getLang('example.delta_width', 0),
                        height : 300 + ed.getLang('example.delta_height', 0),
                        inline : 1
                });
            });

            ed.addCommand('Video', function() {
                ed.windowManager.open({
                        file : url + '/video/window.php',
                        width : 500 + ed.getLang('example.delta_width', 0),
                        height : 535 + ed.getLang('example.delta_height', 0),
                        inline : 1
                });
            });
           
        },  


        createControl : function(n, cm) {  
            switch (n) {
                case 'scgen':
                    var c = cm.createMenuButton('scgen', {                    
                        title : 'Add Shortcodes'                  
                    });

                    c.onRenderMenu.add(function(c, m) {
                        var sub;

                        m.add({title : 'Alerts', onclick : function() {
                            tinyMCE.activeEditor.execCommand('Alerts');
                        }});

                        m.add({title : 'Buttons', onclick : function() {
                            tinyMCE.activeEditor.execCommand('Buttons');
                        }});

                        m.add({title : 'Columns', onclick : function() {
                            tinyMCE.activeEditor.execCommand('Columns');
                        }});

                        sub = m.addMenu({title : 'Dividers'});

                        sub.add({title : 'Horizontal line', onclick : function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, ' [hr] ');
                        }});

                        sub.add({title : 'Spacer', onclick : function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, ' [spacer] ');
                        }});

                        sub.add({title : 'Clear floats', onclick : function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, ' [clear] ');
                        }});

                        m.add({title : 'Icons', onclick : function() {
                            tinyMCE.activeEditor.execCommand('Icons');
                        }});

                        m.add({title : 'Lists', onclick : function() {
                            tinyMCE.activeEditor.execCommand('Lists');
                        }});

                        m.add({title : 'Quotes', onclick : function() {
                            tinyMCE.activeEditor.execCommand('Quotes');
                        }});

                        m.add({title : 'Slider', onclick : function() {
                            tinyMCE.activeEditor.execCommand('Slider');
                        }});

                        sub = m.addMenu({title : 'Tabs and Toggles'});

                        sub.add({title : 'Tabs', onclick : function() {
                            tinyMCE.activeEditor.execCommand('Tabs');
                        }});

                        sub.add({title : 'Accordion', onclick : function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '<br />[accordion]<br/>[accordiontab title="Title 1"]Lorem ipsum dolor sit amet vestibulum amet ut sit nisl. [/accordiontab]<br /><br />[accordiontab title="Title 2"]Lorem ipsum dolor sit amet vestibulum amet ut sit nisl. [/accordiontab]<br />[/accordion]<br />');
                        }});
                        
                        sub.add({title : 'Toggle', onclick : function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', false, '<br />[toggle title="Title 1" default="open"]Lorem ipsum dolor sit amet vestibulum amet ut sit nisl.[/toggle]<br />');
                        }});

                        m.add({title : 'Tooltips', onclick : function() {
                            tinyMCE.activeEditor.execCommand('Tooltips');
                        }});

                        m.add({title : 'Video', onclick : function() {
                            tinyMCE.activeEditor.execCommand('Video');
                        }});

                    });

                    // Return the new menu button instance
                    return c;
            }
            return null;  
        },  

    });  
    tinymce.PluginManager.add('scgen', tinymce.plugins.scgen);  
})(); 