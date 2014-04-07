<?php

function ewsp_wholesale_price( $price, $product ) {
	if ( current_user_can('purchase_wholesale') ) {
		$price = EWSP_WC_WSP_Price::get_wholesale_price( $product );
	}
	return $price;
}

add_filter('woocommerce_get_price', 'ewsp_wholesale_price', 10, 2);
add_filter('woocommerce_get_variation_price', 'ewsp_wholesale_price', 10, 2);
add_filter('woocommerce_get_variation_regular_price', 'ewsp_wholesale_price', 10, 2);