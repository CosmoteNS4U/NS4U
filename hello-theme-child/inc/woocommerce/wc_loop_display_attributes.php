<?php
defined('ABSPATH') || die();

if ( is_woocommerce_activated() ) {
  add_action('woocommerce_shop_loop_item_title', 'ns4u_display_custom_product_attributes_on_loop', 5 );
  function ns4u_display_custom_product_attributes_on_loop() {
    global $product;

    // Settings: Here below set your product attribute label names
    $attributes_names = array('Brand');

    $attributes_data  = array(); // Initializing

    // Loop through product attribute settings array
    foreach ( $attributes_names as $attribute_name ) {
        if ( $value = $product->get_attribute($attribute_name) ) {
            $attributes_data[] = $value;
        }
    }

    if ( ! empty($attributes_data) ) {
        echo '<div class="product-attribute product-attribute-' . $attribute_name . ' ' . $attribute_name .'"><span>' . implode( ' | ', $attributes_data ) . '</span></div>';
    }
  }
}
