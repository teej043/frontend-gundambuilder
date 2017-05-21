// TILES

(function ($) {

  if ($('.gb-tile').length){
    
    var o = $('.gb-main-content');

    o.imagesLoaded( function() {
      initWall();
      $.doTimeout( 500, function(){
        o.addClass('in');
      });
    });


    //require('masonry');
    require('packery');
    //require('dotimeout');

    function initWall(){

      o.each(function(){
        var e = $(this);
        console.log(e);

      });

      //$.wallMasonry = $('.wall').masonry({
      $.wallMasonry = o.packery({
        itemSelector: '.gb-tile',
        percentPosition: true,
        transitionDuration: 0,
        //horizontalOrder: true,
        gutter: 0
      });

      /*
      $('.wall__brick--expandable').on('click', function(){
        var trgt = $(this).data('target');
        $(trgt).toggleClass('hide').siblings('.wall__brick--expansion').addClass('hide');
        //$.wallMasonry.masonry('layout');
        $.wallMasonry.packery('layout');
      });

      $('.brick--image').each(function(){
        var e = $(this);
        var imgSrc = e.find('img').prop('src');
        e.css({
          'background-image' : 'url('+imgSrc+')'
        });
      });
      */

    }

  }


})(jQuery);
