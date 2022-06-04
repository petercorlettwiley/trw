/* global jQuery */

/**
 * File image-load.js.
 *
 * @link https://stackoverflow.com/questions/9845774/fade-in-images-after-they-have-loaded
 */
( function( $ ) {

if ( $('img').length > 0 ) {
	// images exist
} else {
	return;
}

$(window).on('load', function(){
  $('img').css('opacity', '1');
});

}( jQuery ) );
