(function ($) {
    "use strict";

    /* Colorpicker */
    $(function () {
        if ($('.renksec').length) {
            $('.renkseclink').click(function () {
                var $renksec = $(this).parents('span').find('.renksec');
                if ($renksec.length) $renksec.focus();
            });

            $('.renksec').colorpicker()
                .on('changeColor', function (ev) {
                    var $renkseclink = $(this).parents('span').find('.renkseclink');
                    if ($renkseclink.length) $renkseclink.css('color', ev.color.toHex());
                    $(this).parents('span').find('input.renksec').attr('value', ev.color.toHex());
                });

        }
    });
    /* Son: Colorpicker */

    /* Sıralama */
    $(".baglantilar").sortable({
        stop: function () {
            var li = $('.baglantilar li');
            for (var i = 0; i < li.length; i++) {
                $(li[i]).find('.siralama').val(i);
            }
        }
    });
    $(".baglantilar").disableSelection();
    /* Son: Sıralama */

    /* Sil Butonu */
    $('.sosyalsil').click(function () {
        if (!confirm('Bu Kaydı Silmek İstediğinize Emin misiniz?')) return;
        var li = $(this).parents('li')[0];
        $(li).slideToggle();
        $(li).find('.sil').val(1);
    });
    /* Son: Sil Butonu */

    /* Ekle Butonu */
    $('.sosyalekle').click(function () {
        $('.baglantilar').append(
            '<li><span class="ikon"><select name="sosyal_yeni[]" class="form-control">' + $('#sosyal_sablon').html() + '</select></span> ' +
            '<span class="adres"><input type="text" class="form-control" name="sadres_yeni[]" placeholder="http://" /></span> ' +
            '<span class="renk"><label class="md-kapat">İkon Rengi</label> <input type="text" class="renksec" name="renk_yeni[]" value="#000000" />' +
            '<a href="javascript:;" class="renkseclink" style="color: #000000;" data-toggle="tooltip" data-placement="top" title="İkon Rengi">' +
            '<i class="fa fa-circle"></i></a></span> ' +
            '<span class="renk"><label class="md-kapat">Alt. Renk</label> <input type="text" class="renksec" name="hoverrenk_yeni[]" value="#ffffff" />' +
            '<a href="javascript:;" class="renkseclink" style="color: #ffffff;" data-toggle="tooltip" data-placement="top" title="Arka Plan Rengi">' +
            '<i class="fa fa-circle"></i></a></span> ' +
            '<span class="buton"><button type="button" class="btn btn-xs btn-danger sosyalsil"><i class="fa fa-trash-o"></i></button></span> ' +
            '<input type="hidden" name="sira_yeni[]" class="siralama" value="999" /><input type="hidden" name="sil_yeni[]" class="sil" value="0" /></li>'
        );

        /* Sil Butonu İşlemini Yenile*/
        $('.sosyalsil')
            .unbind('click')
            .click(function () {
                if (!confirm('Bu Kaydı Silmek İstediğinize Emin misiniz?')) return;
                var li = $(this).parents('li')[0];
                $(li).slideToggle();
                $(li).find('.sil').val(1);
            });
        /* Son: Sil Butonu İşlemini Yenile */

        /* Colorpicker Yenile */
        $('.renkseclink')
            .unbind('click')
            .click(function () {
                var $renksec = $(this).parents('span').find('.renksec');
                if ($renksec.length) $renksec.focus();
            });

        $('.renksec').colorpicker()
            .off('changeColor')
            .on('changeColor', function (ev) {
                var $renkseclink = $(this).parents('span').find('.renkseclink');
                if ($renkseclink.length) $renkseclink.css('color', ev.color.toHex());
                $(this).parents('span').find('input.renksec').val(ev.color.toHex());
            })
        /* Son: Colorpicker Yenile */
    });
    /* Ekle Butonu */

})(jQuery);