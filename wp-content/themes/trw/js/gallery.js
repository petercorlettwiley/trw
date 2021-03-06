/* eslint-disable no-console */
/* global jQuery */
/**
 * File gallery.js.
 *
 * @link https://stackoverflow.com/questions/24217087/how-to-determine-scroll-direction-without-actually-scrolling
 */
( function( $ ) {

const $gallery = $( '.media-gallery' );
const mobileBreak = 800;

if ( $gallery.length == 0 ) {
  return;
}

const $galleryItem = $gallery.find( '.media-item' );
var index = 0;
var switchIndex = 0;

var scrollDelta = { x: 0, y: 0 };
var moveDelta = { x: 0, y: 0 };
const scrollThreshold = 300;
const scrollTimerReset = 500;
const animationSpeed = 500;
var scrollTimer = null;
var scrolling = false;
var switchScrolling = false;

window.addEventListener('wheel', function(event) {
  scrollDelta.x = event.deltaX;
  scrollDelta.y = event.deltaY;

  if ( !scrolling && $(window).outerWidth() >= mobileBreak ) {
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
    changeSwitchIndex(1);
    moveDelta.x = 0;
  }

  if (moveDelta.x < scrollThreshold * -1) {
    prevSlide();
    changeSwitchIndex(-1);
    moveDelta.x = 0;
  }

  if (moveDelta.y > scrollThreshold ) {
    nextSlide();
    changeSwitchIndex(1);
    moveDelta.y = 0;
  }

  if (moveDelta.y < scrollThreshold * -1) {
    prevSlide();
    changeSwitchIndex(-1);
    moveDelta.y = 0;
  }
}

const $arrowNav = $('.media-nav');

if ( $arrowNav.length > 0 ) {
  $arrowNav.find('a.prev').click(function(event){
    event.preventDefault();

    if ( !scrolling ) {
      prevSlide();
      changeSwitchIndex(-1);
    }
  });
  $arrowNav.find('a.next').click(function(event){
    event.preventDefault();

    if ( !scrolling ) {
      nextSlide();
      changeSwitchIndex(1);
    }
  });
}

$gallery.click(function() {
  if ( !scrolling ) {
    nextSlide();
    changeSwitchIndex(1);
  }
});

function nextSlide() {

  if ($('body').hasClass('about-open')) {
    return false;
  }

  // show 'next project' button
  if ( index == $galleryItem.length-1 ) {
    $('.nav-previous').fadeIn();
    $('.media-counter.stuck').fadeOut();
    return;

  } else {
    $('.media-counter.stuck').fadeIn();
  }

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

  if ($('body').hasClass('about-open')) {
    return false;
  }

  // hide 'next project' button
  if ( index < $galleryItem.length ) {
    $('.nav-previous').fadeOut(400, function() { $('.media-counter.stuck').fadeIn(); });
  }

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

function changeSwitchIndex( dir ) {
  switchIndex += dir;

  if ( switchIndex < 0 ) {
    switchIndex = $galleryItem.length-1;
  }

  if ( switchIndex > $galleryItem.length && !switchScrolling ) {
    switchScrolling = true;

    $('main#primary').css({position: 'relative'}).animate({left: '-=33%', opacity: 0}, animationSpeed, function() {
      $('body').removeClass('loaded');
      setTimeout( function(){ $('.nav-previous a')[0].click();}, 300);
    });
  }
}

}( jQuery ) );
