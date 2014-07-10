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
                url: url + '/fops.php?lang=' + (editor.getParam("language") ? editor.getParam("language") : '') + '&ow=' + editor.getParam("imagebrowser")["overwrite"] + '&root=' + editor.getParam("imagebrowser")["root"] + '&settoplimit=true',
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
					            var margin = 'margin: 1%;'
					            if (width) {
					                if (width == parseInt(width)) {
					                    width = width + 'px;';
					                } else {
					                    width = width;
					                }
					                margin = (width == 'auto' ? '1' : parseInt(width) * .03) + '%;';
					                width = 'width: ' + width;
					            }
					            var float = 'float: ' + ($doc.find('input[name=float]').val() == 'none' ? 'none;' : ($doc.find('input[name=float]').val() == 'left' ? 'left; margin-right: ' : 'right; margin-left: ') + margin);
					            tinyMCE.activeEditor.insertContent('<img src="' + $doc.find('input[name=selfile]').val() + '" style="' + float + ' ' + width + '" alt="' + $doc.find('input[name=alt]').val() + '" />');
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