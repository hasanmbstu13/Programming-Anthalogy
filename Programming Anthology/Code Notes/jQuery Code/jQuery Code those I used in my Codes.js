// Ajax method those are called when ajax request is start before stop
 $(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
    ajaxStop: function() { $body.removeClass("loading"); }    
 });

	// Show javascript error messege in add/delete/edit
    function error_msg(msg){
        noty({
                layout: "topRight",
                type: 'error',
                text: msg,
                dismissQueue: true, 
                animation: {
                    open: {height: 'toggle'},
                    close: {height: 'toggle'},
                    easing: 'swing',
                    speed: 500 
                    },
                timeout: 5000
            });
    }

    // Give success message after add/delete/edit
    function success_msg(msg){
        noty({
                layout: "topRight",
                type: 'success',
                text: msg,
                dismissQueue: true, 
                animation: {
                    open: {height: 'toggle'},
                    close: {height: 'toggle'},
                    easing: 'swing',
                    speed: 500 
                    },
                timeout: 5000
            });
    }

    // This method will refresh dynamiccontent frequently after 5 minutes 
    var dynamiccont_url = $('.dc-url h2').text();
    // console.log(dynamiccont_url);
    setTimeout( function(){ 
        console.log(dynamiccont_url);
        // if( !$('#myChechBoxID').is(':checked'){
            $.ajax({
                type: "GET",
                url: dynamiccont_url,
                success: function(data){
                    $('.modal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('#work-flow-container').html(data);
                },
                error: function () {
                    error_msg("Sorry page can't load refresh again!!");
                }
            });
        // }
        
    },300000,dynamiccont_url);


     // This method will load dynamiccontent after successful brief creation 
    function load_dynamiccontent(url){
        $.ajax({
            type: "GET",
            url: url,
            success: function(data){
                $('#work-flow-container').html(data);
            },
            error: function () {
                error_msg("Sorry page can't load refresh again!!");
            }
        });
    }

    // Date & Time picker for deadline in client_brief
    $(".jsSelect2").select2();
    $('#date_picker').datetimepicker({
        format: 'DD-MMMM-YYYY HH:mm'
        // format: 'DD-MMMM-YYYY hh:mm A'
    });

    $('#est_date_picker').datetimepicker({
        format: 'DD-MMMM-YYYY HH:mm'
    });

    // Change the value of a field by jQuery
    var today = moment().format('DD-MMMM-YYYY HH:mm');
    $('#est-deadline').val(today);
    $('#brief_deadline').val('no deadline');

    // Show only the projects of logged in user
    $(document).on('click', '.show-my-project', function(e) {
        e.preventDefault();
        $('.ignore-elements').hide();
        $(this).removeClass('show-my-project').addClass('show-all-projects').html('Show all projects').button("refresh");
    });
    // Show all of the projects
    $(document).on('click', '.show-all-projects', function(e) {
        e.preventDefault();
        $('.ignore-elements').show();
        $(this).removeClass('show-all-projects').addClass('show-my-project').html('Show only my projects').button("refresh");
    });

    // Check an id or element exists in the dom
    // Add an input when select other option
    $('#allocated-time').change(function(){
        if( $(this).val() == 'other'){
            if(!$('#other-option .form-group #other-time').length){
                $('#other-option .form-group').append('<input id="other-time" name="other_time" type="text" class="form-control" placeholder = "Time in hrs e.g. 10.25" />');
            }
        }else{
            $('#other-time').remove();
        }
    });