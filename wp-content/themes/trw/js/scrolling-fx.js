/* global jQuery */

/**
 * File scrolling-fx.js.
 *
 * @link https://stackoverflow.com/questions/487073/how-to-check-if-element-is-visible-after-scrolling
 */
( function( $ ) {

var $elements;

if ( $('body').hasClass('home') && $('a.post-link-wrap').length > 0 ) {
	// on home
	$elements = $('a.post-link-wrap');
} else {
	return;
}

function isScrolledIntoView(elem) {
  var docViewTop = $(window).scrollTop();
  var docViewBottom = docViewTop + $(window).height();

  var elemTop = $(elem).offset().top;
  var elemMiddle = elemTop + $(elem).height()/2;

  return ((elemMiddle <= docViewBottom) && (elemMiddle >= docViewTop));
}

function testElements() {
	$elements.each( function() {
		if ( isScrolledIntoView($(this)) ) {
			$(this).addClass('visible');
		} else {
			//$(this).removeClass('visible');
		}
	})
}

function init () {
	testElements();
	window.addEventListener('scroll', testElements, false);
}

if (document.readyState !== 'loading') {
  init();
} else {
  document.addEventListener('DOMContentLoaded', init, false);
}

}( jQuery ) );
