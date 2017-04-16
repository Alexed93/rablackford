<?php

/**
 *******************************************************************************
 * Vendors
 *******************************************************************************
 *
 * Any 3rd party plugins or modules that are used should be configured within
 * here, if needs must, a `/lib/config/vendors/` folder should be created.
 *
 * $. Advanced Custom Fields
 * $. Gravity Forms
 *
 */



/**
 * $. Advanced Custom Fields
 ******************************************************************************/

// Add ACF options page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}



/**
 * $. Gravity Forms
 ******************************************************************************/

// Better validation message
function ra_update_validation_message( $msg, $form ){
    $output  = '<div class="alert alert--error">';
    $output .= '<strong>Error:</strong> Please complete the required fields and try again';
    $output .= '</div>';

    return $output;
}

add_filter( 'gform_validation_message', 'ra_update_validation_message', 10, 2 );

// Update the Form submit button
function ra_gforms_submit_button( $btn, $form ){
    $output  = '<button type="submit" class="btn btn--primary" id="gform_submit_button_' . $form['id'] . '">';
    $output .= $form['button']['text'];
    $output .= '</button>';

    return $output;
}

add_filter( 'gform_submit_button', 'ra_gforms_submit_button', 10, 2 );



/**
 * $. TinyMCE editor
 ******************************************************************************/

// Modify TinyMCE editor to remove H1 tags
function ra_tinymce_specify_formats($init) {
    // Add block format elements you want to show in dropdown
    $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;';
    return $init;
}

add_filter('tiny_mce_before_init', 'ra_tinymce_specify_formats' );

