/**
*
* SIDEBAR GUNDAM SERIES LIST STICKY
*
**/

$('.gb-aside-nav').stickySidebar({topSpacing: 0});







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
  transitionDuration: 0,
  //horizontalOrder: true,
  gutter: 0
});



var loadMoreBricks = function(newItems){

  // add the new set of tiles
  wallMasonry.packery({
    transitionDuration: 0
    //initLayout: false
  }).append(newItems).packery('addItems',newItems);


  $.doTimeout( 200, function(){
    wallMasonry.packery('layout');
    wallMasonry.packery({
      transitionDuration: 0
    });
  });

}


checkIfInView('.post-listing','.gb-tile');

window.addEventListener("scroll", function(){
  $.doTimeout('scroll', 250, function(){
    checkIfInView('.post-listing','.gb-tile');
  });
});

function checkIfInView(par,el){
  // ROLLCARDS RIBBON
  if($(par).length){
    $(par).find(el).each(function(){
        if (verge.inViewport($(this))){
          $(this).addClass('appeared');
        }
    })
  }

}
