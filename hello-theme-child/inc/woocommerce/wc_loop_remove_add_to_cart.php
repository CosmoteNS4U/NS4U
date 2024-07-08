<?php
defined('ABSPATH') || die();

if ( is_woocommerce_activated() ) {
  remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
}
