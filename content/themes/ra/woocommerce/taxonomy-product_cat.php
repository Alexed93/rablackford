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

$tax_obj = get_queried_object();
$tax_id = $tax_obj->term_id;
$acf_tax_id = 'category_' .$tax_id;

$excerpt = get_field('excerpt', $acf_tax_id);
$content = $tax_obj->description;

$cat_args = [
	'hide_empty' => false,
	'parent' => $tax_id
];

$child_categories = get_terms('product_cat', $cat_args);

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
			<?php if ($excerpt) : ?>
				<p class="introduction_text"><?php echo $excerpt; ?></p>
			<?php endif; ?>
		</div>
		<?php if ($content) : ?>
			<div class="grid">
				<div class="grid__item grid__item--9-12-bp4">
					<article class="content">
						<?php echo apply_filters('the_content', $content); ?>
				</div>
			</div> <!-- .grid -->
		<?php endif; ?>
		<?php
			rab_get_component(
				'card-introductory',
				[
					'id' => $acf_tax_id
				]
			);

			// either get child categories or product list
			if (!empty($child_categories)) :
				rab_get_component(
					'product-categories',
					[
						'slim' => true,
						'parent' => $tax_id
					]
				);

			else :
				rab_get_component(
					'product-cards',
					[
						'category' => $tax_id
					]
				);
			endif;
		?>



		<?php get_template_part( 'views/cards/card-featured' ); ?>


		<?php

		$additional_content = get_field('additional_content', $acf_tax_id);

		if ($additional_content) : ?>
			<div class="grid u-push-top@2">
				<div class="grid__item grid__item--9-12-bp4">
					<article class="content">
						<?php echo apply_filters('the_content', $additional_content); ?>
				</div>
			</div> <!-- .grid -->
		<?php

		endif;

		// if ( woocommerce_product_loop() ) {

		// 	/**
		// 	 * Hook: woocommerce_before_shop_loop.
		// 	 *
		// 	 * @hooked woocommerce_output_all_notices - 10
		// 	 * @hooked woocommerce_result_count - 20
		// 	 * @hooked woocommerce_catalog_ordering - 30
		// 	 */
		// 	do_action( 'woocommerce_before_shop_loop' );

		// 	// woocommerce_product_loop_start();

		// 	// if ( wc_get_loop_prop( 'total' ) ) {
		// 	// 	while ( have_posts() ) {
		// 	// 		the_post();

		// 	// 		/**
		// 	// 		 * Hook: woocommerce_shop_loop.
		// 	// 		 */
		// 	// 		do_action( 'woocommerce_shop_loop' );

		// 	// 		wc_get_template_part( 'content', 'product' );
		// 	// 	}
		// 	// }

		// 	// woocommerce_product_loop_end();

		// 	/**
		// 	 * Hook: woocommerce_after_shop_loop.
		// 	 *
		// 	 * @hooked woocommerce_pagination - 10
		// 	 */
		// 	do_action( 'woocommerce_after_shop_loop' );
		// } else {
		// 	/**
		// 	 * Hook: woocommerce_no_products_found.
		// 	 *
		// 	 * @hooked wc_no_products_found - 10
		// 	 */
		// 	do_action( 'woocommerce_no_products_found' );
		// }

		?>
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
//do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
