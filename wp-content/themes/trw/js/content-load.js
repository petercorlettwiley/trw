/* global jQuery */

/**
 * File content-load.js.
 *
 */
( function( $ ) {

  $(window).on('load', function(){
    $('body').addClass('loaded');
  });

  // clicking to new page and 'unloading' old page

  var $links = $('a:not([href*="#"])');

  $links.each(function(){
    let href = $(this).attr('href');

    $(this).on('click', function(e) {
      e.preventDefault();
      $('body').removeClass('loaded');
      setTimeout(function() { window.location.href = href; }, 300);
    });
  });

}( jQuery ) );
