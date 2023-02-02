(function($) {
    "use strict";

    // Changed some elements with new animation
    var slowFadeIn = 'animated fadeIn';
    $('body').addClass('perfex_office_theme_initiated');
    $('.screen-options-area').addClass(slowFadeIn);
    $('#mobile-collapse').addClass(slowFadeIn);

    $('.quick-links').prependTo('#header nav .navbar-nav');

    $('.quick-links').css('display', 'block');

    $('li:has(a.close-customizer)').css({
        'background': '#566de2',
        'height': '62px'
    });

    // Add butons wave effects
    Waves.init();
    Waves.attach('.btn', ['waves-effect', 'waves-light', 'waves-ripple']);

    // Change chart default font color
    Chart.defaults.global.defaultFontColor = "#000000";
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