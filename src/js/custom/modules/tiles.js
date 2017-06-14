// TILES
require('packery');
require('dotimeout');

(function ($) {

  $( document ).on( 'post-load', function () {
    $.initWall();
  });

  $.initWall = function(){

    require('blazy');

    var bLazy = new Blazy({
      selector: '.gb-content-posts .lazy',
      successClass: 'lazy--loaded',
      loadInvisible: true
    });

    var o = $('.gb-main-content');

    o.each(function(){
      var e = $(this);
      console.log(e);
    });

    $.wallMasonry = o.packery({
      itemSelector: '.gb-tile',
      percentPosition: true,
      transitionDuration: 0.5,
      //horizontalOrder: true,
      gutter: 0
    });

  }

  $.loadMoreBricks = function(newItems){

    // add the new set of tiles
    $.wallMasonry.packery({
      transitionDuration: 0
      //initLayout: false
    }).append(newItems).packery('addItems',newItems);


    $.doTimeout( 200, function(){
      $.wallMasonry.packery('layout');
      $.wallMasonry.packery({
        transitionDuration: 0
      });
    });
  }



  if ($('.gb-tile').length){
    $.initWall();
  }


})(jQuery);
