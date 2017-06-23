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
      var thumb = playerWrapper.find('.gb-video__thumb');
      var btn = playerWrapper.find('.gb-video__toggler');

      player = new YT.Player($(this)[0], {
        videoId: vid,
        playerVars: {
          'controls': 0,
          'showinfo': 0,
          'rel': 0,
          'loop': 1
        },
        events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange
        }
      });

      var el = null;

      function isWideScreenAspectRatio(){
        var height = thumb[0].naturalHeight;
        var width = thumb[0].naturalWidth;
        // height = height.replace('px', '');
        // width = width.replace('px', '');
        var arB = height / 3;
        var arT = width / arB;

        if (width == 0 && height==0){
          return 0;
        }

        if (arT == 4)   {
          //alert ("4:3");
          return 0;
        }
        else {
          ///alert ("16:9");
          return 1;
        }
      }


      function videoCenterView(topbarHeight = 0){
        var trgt = playerWrapper;
        var trgtH = trgt.height();
        var tbarH = topbarHeight;
        var viewH = verge.viewportH();
        var offset = (viewH / 2) - ((trgtH / 2));
        //alert(viewH+','+trgtH+','+((trgt.offset().top) - offset));
        $('body,html').animate({
          scrollTop: ((trgt.offset().top) - offset)
        }, {
          duration: 500,
          easing: "swing"
        });
      }

      function videoToggle(){
        playerWrapper.toggleClass('gb-video--discreet');

        if (playerWrapper.is('.gb-video--discreet')){
          player.mute()
          player.setLoop(true);
          playerWrapper.attr('style','');
          player.playVideo();

        }else{
          playerWrapper.css('height',getHeight(wrapper));
          $.doTimeout(500,function(){
            player.unMute()
            player.seekTo(0)
            player.setLoop(false);
            $.doTimeout(500,function(){
              videoCenterView(0);
            })
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

      function onPlayerReady(event) {
        player.mute()
        player.playVideo();
        player.setLoop(true);
        el = event.target.a;
        playerWrapper.addClass('gb-video--loaded');
        console.log(player);
        console.log(player.getPlaybackQuality());
        if (isWideScreenAspectRatio()){
          playerWrapper.addClass('gb-video--widescreen');
        }

      }

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
          if (!playerWrapper.is('.gb-video--discreet')){
            videoToggle();
          } else {
            player.playVideo();
          }
        }
        else if (event.data == 3) {
          playerWrapper.removeClass('gb-video--playing').addClass('gb-video--buffering');
        }

      }

    });


  }
}
