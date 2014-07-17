(function ($) {
    "use strict";

    /* Colorpicker */
    $(function () {
        if ($('.renksec').length) {
            $('.renkseclink').click(function () {
                var $renksec = $(this).parents('li').find('.renksec');
                if ($renksec.length) $renksec.focus();
            });

            $('.renksec').colorpicker()
                .on('changeColor', function (ev) {
                    var $renkseclink = $(this).parents('li').find('.renkseclink');
                    if ($renkseclink.length) $renkseclink.css('color', ev.color.toHex());
                })
                .on('hidePicker', function () {
                    var renk = $(this).val();
                    var id = $(this).data('id');
                    $.ajax({
                        url: "?sayfa=etiketler",
                        method: 'post',
                        data: {
                            islem: 'renk',
                            id: id,
                            renk: renk
                        }
                    });
                });
        }
    });
    /* Son: Colorpicker */

    $('.kaldir').click(function () {
        var id = $(this).data('id');
        $.ajax({
            url: "?sayfa=etiketler",
            method: 'post',
            data: {
                islem: 'degistir',
                id: id
            }
        }).done(function () {
            location.reload();
        });
    });

    $('.sil').click(function () {
        var id = $(this).data('id');
        $.ajax({
            url: "?sayfa=etiketler",
            method: 'post',
            data: {
                islem: 'sil',
                id: id
            }
        }).done(function () {
            location.reload();
        });
    });

})(jQuery);