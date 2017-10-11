// Load an existing id with dynamic content by ajax request
// Load most read article
if(jQuery('#most_read_vertical_slider').length )  {
	jQuery.ajax({
	        url: "/most-read-vertical-slider/" + '?time=' + new Date().getTime(),
	        type: "GET",
	        dataType: "html",
	        success: function (data) {
	        	// console.log(data);
	            jQuery('#most_read_vertical_slider').html(jQuery(data).find('.wpb_wrapper').html());
	        },
	        error: function (xhr, status) {
	            alert("Sorry, there was a problem!");
	        },
	        complete: function (xhr, status) {
	            //jQuery('#most_read_vertical_slider').slideDown('slow')
	        }
	    });
}