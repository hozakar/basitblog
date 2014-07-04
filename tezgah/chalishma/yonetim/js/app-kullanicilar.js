(function ($) {
    "use strict";

    $('.kullanicikayit').click(function () {
        $('#kullanici [name=id]').val($(this).data('kullanici-id'));
        $('#kullanici [name=isim]').val($(this).data('kullanici-isim'));
        $('#kullanici [name=eposta]').val($(this).data('kullanici-eposta'));
        if ($(this).data('kullanici-id') > 0) {
            $('#kullanici [name=duzey]').val($(this).data('kullanici-duzey'));
            $('#kullanici [name=sifre]').removeAttr('required');
        } else {
            $('#kullanici [name=sifre]').attr('required', 'required');
        }
    });

    $('.kullanicisil').click(function () {
        if (!confirm('Bu Kullanıcıyı Silmek İstediğinize Emin misiniz?')) return;

        $.ajax({
            url: "?sayfa=kullanicilar",
            method: 'post',
            data: {
                islem: 'sil',
                id: $(this).data('kullanici-id')
            }
        }).done(function () {
            location.reload();
        });
    });

    $('.aktifdegistir').click(function () {
        $.ajax({
            url: "?sayfa=kullanicilar",
            method: 'post',
            data: {
                islem: 'degistir',
                id: $(this).data('kullanici-id')
            }
        }).done(function () {
            location.reload();
        });
    });
})(jQuery);