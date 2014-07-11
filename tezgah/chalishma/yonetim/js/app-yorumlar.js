(function ($) {
    "use strict";

    $('.yorumdetay').click(function () {
        $('#yorumdetay .modal-body').html($(this).parents('tr').find('.liste-uzun-metin').html());
    });

    $('.yorumsil').click(function () {
        if (!confirm('Bu Yorumu Silmek İstediğinize Emin misiniz?')) return;

        $.ajax({
            url: "?sayfa=yorumlar",
            method: 'post',
            data: {
                islem: 'sil',
                id: $(this).data('yorum-id'),
                atab: $(this).data('tab')
            }
        }).done(function () {
            if ($('#makalekaydet').length) {
                $('#makalekaydet').parents('form').append('<input type="hidden" name="acilis" value="yorumlar" />');
                $('#makalekaydet').click();
            } else {
                location.reload();
            }
        });
    });

    $('.aktifdegistir').click(function () {
        $.ajax({
            url: "?sayfa=yorumlar",
            method: 'post',
            data: {
                islem: 'degistir',
                id: $(this).data('yorum-id'),
                atab: $(this).data('tab')
            }
        }).done(function () {
            if ($('#makalekaydet').length) {
                $('#makalekaydet').parents('form').append('<input type="hidden" name="acilis" value="yorumlar" />');
                $('#makalekaydet').click();
            } else {
                location.reload();
            }
        });
    });
})(jQuery);