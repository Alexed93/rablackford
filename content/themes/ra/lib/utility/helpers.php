<?php

/**
 *******************************************************************************
 * Helpers
 *******************************************************************************
 *
 * Helper functions which makes life easier and remove any unnecessary
 * repetition.
 *
 * $. Conditionals
 *
 */



/**
 * Conditionals
 ******************************************************************************/

// Conditionals here


/**
 * Other
 ******************************************************************************/

/**
 * Get a post's excerpt by its ID
 *
 * @param  int     $id  The ID of the post
 * @return string       The post's excerpt
 */
function ra_get_excerpt_by_id ( $id ) {

    // Get current post
    $page = get_post($id);

    // Get it's excerpt
    $excerpt = $page->post_excerpt;

    // Return the excerpt
    return $excerpt;
}

/**
 * Create properly formatted tel: links
 * $input = <p>(01423) 598 008</p>
 * $output = 01423598008
 */
function ra_format_tel($text){
    $exp = "/[^0-9]/";
    $text = preg_replace($exp, '', strip_tags($text));
    return $text;
}

