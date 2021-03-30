/* global jQuery */

/**
 * File image-load.js.
 *
 * @link https://stackoverflow.com/questions/9845774/fade-in-images-after-they-have-loaded
 */
( function( $ ) {

if(videojs) {

  setTimeout(function() { 

    var player = videojs('my-video');
  
    if (player) {
    
      player.ready(function() {
        var img = new Image();
        img.src = player.getAttribute('poster');
        img.onload = function(){
          player.addClass('player-loaded');
        }
      });
    
    } else {
      return;
    }
  }, 1000);
}

}( jQuery ) );
