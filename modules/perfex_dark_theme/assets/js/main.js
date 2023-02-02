(function ($) {
    "use strict";

    // Changed some elements with new animation
    var flipInY = 'animated fast flipInY';
    var slowFadeIn = 'animated slow fadeIn';
    $('body').addClass('perfex_dark_theme_initiated');
    $('.screen-options-area').addClass(slowFadeIn);
    $('#mobile-collapse').addClass(flipInY);
    $('.dropdown-menu').removeClass('fadeIn').addClass(flipInY);

    //  Added modal animation effects
    $(window).on('show.bs.modal', function () {
        $('.modal-content').addClass('animated fast zoomInUp');
    });

    // Add butons wave effects
    Waves.init();
    Waves.attach('.btn', ['waves-effect', 'waves-light', 'waves-ripple']);
    $('body .col-md-2.col-xs-6.border-right p.font-medium.no-mbot:contains("Testing")').css('color', '#736f6f');

    // Change chart default font color
    Chart.defaults.global.defaultFontColor = "rgba(225,235,245,.90)";

    // Ini nanobar
    var options = {
        target: document.getElementsByTagName("BODY")[0]
    };

    var nanobar = new Nanobar(options);
    if (document.readyState == 'loading') {
        nanobar.go(30);
        nanobar.go(76);
        nanobar.go(100);
    }
})(jQuery);