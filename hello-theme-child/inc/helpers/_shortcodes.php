<?php
defined('ABSPATH') || die();

/**
 * Do hook when it's not available by using a shortcode
 * Usage: [do_hook hook="the_hook_i_want_to_run"]
 */
add_shortcode( 'do_hook', function( $atts = array(), $content = null, $tag = ''){
	if ( isset( $atts['hook'] ) ) {
		do_action( $atts['hook'] );
	}
	return;
});
