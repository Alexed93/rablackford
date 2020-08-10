<?php

/**
 * Woocommerce functions, filters and hooks
 */



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
