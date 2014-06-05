"use strict";
(function($) {
    var bl_menu = {
        width: 320,
        init: function(el) {
            /* Tüm Body içeriğini taşımak için bir layer yarat */
            $('body').wrapInner('<div class="sol-menu-body-wrapper"></div>');

            /* Sol menu içeriğini taşımak için bir layer yarat */
            $('body').prepend('<div class="sol-menu-menu-wrapper" style="width: ' + bl_menu.width + 'px; left: -' + bl_menu.width + 'px;"></div>');
            el.appendTo('.sol-menu-menu-wrapper');

            /* Sol menu açıkken bodynin üzerinde cover işlevi görecek
            ** layer yarat. Aynı zamanda tıklanıldığında menuyu kapatacak */
            $('body').append('<div class="sol-menu-body-cover"></div>');

            $('.sol-menu-body-wrapper').click(bl_menu.toggleMenu);
        },
        toggleMenu: function() {
            $('.sol-menu-menu-wrapper').toggleClass('aktif');
        },
        openMenu: function() {
            $('.sol-menu-menu-wrapper').addClass('aktif');
        },
        closeMenu: function() {
            $('.sol-menu-menu-wrapper').removeClass('aktif');
        }
    }

	/* Plug-in Start */
	$.fn.solMenu = function(parameters) {
        bl_menu.init(this);
	}
	/* End: Plug-in Start */
})(jQuery);
