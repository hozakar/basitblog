(function ($) {
    "use strict";
    $('.cover>a').click(function () {
        if (!confirm('Bu Fotoğrafı Silmek İstediğinize Emin misiniz?')) return;
        var id = $(this).parents('li').data('id');
        $.ajax({
            url: "?sayfa=makale",
            method: 'post',
            data: {
                islem: 'fotosil',
                id: id
            }
        }).done(function (answer) {
            $('#makalekaydet').parents('form').append('<input type="hidden" name="acilis" value="fotolar" />');
            $('#makalekaydet').click();
        });
    });

    $(function () {
        /* FileUpload İşleri */
        var url = $('input[name=id]').data('ana-dizin') + "upload/";
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    var dosya = file.name;
                    $.ajax({
                        url: $('input[name=id]').data('ana-dizin') + "upload/dosyaduzenle.php",
                        method: 'get',
                        data: {
                            dosya: dosya,
                            id: $('input[name=id]').val(),
                            yol: $('input[name=id]').data('ana-dizin')
                        }
                    });
                });
            },
            stop: function () {
                $('#makalekaydet').parents('form').append('<input type="hidden" name="acilis" value="fotolar" />');
                $('#makalekaydet').click();
            },
            start: function () {
                $('#progress').css('display', 'block');
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
        /* Son: FileUpload İşleri */

        $(".sirala").sortable({
            stop: function () {
                var liste = $('.foto .sirala>li');
                var sira = new Array();
                for (var i = 0; i < liste.length; i++) {
                    sira.push($(liste[i]).data('id'));
                }
                sira = sira.join(',');
                $.ajax({
                    url: "?sayfa=makale",
                    method: 'post',
                    data: {
                        islem: 'fotosirala',
                        sira: sira
                    }
                });
            }
        });
        $(".sirala").disableSelection();
    });

    $(window).load(function () {
        if ($('#acilis').length) {
            $(window).scrollTop($('#acilis').offset().top);
        }
    });

})(jQuery);