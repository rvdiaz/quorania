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

var acc = document.getElementsByClassName("accordion-user-administration");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

