jQuery( document ).ready(function() {

  jQuery('.pisos--filters--container--items--item--content span').click(function(e){
  		
  		e.preventDefault();
  		var building = jQuery(this).attr('data-building');
  		jQuery.ajax({
					type : "post",
				 	url : ajax.url,
					data : { action: 'quorania_filter', building : building },
					success: function(response){								  
								  console.log("resp"+response);
								  //jQuery('#prueba_ajax').html(response.building);
					}								        
		});

  });
	
});
