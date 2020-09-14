<?php
/**
 * Add to Quote button template
 *
 * @package YITH Woocommerce Request A Quote
 * @since   1.0.0
 * @version 1.5.3
 * @author  YITH
 *
 * @var $product_id integer
 * @var $exists bool
 * @var $template_part string
 * @var $rqa_url string
 * @var $label_browse string
 */

 $label_browse = 'Your quote request list';

?>

<div class="yith-ywraq-add-to-quote add-to-quote-<?php echo esc_attr( $product_id ); ?>">
	<h3>Add this product to a Quote</h3>
	<p>We can often offer better quotes when collecting directly from our yard.</p>
	<div class="yith-ywraq-add-button <?php echo esc_attr( ( $exists ) ? 'hide' : 'show' ); ?>" style="display:<?php echo esc_attr( ( $exists ) ? 'none' : 'block' ); ?>">
		<?php wc_get_template( 'add-to-quote-' . $template_part . '.php', $args, '', YITH_YWRAQ_TEMPLATE_PATH ); ?>
	</div>
	<?php if ( $exists ) : ?>
		<div class="yith_ywraq_add_item_response-<?php echo esc_attr( $product_id ); ?> yith_ywraq_add_item_response_message"><?php echo wp_kses_post( apply_filters( 'ywraq_product_in_list', __( 'The product is already in your quote request list.', 'yith-woocommerce-request-a-quote' ) ) ); ?></div>
		<div class="yith_ywraq_add_item_browse-list-<?php echo esc_attr( $product_id ); ?> yith_ywraq_add_item_browse_message u-push-top"><a href="<?php echo esc_url( $rqa_url ); ?>" class="btn btn--primary-border"><?php echo wp_kses_post( $label_browse ); ?></a></div>
	<?php endif ?>
</div>

<div class="clear"></div>
