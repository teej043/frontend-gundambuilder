/**
*
* TILES SCRIPTS
*
**/






$( document ).on( 'post-load', function () {
  listLazy.revalidate()
});


var listLazy = new Blazy({
  selector: '.post-listing .lazy',
  successClass: 'lazy--loaded',
  loadInvisible: true
});

//var o = $('.gb-main-content');
var o = $('.post-listing');

o.each(function(){
  var e = $(this);
  console.log(e);
});

var wallMasonry = o.packery({
  itemSelector: '.gb-tile',
  percentPosition: true,
  transitionDuration: '0.8s',
  //horizontalOrder: true,
  gutter: 0
});



var loadMoreBricks = function(newItems){

  // add the new set of tiles
  wallMasonry.packery({
    transitionDuration: '0.8s'
    //initLayout: false
  }).append(newItems).packery('addItems',newItems);


  $.doTimeout( 200, function(){
    wallMasonry.packery('layout');
    wallMasonry.packery({
      transitionDuration: '0.8s'
    });
  });

}
