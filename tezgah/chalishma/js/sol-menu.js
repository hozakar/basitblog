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

            /* Sol menu için aç - kapat butonunu taşıyacak bir layer yarat 
            ** bu layer aynı zamanda menu açıldığında bodynin üzerinde cover
            ** işlevi görecek */
            $('.sol-menu-body-wrapper').prepend('<div class="sol-menu-ac-kapat-buton"></div>');
        }
    }

	/* Plug-in Start */
	$.fn.solMenu = function(parameters) {
        bl_menu.init(this);
	}
	/* End: Plug-in Start */
})(jQuery);
