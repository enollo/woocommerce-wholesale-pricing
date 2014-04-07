<?php 

/*
Meta keys
_ewsp_wc_wholesale_markup
_ewsp_wc_wholesale_price
_ewsp_wc_suggested_retail_markup
_ewsp_wc_suggested_retail_price

_ewsp_wc_wholesale_markup_variable
_ewsp_wc_wholesale_price_variable
_ewsp_wc_suggested_retail_markup_variable
_ewsp_wc_suggested_retail_price_variable
*/


/**
 * Add pricing fields to simple products under the 'General' tab
 */
function ewsp_add_pricing_fields_to_simple_product() {
	
	echo '<div class="ewsp_wholesale_fields">';
	
	woocommerce_wp_text_input(
		array(
			'id'                => '_ewsp_wc_wholesale_markup',
			'class'             => 'wc_input_price short',
			'label'             => __( 'Wholesale Markup (%)', 'ewsp' ),
			'type'              => 'number',
			'custom_attributes' => array(
				'step' => 'any',
				'min'  => '0',
			),
		)
	);
	
	woocommerce_wp_text_input(
		array(
			'id'                => '_ewsp_wc_wholesale_price',
			'class'             => 'wc_input_price short',
			'label'             => sprintf( __( 'Wholesale Price (%s)', 'ewsp' ), get_woocommerce_currency_symbol() ),
			'type'              => 'number',
			'custom_attributes' => array(
				'step' => 'any',
				'min'  => '0',
			),
		)
	);
	
	echo '</div>';
	
	echo '<div class="ewsp_suggested_retail_fields">';
	
	woocommerce_wp_text_input(
		array(
			'id'                => '_ewsp_wc_suggested_retail_markup',
			'class'             => 'wc_input_price short',
			'label'             => __( 'Suggested Retail Markup (%)', 'ewsp' ),
			'type'              => 'number',
			'custom_attributes' => array(
				'step' => 'any',
				'min'  => '0',
			),
		)
	);
	
	woocommerce_wp_text_input(
		array(
			'id'                => '_ewsp_wc_suggested_retail_price',
			'class'             => 'wc_input_price short',
			'label'             => sprintf( __( 'Suggested Retail Price (%s)', 'ewsp' ), get_woocommerce_currency_symbol() ),
			'type'              => 'number',
			'custom_attributes' => array(
				'step' => 'any',
				'min'  => '0',
			),
		)
	);
	
	echo '</div>';
	
}
add_action( 'woocommerce_product_options_pricing', 'ewsp_add_pricing_fields_to_simple_product', 15 );


/**
 * Add pricing fields to variable products under the 'General' tab
 */
function ewsp_add_pricing_fields_to_variable_product() {
	
	echo '<div class="ewsp_wholesale_fields">';
	
	woocommerce_wp_text_input(
		array(
			'id'                => '_ewsp_wc_wholesale_markup_variable',
			'class'             => 'wc_input_price short',
			'wrapper_class'     => 'show_if_variable',
			'label'             => __( 'Wholesale Markup (%)', 'ewsp' ),
			'type'              => 'number',
			'desc_tip'          => true,
			'description'       => __( 'Default wholesale markup for product variations', 'ewsp' ),
			'custom_attributes' => array(
				'step' => 'any',
				'min'  => '0',
			),
		)
	);
	
	woocommerce_wp_text_input(
		array(
			'id'                => '_ewsp_wc_wholesale_price_variable',
			'class'             => 'wc_input_price short',
			'wrapper_class'     => 'show_if_variable',
			'label'             => sprintf( __( 'Wholesale Price (%s)', 'ewsp' ), get_woocommerce_currency_symbol() ),
			'type'              => 'number',
			'desc_tip'          => true,
			'description'       => __( 'Default wholesale price for product variations', 'ewsp' ),
			'custom_attributes' => array(
				'step' => 'any',
				'min'  => '0',
			),
		)
	);
	
	echo '</div>';
	
	echo '<div class="ewsp_suggested_retail_fields">';
	
	woocommerce_wp_text_input(
		array(
			'id'                => '_ewsp_wc_suggested_retail_markup_variable',
			'class'             => 'wc_input_price short',
			'wrapper_class'     => 'show_if_variable',
			'label'             => __( 'Suggested Retail Markup (%)', 'ewsp' ),
			'type'              => 'number',
			'desc_tip'          => true,
			'description'       => __( 'Default suggested retail markup for product variations', 'ewsp' ),
			'custom_attributes' => array(
				'step' => 'any',
				'min'  => '0',
			),
		)
	);
	
	woocommerce_wp_text_input(
		array(
			'id'                => '_ewsp_wc_suggested_retail_price_variable',
			'class'             => 'wc_input_price short',
			'wrapper_class'     => 'show_if_variable',
			'label'             => sprintf( __( 'Suggested Retail Price (%s)', 'ewsp' ), get_woocommerce_currency_symbol() ),
			'type'              => 'number',
			'desc_tip'          => true,
			'description'       => __( 'Default suggested retail price for product variations', 'ewsp' ),
			'custom_attributes' => array(
				'step' => 'any',
				'min'  => '0',
			),
		)
	);
	
	echo '</div>';
	
}
add_action( 'woocommerce_product_options_sku', 'ewsp_add_pricing_fields_to_variable_product', 15 );


/**
 * Save pricing fields for simple product
 */
function ewsp_save_simple_product_pricing( $post_id ) {

	$product_type = empty( $_POST['product-type'] ) ? 'simple' : sanitize_title( stripslashes( $_POST['product-type'] ) );

	// need this check because this action is called *after* the variable product action, meaning the variable product pricing fields would be overridden
	if ( 'variable' != $product_type ) {
		update_post_meta( $post_id, '_ewsp_wc_wholesale_markup', stripslashes( $_POST['_ewsp_wc_wholesale_markup'] ) );
		update_post_meta( $post_id, '_ewsp_wc_wholesale_price', stripslashes( $_POST['_ewsp_wc_wholesale_price'] ) );
		update_post_meta( $post_id, '_ewsp_wc_suggested_retail_markup', stripslashes( $_POST['_ewsp_wc_suggested_retail_markup'] ) );
		update_post_meta( $post_id, '_ewsp_wc_suggested_retail_price', stripslashes( $_POST['_ewsp_wc_suggested_retail_price'] ) );
	}

}
add_action( 'woocommerce_process_product_meta', 'ewsp_save_simple_product_pricing', 10, 2 );


/**
 * Renders the fileds as bulk edit options on the product admin Variations tab.
 * There is core JS code that automatically handles these bulk edits.
 */
function ewsp_add_variable_product_bulk_edit_pricing_action() {
	echo '<option value="variable_ewsp_wc_wholesale_markup">' . __( 'Wholesale Markup (%)', 'ewsp' ) . '</option>';
	echo '<option value="variable_ewsp_wc_wholesale_price">' . sprintf( __( 'Wholesale Price (%s)', 'ewsp' ), esc_html( get_woocommerce_currency_symbol() ) ) . '</option>';
	echo '<option value="variable_ewsp_wc_suggested_retail_markup">' . __( 'Suggested Retal Markup (%', 'ewsp' ) . '</option>';
	echo '<option value="variable_ewsp_wc_suggested_retail_price">' . sprintf( __( 'Suggested Retail Price (%s)', 'ewsp' ), esc_html( get_woocommerce_currency_symbol() ) ) . '</option>';
}
add_action( 'woocommerce_variable_product_bulk_edit_actions', 'ewsp_add_variable_product_bulk_edit_pricing_action', 11 );

/**
 * Add fields to variable products under the 'Variations' tab after the shipping class dropdown
 */
function ewsp_wc_add_pricing_fields_to_product_variation( $loop, $variation_data, $variation ) {

	$default_ws_markup = get_post_meta( $variation->post_parent, '_ewsp_wc_wholesale_markup_variable', true );
	$ws_markup = ( isset( $variation_data['_ewsp_wc_wholesale_markup'][0] ) ) ? $variation_data['_ewsp_wc_wholesale_markup'][0] : '';
	
	$default_ws_price = get_post_meta( $variation->post_parent, '_ewsp_wc_wholesale_price_variable', true );
	$ws_price = ( isset( $variation_data['_ewsp_wc_wholesale_price'][0] ) ) ? $variation_data['_ewsp_wc_wholesale_price'][0] : '';
	
	$default_sr_markup = get_post_meta( $variation->post_parent, '_ewsp_wc_suggested_retail_markup_variable', true );
	$sr_markup = ( isset( $variation_data['_ewsp_wc_suggested_retail_markup'][0] ) ) ? $variation_data['_ewsp_wc_suggested_retail_markup'][0] : '';
	
	$default_sr_price = get_post_meta( $variation->post_parent, '_ewsp_wc_suggested_retail_price_variable', true );
	$sr_price = ( isset( $variation_data['_ewsp_wc_suggested_retail_price'][0] ) ) ? $variation_data['_ewsp_wc_suggested_retail_price'][0] : '';

	?>
		<tr class="ewsp_wholesale_fields">
			<td>
				<label><?php echo __( 'Wholesale Markup (%)', 'ewsp' ); ?></label>
				<input type="number" size="5" name="variable_ewsp_wc_wholesale_markup[<?php echo esc_attr( $loop ); ?>]" value="<?php echo esc_attr( $ws_markup ); ?>" step="any" min="0" placeholder="<?php echo esc_attr( $default_ws_markup ); ?>" />
			</td>
			<td>
				<label><?php printf( __( 'Wholesale Price (%s)', 'ewsp' ), esc_html( get_woocommerce_currency_symbol() ) ); ?></label>
				<input type="number" size="5" name="variable_ewsp_wc_wholesale_price[<?php echo esc_attr( $loop ); ?>]" value="<?php echo esc_attr( $ws_price ); ?>" step="any" min="0" placeholder="<?php echo esc_attr( $default_ws_price ); ?>" />
			</td>
		</tr>
		
		<tr class="ewsp_suggested_retail_fields">
			<td>
				<label><?php echo __( 'Suggested Retal Markup (%)', 'ewsp' ); ?></label>
				<input type="number" size="5" name="variable_ewsp_wc_suggested_retail_markup[<?php echo esc_attr( $loop ); ?>]" value="<?php echo esc_attr( $sr_markup ); ?>" step="any" min="0" placeholder="<?php echo esc_attr( $default_sr_markup ); ?>" />
			</td>
			<td>
				<label><?php printf( __( 'Suggested Retal Price (%s)', 'ewsp' ), esc_html( get_woocommerce_currency_symbol() ) ); ?></label>
				<input type="number" size="5" name="variable_ewsp_wc_suggested_retail_price[<?php echo esc_attr( $loop ); ?>]" value="<?php echo esc_attr( $sr_price ); ?>" step="any" min="0" placeholder="<?php echo esc_attr( $default_sr_price ); ?>" />
			</td>
		</tr>
	<?php
}
add_action( 'woocommerce_product_after_variable_attributes', 'ewsp_wc_add_pricing_fields_to_product_variation', 20, 3 );

/**
 * Save pricing fields for the variation product
 */
function ewsp_save_variation_product_pricing( $variation_id ) {

	// find the index for the given variation ID and save the associated pricing fields
	if ( false !== ( $i = array_search( $variation_id, $_POST['variable_post_id'] ) ) ) {
		update_post_meta( $variation_id, '_ewsp_wc_wholesale_markup', $_POST['variable_ewsp_wc_wholesale_markup'][ $i ] );
		update_post_meta( $variation_id, '_ewsp_wc_wholesale_price', $_POST['variable_ewsp_wc_wholesale_price'][ $i ] );
		update_post_meta( $variation_id, '_ewsp_wc_suggested_retail_markup', $_POST['variable_ewsp_wc_suggested_retail_markup'][ $i ] );
		update_post_meta( $variation_id, '_ewsp_wc_suggested_retail_price', $_POST['variable_ewsp_wc_suggested_retail_price'][ $i ] );
	}
		
}
add_action( 'woocommerce_save_product_variation', 'ewsp_save_variation_product_pricing' );


/**
 * Save pricing/min/max for variable products
 */
function ewsp_save_variable_product_pricing( $post_id ) {

	// default pricing fields
	update_post_meta( $post_id, '_ewsp_wc_wholesale_markup_variable', stripslashes( $_POST['_ewsp_wc_wholesale_markup_variable'] ) );
	update_post_meta( $post_id, '_ewsp_wc_wholesale_price_variable', stripslashes( $_POST['_ewsp_wc_wholesale_price_variable'] ) );
	update_post_meta( $post_id, '_ewsp_wc_suggested_retail_markup_variable', stripslashes( $_POST['_ewsp_wc_suggested_retail_markup_variable'] ) );
	update_post_meta( $post_id, '_ewsp_wc_suggested_retail_price_variable', stripslashes( $_POST['_ewsp_wc_suggested_retail_price_variable'] ) );

	// get the minimum and maximum wholesale price associated with the product
	list( $min_wholesale_price, $max_wholesale_price ) = EWSP_WC_WSP_Price::get_variable_product_min_max_wholesale_prices( $post_id );

	update_post_meta( $post_id, '_ewsp_wc_wholesale_price', $min_wholesale_price );
	update_post_meta( $post_id, '_ewsp_wc_wholesale_price_min', $min_wholesale_price );
	update_post_meta( $post_id, '_ewsp_wc_wholesale_price_max', $max_wholesale_price );
	
	// get the minimum and maximum suggested retail price associated with the product
	list( $min_variation_suggested_retail_price, $max_variation_suggested_retail_price ) = EWSP_WC_SRP_Price::get_variable_product_min_max_suggested_retail_prices( $post_id );

	update_post_meta( $post_id, '_ewsp_wc_suggested_retail_price', $min_variation_suggested_retail_price );
	update_post_meta( $post_id, '_ewsp_wc_suggested_retail_price_min', $min_variation_suggested_retail_price );
	update_post_meta( $post_id, '_ewsp_wc_suggested_retail_price_max', $max_wholesale_price );

}
add_action( 'woocommerce_process_product_meta_variable', 'ewsp_save_variable_product_pricing', 15 );