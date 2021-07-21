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
const $aboutClose = $('#aboutClose');
const $aboutContent = $('#about a, #about .about-content');
const $body = $('body');

if ( $aboutLink.length == 0 || $aboutPage.length == 0 || $aboutContent.length == 0 || $aboutClose.length == 0) {
  return;
}

$aboutLink.on('click', function (event){
  event.preventDefault();

  openAboutPage();
});

$aboutContent.on('click', function (event) {
  event.stopPropagation();
});

$aboutPage.on('click', function (event) {
  event.preventDefault();

  closeAboutPage();
});

$aboutClose.on('click', function (event) {
  event.preventDefault();

  closeAboutPage();
});

$(document).keyup( function(event){
  if (event.keyCode === 27) {
    closeAboutPage();
  }
});

function openAboutPage() {
  if (!$body.hasClass('about-open')) {
    $aboutPage.addClass('open');
    $body.addClass('about-open');
  }
}

function closeAboutPage() {
  if ($body.hasClass('about-open')) {
    $body.removeClass('about-open');
    $aboutPage.removeClass('open');
  }
}

var $lineStyles = '<style id="lineStyles"></style>';

function adjustAboutLines() {
  const $aboutParagraph = $('#about .about-content p');
  const $bottom = $aboutParagraph.outerHeight() * 4/5;
  const $top = $aboutParagraph.outerHeight() * 4/5 + 4;
  $('#lineStyles').text('#about .about-content:before { bottom: calc(50% + ' + $bottom + 'px); } #about .about-content:after { top: calc(50% + ' + $top + 'px); }');
}

$(window).on('resize', function () {
  adjustAboutLines();
});

$(window).on('load', function(){
  $('head').append($lineStyles);
  adjustAboutLines();
});

}( jQuery ) );