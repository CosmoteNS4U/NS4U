<?php
defined('ABSPATH') || die();

/**
 * Checks if a string exist in array
 */
function contains( $str, array $arr)  {

	foreach( $arr as $a ) {

		if ( stripos( $str, $a ) !== false ) return true;

	}

	return false;

}

/**
 * Check if WooCommerce is activated
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { 
      return true; 
    } else { 
      return false; 
    }
	}
}
