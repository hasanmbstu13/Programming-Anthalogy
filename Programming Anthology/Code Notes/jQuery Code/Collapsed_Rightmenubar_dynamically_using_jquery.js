// define in header file
    var ABS_PATH = "<?php echo get_template_directory_uri(); ?>";

var right_arrow = '<img src="'+ABS_PATH+'/assets/images/menu-right.png">';
var down_arrow = '<img src="'+ABS_PATH+'/assets/images/menu-down.png">';

  $('.list-unstyled .collapse-item').on('click', function(e){
    e.preventDefault();
    var $curr_elem = $(this);
    var $id = $curr_elem.attr('id');
    if($curr_elem.hasClass("right-arrow")){
        $curr_elem.html(down_arrow);
        var $show_elem = '.' + $id;
        $($show_elem).slideDown('medium');
        $curr_elem.removeClass('right-arrow');
        $curr_elem.addClass('down-arrow');
    } else if($curr_elem.hasClass("down-arrow")){
        $curr_elem.html(right_arrow);
        var $show_elem = '.' + $id;
        $($show_elem).slideUp('medium');
        $curr_elem.removeClass('down-arrow');
        $curr_elem.addClass('right-arrow');
    }
    
  });

  var current_location = window.location.href.split('/');
  var $selected_item = '.' + current_location[5];
  if(current_location.length == 7){
    $($selected_item).closest('.curr-cat').addClass('active');
    $($selected_item).closest('.curr-cat').find('.collapse-item').removeClass('right-arrow');
    $($selected_item).closest('.curr-cat').find('.collapse-item').addClass('down-arrow');
    $($selected_item).closest('.curr-cat').find('.collapse-item').html(down_arrow);
  } else if(current_location.length == 6){
    var $selected_item = '.' + current_location[4];
    $($selected_item).closest('.curr-cat').addClass('active');
    $($selected_item).closest('.curr-cat').find('.collapse-item').removeClass('right-arrow');
    $($selected_item).closest('.curr-cat').find('.collapse-item').addClass('down-arrow');
    $($selected_item).closest('.curr-cat').find('.collapse-item').html(down_arrow);
  }