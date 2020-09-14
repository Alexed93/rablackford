<?php

/**
 * Woocommerce functions, filters and hooks
 */


 /* WooCommerce Add To Cart Text */

 add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_add_to_cart_text');

 function woocommerce_custom_add_to_cart_text() {
 return __('Add to basket', 'woocommerce');
 }


 /**
  * Woocommerce empty cart message
  */

 remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
 add_action( 'woocommerce_cart_is_empty', 'custom_empty_cart_message', 10 );

 function custom_empty_cart_message() {
     echo '<p class="cart-empty woocommerce-info">' . wp_kses_post( apply_filters( 'wc_empty_cart_message', __( 'Your basket is currently empty.', 'woocommerce' ) ) ) . '</p>';
 }


// adjust secondary menu to add WC items
add_filter('wp_nav_menu_items', 'add_woocommerce_links', 10, 2);
function add_woocommerce_links($items, $args){
    if( $args->theme_location == 'secondary' ){
        $account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );
        $cart_link = wc_get_cart_url();
        $count = WC()->cart->get_cart_contents_count();
        $items .= '<li class="nav__item"><a href="'. $account_link .'" class="nav__link">My Account</a></li><li class="nav__item"><a href="'. $cart_link .'" class="nav__link nav__link--basket">Basket<span>' . $count . '</span></a></li>';
    }
    return $items;
}



// remove proceed to checkout button if no shipping method chosen
function rab_checkout_button_no_shipping() {

    $chosen_shipping_methods = WC()->session->get( 'chosen_shipping_methods' );

    // remove button if there is no chosen shipping method
    if( empty( $chosen_shipping_methods[0] ) ) {
        remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
    }
}
add_action( 'woocommerce_proceed_to_checkout', 'rab_checkout_button_no_shipping', 1 );



// woocommerce shop page > category > product hierarchy. Needs testing
add_filter("rewrite_rules_array", function ($rules) {
    global $wp_rewrite;

    $option = get_option("woocommerce_permalinks");
    if (!$option) {
      return $rules;
    }

    $category_base = $option["category_base"];
    $pagination_base = $wp_rewrite->pagination_base;

    $terms = array_map(function($term) {
      return (object)array("term_id"   => $term->term_id,
                           "parent_id" => $term->parent,
                           "parent"    => NULL,
                           "slug"      => $term->slug,
                           "path"      => NULL);
    }, get_terms("product_cat", array("hide_empty" => 0)));

    foreach ($terms as $term) {
        $arrayFilt = array_filter($terms, function($parent) use ($term) {
            return ($term->parent_id == $parent->term_id);
          });
        $term->parent = array_pop($arrayFilt);
    }

    foreach ($terms as $term) {
      $slugs = array();
      $current_term = $term;
      while ($current_term) {
        array_unshift($slugs, $current_term->slug);
        $current_term = $current_term->parent;
      }
      $term->path = implode("/", $slugs);
    }

    usort($terms, function($term1, $term2) {
      return (substr_count($term1->path, "/") > substr_count($term2->path, "/")) ? -1 : 1;
    });

    $new_rules = array();

    foreach ($terms as $term) {
      $new_rules["$category_base/$term->path/$pagination_base/([0-9]{1,})/?$"] = "index.php?product_cat=$term->slug&paged=\$matches[1]";
      $new_rules["$category_base/$term->path/?$"] = "index.php?product_cat=$term->slug";
    }

    $new_rules["$category_base/$pagination_base/([0-9]{1,})/?$"] = "index.php?post_type=product&paged=\$matches[1]";

    return array_merge($new_rules, $rules);
  });

  add_action("create_product_cat", "flush_rewrite_rules");
  add_action("edited_product_cat", "flush_rewrite_rules");
  add_action("delete_product_cat", "flush_rewrite_rules");


  /**
 * Remove woocommerce stylesheets
 */

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


function rab_get_products_from_category_by_ID( $category ) {

  $products = new WP_Query( array(
      'post_type'   => 'product',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'fields'      => 'ids',
      'tax_query'   => array(
          'relation' => 'AND',
          array(
              'taxonomy' => 'product_cat',
              'field'    => 'term_id',
              'terms'    => $category,
          ),
          array(
              'taxonomy' => 'product_visibility',
              'field' => 'slug',
              'terms' => 'exclude-from-catalog',
              'operator' => 'NOT IN'
          )
      ),

  ) );
  return $products->posts;
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );


// product specific adjustments
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


// add weight after price on single product
function rab_get_weight_for_product_price() {
  global $product;

  $weight = $product->get_weight();

  $weight_html = '<div>per bag</div>';

  if ($weight) {
      $weight_html = '<div>per ' . wc_format_weight($weight) . ' bag</div>';
  }

  echo $weight_html;
}
add_action('woocommerce_single_product_summary', 'rab_get_weight_for_product_price', 15);


// cart custom delivery option
add_action( 'woocommerce_review_order_after_shipping', 'rab_order_delivery_options', 20 );
add_action('woocommerce_cart_totals_before_order_total', 'rab_order_delivery_options', 20);
function rab_order_delivery_options(){
    $domain = 'wocommerce';

    //if (  WC()->session->get( 'chosen_shipping_methods' )[0] == targeted_shipping_method() ) :

        echo '<tr class="delivery"><th>' . __('Fuel delivery method', $domain) . '</th><td>';
        echo '<ul id="delivery__methods" class="">';

        $chosen = WC()->session->get('chosen_delivery');
        $chosen = empty($chosen) ? WC()->checkout->get_value('delivery') : $chosen;
        $chosen = empty($chosen) ? 'radio_delivery_open' : $chosen;

        //echo $chosen;

        ?>
        <li>
          <input type="radio" class="input-radio " value="radio_delivery_open" name="radio_delivery"  id="radio_delivery_open" <?php checked( $chosen, 'radio_delivery_open', true ); ?>/>
          <label for="radio_delivery_open" class="radio ">Open Sacks</label>
        </li>
        <li>
          <input type="radio" class="input-radio " value="radio_delivery_closed" name="radio_delivery"  id="radio_delivery_bagged" <?php checked( $chosen, 'radio_delivery_closed', true ); ?>/>
          <label for="radio_delivery_bagged" class="radio ">Sealed Plastic Bags</label>
        </li>


        <?php

        echo '</ul>';

        $method_text = get_field('delivery_method_supporting_text', 'options');

        if ($method_text) :
            echo wpautop($method_text);
        endif;

        echo '</td></tr>';

    //endif;
}


// jQuery - Ajax script
add_action( 'wp_footer', 'checkout_delivery_script' );
function checkout_delivery_script() {
    // Only checkout page
    if ( ! is_checkout() ) return;
    ?>
    <script type="text/javascript">
    jQuery( function($){
        if (typeof wc_checkout_params === 'undefined')
            return false;

        $('form.checkout').on('change', 'input[name=radio_delivery]', function(e){
            e.preventDefault();
            var d = $(this).val();

            $.ajax({
                type: 'POST',
                url: wc_checkout_params.ajax_url,
                data: {
                    'action': 'delivery',
                    'delivery': d
                },
                success: function (result) {
                    $('body').trigger('update_checkout');
                    //console.log(result); // just for testing | TO BE REMOVED
                },
                error: function(error){
                    //console.log(error); // just for testing | TO BE REMOVED
                }
            });
        });
    });
    </script>
    <?php

}


add_action( 'wp_footer', 'cart_delivery_script' );
function cart_delivery_script() {

    // Only checkout page
    if ( ! is_cart() ) return;

    ?>
    <script type="text/javascript">
    //console.log('cart');
    jQuery( function($){
        //if (typeof wc_cart_params === 'undefined')
           // return false;

        $('.woocommerce-cart').on('change', 'input[name=radio_delivery]', function(e){
            e.preventDefault();
            var d = $(this).val();

          //console.log('cart trigger');

            $.ajax({
                type: 'POST',
                url: wc_cart_params.ajax_url,
                data: {
                    'action': 'delivery',
                    'delivery': d
                },
                success: function (result) {
                  $("[name='update_cart']").trigger("click");
                    //console.log(result); // just for testing | TO BE REMOVED
                },
                error: function(error){
                    //console.log(error); // just for testing | TO BE REMOVED
                }
            });
        });
    });
    </script>
    <?php

}


// Get Ajax request and saving to WC session
add_action( 'wp_ajax_delivery', 'wc_get_delivery_ajax_data' );
add_action( 'wp_ajax_nopriv_delivery', 'wc_get_delivery_ajax_data' );
function wc_get_delivery_ajax_data() {
    if ( isset($_POST['delivery']) ){
        WC()->session->set('chosen_delivery', sanitize_key( $_POST['delivery'] ) );
        echo json_encode( $delivery ); // Return the value to jQuery
    }
    die();
}


// add custom delivery method to order
add_action( 'woocommerce_checkout_create_order', 'rab_custom_meta_to_order', 20, 1 );
function rab_custom_meta_to_order( $order ) {

    if (isset($_POST['radio_delivery'])) {
        $delivery_method = $_POST['radio_delivery'];
        if (!empty($delivery_method)) $order->update_meta_data('delivery_method', $delivery_method);
    }

}

// show custom delivery method in admin
add_action( 'woocommerce_admin_order_data_after_billing_address', 'rab_custom_delivery_method_in_admin', 10, 1 );
function rab_custom_delivery_method_in_admin($order){
    // Get the custom field value
    $delivery_method = get_post_meta( $order->get_id(), 'delivery_method', true );

    $delivery_text = '';

    if ($delivery_method == 'radio_delivery_closed') {
        $delivery_text = 'Sealed Bags';
    }

    if ($delivery_method == 'radio_delivery_open') {
        $delivery_text = 'Open Bags';
    }
    // Display the custom field:
    if ($delivery_text) {
        echo '<h3>' . __('Delivery Method', 'woocommerce') . ': </h3><p>' . $delivery_text . '</p>';
    }
}


// show delivery method in order review and emails
add_action( 'woocommerce_order_item_meta_end', 'rab_custom_delivery_method_review', 10, 3 );
function rab_custom_delivery_method_review( $item_id, $item, $order ){
    // Get the custom field value
    $delivery_method = get_post_meta( $order->get_id(), 'delivery_method', true );

    $delivery_text = '';

    if ($delivery_method == 'radio_delivery_closed') {
        $delivery_text = 'Sealed Bags';
    }

    if ($delivery_method == 'radio_delivery_open') {
        $delivery_text = 'Open Bags';
    }
    // Display the custom field:
    echo '<p class="u-pad-top"><strong>' . __('Delivery Method', 'woocommerce') . ': </strong>' . $delivery_text . '</p>';
}
