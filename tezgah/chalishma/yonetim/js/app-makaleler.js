(function ($) {
    "use strict";

    $('.makalesil').click(function () {
        if (!confirm('Bu Makaleyi Silmek İstediğinize Emin misiniz?')) return;

        $.ajax({
            url: "?sayfa=makaleler",
            method: 'post',
            data: {
                islem: 'sil',
                id: $(this).data('makale-id')
            }
        }).done(function () {
            location.reload();
        });
    });

    $('.aktifdegistir').click(function () {
        $.ajax({
            url: "?sayfa=makaleler",
            method: 'post',
            data: {
                islem: 'degistir',
                id: $(this).data('makale-id')
            }
        }).done(function () {
            location.reload();
        });
    });

})(jQuery);