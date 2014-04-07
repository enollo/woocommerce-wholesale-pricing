<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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
 * Columns for Products page (to house inline data)
 */
function ewsp_wc_edit_product_columns( $columns ) {
	$columns["ewsp_inline_data"] = __( 'FrostyFly Inline Data - Do not remove', 'ewsp' );
	return $columns;
}
add_filter( 'manage_edit-product_columns', 'ewsp_wc_edit_product_columns' );

/**
 * Custom Columns for Products page
 */
function ewsp_wc_custom_product_columns( $column ) {
	global $post, $woocommerce, $the_product;
	
	if ( $column == 'ewsp_inline_data') {
		/* Custom inline data for quick edit */
		echo '
			<div class="hidden" id="ewsp_inline_data_' . $post->ID . '">
				<div class="ewsp_wc_cog_cost">' . get_post_meta( $post->ID, '_wc_cog_cost', true ) . '</div>
				<div class="ewsp_wc_wholesale_markup">' . get_post_meta( $post->ID, '_ewsp_wc_wholesale_markup', true ) . '</div>
				<div class="ewsp_wc_wholesale_price">' . get_post_meta( $post->ID, '_ewsp_wc_wholesale_price', true ) . '</div>
				<div class="ewsp_wc_suggested_retail_markup">' . get_post_meta( $post->ID, '_ewsp_wc_suggested_retail_markup', true ) . '</div>
				<div class="ewsp_wc_suggested_retail_price">' . get_post_meta( $post->ID, '_ewsp_wc_suggested_retail_price', true ) . '</div>
				
				<div class="ewsp_wc_cog_cost_variable">' . get_post_meta( $post->ID, '_wc_cog_cost_variable', true ). '</div>
				<div class="ewsp_wc_wholesale_markup_variable">' . get_post_meta( $post->ID, '_ewsp_wc_wholesale_markup_variable', true ) . '</div>
				<div class="ewsp_wc_wholesale_price_variable">' . get_post_meta( $post->ID, '_ewsp_wc_wholesale_price_variable', true ) . '</div>
				<div class="ewsp_wc_suggested_retail_markup_variable">' . get_post_meta( $post->ID, '_ewsp_wc_suggested_retail_markup_variable', true ) . '</div>
				<div class="ewsp_wc_suggested_retail_price_variable">' . get_post_meta( $post->ID, '_ewsp_wc_suggested_retail_price_variable', true ) . '</div>
				
			</div>
		';
	}
}
add_action('manage_product_posts_custom_column', 'ewsp_wc_custom_product_columns', 15 );

/**
 * Custom quick edit - form
 */
function ewsp_wc_admin_product_quick_edit( $column_name, $post_type ) {
	if ($column_name != 'price' || $post_type != 'product') return;
	?>
    <fieldset class="inline-edit-col-left">
		<div id="ewsp-pricing-fields" class="ewsp-pricing-fields inline-edit-col">

			<h4><?php _e( 'Forsty Prcing Data', 'ewsp' ); ?></h4>
			
			<div class="ewsp-pricing-fields-simple-product ewsp-pricing-field-wrapper">
				<div class="ewsp_cog_fields ewsp_price_fields">
					<label>
					    <span class="title"><?php _e( 'Cost', 'ewsp' ); ?></span>
					    <span class="input-text-wrap">
							<input type="text" name="_wc_cog_cost" class="text regular_price" placeholder="<?php _e( 'Cost of Goods', 'ewsp' ); ?>" value="">
						</span>
					</label>
					<br class="clear" />
				</div>
				
				<div class="ewsp_wholesale_fields ewsp_price_fields">
					<label>
					    <span class="title" title="<?php _e( 'Wholesale Markup', 'ewsp' ); ?>"><?php _e( 'WSM', 'ewsp' ); ?></span>
					    <span class="input-text-wrap">
							<input type="text" name="_ewsp_wc_wholesale_markup" class="text regular_price" placeholder="<?php _e( 'Wholesale Markup (%)', 'ewsp' ); ?>" value="">
						</span>
					</label>
					<br class="clear" />
					
					<label>
					    <span class="title" title="<?php _e( 'Wholesale Price', 'ewsp' ); ?>"><?php _e( 'WSP', 'ewsp' ); ?></span>
					    <span class="input-text-wrap">
							<input type="text" name="_ewsp_wc_wholesale_price" class="text regular_price" placeholder="<?php _e( 'Wholesale Price', 'ewsp' ); ?>" value="">
						</span>
					</label>
					<br class="clear" />
				</div>
				
				<div class="ewsp_suggested_retail_fields ewsp_price_fields">
					<label>
					    <span class="title" title="<?php _e( 'Suggested Retail Markup', 'ewsp' ); ?>"><?php _e( 'SRM', 'ewsp' ); ?></span>
					    <span class="input-text-wrap">
							<input type="text" name="_ewsp_wc_suggested_retail_markup" class="text regular_price" placeholder="<?php _e( 'Suggested Retail Markup (%)', 'ewsp' ); ?>" value="">
						</span>
					</label>
					<br class="clear" />
					
					<label>
					    <span class="title" title="<?php _e( 'Suggested Retail Price', 'ewsp' ); ?>"><?php _e( 'SRP', 'ewsp' ); ?></span>
					    <span class="input-text-wrap">
							<input type="text" name="_ewsp_wc_suggested_retail_price" class="text regular_price" placeholder="<?php _e( 'Suggested Retail Price', 'ewsp' ); ?>" value="">
						</span>
					</label>
					<br class="clear" />
				</div>
			</div>
			
			<div class="ewsp-pricing-fields-variable-product ewsp-pricing-field-wrapper">
				<div class="ewsp_cog_fields ewsp_price_fields">
					<label>
					    <span class="title"><?php _e( 'Cost', 'ewsp' ); ?></span>
					    <span class="input-text-wrap">
							<input type="text" name="_wc_cog_cost_variable" class="text regular_price" placeholder="<?php _e( 'Cost of Goods', 'ewsp' ); ?>" value="">
						</span>
					</label>
					<br class="clear" />
				</div>
				
				<div class="ewsp_wholesale_fields ewsp_price_fields">
					<label>
					    <span class="title" title="<?php _e( 'Wholesale Markup', 'ewsp' ); ?>"><?php _e( 'WSM', 'ewsp' ); ?></span>
					    <span class="input-text-wrap">
							<input type="text" name="_ewsp_wc_wholesale_markup_variable" class="text regular_price" placeholder="<?php _e( 'Wholesale Markup (%)', 'ewsp' ); ?>" value="">
						</span>
					</label>
					<br class="clear" />
					
					<label>
					    <span class="title" title="<?php _e( 'Wholesale Price', 'ewsp' ); ?>"><?php _e( 'WSP', 'ewsp' ); ?></span>
					    <span class="input-text-wrap">
							<input type="text" name="_ewsp_wc_wholesale_price_variable" class="text regular_price" placeholder="<?php _e( 'Wholesale Price', 'ewsp' ); ?>" value="">
						</span>
					</label>
					<br class="clear" />
				</div>
				
				<div class="ewsp_suggested_retail_fields ewsp_price_fields">
					<label>
					    <span class="title" title="<?php _e( 'Suggested Retail Markup', 'ewsp' ); ?>"><?php _e( 'SRM', 'ewsp' ); ?></span>
					    <span class="input-text-wrap">
							<input type="text" name="_ewsp_wc_suggested_retail_markup_variable" class="text regular_price" placeholder="<?php _e( 'Suggested Retail Markup (%)', 'ewsp' ); ?>" value="">
						</span>
					</label>
					<br class="clear" />
					
					<label>
					    <span class="title" title="<?php _e( 'Suggested Retail Price', 'ewsp' ); ?>"><?php _e( 'SRP', 'ewsp' ); ?></span>
					    <span class="input-text-wrap">
							<input type="text" name="_ewsp_wc_suggested_retail_price_variable" class="text regular_price" placeholder="<?php _e( 'Suggested Retail Price', 'ewsp' ); ?>" value="">
						</span>
					</label>
					<br class="clear" />
				</div>
			</div>
			
			<input type="hidden" name="ewsp_quick_edit_nonce" value="<?php echo wp_create_nonce( 'ewsp_quick_edit_nonce' ); ?>" />
		</div>
	</fieldset>
	<?php
}
add_action( 'quick_edit_custom_box',  'ewsp_wc_admin_product_quick_edit', 11, 2 );


/**
 * Custom quick edit - save
 */
function ewsp_wc_admin_product_quick_edit_save( $post_id, $post ) {

	if ( ! $_POST || is_int( wp_is_post_revision( $post_id ) ) || is_int( wp_is_post_autosave( $post_id ) ) ) return $post_id;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
	if ( ! isset( $_POST['ewsp_quick_edit_nonce'] ) || ! wp_verify_nonce( $_POST['ewsp_quick_edit_nonce'], 'ewsp_quick_edit_nonce' ) ) return $post_id;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;
	if ( $post->post_type != 'product' ) return $post_id;

	global $woocommerce, $wpdb;
	
	$product = get_product( $post );
	
	if ( $product->is_type('simple') || $product->is_type('external') ) {
		// Save fields
		if ( isset( $_POST['_wc_cog_cost'] ) )                         update_post_meta( $post_id, '_wc_cog_cost', woocommerce_clean( $_POST['_wc_cog_cost'] ) );
		if ( isset( $_POST['_ewsp_wc_wholesale_markup'] ) )            update_post_meta( $post_id, '_ewsp_wc_wholesale_markup', woocommerce_clean( $_POST['_ewsp_wc_wholesale_markup'] ) );
		if ( isset( $_POST['_ewsp_wc_wholesale_price'] ) )             update_post_meta( $post_id, '_ewsp_wc_wholesale_price', woocommerce_clean( $_POST['_ewsp_wc_wholesale_price'] ) );
		if ( isset( $_POST['_ewsp_wc_suggested_retail_markup'] ) )     update_post_meta( $post_id, '_ewsp_wc_suggested_retail_markup', woocommerce_clean( $_POST['_ewsp_wc_suggested_retail_markup'] ) );
		if ( isset( $_POST['_ewsp_wc_suggested_retail_price'] ) )      update_post_meta( $post_id, '_ewsp_wc_suggested_retail_price', woocommerce_clean( $_POST['_ewsp_wc_suggested_retail_price'] ) );
	
	}
	
	if ( $product->is_type('variable') ) {
		if ( isset( $_POST['_wc_cog_cost_variable'] ) )                         update_post_meta( $post_id, '_wc_cog_cost_variable', woocommerce_clean( $_POST['_wc_cog_cost_variable'] ) );
		if ( isset( $_POST['_ewsp_wc_wholesale_markup_variable'] ) )            update_post_meta( $post_id, '_ewsp_wc_wholesale_markup_variable', woocommerce_clean( $_POST['_ewsp_wc_wholesale_markup_variable'] ) );
		if ( isset( $_POST['_ewsp_wc_wholesale_price_variable'] ) )             update_post_meta( $post_id, '_ewsp_wc_wholesale_price_variable', woocommerce_clean( $_POST['_ewsp_wc_wholesale_price_variable'] ) );
		if ( isset( $_POST['_ewsp_wc_suggested_retail_markup_variable'] ) )     update_post_meta( $post_id, '_ewsp_wc_suggested_retail_markup_variable', woocommerce_clean( $_POST['_ewsp_wc_suggested_retail_markup_variable'] ) );
		if ( isset( $_POST['_ewsp_wc_suggested_retail_price_variable'] ) )      update_post_meta( $post_id, '_ewsp_wc_suggested_retail_price_variable', woocommerce_clean( $_POST['_ewsp_wc_suggested_retail_price_variable'] ) );
		
	}	

	// Clear transient
	wc_delete_product_transients( $post_id );
}
add_action( 'save_post', 'ewsp_wc_admin_product_quick_edit_save', 10, 2 );




/**
 * Custom bulk edit - form
 */
function ewsp_wc_admin_product_bulk_edit() {
		?>			
			<div class="inline-edit-group">
				<label class="alignleft">
					<span class="title" title="<?php _e( 'Wholesale Markup', 'ewsp' ); ?>"><?php _e( 'WSM', 'ewsp' ); ?></span>
					<span class="input-text-wrap">
						<select class="change_ewsp_wc_wholesale_markup change_to" name="change_ewsp_wc_wholesale_markup">
						<?php
							$options = array(
								''  => __( '— No Change —', 'ewsp' ),
								'1' => __( 'Change to (in %):', 'ewsp' ),
								'2' => __( 'Increase by (fixed amount or %):', 'ewsp' ),
								'3' => __( 'Decrease by (fixed amount or %):', 'ewsp' )
							);
							foreach ( $options as $key => $value ) {
								echo '<option value="' . esc_attr( $key ) . '">' . esc_html( $value ) . '</option>';
							}
						?>
						</select>
					</span>
				</label>
				<label class="alignright">
					<input type="text" name="_ewsp_wc_wholesale_markup" class="text ewsp_wc_wholesale_markup" placeholder="<?php _e( 'Enter Wholesale Markup', 'ewsp' ); ?>" value="" />
				</label>
			</div>
			
			<div class="inline-edit-group">
				<label class="alignleft">
					<span class="title" title="<?php _e( 'Suggested Retail Markup', 'ewsp' ); ?>"><?php _e( 'SRM', 'ewsp' ); ?></span>
					<span class="input-text-wrap">
						<select class="change_ewsp_wc_suggested_retail_markup change_to" name="change_ewsp_wc_suggested_retail_markup">
						<?php
							$options = array(
								''  => __( '— No Change —', 'ewsp' ),
								'1' => __( 'Change to (in %):', 'ewsp' ),
								'2' => __( 'Increase by (fixed amount or %):', 'ewsp' ),
								'3' => __( 'Decrease by (fixed amount or %):', 'ewsp' )
							);
							foreach ( $options as $key => $value ) {
								echo '<option value="' . esc_attr( $key ) . '">' . esc_html( $value ) . '</option>';
							}
						?>
						</select>
					</span>
				</label>
				<label class="alignright">
					<input type="text" name="_ewsp_wc_suggested_retail_markup" class="text ewsp_wc_suggested_retail_markup" placeholder="<?php _e( 'Enter Suggested Retail Markup', 'ewsp' ); ?>" value="" />
				</label>
			</div>
			
		<?php
	}

add_action( 'woocommerce_product_bulk_edit_end', 'ewsp_wc_admin_product_bulk_edit', 15 );

/**
 * Custom bulk edit - save ::Runs on WooCommerce action
 */
function ewsp_admin_product_bulk_edit_save( $product ) {
	
	$meta_updated = false;
	
	if ( $product->is_type('variable') ) {
		$meta_key_suffix = '_variable';
	} else { //if ( $product->is_type('simple') || $product->is_type('external') )
		$meta_key_suffix = '';
	}
	
	if ( ! empty( $_REQUEST['change_cost_of_good'] ) ) { //check if cost was updated
		$meta_updated = true;
	}
	
	if ( ! empty( $_REQUEST['change_ewsp_wc_wholesale_markup'] ) ) {

		$option_selected = absint( $_REQUEST['change_ewsp_wc_wholesale_markup'] );
		$requested_change = stripslashes( $_REQUEST['_ewsp_wc_wholesale_markup'] );
		
		$meta_key = '_ewsp_wc_wholesale_markup' . $meta_key_suffix;
		
		$current_value = get_post_meta( $product->id, $meta_key, true );

		switch ( $option_selected ) {

			// change value to fixed amount
			case 1 :
				$new_value = $requested_change;
				break;

			// increase value by fixed amount/percentage
			case 2 :
				if ( false !== strpos( $requested_change, '%' ) ) {
					$percent = str_replace( '%', '', $requested_change ) / 100;
					$new_value = $current_value + ( $current_value * $percent );
				} else {
					$new_value = $current_value + $requested_change;
				}
				break;

			// decrease value by fixed amount/percentage
			case 3 :
				if ( false !== strpos( $requested_change, '%' ) ) {
					$percent = str_replace( '%', '', $requested_change ) / 100;
					$new_value = $current_value - ( $current_value * $percent );
				} else {
					$new_value = $current_value - $requested_change;
				}
			break;
		}

		// update to new value if different than current cost
		if ( isset( $new_value ) && $new_value != $current_value ) {
			update_post_meta( $product->id, $meta_key, $new_value );
			$meta_updated = true;
		}
	}
		
	if ( ! empty( $_REQUEST['change_ewsp_wc_suggested_retail_markup'] ) ) {

		$option_selected = absint( $_REQUEST['change_ewsp_wc_suggested_retail_markup'] );
		$requested_change = stripslashes( $_REQUEST['_ewsp_wc_suggested_retail_markup'] );
		
		$meta_key = '_ewsp_wc_suggested_retail_markup' . $meta_key_suffix;
		
		$current_value = get_post_meta( $product->id, $meta_key, true );

		switch ( $option_selected ) {

			// change value to fixed amount
			case 1 :
				$new_value = $requested_change;
				break;

			// increase value by fixed amount/percentage
			case 2 :
				if ( false !== strpos( $requested_change, '%' ) ) {
					$percent = str_replace( '%', '', $requested_change ) / 100;
					$new_value = $current_value + ( $current_value * $percent );
				} else {
					$new_value = $current_value + $requested_change;
				}
				break;

			// decrease value by fixed amount/percentage
			case 3 :
				if ( false !== strpos( $requested_change, '%' ) ) {
					$percent = str_replace( '%', '', $requested_change ) / 100;
					$new_value = $current_value - ( $current_value * $percent );
				} else {
					$new_value = $current_value - $requested_change;
				}
				break;
		}

		// update to new value if different than current cost
		if ( isset( $new_value ) && $new_value != $current_value ) {
			update_post_meta( $product->id, $meta_key, $new_value );
			$meta_updated = true;
		}
	}
	
	if ( $meta_updated ) { //update the prices 
		$cost =  get_post_meta( $product->id, '_wc_cog_cost' . $meta_key_suffix, true );
		$wholesale_markup = get_post_meta( $product->id, '_ewsp_wc_wholesale_markup' . $meta_key_suffix, true );
		$suggested_retail_markup = get_post_meta( $product->id, '_ewsp_wc_suggested_retail_markup' . $meta_key_suffix, true );
		
		$wholesale_markup = str_replace( '%', '', $wholesale_markup ) / 100;
		$suggested_retail_markup = str_replace( '%', '', $suggested_retail_markup ) / 100;
		
		$wholesale_price = $cost * ( 1 + $wholesale_markup );
		update_post_meta( $product->id, '_ewsp_wc_wholesale_price' . $meta_key_suffix, $wholesale_price);
		
		$suggested_retail_price = $wholesale_price * ( 1 + $suggested_retail_markup );
		update_post_meta( $product->id, '_ewsp_wc_suggested_retail_price' . $meta_key_suffix, $suggested_retail_price);
		
	}
	
}
add_action( 'woocommerce_product_bulk_edit_save', 'ewsp_admin_product_bulk_edit_save', 20 );


