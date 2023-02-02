(function($) {
    "use strict";

    $('body').addClass('office_theme_theme_initiated');

    // Add butons wave effects
    Waves.init();
    Waves.attach('.btn', ['waves-effect', 'waves-light', 'waves-ripple']);

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