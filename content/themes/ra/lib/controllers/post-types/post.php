<?php

/**
 *******************************************************************************
 * Post type queries: Page
 *******************************************************************************
 *
 * A set of functions to access the Page post type results.
 *
 * $. Getters
 * $. Setters
 *
 */



/**
 * $. Getters
 ******************************************************************************/

/**
 * Get pages.
 *
 * @param  int     $parent  Define the parent page of the pages you're getting.
 * @param  int     $count   Number of posts you'd like to bring through.
 * @return object           WP_Query instance
 */

function ra_get_news_posts ($count = -1, $orderby = 'menu_order', $order = 'ASC') {

    $featured = get_field('featured' , 53);
    $featured_id = [$featured[0]->ID];

    // Define arguments for query.
    $args = array(
        'post_type'      => 'post',
        'post__not_in'  =>  $featured_id,
        'posts_per_page' => $count,
        'orderby'        => $orderby,
        'order'          => $order
    );

    // Create new instance of WP_Query class.
    $output = new WP_Query( $args );


    // Return the results
    return $output;
}


/**
 * $. Setters
 ******************************************************************************/

// Add new page to post type through function here.
