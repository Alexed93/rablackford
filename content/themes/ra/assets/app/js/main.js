/**
 * Title:
 *    Main Javascript
 * Description:
 *    The main Javascript file where you will write the bulk
 *    of your scripts. Make sure to include this just before
 *    the closing </body> tag.
 * Sections:
 *    $. Your Scripts
 *    $. Grunticon Loader
 */



/* $. Your Scripts - To go within the SIAF (Self invoking annonymous function)
\*----------------------------------------------------------------*/

(function($) {

    /**
     * Set variable to pool DOM only once.
     */
    var html = $('html');
    var body = $('body');
    var toggleNav = $('.toggle__icon--nav');

    /**
     * Setup 'CustomSelect' plugin on all Select elements
     */
    if(!$('html').hasClass('ie')) {
        $("select").each(function() {
            new CustomSelect($(this));
        });
    }

    /**
     * Toggle the navigation
     */
    $('.js-toggle-nav').on('click', function() {
        // 1. Toggle the Nav
        body.toggleClass('is-active-nav');

        // 2. Toggle Icons to show whether Nav is active or not
        toggleNav.toggleClass('icon--menu-open').toggleClass('icon--menu-close');
    });
    /**
     * Setup 'CustomSelect' plugin on all Select elements
     */
    if(!html.hasClass('ie')) {
        $("select").each(function() {
            new CustomSelect($(this));
        });
    }

})(jQuery);



/* $. Grunticon Load
\*----------------------------------------------------------------*/

grunticon([ "/content/themes/ra/assets/dist/grunticon/icons.data.svg.css", "/content/themes/ra/assets/dist/grunticon/icons.data.png.css", "/content/themes/ra/assets/dist/grunticon/icons.fallback.css" ]);
