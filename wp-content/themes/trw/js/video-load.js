/* global jQuery */

/**
 * File video-load.js.
 *
 */
( function( $ ) {

  setTimeout(function() { 
  
    var videos = Object.keys(videojs.getPlayers()).length;
    
    if (videos > 0) {
  
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
    }
  }, 2000);

}( jQuery ) );
