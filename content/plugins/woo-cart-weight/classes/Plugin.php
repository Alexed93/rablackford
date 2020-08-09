<?php
/**
 * Plugin main class.
 *
 * @package WPDesk\WooCommerceCartWeight
 */

namespace WPDesk\WooCommerceCartWeight;

/**
 * Main plugin class. The most important flow decisions are made here.
 *
 * @package WPDesk\WooCommerceCartWeight
 */
class Plugin extends \WCWeightVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin {

	/**
	 * Define plugin namespace for backward compatibility.
	 */
	const PLUGIN_NAMESPACE = 'woo-cart-weight';

	/**
	 * Plugin constructor.
	 *
	 * @param \WCWeightVendor\WPDesk_Plugin_Info $plugin_info Plugin info.
	 */
	public function __construct( \WCWeightVendor\WPDesk_Plugin_Info $plugin_info ) {
		$this->plugin_info = $plugin_info;
		parent::__construct( $plugin_info );
	}

	/**
	 * Init base variables for plugin
	 */
	public function init_base_variables() {
		$this->plugin_url         = $this->plugin_info->get_plugin_url();
		$this->plugin_namespace   = self::PLUGIN_NAMESPACE;
	}

	/**
	 * Fires hooks
	 */
	public function hooks() {
		parent::hooks();
		add_action( 'woocommerce_cart_totals_after_order_total', array( $this, 'woocommerce_order_total_action' ) );
		add_action( 'woocommerce_review_order_after_order_total', array( $this, 'woocommerce_order_total_action' ) );
		add_action( 'woocommerce_widget_shopping_cart_before_buttons', array( $this, 'woocommerce_widget_shopping_action' ) );
	}

	/**
	 * Add Cart Weight to Cart and Checkout
	 */
	public function woocommerce_order_total_action() {
		$cart_weight = WC()->cart->get_cart_contents_weight();
		if ( WC()->cart->needs_shipping() && ! empty( $cart_weight ) ) :
			?>
			<tr class="total-weight">
				<th><?php echo esc_attr( __( 'Total Weight', 'woo-cart-weight' ) ); ?></th>
				<td data-title="<?php echo esc_attr( __( 'Total Weight', 'woo-cart-weight' ) ); ?>"><?php echo esc_html( $cart_weight . ' ' . get_option( 'woocommerce_weight_unit' ) ); ?></td>
			</tr>
			<?php
		endif;
	}

	/**
	 * Add Cart Weight to Mini Cart
	 */
	public function woocommerce_widget_shopping_action() {
		$cart_weight = WC()->cart->get_cart_contents_weight();
		if ( WC()->cart->needs_shipping() && ! empty( $cart_weight ) ) :
			?>
			<p class="woocommerce-mini-cart__total total total-weight">
				<strong><?php echo esc_attr( __( 'Total Weight:', 'woo-cart-weight' ) ); ?></strong> <?php echo esc_html( $cart_weight . ' ' . get_option( 'woocommerce_weight_unit' ) ); ?>
			</p>
			<?php
		endif;
	}
}
