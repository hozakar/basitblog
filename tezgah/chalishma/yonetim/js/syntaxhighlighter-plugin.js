tinymce.PluginManager.add('syntaxhighlighter', function (editor, url) {
    editor.addButton('syntaxhighlighter', {
        type: 'menubutton',
        text: 'Kod',
        icon: false,
        menu: [
            { text: 'HTML / XML', onclick: function () {
                    ekle("brush: xml", editor);
                }
            },
            { text: 'HTML + PHP', onclick: function () {
                    ekle("brush: php ; html-script: true", editor);
                }
            },
            { text: 'HTML + CSS', onclick: function () {
                    ekle("brush: css ; html-script: true", editor);
                }
            },
            { text: 'HTML + JavaScript', onclick: function () {
                    ekle("brush: js ; html-script: true", editor);
                }
            },
            { text: 'PHP', onclick: function () {
                    ekle("brush: php", editor);
                }
            },
            { text: 'CSS', onclick: function () {
                    ekle("brush: css", editor);
                }
            },
            { text: 'JavaScript', onclick: function () {
                    ekle("brush: js", editor);
                }
            },
            { text: 'SQL', onclick: function () {
                    ekle("brush: sql", editor);
                }
            }
        ]
    });
});

function ekle(cls, editor) {
    var kod = tinyMCE.activeEditor.selection.getContent() ? tinyMCE.activeEditor.selection.getContent() : '!!Kod Buraya!!';
    editor.insertContent('<pre class="'+ cls +'">' + kod + '</pre>');
}