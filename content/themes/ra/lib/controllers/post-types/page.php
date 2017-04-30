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
function ra_get_pages ( $parent = 0, $count = -1, $orderby = 'menu_order', $order = 'ASC' ) {

    // Define arguments for query.
    $args = array(
        'post_type'      => 'page',
        'post_parent'    => $parent,
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
 * Fetch child posts from current post or if none are available
 * fetch sibling posts
 */
function ra_children_or_siblings( $exclude ) {
    global $post;
    $exclude = [];
    $parent_slug = ra_get_parent_slug();

    // Setup initial query args
    $args = [
        "post_parent" => $post->ID,
        "post_type" => get_post_type( $post->ID ),
        "post_status" => "publish",
        "orderby" => "menu_order title",
        "order" => "ASC",
        "posts_per_page" => - 1,
        "post__not_in" => $exclude
    ];

    $children = get_children( $args, OBJECT );

    if ( $children ) :
        return $children;
    elseif ( $post->post_parent != 0 && (is_single() || is_page()) ) :
        $args["post_parent"] = $post->post_parent;
        $posts               = get_posts( $args );

        if ( count($posts) > 1 ) {
            return $posts;
        }

    endif;

    return false;
}


/**
 * Get parent slug
 */
function ra_get_parent_slug() {
    global $post;
    if($post->post_parent == 0) return '';
    $parent_data = get_post($post->post_parent);
    return $parent_data->post_name;
}


/**
 * $. Setters
 ******************************************************************************/

// Add new page to post type through function here.
