<?php
/*
Plugin Name: Custom Gifts for WooCommerce
Plugin URI: https://woocommerce.com/
Description: Modifications on cart page for the gift category products.
Author: Priyanka Kaswala
Version: 1.0.0
*/

//Add 'count of orders' column in products listing page 
function add_column_to_product( $columns ) {
    $columns['order_count'] = __( 'Total Orders', 'woocommerce' );
    return $columns;
}
add_filter( 'manage_edit-product_columns', 'add_column_to_product', 10, 1 );

function display_columns_content($column_name, $post_ID) {
    if ($column_name == 'order_count') {
    	$total_sales = get_post_meta( $post_ID, 'total_sales', true );
        echo $total_sales;
    }
}
add_filter( 'manage_product_posts_custom_column', 'display_columns_content', 10, 3);


//Add a message field on cart page
function add_message_field_in_cart( $cart_item, $cart_item_key ) {

	$message = isset( $cart_item['message'] ) ? $cart_item['message'] : '';
	$product_id = $cart_item['product_id'];
	$terms = get_the_terms( $product_id, 'product_cat' );
	foreach ($terms as $term) {
	   $product_cat = $term->term_id;
	}

	if($product_cat == 16) {
		printf(
			'<div><textarea class="%s" placeholder="Type your message" id="cart_message_%s" data-cart-id="%s">%s</textarea></div>',
			'gift-pro-message',
			$cart_item_key,
			$cart_item_key,
			$message
		);
	}
}
add_action( 'woocommerce_after_cart_item_name', 'add_message_field_in_cart', 10, 2 );

//Enqueue the JS file
function custom_enqueue_scripts() {
	wp_register_script( 'custom-script', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'js/custom-cart.js', array( 'jquery-blockui' ), time(), true );
	wp_localize_script('custom-script', 'ajax_url', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'custom_enqueue_scripts' );

//Save the message
function save_cart_message() {

	if( ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'woocommerce-cart' ) ) {
		wp_send_json( array( 'nonce_fail' => 1 ) );
		exit;
	}

	$cart = WC()->cart->cart_contents;
	$cart_id = $_POST['cart_id'];
	$notes = $_POST['message'];
	$cart_item = $cart[$cart_id];
	$cart_item['message'] = $notes;
	WC()->cart->cart_contents[$cart_id] = $cart_item;
	WC()->cart->set_session();
	wp_send_json( array( 'success' => 1 ) );
	exit;
}
add_action( 'wp_ajax_custom_cart_message', 'save_cart_message' );

//Display the message in order detail section
function display_gift_message( $item, $cart_item_key, $values, $order ) {
	foreach( $item as $cart_item_key=>$cart_item ) {
		if( isset( $cart_item['message'] ) ) {
			$item->add_meta_data( 'message', $cart_item['message'], true );
		}
	}
}
add_action( 'woocommerce_checkout_create_order_line_item', 'display_gift_message', 10, 4 );