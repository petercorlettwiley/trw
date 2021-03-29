/* global jQuery */

/**
 * File image-load.js.
 *
 * @link https://stackoverflow.com/questions/9845774/fade-in-images-after-they-have-loaded
 */
( function( $ ) {

var player = videojs('my-video');

player.on('ready', function() {
  var img = new Image();
  img.src = player.getAttribute('poster');
  img.onload = function(){
    player.addClass('player-loaded');
  }
});

//snippet.log('before:  '+video.getBoundingClientRect().width);


}( jQuery ) );
