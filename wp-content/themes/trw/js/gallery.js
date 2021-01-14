/* eslint-disable no-console */
/* global jQuery */
/**
 * File gallery.js.
 *
 * @link https://stackoverflow.com/questions/24217087/how-to-determine-scroll-direction-without-actually-scrolling
 */
( function( $ ) {


const $gallery = $( '.media-gallery' );

if ( $gallery.length == 0 ) {
  return;
}

const $galleryItem = $gallery.find( '.media-item' );
var index = 0;

var scrollDelta = { x: 0, y: 0 };
var moveDelta = { x: 0, y: 0 };
const scrollThreshold = 300;
const scrollTimerReset = 500;
const animationSpeed = 500;
var scrollTimer = null;
var scrolling = false;

window.addEventListener('wheel', function(event) {
  scrollDelta.x = event.deltaX;
  scrollDelta.y = event.deltaY;

  if ( !scrolling ) {
    checkScroll( scrollDelta );
  }
  
  if ( scrollTimer !== null ) {
    clearTimeout(scrollTimer);        
  }

  scrollTimer = setTimeout(function() {
    moveDelta = { x: 0, y: 0 };
  }, scrollTimerReset);
});

function checkScroll ( delta ) {
  moveDelta.x += delta.x;
  moveDelta.y += delta.y;
  
  if (moveDelta.x > scrollThreshold) {
    nextSlide();
    moveDelta.x = 0;
  }

  if (moveDelta.x < scrollThreshold * -1) {
    prevSlide();
    moveDelta.x = 0;
  }

  if (moveDelta.y > scrollThreshold ) {
    nextSlide();
    moveDelta.y = 0;
  }

  if (moveDelta.y < scrollThreshold * -1) {
    prevSlide();
    moveDelta.y = 0;
  }
}

function nextSlide() {
  // remove previous index
  scrolling = true;
  const $lastItem = $gallery.find( '#media-'+index );

  $lastItem.animate({ opacity: 0, left: "-=100%" }, animationSpeed, function() {

    $lastItem.hide();
    $gallery.append($lastItem);
    $lastItem.show().css({opacity: '', left: ''});

    // load new index
    if ( index < $galleryItem.length-1 ) {
      index++;
    } else {
      index = 0;
    }

    const $nextItem = $gallery.find( '#media-'+index );
    $nextItem.css({opacity: 0, left: '+=100%'});
    $gallery.prepend($nextItem);
    $nextItem.animate({opacity: 1, left: 0}, animationSpeed, function() {scrolling = false;});

  });

}

function prevSlide() {
  // remove previous index
  scrolling = true;
  const $lastItem = $gallery.find( '#media-'+index );

  $lastItem.animate({ opacity: 0, left: "+=100%" }, animationSpeed, function() {

    $lastItem.hide();
    $gallery.append($lastItem);
    $lastItem.show().css({opacity: '', left: ''});

    // load new index
    if ( index > 0 ) {
      index--;
    } else {
      index = $galleryItem.length-1;
    }

    const $nextItem = $gallery.find( '#media-'+index );
    $nextItem.css({opacity: 0, left: '-=100%'});
    $gallery.prepend($nextItem);
    $nextItem.animate({opacity: 1, left: 0}, animationSpeed, function() {scrolling = false;});

  });

}

}( jQuery ) );
