(function ($) {
    "use strict";

    /* Kullanıcı Menu Aktivasyonu */
    $('.isim').data('width', $('.isim').width());
    $('.isim div').width($('.isim').data('width'));
    $('.isim').width(0);
    $('.kullanici').mouseenter(function () {
        $('.isim').width($('.isim').data('width'));
    });
    $('.kullanici').mouseleave(function () {
        $('.isim').width(0);
    });
    /* Son: Kullanıcı Menu Aktivasyonu */

    /* Tooltip */
    $('[data-toggle=tooltip]').tooltip();
    /* Son: Tooltip */

    /* Menu Aç Kapat */
    $('.menu-ac-kapat').click(function () {
        $('.menu, .body').toggleClass('acik');
        $('.body').unbind('click');

        setTimeout(function () {
            $('.body').css('min-height', $(window).height() + 'px');
            if ($('.body').hasClass('acik')) $('.body').click(function () {
                if ($('.menu-ac-kapat').css('display') == 'none') {
                    $('.menu-ac-kapat').trigger('click');
                }
                return false;
            });
        }, 250);
    });

    $('.menu-kapat').click(function () {
        $('.menu, .body').removeClass('acik');
        $('.body').unbind('click');
    });

    $(window).resize(function () {
        if ($(window).width() > 1365) $('.menu, .body').removeClass('acik');
        $('.body').css('min-height', $(window).height() + 'px');
    });
    /* Son: Menu Aç Kapat */

    /* Tarih Kutusu */
    /* Türkçeleştirmek için ilgi js dosyasında bazı değişiklikler yapıldı */
    $('input.tarih').datepicker().on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });
    $('.input-group-addon.tarih').click(function () {
        $(this).parents('.input-group').find('input.tarih').datepicker('show');
    });
    /* Son: Tarih Kutusu */

    /* Select2 */
    var s2 = $('.select2-etiket');
    for (var i = 0; i < s2.length; i++) {
        $(s2[i]).select2({
            tags: $(s2[i]).data('liste').split(',')
        });
    }
    /* Son: Select2 */
})(jQuery);
