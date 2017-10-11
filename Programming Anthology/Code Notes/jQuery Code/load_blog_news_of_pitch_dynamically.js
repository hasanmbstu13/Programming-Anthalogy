var page = 1; // What page we are on.
    var ppp = 5; // Post per page

    jQuery('body').on('click', '.all-posts .aligncenter .btn-box', function (e) {
        e.preventDefault();
        var cat = $(this).data('cat');
        jQuery.ajax({
            // url: "/wp-admin/admin-ajax.php",
            url: pitch_ajax_obj.ajaxurl,
            // type: 'GET',
            type: 'POST',
            data: {
                action: 'load_more_content',
                offset: (page * ppp) + 1,
                ppp: ppp,
                category: cat
            },
            cache: false,
            success: function (data) {
                page++;
                if (data.status == 'success') {
                    if (data.content == '') {
                        $("<p class=\"ending-msg\">Congratualions you've reached in the last of the page</p>").insertBefore('.all-posts .aligncenter');
                    } else {
                        $(data.content).insertBefore('.all-posts .aligncenter');
                    }
                } else {
                }
            },
        });
    });


function load_more_content() {
    $output = '';
    $category = (isset($_POST['category'])) ? $_POST['category'] : '';
    $pp = get_option("posts_per_page");
    $offset = $_POST["offset"];
    $args = array(
    'category_name' => $category,
    'post_type' => 'post',
    'posts_per_page' => $pp,
    'offset' => $offset,
    );
    query_posts($args);
    $new_offset = 0;
    while (have_posts()) : the_post();
    $new_offset++;
    $output .= '<a href="' . get_permalink() . '"class="posts">';
    $output .= '<div class="container">';
    $output .= '<div class="row">';
    $output .= '<div class="col-sm-12 col-xs-12">';
    $category = get_the_category();
    $output .= '<h4 class="border-style">' . $category[0]->cat_name;
    $output .= "<span>/ " . get_the_date() . "</span></h4>";
    $output .= '<h3>' . get_the_title() . '</h3>';
    $output .= '<p>' . get_the_excerpt() . '</p>';
    // $output .= '<div>'.the_advanced_excerpt().'</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</a>';
    endwhile;
    wp_reset_postdata();
    $offset = $old_offset + $new_offset;
    $response = json_encode(array(
    'status' => 'success',
    'content' => $output,
    'offset' => $offset,
    ));
    header("Content-Type: application/json");
    echo $response;
    exit;
}