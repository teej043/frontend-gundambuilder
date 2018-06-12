

$(document).ready(function() {
	$('.gb-aside-nav, .gb-sidebar')
		.theiaStickySidebar({
			additionalMarginTop: 30
		});
});



$(window).load(function(){



	//lazy loading script
	var bLazy = new Blazy({
		  breakpoints: [{
		  width: 420 // Max-width
		  , src: 'data-src-small'
			}]
		  , success: function(element){
		  setTimeout(function(){
			// We want to remove the loader gif now.
			// First we find the parent container
			// then we remove the "loading" class which holds the loader image
			var parent = element.parentNode;
			parent.className = parent.className.replace(/\bloading\b/,'');
		  }, 200);
		}
	});



	//for the scroll list on mobile suit lists of gunpla kits

	$('.gb-mobile-suit-art .kits-bar--vertical').each(function(){
		var h = $(this).innerHeight(), hh = $(this).find('.kits').innerHeight();

		if (!(hh < h)){
			$(this).parent().find('.indicator-down').show();
		}else{
				$(this).parent().find('.indicator-down').hide();
		}
	});

});



	$(document).ready(function () {

		//for the scroll list on mobile suit lists of gunpla kits
		$('.gb-mobile-suit-art .kits-bar--vertical').each(function(){
			var h = $(this).innerHeight(), hh = $(this).find('.kits').innerHeight();

			if (!(hh < h)){
				$(this).parent().find('.indicator-down').show();

				$(this).on('scroll',function(){
					var topY = $(this).offset().top, scrollY = $(this).scrollTop();
					if (scrollY <= ((hh - h) - 60)){
						$(this).parent().find('.indicator-down').show(300);
					}else{
						$(this).parent().find('.indicator-down').hide(300);
					}
					console.log(h + ',' + hh + ',' + ',' + (hh - h) + ',' + scrollY);
				});
			}else{
					$(this).parent().find('.indicator-down').hide();
			}
		});

		if (($('#ms-select').length) > 0){
			$('#ms-select').select2({ placeholder : '' }).on("change", function(e) {
				// mostly used event, fired to the original element when the value changes


				  if (e.val == ''){
					  $('input#model-name').val('').prop('disabled', false);
					  $('input#model-code').val('').prop('disabled', false);
					  $('input#model-alias').val('').prop('disabled', false);
					  $('input#model-wikilink').val('').prop('disabled', false);
				  }else{
						oBj = $('#ms-select option[value="'+e.val+'"]');
					  valCodeName = oBj.attr('data-codename');
					  valAlias = oBj.attr('data-alias');
					  valWikiLink = oBj.attr('data-wikilink');
					  $('input#model-name').val(valCodeName).prop('disabled', true);
					  $('input#model-code').val(valCodeName).prop('disabled', true);
					  $('input#model-alias').val(valAlias).prop('disabled', true);
					  $('input#model-wikilink').val(valWikiLink).prop('disabled', true);
					  alert("change val=" + e.val);
				  }
			});

			$('#ms-series-select').select2({ placeholder : '', maximumSelectionSize: 3 }).on("change", function(e) {
				// mostly used event, fired to the original element when the value changes

				  /*
				  if (e.val == ''){
					  $('input#model-name').val('').prop('disabled', false);
					  $('input#model-code').val('').prop('disabled', false);
					  $('input#model-alias').val('').prop('disabled', false);
					  $('input#model-wikilink').val('').prop('disabled', false);
				  }else{
						oBj = $('#single option[value="'+e.val+'"]');
					  valCodeName = oBj.attr('data-codename');
					  valAlias = oBj.attr('data-alias');
					  valWikiLink = oBj.attr('data-wikilink');
					  $('input#model-name').val(valCodeName).prop('disabled', true);
					  $('input#model-code').val(valCodeName).prop('disabled', true);
					  $('input#model-alias').val(valAlias).prop('disabled', true);
					  $('input#model-wikilink').val(valWikiLink).prop('disabled', true);
					  alert("change val=" + e.val);
				  }*/
			});

			$('#gb-kit-type-select').select2({ placeholder : '' }).on("change", function(e) {
				// mostly used event, fired to the original element when the value changes

				  /*
				  if (e.val == ''){
					  $('input#model-name').val('').prop('disabled', false);
					  $('input#model-code').val('').prop('disabled', false);
					  $('input#model-alias').val('').prop('disabled', false);
					  $('input#model-wikilink').val('').prop('disabled', false);
				  }else{
						oBj = $('#single option[value="'+e.val+'"]');
					  valCodeName = oBj.attr('data-codename');
					  valAlias = oBj.attr('data-alias');
					  valWikiLink = oBj.attr('data-wikilink');
					  $('input#model-name').val(valCodeName).prop('disabled', true);
					  $('input#model-code').val(valCodeName).prop('disabled', true);
					  $('input#model-alias').val(valAlias).prop('disabled', true);
					  $('input#model-wikilink').val(valWikiLink).prop('disabled', true);
					  alert("change val=" + e.val);
				  }*/
			});
		}

		$("#respond textarea,#respond input").addClass("form-control");


		//
		// $("[data-toggle='tooltip']").tooltip();
		// $("[data-toggle='popover']").popover({
		// 		trigger:'hover'
		// 	}
		// );

		$('.gb-buttons-mobile').click(function(){
			//$('.gb-head .gb-menu').slideToggle('fast');
			$(this).toggleClass('active');
			$('.gb-hdr').toggleClass('menu-on');
			$('html').toggleClass('no-scroll');
		});

		$('.gb-hdr__burger').on('click', function(){

		});

		// var ww;
		// ww = $(window).width();
		//
		// if (ww > 768){
		// 	$('.gb-head .menu ul').show();
		// }
		//
		// $(window).resize(function(){
		// 	ww = $(document).width();
		//
		// 	if (ww < 768-15){
		// 		$('.gb-head .menu ul').hide();
		// 	}
		// 	else if (ww >= 768-15){
		// 		$('.gb-head .menu ul').show();
		// 	}
		//
		// });





		//adjust font size to fit all text inside the heading

		/*
		$('.gb-post-heading .gb-post-title h2').each(function(){
			var myTxt=$(this).find('a').text().length;
			if (myTxt >= 36){
				$(this).css('font-size','26px');
			}
		});
		*/

		//togglers

		$('#toggle-show-series').click(function(){
			$('.gb-nav-cat').toggleClass('show-half');
		});


		$('.go-top').click(function(event) {
			event.preventDefault();

			$('html, body').animate({scrollTop: 0}, 300);
		})


		/*
		function loading(img)
		{
		  img.fadeOut(0, function() {
			img.fadeIn(1000);
		  });
		}
		$('.lazyload').lazyload({load: loading});
		*/




		// Gallery + Popup
		if ($('.gallery-wrapper').length){
			var par = $('.gallery-wrapper');
			var list = par.find('>ul');
			console.log(list.find("li:first-child").data('mfp-src'));
			list.magnificPopup({
				delegate: 'li',
				type: 'image',
			  gallery:{
			    enabled:true
			  },
				image:{
					titleSrc: 'data-caption'
				},
				callbacks: {
				  beforeOpen: function() {
				    //console.log('Start of popup initialization');
				  },
				  elementParse: function(item) {
				    //console.log('Parsing content. Item object that is being parsed:', item);
				  }
				}
			});
		}



	});
