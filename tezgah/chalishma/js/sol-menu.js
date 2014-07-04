"use strict";
(function($) {
    var bl_menu = {
        menuBtn: $('.menu-buton'),
        width: 320,
        init: function(el, param) {
            if(param) {
                if(param.menuBtn) bl_menu.menuBtn = $(param.menuBtn);
                if(param.width) bl_menu.width = param.width;
            }

            /* Body'nin overflow'unu bir kenara yazalım */
            $('body').data('overflow', $('body').css('overflow'));

            /* Tüm Body içeriğini taşımak için bir layer yarat */
            $('body').wrapInner('<div class="sol-menu-body-wrapper"></div>');

            /* Sol menu içeriğini taşımak için bir layer yarat */
            $('body').prepend('<div class="sol-menu-menu-wrapper" style="width: ' + bl_menu.width + 'px; left: -' + bl_menu.width + 'px;"></div>');
            el.appendTo('.sol-menu-menu-wrapper');

            /* Sol menu açıkken bodynin üzerinde cover işlevi görecek
            ** layer yarat. Aynı zamanda tıklanıldığında menuyu kapatacak */
            $('body').append('<div class="sol-menu-body-cover"></div>');

            bl_menu.cover = $('.sol-menu-body-cover');
            bl_menu.menu = $('.sol-menu-menu-wrapper');
            bl_menu.body = $('.sol-menu-body-wrapper');

            bl_menu.cover.click(bl_menu.toggle);
            bl_menu.menuBtn.click(bl_menu.toggle);
        },
        toggle: function() {
            bl_menu.menu.toggleClass('aktif');
            setCover();
        },
        open: function() {
            bl_menu.menu.addClass('aktif');
            setCover();
        },
        close: function() {
            bl_menu.menu.removeClass('aktif');
            setCover();
        }
    }

    function setCover() {
        if(bl_menu.menu.hasClass('aktif')) {
            bl_menu.cover.addClass('aktif');
            bl_menu.body.addClass('aktif');
            $('body').css('overflow', 'hidden');
        } else {
            bl_menu.cover.removeClass('aktif');
            bl_menu.body.removeClass('aktif');
            $('body').css('overflow', $('body').data('overflow'));
        }
    }

	/* Plug-in Start */
	$.fn.solMenu = function(parameters) {
        bl_menu.init(this, parameters);
	}
	/* End: Plug-in Start */
})(jQuery);
