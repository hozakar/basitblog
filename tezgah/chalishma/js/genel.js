"use strict";

/* !!! BU DOSYA HTML SAYFASININ SONUNDA YÜKLENMELİDİR !!! */

/* *********************************************************
** Sayfa scroll edilkdiğinde menu barın rengi değişsin
** sağ alt köşede yukarı butonu çıksın
** Sosyal Medya butonlarının renkleri tersine dönsün
********************************************************* */
/* Yukarı butonunu yarat */
$('body').append('<div class="yukari-buton hidden text-center" style="bottom: ' + ($('.alt-bar').outerHeight() + 12) + 'px"><i class="fa fa-2x fa-angle-up"></i></div>');

/* Yukarı butonuna tıklandığında */
$('.yukari-buton').click(function () {
    $('body').animate({scrollTop: 0}, 400);
});

$(window).scroll(function () {
    if ($(window).scrollTop() > $('.ust-bar .bar-bg').height() - $('.ust-bar .menu-bar').height()) {
        $('.ust-bar .menu-bar').addClass('alt'); // Menu rengini değiştir
        $('.yukari-buton').removeClass('hidden'); // Yukarı butonunu sakla
    } else {
        $('.ust-bar .menu-bar').removeClass('alt'); // Menu rengini değiştir
        $('.yukari-buton').addClass('hidden'); // Yukarı butonunu göster
    }
    $('.mousetakip').trigger('mouseleave'); // SM butonlarını renk değişimi için trigger et
});

/* ****************************************************** */

/* Sosyal Medya Butonlarının renk değişimleri */
var smbuton = $('.sosyal [data-color]');

for (var i = 0; i < smbuton.length; i++) {
    if ($(smbuton[i]).data('hover-color')) {
        $(smbuton[i]).mouseenter(function () {
            var color = $(this).data('hover-color');
            var hcolor = $(this).data('color');
            
            if ($(this).parents('.menu-bar').hasClass('alt')) {
                color = $(this).data('color');
                hcolor = $(this).data('hover-color');
            }
            
            $(this).css({
                color: color,
                background: hcolor
            });
        });
        $(smbuton[i]).mouseleave(function () {
            $(smbuton[i]).addClass('mousetakip');

            var color = $(this).data('color');
            var hcolor = $(this).data('hover-color');
            
            if ($(this).parents('.menu-bar').hasClass('alt')) {
                color = $(this).data('hover-color');
                hcolor = $(this).data('color');
            }
            
            $(this).css({
                color: color,
                background: hcolor
            });
        });
        $(smbuton[i]).trigger('mouseleave');
    }
}
/* ****************************************** */

/* Modal için başlık ata */
$('[data-baslik-id]').click(function () {
    $('#' + $(this).data('baslik-id')).html($(this).data('baslik') ? $(this).data('baslik') : $(this).html());
});
/* ********************* */