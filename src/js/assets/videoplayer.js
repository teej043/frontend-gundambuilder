if ($('.gb-video').length){

  var tag = document.createElement('script');

  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


  // 3. This function creates an <iframe> (and YouTube player)
  //    after the API code downloads.

  function onYouTubeIframeAPIReady() {


    $('.gb-video__player').each(function(){

      var player;
      var playerWrapper = $(this).closest('.gb-video');
      var wrapper = playerWrapper.find('.gb-video__wrapper');
      var vid = $(this).data('videoid');
      var btn = playerWrapper.find('.gb-video__toggler');

      player = new YT.Player($(this)[0], {
        height: '691',
        width: '518',
        videoId: vid,
        events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange
        }
      });

      var el = null;

      function videoToggle(){
        playerWrapper.toggleClass('gb-video--discreet');

        if (playerWrapper.is('.gb-video--discreet')){
          player.mute()
          player.setLoop(true);
          playerWrapper.attr('style','');
        }else{
          playerWrapper.css('height',getHeight(wrapper));
          $.doTimeout(500,function(){
            player.unMute()
            player.seekTo(0)
            player.setLoop(false);
          })
        }
      }

      window.addEventListener("resize", function(){
        $.doTimeout('videoinview',250,function(){
          if (!playerWrapper.is('.gb-video--discreet')){
            playerWrapper.css('height',getHeight(wrapper));
          }
        });
      });

      function getHeight(o){
        var ht;
        ht = o.outerHeight();
        console.log(ht);
        return ht;
      }

      btn.on('click', function(){
        videoToggle();
      });

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        player.mute()
        player.setLoop(true);
        player.playVideo();
        el = event.target.a;
        playerWrapper.addClass('gb-video--loaded');
      }
      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {

        if (event.data == 1 && !done) {
          playerWrapper.removeClass('gb-video--paused gb-video--ended').addClass('gb-video--playing');
          getHeight(wrapper);
          //setTimeout(stopVideo, 6000);
          //done = true;
        }
        else if (event.data == 2) {
          playerWrapper.removeClass('gb-video--playing').addClass('gb-video--paused');
        }
        else if (event.data == 0) {
          playerWrapper.removeClass('gb-video--playing').addClass('gb-video--ended');
        }
        else if (event.data == 3) {
          playerWrapper.removeClass('gb-video--playing').addClass('gb-video--buffering');
        }

      }
      // function stopVideo() {
      //   player.stopVideo();
      // }

    });


  }
}
