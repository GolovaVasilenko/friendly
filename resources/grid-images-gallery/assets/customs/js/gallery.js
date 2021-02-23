"use strict";

(function ($){
	
  $.fn.masonry_gallery = function(){	

		
		var $grid_gallery = $('.grid-gallery');

		$grid_gallery.imagesLoaded( function(){
		  $grid_gallery.isotope({
			// options...
			itemSelector: '.gallery-grid-item',
			layoutMode: 'masonry'
		  });
		});

		// filter functions
		var filterFns = {

		};

		// bind filter button click
		$('#gallery-filters').on( 'click', 'button', function() {
		  var filterValue = $( this ).attr('data-filter');
		  // use filterFn if matches value
		  filterValue = filterFns[ filterValue ] || filterValue;
		  $grid_gallery.isotope({ filter: filterValue });
		});

		// change is-checked class on buttons
		$('.gallery-button-group').each( function( i, buttonGroup ) {
		  var $buttonGroup = $( buttonGroup );
		  $buttonGroup.on( 'click', 'button', function() {
			$buttonGroup.find('.is-checked').removeClass('is-checked');
			$( this ).addClass('is-checked');
		  });
		});
		
  
		// init Masonry after all images have loaded
		var $grid_gallery = $('.grid-gallery').imagesLoaded( function() {
		  $grid_gallery.masonry({
			itemSelector: '.gallery-grid-item',
			percentPosition: true,
			columnWidth: '.gallery-grid-sizer'
		  }); 
		});
		
		//fanybox image zoom library in products and gallery
		$(".grid-image-zoom").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	200, 
			'overlayShow'	:	false
		});
		
  }
  
  $(this).masonry_gallery();
  	

}(jQuery));