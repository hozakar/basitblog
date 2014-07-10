(function ($) {
    "use strict";

    $('#fileupload')
        .bind('fileuploaddone', function (e, data) {
            var dosya = data.files[0].name;
            $.ajax({
                url: $('input[name=id]').data('ana-dizin') + "upload/dosyaduzenle.php",
                method: 'get',
                data: {
                    dosya: dosya,
                    id: $('input[name=id]').val(),
                    yol: $('input[name=id]').data('ana-dizin')
                }
            });
        })
        .bind('fileuploadstop', function (e) {
            $('#makalekaydet').parents('form').append('<input type="hidden" name="acilis" value="fotolar" />');
            $('#makalekaydet').click();
        });

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
        }).done(function () {
            $('#makalekaydet').parents('form').append('<input type="hidden" name="acilis" value="fotolar" />');
            $('#makalekaydet').click();
        });
    });

    $(function () {
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