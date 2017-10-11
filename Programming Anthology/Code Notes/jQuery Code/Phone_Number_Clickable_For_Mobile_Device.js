    var width = $(window).width(), height = $(window).height();
    if ((width <= 1023)) {
         $('.phone-number').html('<a href="tel:020 7871 0598">020 7871 0598</a>');
    } 

    $(window).resize(function(){
        if ($(window).width() <= 1023){  
         $('.phone-number').html('<a href="tel:020 7871 0598">020 7871 0598</a>');            
        } else {
             $('.phone-number').html('020 7871 0598');
        }  
    });