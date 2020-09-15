/*
* JS external modules/libraries
*/

// import jquery. sort some namespaces out, as this will be largely handled by webpack.
import $ from 'jquery';

window.jQuery = $;
window.$ = $;

// import modernizr build
require('./vendor/modernizr.js');

// slick carousel
// const slick = require('slick-carousel');

// partials not reliant on jquery
require('./partials/debounce.js');

$(document).ready(function () {

  require('./vendor/custom-select.jquery.js');
  require('./partials/responsive-svg.js');

  /**
     * Set variable to pool DOM only once.
     */
    var html = $('html');
    var body = $('body');
    var toggleNav = $('.toggle__icon--nav');

    /**
     * Setup 'CustomSelect' plugin on all Select elements
     */
    // if(!$('html').hasClass('ie')) {
    //     $("select").each(function() {
    //         new CustomSelect($(this));
    //     });
    // }

    /**
     * Toggle the navigation
     */
    $('.js-toggle-nav').on('click', function() {
        // 1. Toggle the Nav
        body.toggleClass('is-active-nav');

        // 2. Toggle Icons to show whether Nav is active or not
        toggleNav.toggleClass('icon--menu-open').toggleClass('icon--menu-close');
        $(this).toggleClass('is-active');
    });


    /**
    * $. News Achive Accordion
    */

     var allPanels = $('.list--accordion .list__sub');
     allPanels.hide();

     $('.list__major').click(function() {
       if( $(this).hasClass('is-active') ){
           //closing
           $(this).siblings('.list__sub').slideUp();

           $(this).removeClass('is-active')
               .addClass('sidebar__list--open')
               .removeClass('sidebar__list--close');

       } else {
           //opening
           $(this).addClass('sidebar__list--close')
                   .addClass('is-active')
                   .removeClass('sidebar__list--open');

           $(this).siblings('.list__sub').slideDown();
           allPanels.slideUp();

       }

       return false;

     });

});

$(window).on('load', function () {

});
