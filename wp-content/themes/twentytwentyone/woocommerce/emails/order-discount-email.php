<?php
/**
 *
 * Order Discount Email Template
 *
 * The file is prone to modifications after plugin upgrade or alike; customizations are advised via hooks/filters
 *
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); 

$getorder = wc_get_order( $order->get_id() );
foreach( $getorder->get_items() as $item ) {
	$discount_amount = get_post_meta($item['product_id'], 'amount_of_discount', true);

	$characters = "ABCDEFGHJKMNPQRSTUVWXYZ23456789";
	$char_length = "8";
	$discount_code = substr( str_shuffle( $characters ), 0, $char_length );
	$discount_type = 'fixed_cart';

	$coupon = array(
	'post_title' => $discount_code,
	'post_content' => '',
	'post_status' => 'publish',
	'post_author' => 1,
	'post_type' => 'shop_coupon');

	$new_coupon_id = wp_insert_post( $coupon );

	update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
	update_post_meta( $new_coupon_id, 'coupon_amount', $discount_amount );
	update_post_meta( $new_coupon_id, 'individual_use', 'no' );
	update_post_meta( $new_coupon_id, 'product_ids', '' );
	update_post_meta( $new_coupon_id, 'usage_limit', '1' );
	update_post_meta( $new_coupon_id, 'expiry_date', '' );
	update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
	update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
}

?>
<p><?php _e( 'Thank you for your order.', 'woocommerce' ); ?></p>
<p><?php _e( 'We are happy to extend <strong>'.wc_price($discount_amount).'</strong>  discount on your next purchase.', 'woocommerce' ); ?></p>
<p><?php _e( 'Use the coupon code <strong>' . $discount_code . '</strong> to avail the discount.', 'woocommerce' ); ?></p>
<p><?php _e( 'Below are the order details for your reference.', 'woocommerce' ) ?></p>
<?php
/**
* @hooked WC_Emails::order_details() Shows the order details table.
* @hooked WC_Emails::order_schema_markup() Adds Schema.org markup.
* @since 2.5.0
*/
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );
/**
* @hooked WC_Emails::order_meta() Shows order meta data.
*/
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );
/**
* @hooked WC_Emails::customer_details() Shows customer details
* @hooked WC_Emails::email_address() Shows email address
*/
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );
/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );