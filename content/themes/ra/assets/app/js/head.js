/**
 * Title:
 *    Header Javascript
 * Description:
 *    Javascript file which is located in the <head>.
 *    Only to be used for scripts that are needed to be
 *    produced before the DOM has loaded. i.e. Modernizr
 * Sections:
 *    $. Your Scripts
 */

 // import jquery. sort some namespaces out, as this will be largely handled by webpack.
import $ from 'jquery';

window.jQuery = $;
window.$ = $;

// import modernizr build
require('./vendor/modernizr.js');




/* $. Your Scripts - To go within the SIAF (Self invoking annonymous function)
\*----------------------------------------------------------------*/



(function($) {

    $(document).ready(function() {
        require('./partials/custom-select.js');
    });

})(jQuery);
