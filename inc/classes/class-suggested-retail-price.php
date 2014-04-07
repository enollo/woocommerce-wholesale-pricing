<?php
/**
 * WooCommerce Suggested Retail Markup and Price
 *
 * @package     ewsp/Classes
 * @author      Enollo
 * @copyright   Copyright (c) 2013, Enollo, Inc.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Suggested Retail Price Class
 *
 * Product utility class
 *
 * @since 1.1
 */
class EWSP_WC_SRP_Price {


	/** API methods ******************************************************/


	/**
	 * Returns the product Suggested Retail price, if any
	 *
	 * @since 1.0
	 * @param WC_Product|int $product the product or product id
	 * @return float|string product price if configured, the empty string otherwise
	 */
	public static function get_suggested_retail_price( $product ) {

		// get the product object
		$product = is_numeric( $product ) ? get_product( $product ) : $product;

		// get the product id
		$product_id = $product->is_type( 'variation' ) ? $product->variation_id : $product->id;

		// get the product price
		$price = get_post_meta( $product_id, '_ewsp_wc_suggested_retail_price', true );

		// if no price set for product variation, check if a default price exists for the parent variable product
		if ( '' === $price && $product->is_type( 'variation' ) ) {
			$price = get_post_meta( $product->id, '_ewsp_wc_suggested_retail_price_variable', true );
		}

		return $price;

	}


	/**
	 * Returns the minimum/maximum prices associated with the child variations
	 * of $product
	 *
	 * @since 1.1
	 * @param WC_Product_Variable|int $product the variable product
	 * @return array containing the minimum and maximum prices associated with $product
	 */
	public static function get_variable_product_min_max_suggested_retail_prices( $product ) {

		// get the product id
		$product_id = is_object( $product ) ? $product->id : $product;

		// get all child variations
		$children = get_posts( array(
			'post_parent'    => $product_id,
			'posts_per_page' => -1,
			'post_type'      => 'product_variation',
			'fields'         => 'ids',
			'post_status'    => 'publish',
		) );

		// determine the minimum and maximum child prices
		$min_variation_suggested_retail_price = '';
		$max_variation_suggested_retail_price = '';

		if ( $children ) {

			foreach ( $children as $child_product_id ) {

				$child_price = self::get_suggested_retail_price( $child_product_id );

				if ( '' === $child_price )
					continue;

				$min_variation_suggested_retail_price = '' === $min_variation_suggested_retail_price ? $child_price : min( $min_variation_suggested_retail_price, $child_price );
				$max_variation_suggested_retail_price = '' === $max_variation_suggested_retail_price ? $child_price : max( $max_variation_suggested_retail_price, $child_price );
			}

		}

		return array( $min_variation_suggested_retail_price, $max_variation_suggested_retail_price );
	}


	/**
	 * Returns the product price html, if any
	 *
	 * @since 1.1
	 * @param WC_Product|int $product the product or product id
	 * @return string product price markup
	 */
	public static function get_suggested_retail_price_html( $product ) {

		$price = '';

		// get the product
		$product = is_numeric( $product ) ? get_product( $product ) : $product;

		if ( $product->is_type( 'variable' ) ) {

			// get the minimum and maximum prices associated with the product
			list( $min_variation_suggested_retail_price, $max_variation_suggested_retail_price ) = self::get_variable_product_min_max_suggested_retail_prices( $product );

			if ( '' === $min_variation_suggested_retail_price ) {

				$price = apply_filters( 'wc_suggested_retail_price_variable_empty_html', '', $product );

			} else {

				if ( $min_variation_suggested_retail_price != $max_variation_suggested_retail_price ) {
					$price .= $product->get_price_html_from_text();
				}

				$price .= woocommerce_price( $min_variation_suggested_retail_price );
				$price = apply_filters( 'wc_suggested_retail_price_variablet_html', $price, $product );

			}

		} else {

			// simple product
			$price = self::get_suggested_retail_price( $product );

			if ( '' === $price ) {

				$price = apply_filters( 'wc_suggested_retail_price_empty_html', '', $product );

			} else {

				$price = woocommerce_price( $price );
				$price = apply_filters( 'wc_suggested_retail_price_html', $price, $product );

			}

		}

		return apply_filters( 'wc_suggested_retail_price_get_suggested_retail_price_html', $price, $product );

	}


} // end \EWSP_WC_SRP_Price class
