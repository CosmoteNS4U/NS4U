<?php
defined('ABSPATH') || die();

if ( is_woocommerce_activated() ) {
	add_filter( 'woocommerce_product_tabs', 'ns4u_extra_custom_product_tabs' );

	function ns4u_extra_custom_product_tabs( $tabs ) {
		
		// first tab
		$tabs[ 'ns4u_tab1' ] = array(
			'title'    => __( 'Τρόποι Πληρωμής', 'hello-elementor-child' ),
			'callback' => 'ns4u_tabs_callback',
			'priority' => 40,
		);
		
		// second tab
		$tabs[ 'ns4u_tab2' ] = array(
			'title'    => __( 'Αποστολές', 'hello-elementor-child' ),
			'callback' => 'ns4u_tabs_callback',
			'priority' => 50,
		);
		
		return $tabs;
		
	}

	// we use the only callback function for all the tabs
	function ns4u_tabs_callback( $slug, $tab ) {
		
		// display tab heading for every tab
		echo '<h2>' . $tab[ 'title' ] . '</h2>';
			
		if ( 'ns4u_tab1' === $slug ) {
			echo do_shortcode( '[elementor-template id="537"]' );
		}
		
		if ( 'ns4u_tab2' === $slug ) {
			echo do_shortcode( '[elementor-template id="540"]' );
		}
	}


	// Move Weight to bottom
	add_filter( 'woocommerce_display_product_attributes', 'woocommerce_sort_product_attributes', 10, 2 );
	function woocommerce_sort_product_attributes ( $product_attributes, $product ) {
		ksort( $product_attributes );
		return $product_attributes;
	}
}
