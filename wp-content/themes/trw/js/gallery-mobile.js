/* eslint-disable no-console */
/* global jQuery */
/**
 * File gallery-mobile.js.
 *
 */
( function( $ ) {

const $gallery = $( '.media-gallery' );
const mobileBreak = 800;

if ( $gallery.length == 0 ) {
  return;
}

const $galleryItem = $gallery.find( '.media-item' );
const counterPadding = 60;

$(window).on('load', function(){
  setGalleryWidth();
});

$(window).on('resize', function () {
  setGalleryWidth();
});

function setGalleryWidth() {

  var galleryItemRatios = [];
  var minRatio = 0;

  // store image ratios
  $galleryItem.each(function() {
    const $image = $(this).find('img');
  
    $image.each(function(){
      var img = new Image();
      const width = $(this).outerWidth();
      const height = $(this).outerHeight() + counterPadding;
      const ratio = width / height;
  
      galleryItemRatios.push(ratio);
    });
  });

  minRatio = Math.min.apply( Math, galleryItemRatios );

  if ($(window).outerWidth() < mobileBreak) {
    const height = $gallery.outerHeight();
    $gallery.css('width', height*minRatio + 'px');

  } else {
    $gallery.css('width', '');
  }
}

}( jQuery ) );
