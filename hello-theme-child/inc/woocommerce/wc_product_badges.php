<?php
defined('ABSPATH') || die();

if ( is_woocommerce_activated() ) {
  /**
   * @snippet       Change "on sale" text badge on products loop to percentage
   * @author        Yiannis K.
   * @compatible    WooCommerce 3.5.4
   */

  add_filter( 'woocommerce_sale_flash', 'remove_sale_badge', 20, 3 );
  function remove_sale_badge( $html, $post, $product ) {
    return null;
  }

  //add_filter( 'woocommerce_sale_flash', 'add_percentage_to_sale_badge', 20, 3 );
  function add_percentage_to_sale_badge( $html, $post, $product ) {

    if ( $product->is_type('variable')) {
      $percentages = array();

      // Get all variation prices
      $prices = $product->get_variation_prices();

      // Loop through variation prices
      foreach( $prices['price'] as $key => $price ){
        // Only on sale variations
        if ( $prices['regular_price'][$key] !== $price ) {
          // Calculate and set in the array the percentage for each variation on sale
          // $percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
          // Fix
          $percentages[] = ( floatval( $prices['regular_price'][ $key ] ) - floatval( $price ) ) / floatval( $prices['regular_price'][ $key ] ) * 100;
        }
      }
      // We keep the highest value
      // $percentage = max($percentages) . '%';
      $percentage = max($percentages);
      $percentage = round( $percentage, 0 );
      $percentage = $percentage . '%';

    } elseif ( $product->is_type('grouped') ) { 
      $percentages = array();

      // Get all variation prices
      $children_ids = $product->get_children();

      // Loop through variation prices
      foreach ( $children_ids as $child_id ) {
        $child_product = wc_get_product( $child_id );

        $regular_price = (float) $child_product->get_regular_price();
        $sale_price    = (float) $child_product->get_sale_price();

        if ( $sale_price != 0 || ! empty($sale_price) ) {
          // Calculate and set in the array the percentage for each child on sale
          $percentages[] = round(100 - ( $sale_price / $regular_price * 100) );
        }
      }
      // We keep the highest value
      $percentage = max($percentages) . '%';

    } else {
        $regular_price = (float) $product->get_regular_price();
        $sale_price    = (float) $product->get_sale_price();

        if ( $sale_price != 0 || ! empty( $sale_price ) ) {
          $percentage    = round( 100 - ( $sale_price / $regular_price * 100 ) ) . '%';
        } else {
          return $html;
        }
    }
    // return '<span class="onsale">' . esc_html__( 'SALE', 'woocommerce' ) . ' ' . $percentage . '</span>';
    return '<span class="onsale">' . '-' . $percentage . '</span>';
  }

  /**
   * @snippet       Add "new" badge on products loop
   * @author        Yiannis K.
   * @compatible    WooCommerce 3.5.4
   */
  
  //add_action( 'woocommerce_before_shop_loop_item_title', 'ns4u_new_badge_shop_page', 3 );
  function ns4u_new_badge_shop_page() {
    global $product;
    $newness_days = 30;
    $created = strtotime( $product->get_date_created() );
    if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
      echo '<span class="ns4u-new onsale">' . esc_html__( 'New!', 'woocommerce' ) . '</span>';
    }
  }

  /**
   * @snippet       Add "sold" badge on products loop
   * @author        Yiannis K.
   * @compatible    WooCommerce 3.5.4
   */
  
  add_action( 'woocommerce_before_shop_loop_item_title', 'ns4u_display_sold_out_loop_woocommerce' );
  function ns4u_display_sold_out_loop_woocommerce() {
    global $product;
    if ( ! $product->is_in_stock() ) {
      echo '<span class="ns4u-soldout">' . esc_html__( 'Sold Out!', 'woocommerce' ) . '</span>';
    }
  }
}