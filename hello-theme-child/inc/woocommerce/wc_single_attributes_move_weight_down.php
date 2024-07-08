<?php
defined('ABSPATH') || die();

if ( is_woocommerce_activated() ) {
	// Move Weight to bottom
	add_filter( 'woocommerce_display_product_attributes', 'woocommerce_sort_product_attributes', 10, 2 );
	function woocommerce_sort_product_attributes ( $product_attributes, $product ) {
		ksort( $product_attributes );
		return $product_attributes;
	}
}
