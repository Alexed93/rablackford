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
