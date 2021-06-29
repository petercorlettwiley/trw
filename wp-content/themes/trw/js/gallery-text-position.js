/* eslint-disable no-console */
/* global jQuery */
/**
 * File gallery-text-position.js.
 *
 */
( function( $ ) {

const $gallery = $( '.media-gallery' );
const mobileBreak = 800;

if ( $gallery.length == 0 ) {
  return;
}

const $galleryItem = $gallery.find('.media-item');

$galleryItem.each(function() {

  const $image = $(this).find('img');
  const $text = $(this).find('.media-counter:not(.stuck)');

  //check all images on the page
  $image.each(function(){
    var img = new Image();

    img.addEventListener("load", function() {

      setTextPosition($image, $text);

    });

    img.src = $(this).attr('src');
  });

  $(window).on('resize', function () {
    $image.each(function(){
      setTextPosition($(this), $text);
    });
  });


});

function setTextPosition(image, text) {

  const $imageWidth = image.width();
  const $imageHeight = image.height();
  const $text = text;
  const offsetHorizontal = '3rem';
  const offsetVertical = '1rem';

  //console.log($image.outerHeight());

  if ($(window).outerWidth() >= mobileBreak) {

    $text.css({ left: 'calc(50% - ' + $imageWidth/2 + 'px - ' + offsetHorizontal + ')' });
  
    if ( $imageWidth >= $imageHeight ) {
      $text.css({ bottom: 'calc(50% - ' + $imageHeight/2 + 'px + ' + offsetVertical + ')' });
    }
  } else {
    $text.css('left', '').css('bottom', '');
  }
}

}( jQuery ) );
