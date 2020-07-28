<?php

/**
 *******************************************************************************
 * Theme
 *******************************************************************************
 *
 * This file is used to create a baseline for the front-end of the site.
 *
 * $. Remove unnecessary meta/link tags
 * $. Remove & disable JSON API
 * $. Remove oembed scripts
 * $. Queue jQuery correctly
 * $. Update image sizes
 * $. Update functions to HTML5
 * $. Gravity forms
 *
 */



/**
 * $. Remove unnecessary meta/link tags
 ******************************************************************************/

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );



/**
 * $. Remove & disable JSON API
 ******************************************************************************/

function ra_remove_json_api () {

    /**
     * Remove API scripts from header/footer
     */

    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    add_filter( 'embed_oembed_discover', '__return_false' );

    /**
     * Disable API from working all together
     */

    add_filter('json_enabled', '__return_false');
    add_filter('rest_enabled', '__return_false');
    add_filter('json_jsonp_enabled', '__return_false');
    add_filter('rest_jsonp_enabled', '__return_false');

    // Remove pingback
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
    remove_action( 'template_redirect', 'rest_output_link_header', 11 );
}

add_action( 'init', 'ra_remove_json_api' );

/**
 * Remove pingback headers
 */
function ra_unset_wp_pingback($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}

add_filter( 'wp_headers', 'ra_unset_wp_pingback' );



/**
 * $. Remove oembed scripts from frontend
 ******************************************************************************/

function ra_deregister_oembed() {
    wp_deregister_script( 'wp-embed' );
}

add_action( 'wp_footer', 'ra_deregister_oembed' );



/**
 * $. Queue jQuery correctly
 ******************************************************************************/

// function ra_requeue_jquery () {
//     $js_head = get_stylesheet_directory_uri() . '/assets/dist/js/head.min.js';
//     $js_main = get_stylesheet_directory_uri() . '/assets/dist/js/main.min.js';

//     wp_deregister_script( 'jquery' );

//     wp_register_script( 'jquery', $js_head, '', '', false );
//     wp_enqueue_script( 'jquery' );

//     wp_register_script( 'js-main', $js_main, '', '', true );
//     wp_enqueue_script( 'js-main' );
// }

// if ( !is_admin() ) {
//     add_action( 'wp_enqueue_scripts', 'ra_requeue_jquery', 11 );
// }

add_action('wp_enqueue_scripts', 'liv_load_js', 100);

function liv_load_js()
{
    if (!is_admin()) {
        global $wp_query;

        wp_deregister_script('jquery');
        //wp_deregister_script('jquery-ui-core');
        wp_deregister_script('jquery-migrate');
        wp_deregister_script('wp-embed');

        wp_register_script(
            'jquery',
            get_stylesheet_directory_uri() . '/assets/dist/js/jquery.min.js',
            array(),
            null,
            false
        );

       wp_enqueue_script('jquery');

       wp_register_script(
            'jquery-migrate',
            get_stylesheet_directory_uri() . '/assets/dist/js/jquery-migrate.min.js',
            array(),
            '3.3.1',
            false
        );

        wp_enqueue_script('jquery-migrate');

        // register dist scripts with hashes produced by webpack
        $manifest = file_get_contents(get_stylesheet_directory() . '/assets/dist/manifest.json');
        $manifestList = json_decode($manifest);
        foreach ($manifestList as $file) {

            // JS files
            if (pathinfo($file, PATHINFO_EXTENSION) === 'js') {
                $fullName = basename($file);
                $fullNameArray = explode(".", $fullName);
                $name = $fullNameArray[0];
                $is_jquery = (substr($fullName, 0, 6) === 'jquery') ? true : false;

                // enqueue each non-jquery script
                if ($fullName && !$is_jquery) {
                    wp_enqueue_script($name, get_template_directory_uri() . '/assets/dist/' . $fullName, array(), null, false);
                    wp_localize_script($name, $name . '_ajax', array(
                        'ajaxurl' => admin_url('admin-ajax.php'),
                        'post_id' => get_the_ID(),
                        'posts' => json_encode($wp_query->query_vars),
                        'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
                        'max_page' => $wp_query->max_num_pages
                    ));
                }
            }

            // CSS files
            if (pathinfo($file, PATHINFO_EXTENSION) === 'css') {
                $fullName = basename($file);
                $fullNameArray = explode(".", $fullName);
                $name = $fullNameArray[0];

                // enqueue each script
                if ($fullName) {
                    wp_enqueue_style($name, get_template_directory_uri() . '/assets/dist/' . $fullName, array(), null);
                }
            }
        }

        // wp_register_script(
        //     'google-maps',
        //     "https://maps.googleapis.com/maps/api/js?key=" . esc_attr(get_field('google_maps_api_key', 'options')),
        //     array(),
        //     '1.0.0',
        //     true
        // );

        // wp_enqueue_script('google-maps');

    }

}


/**
 * $. Update image sizes
 ******************************************************************************/

if ( get_option("medium_crop") === false ) {
    add_option("medium_crop", "1");
} else {
    update_option("medium_crop", "1");
}

if ( get_option("large_crop") === false ) {
    add_option("large_crop", "1");
} else {
    update_option("large_crop", "1");
}

/**
 * This is an example on how to create a new image size. Please look at
 * https://developer.wordpress.org/reference/functions/add_image_size/ for more info.
 */

//add_image_size('banner', 429, 280, true);



/**
 * $. Update functions to HTML5
 ******************************************************************************/

add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery']);
