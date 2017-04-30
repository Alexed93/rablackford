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

function ra_term_links( $post_id, $taxonomy, $wrap = true ){
    $terms = wp_get_object_terms($post_id, $taxonomy);
    $str_output = '';

    if(!is_wp_error($terms) && $terms ):
        if ($wrap) {
            $str_output .= '<ul class="list list--unset list--inline list--box">';
        }

        foreach($terms as $term):
            if ($wrap) {
                $str_output .= '<li class="zeta">';
            }

            $url = get_term_link($term , $taxonomy);
            $str_output .= '<a href="'.$url.'">'.$term->name.'</a>';

            if ($wrap) {
                $str_output .= '</li>';
            }

        endforeach;

        if ($wrap) {
           $str_output .= '</ul>';
        }

    endif;

    return $str_output;

}
