  <script type="text/javascript">
    //Update cart item value
    jQuery('body').on('click','.remove', function(e){
     e.preventDefault();   
     var current_remove_btn = $(this);   
        jQuery.ajax({
          url:  woocs_ajaxurl,          
          type: 'GET',
          data: {
              action: 'ct_remove_item_from_cart',
              product_id : $(this).data('product_id'),
          },
          // cache: false,
          success: function(response ) {
            console.log('success');
            console.log(current_remove_btn.closest('.mini_cart_item'));
            current_remove_btn.closest('.mini_cart_item').remove();
          },
        }); 
    }); 
  </script>

<?php 
    
    //Remove product from the cart
    add_action( 'wp_ajax_ct_remove_item_from_cart', 'remove_item_from_the_cart' );
    add_action( 'wp_ajax_nopriv_ct_remove_item_from_cart', 'remove_item_from_the_cart' );

    function remove_item_from_the_cart(){
      global $woocommerce;
      $cart = $woocommerce->cart;

      foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item){
          if($cart_item['product_id'] == $_GET['product_id'] ){
              // Remove product in the cart using  cart_item_key.
              $cart->remove_cart_item($cart_item_key);
        }
      }
      exit;
    }

 ?>