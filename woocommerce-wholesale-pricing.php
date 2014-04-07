<?php
/*
Plugin Name: WooCommerce Wholesale Pricing
Description: Add wholesale pricing functionality to WooCommerce products
Version: 0.01
License: GPL
Author: Enollo
Author URI: enollo.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Check if WooCommerce is active
 **/
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    return;
}

define( 'EWSP_URL', plugins_url( '', __FILE__ ) );
define( 'EWSP_PATH', plugin_dir_path( __FILE__ ) );

require_once(EWSP_PATH . '/inc/classes/class-wholesale-price.php');
require_once(EWSP_PATH . '/inc/classes/class-suggested-retail-price.php');

require_once(EWSP_PATH . '/inc/admin/settings.php');

require_once(EWSP_PATH . '/inc/admin/pricing-admin.php');
require_once(EWSP_PATH . '/inc/admin/quick-edit.php');
require_once(EWSP_PATH . '/inc/wholesale-pricing.php');

// TO DO 
//require_once(EWSP_PATH . '/inc/bulk-order-form.php');
//require_once(EWSP_PATH . '/inc/shortcodes.php');



function ewsp_init() {
	if ( is_admin() ) {
	}	
}
add_action( 'init', 'ewsp_init' );

function ewsp_activate() {	
	//temp while in dev
	remove_role('wholesale_customer');
	
	// Setup roles and capabilities
	////
	
	// Get Customer Role
	$customer_role = get_role( 'customer' );
	
	// Add Wholesale Customer Role
   $wholesale_customer_role = add_role( 'wholesale_customer', 'Wholesale Customer', $customer_role->capabilities );
   $wholesale_customer_role->add_cap( 'purchase_wholesale' );
}
register_activation_hook( __FILE__, 'ewsp_activate' );

/**
 * Enqueue scripts and styles
 */
function ewsp_scripts() {
}
//add_action( 'wp_enqueue_scripts', 'ewsp_scripts' );


function ewsp_admin_scripts() {
	wp_enqueue_style('ewsp_admin_style', EWSP_URL . '/assets/css/admin.min.css', false, null );
	
	wp_register_script('ewsp_admin_scripts', EWSP_URL . '/assets/js/admin/admin.min.js', array('jquery'), 'ad875d471efc93d305f26831fce81b50', false);
	wp_enqueue_script('ewsp_admin_scripts');
}
add_action( 'admin_enqueue_scripts', 'ewsp_admin_scripts' );

/**
 * Custom quick edit script
 */
function ewsp_admin_product_quick_edit_scripts( $hook ) {
	global $woocommerce, $post_type;

	if ( $hook == 'edit.php' && $post_type == 'product' )
    	wp_enqueue_script( 'ewsp_quick-edit', EWSP_URL . '/assets/js/admin/quick-edit.min.js', array('jquery') );
}
add_action( 'admin_enqueue_scripts', 'ewsp_admin_product_quick_edit_scripts', 11 );