<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function ewsp_add_inventory_settings( $settings ) {
	$settings = array_merge( $settings, ewsp_get_inventory_settings() );
	return $settings;
}
add_filter( 'woocommerce_inventory_settings', 'ewsp_add_inventory_settings', 20 );

function ewsp_get_inventory_settings() {
	
	return apply_filters( 'ewsp_inventory_settings', array(
		
		// start section
		array(
			'title' => __( 'Wholesale Pricing Options (TODO)', 'ewsp' ),
			'type' => 'title',
			'desc' => '',
			'id' => 'ewsp_wholesale_options' 
		),
		
		// Wholesale Pricing Fields Checkbox Group
		
		// Wholesale Price Field
		array(
			'title' => __( 'Enable Wholesale Pricing Fields', 'ewsp' ),
			'desc' => __( 'Enable Wholesale Price Field', 'ewsp' ),
			'id' => 'ewsp_enable_wholesale_price_field',
			'default'=> 'yes',
			'type' => 'checkbox',
			'checkboxgroup' => 'start'
		),
		
		// Wholesale Markup Field
		array(
			'desc' => __( 'Enable Wholesale Markup Field (%)', 'ewsp' ),
			'id' => 'ewsp_enable_wholesale_markup_field',
			'default'=> 'no',
			'type' => 'checkbox',
			'checkboxgroup' => ''
		),
		
		// Suggested Retail Price Field
		array(
			'desc' => __( 'Enable Suggested Retail Price Field', 'ewsp' ),
			'id' => 'ewsp_enable_suggested_retail_price_field',
			'default'=> 'no',
			'type' => 'checkbox',
			'checkboxgroup' => ''
		),
		
		// Suggested Retail Markup Field
		array(
			'desc' => __( 'Enable Suggested Retail Markup Field', 'ewsp' ),
			'id' => 'ewsp_enable_suggested_retail_markup_field',
			'default'=> 'no',
			'type' => 'checkbox',
			'checkboxgroup' => 'end'
		),
		
		// end section
		array( 
			'type' => 'sectionend', 
			'id' => 'ewsp_wholesale_options'
		),
	
	));
	
}