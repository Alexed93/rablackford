<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$post_id = $post->ID;

if( is_shop() ) {
	$post_id = get_option( 'woocommerce_shop_page_id' );
}

// $tax_obj = get_queried_object();

// var_dump($tax_obj);
// $tax_id = $tax_obj->term_id;
// $acf_tax_id = 'category_' .$tax_id;

// $excerpt = get_field('excerpt', $acf_tax_id);

?>
<?php

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<?php get_template_part( 'views/globals/breadcrumbs' ); ?>

<section class="section">
	<div class="container">

		<div class="container--introduction">
			<h1 class="headline"><?php woocommerce_page_title(); ?></h1>
			<p class="introduction_text"><?php echo get_the_excerpt($post_id); ?></p>
		</div>
		<?php
			rab_get_component(
				'card-introductory',
				[
					'id' => $post_id
				]);
		?>

		<?php
		if ( woocommerce_product_loop() ) {

			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );

			// replace woocommerce loop with custom category cards
			if (is_shop()) {
				rab_get_component(
					'product-categories',
					[
						'slim' => true,
						'top_level' => true
					]
				);
			}


			// woocommerce_product_loop_start();

			// if ( wc_get_loop_prop( 'total' ) ) {
			// 	while ( have_posts() ) {
			// 		the_post();

			// 		/**
			// 		 * Hook: woocommerce_shop_loop.
			// 		 */
			// 		do_action( 'woocommerce_shop_loop' );

			// 		wc_get_template_part( 'content', 'product' );
			// 	}
			// }

			// woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}

		?>

		<?php get_template_part( 'views/cards/card-featured' ); ?>
	</div>
</section>
<?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
