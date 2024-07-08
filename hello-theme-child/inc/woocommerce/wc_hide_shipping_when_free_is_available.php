<?php
defined('ABSPATH') || die();
/**
 * Hide shipping rates when free shipping is available, but keep "Local pickup" 
 * Updated to support WooCommerce 2.6 Shipping Zones
 */
if ( is_woocommerce_activated() ) {
  add_filter( 'woocommerce_package_rates', 'hide_shipping_when_free_is_available', 10, 2 );
  function hide_shipping_when_free_is_available( $rates, $package ) {
    $new_rates = array();
    foreach ( $rates as $rate_id => $rate ) {
      // Only modify rates if free_shipping is present.
      if ( 'free_shipping' === $rate->method_id ) {
        $new_rates[ $rate_id ] = $rate;
        break;
      }
    }

    if ( ! empty( $new_rates ) ) {
      //Save local pickup if it's present.
      foreach ( $rates as $rate_id => $rate ) {
        if ('local_pickup' === $rate->method_id ) {
          $new_rates[ $rate_id ] = $rate;
          break;
        }
      }
      return $new_rates;
    }

    return $rates;
  }
}
