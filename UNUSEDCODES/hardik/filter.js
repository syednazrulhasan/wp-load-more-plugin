jQuery( document ).ready(function() {

	const ajaxurl = themeData.ajaxurl; 
	

	console.log('readyho');


	/*On Document Ready*/
		var pageno      = jQuery('#pageno').val();
		var category    = jQuery('.cat-list .active').data('termslug');
		var year        = jQuery('#selectyear').find(":selected").val();
		var region      = jQuery('#selectregion').find(":selected").val();

		console.log(pageno);
		console.log(category);
		console.log(year);
		console.log(region);

    	let
        	data = {
                  action         : 'filter_media',
                  category       : category,
                  pageno         : pageno  , 
                  year           : year    , 
                  region         : region
               }

       jQuery.ajax({
          url    : ajaxurl,
          type   : 'POST',
          data   : data,      
          beforeSend: function() {
			jQuery('#mediaposts').html('<img class="loader" width="100" src="'+themeData.templateurl+'/assets/images/74H8.gif" alt="Loading...">');
		  },         
          success: function(response) {

          	jQuery('#mediaposts').empty().append(response);
          	jQuery('#pageno').val( parseInt(jQuery('#pageno').val()) +1 );

          },

      });



	jQuery('.filteritem').click(function(){

		jQuery('#pageno').val(1);
		jQuery('.filteritem').removeClass('active');
		jQuery('.filteritem').removeClass('gradient-1');
		jQuery('.filteritem').removeClass('white');

		jQuery(this).addClass('active');
		jQuery(this).addClass('gradient-1');
		jQuery(this).addClass('white');

		
		var pageno      = jQuery('#pageno').val();
		var category    = jQuery(this).data('termslug');
		var year        = jQuery('#selectyear').find(":selected").val();
		var region      = jQuery('#selectregion').find(":selected").val();

		console.log(pageno);
		console.log(category);
		console.log(year);
		console.log(region);

    	let
        	data = {
                  action         : 'filter_media',
                  category       : category,
                  pageno         : pageno  , 
                  year           : year    , 
                  region         : region
               }

               jQuery.ajax({
                  url    : ajaxurl,
                  type   : 'POST',
                  data   : data,      
                  beforeSend: function() {
			jQuery('#mediaposts').html('<img class="loader" width="100" src="'+themeData.templateurl+'/assets/images/74H8.gif" alt="Loading...">');
                            
                  },         
                  success: function(response) {

                  	jQuery('#mediaposts').empty().append(response);
                  	jQuery('#pageno').val( parseInt(jQuery('#pageno').val()) +1 );

                  },

              });

	});



	/*On Region Change*/
	jQuery('#selectregion').change(function(){

		jQuery('#pageno').val(1);
		var pageno      = jQuery('#pageno').val();
		var category    = jQuery('.cat-list .active').data('termslug');
		var year        = jQuery('#selectyear').find(":selected").val();
		var region      = jQuery('#selectregion').find(":selected").val();

		console.log(pageno);
		console.log(category);
		console.log(year);
		console.log(region);

    	let
        	data = {
                  action         : 'filter_media',
                  category       : category,
                  pageno         : pageno  , 
                  year           : year    , 
                  region         : region
               }

               jQuery.ajax({
                  url    : ajaxurl,
                  type   : 'POST',
                  data   : data,      
                  beforeSend: function() {
			jQuery('#mediaposts').html('<img class="loader" width="100" src="'+themeData.templateurl+'/assets/images/74H8.gif" alt="Loading...">');
                            
                  },         
                  success: function(response) {

                  	jQuery('#mediaposts').empty().append(response);
                  	jQuery('#pageno').val( parseInt(jQuery('#pageno').val()) +1 );

                  },

              });

	});



	/*On Year Change*/
	jQuery('#selectyear').change(function(){

		jQuery('#pageno').val(1);
		var pageno      = jQuery('#pageno').val();
		var category    = jQuery('.cat-list .active').data('termslug');
		var year        = jQuery('#selectyear').find(":selected").val();
		var region      = jQuery('#selectregion').find(":selected").val();

		console.log(pageno);
		console.log(category);
		console.log(year);
		console.log(region);

    	let
        	data = {
                  action         : 'filter_media',
                  category       : category,
                  pageno         : pageno  , 
                  year           : year    , 
                  region         : region
               }

               jQuery.ajax({
                  url    : ajaxurl,
                  type   : 'POST',
                  data   : data,      
                  beforeSend: function() {
			jQuery('#mediaposts').html('<img class="loader" width="100" src="'+themeData.templateurl+'/assets/images/74H8.gif" alt="Loading...">');
                            
                  },         
                  success: function(response) {

                  	jQuery('#mediaposts').empty().append(response);
                  	jQuery('#pageno').val( parseInt(jQuery('#pageno').val()) +1 );

                  },

              });

	});


	/*On Load More Click*/
	jQuery('#loadmore').click(function(){

		
		var pageno      = jQuery('#pageno').val();
		var category    = jQuery('.cat-list .active').data('termslug');
		var year        = jQuery('#selectyear').find(":selected").val();
		var region      = jQuery('#selectregion').find(":selected").val();

		console.log(pageno);
		console.log(category);
		console.log(year);
		console.log(region);

    	let
        	data = {
                  action         : 'filter_media',
                  category       : category,
                  pageno         : pageno  , 
                  year           : year    , 
                  region         : region
               }

               jQuery.ajax({
                  url    : ajaxurl,
                  type   : 'POST',
                  data   : data,      
                  beforeSend: function() {
						           
                  },         
                  success: function(response) {

                  	jQuery('#mediaposts').append(response);
                  	jQuery('#pageno').val( parseInt(jQuery('#pageno').val()) +1 );

                  },

              });

	});



});