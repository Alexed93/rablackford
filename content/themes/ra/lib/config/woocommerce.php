<?php

/**
 * Woocommerce functions, filters and hooks
 */

function rab_checkout_button_no_shipping() {

    $chosen_shipping_methods = WC()->session->get( 'chosen_shipping_methods' );

    // remove button if there is no chosen shipping method
    if( empty( $chosen_shipping_methods[0] ) ) {
        remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
    }
}
add_action( 'woocommerce_proceed_to_checkout', 'rab_checkout_button_no_shipping', 1 );
