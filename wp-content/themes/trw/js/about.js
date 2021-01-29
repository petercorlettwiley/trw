/* eslint-disable no-console */
/* global jQuery */
/**
 * File about.js.
 *
 * Handle about page modal
 */
( function( $ ) {

const $aboutLink = $('a[href="#about"');
const $aboutPage = $('#about');
const $body = $('body');

if ( $aboutLink.length == 0 || $aboutPage.length == 0 ) {
  return;
}

$aboutLink.click(function(event){
  event.preventDefault();

  $aboutPage.toggleClass('open');
  $body.toggleClass('about-open');
});

}( jQuery ) );