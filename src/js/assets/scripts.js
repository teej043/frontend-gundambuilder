/**
*
* SIDEBAR GUNDAM SERIES LIST STICKY
*
**/

function seriesListSticky(){

  var el = $('.gb-nav-cat');
  var wH = $(window).height();
  var vH = verge.viewportH();
  var elW = el.width();
  var elH = el.height();
  var elY = el.offset().top;
  var sY = verge.scrollY();

  var boundBot = 0;
  var boundTop = 0;
  var boundY = 0;
  var boundBotLast = 0;
  var boundTopLast = 0;

  var infoY = 300;

  var sYx = 0;
  var isScrollDown = -1;

  var infoElH = $('<div id="infoElH" style="position:fixed;top:'+(infoY+0)+'px;left:0px;z-index:99999"></div>').appendTo(el);
  var infoElY = $('<div id="infoElY" style="position:fixed;top:'+(infoY+20)+'px;left:0px;z-index:99999"></div>').appendTo(el);
  var infoVH = $('<div id="infoVH" style="position:fixed;top:'+(infoY+40)+'px;left:0px;z-index:99999"></div>').appendTo(el);
  var infoSY = $('<div id="infoSY" style="position:fixed;top:'+(infoY+60)+'px;left:0px;z-index:99999"></div>').appendTo(el);
  var infoSCD = $('<div id="infoIsScrollDown" style="position:fixed;top:'+(infoY+80)+'px;left:0px;z-index:99999"></div>').appendTo(el);
  var infoBTop = $('<div id="infoBtop" style="position:fixed;top:'+(infoY+100)+'px;left:0px;z-index:99999"></div>').appendTo(el);
  var infoBBot = $('<div id="infoBBot" style="position:fixed;top:'+(infoY+120)+'px;left:0px;z-index:99999"></div>').appendTo(el);
  var infoBY = $('<div id="infoBY" style="position:fixed;top:'+(infoY+140)+'px;left:0px;z-index:99999"></div>').appendTo(el);



  window.addEventListener("scroll", function(){
    $.doTimeout('test', 1, function(){
      wH = $(window).height();
      vH = verge.viewportH();
      elH = el.height();

      sY = verge.scrollY();



      var st = $(this).scrollTop();
      if (st > sYx){
        isScrollDown = true;
      } else {
        isScrollDown = false;
      }
      sYx = st;


      infoElH.text(elH);
      infoElY.text(elY);
      infoVH.text(vH);
      infoSY.text(sY);
      infoSCD.text(isScrollDown);

      infoBTop.text(boundTop+','+boundTopLast);
      infoBBot.text(boundBot+','+boundBotLast);

      if (isScrollDown){

        infoSCD.text('scrolling down');

        if ((vH + sY) > elH){




          infoSCD.text('scrolling down');
          if (boundTopLast <= (sY - elH)){

            infoSCD.text('scrolling down, pushing down');
            boundBot = (vH + sY);
            boundTop = boundBot - elH;
            boundBotLast = boundBot;

            el.css({
              'width' : elW+'px',
              'position':'fixed',
              'bottom':'0px',
              'top':'auto'
            });

            //boundTopLast = boundTop;
          }else{
            boundTopLast = boundTop;

            el.css({
              'width' : elW+'px',
              'position':'absolute',
              'bottom':'auto',
              'top':(boundBot + vH) - (elH)
            });
          }




        }

      } else {
        infoSCD.text('scrolling up');



        if (sY < (boundBotLast-elH)){
          infoSCD.text('scrolling up, pushing up');
          boundBot = (vH + sY);
          boundTop = boundBot - elH;
          boundTopLast = boundTop;

          el.css({
            'width' : elW+'px',
            'position':'fixed',
            'bottom':'auto',
            'top':'0px'
          });
          //boundBotLast = boundBot;
        }else{
          boundBotLast = boundBot;

          el.css({
            'width' : elW+'px',
            'position':'absolute',
            'bottom':'auto',
            'top':boundTop
          });
        }


      }




      console.log(elH);

      /*
      if ((sY + vH) >= (elH)){
        // if scrollY is greater than listHeight

        if (isScrollDown){
        // when scrolling down

          boundTop = sY
          boundBot = sY + vH;




          if (elY <= sY){
            elY = el.offset().top; // record the element Y coord

            // fix to bottom
            el.css({
              'width' : elW+'px',
              'position':'fixed',
              'bottom':'0px',
              'top':'auto'
            });
          }


        }else{
          if (elY <= sY){
            el.css({
              'width' : elW+'px',
              'position':'absolute',
              'bottom':'auto',
              'top':elY
            });
          }else{
            boundTop = sY;
            boundBot = sY + elH;

            el.css({
              'width' : elW+'px',
              'position':'fixed',
              'bottom':'auto',
              'top':'0px'
            });
          }
        }
      } else {

        el.attr('style','');
      }
      */

    });
  });


}

seriesListSticky();





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
