/*
**  Image Browser 1.0.0
**  Plugin for TinyMCE
**  https://github.com/hozakar/imagebrowser-for-tinymce
**
**  Copyright 2014, Hakan Özakar
**  http://beltslib.net
**
**  Licensed under CC0 1.0 Universal Licence:
**  https://creativecommons.org/publicdomain/zero/1.0/
*/

"use strict";

tinymce.PluginManager.add('imagebrowser', function (editor, url) {
    editor.addButton('imagebrowser', {
        icon: 'image',
        onclick: function () {
            editor.windowManager.open({
                title: editor.getParam("imagebrowser")["windowcaption"] ? editor.getParam("imagebrowser")["windowcaption"] : 'Image Browser',
                url: url + '/fops.php?lang=' + (editor.getParam("language") ? editor.getParam("language") : '') + '&ow=' + editor.getParam("imagebrowser")["overwrite"] + '&root=' + editor.getParam("imagebrowser")["root"],
                width: $(window).width() * .7,
                height: $(window).height() * .7,
                buttons: [
					{
					    text: tinymce.translate("Ok"),
					    active: true,
					    classes: 'widget btn primary okbtn',
					    onclick: function () {
					        var $doc = $(tinyMCE.activeEditor.windowManager.getWindows()[0].getContentWindow().document);
					        if ($doc.find('input[name=selfile]').val()) {
					            var width = $doc.find('input[name=width]').val();
					            if (width) {
					                if (width == parseInt(width)) {
					                    width = 'width: ' + width + 'px;';
					                } else {
					                    width = 'width: ' + width;
					                }
					            }
					            tinyMCE.activeEditor.insertContent('<img src="' + $doc.find('input[name=selfile]').val() + '" style="float: ' + $doc.find('input[name=float]').val() + '; ' + width + '" />');
					        }
					        tinyMCE.activeEditor.windowManager.close();
					    }
					},
					{
					    text: tinymce.translate("Cancel"),
					    onclick: function () {
					        tinyMCE.activeEditor.windowManager.close();
					    }
					}
				]
            });
        }
    });
});