<?php
defined('ABSPATH') || die();

if ( is_woocommerce_activated() ) {
  // Merge description and additional information product tabs
  add_filter( 'woocommerce_product_tabs', 'ns4u_merged_product_tabs_in_summary', 98 );
  function ns4u_merged_product_tabs_in_summary( $tabs ) {
    
    if ( empty($tabs['additional_information']) && empty($tabs['description']) ) {
      unset( $tabs['additional_information'] );
      unset( $tabs['description'] );
      return $tabs;
    } 
    
    if ( !empty($tabs['additional_information']) && !empty($tabs['description']) ) {
      // Custom description callback.
      $tabs['description']['callback'] = function() {
        global $post, $product;
        echo '<div class="ns4u-merged-tabs">';
      
        // Display the content of the Description tab.
        echo '<div class="elementor-column elementor-col-100 elementor-top-column elementor-element column-description">';
        //echo '<h2 class="ns4u-merged-tabs--title">Περιγραφή</h2>';
        echo '<div class="ns4u-merged-tabs--content description">';
        the_content();
        echo '</div>';
        echo '</div>';
    
          // Display the heading and content of the Additional Information tab.
        echo '<div class="elementor-column elementor-col-100 elementor-top-column elementor-element column-attributes">';
          //echo '<h2 class="ns4u-merged-tabs--title">Χαρακτηριστικά</h2>';
        echo '<div class="ns4u-merged-tabs--content attributes">';
          do_action( 'woocommerce_product_additional_information', $product );
        echo '</div>';
        echo '</div>';
      
        echo '</div>'; // elementor-container elementor-column-gap-default
      };
      
      // Remove the additional information tab.
      unset( $tabs['additional_information'] );
    }



    return $tabs;
  }
}