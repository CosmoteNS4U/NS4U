
<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {
	
	wp_enqueue_style( 'hello-elementor-child-style', get_stylesheet_directory_uri() . '/style.css', [ 'hello-elementor-theme-style', ], HELLO_ELEMENTOR_CHILD_VERSION	);

}

add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );

/**
 * Require files
 */

require_once( 'inc/helpers/helpers.php' );

require_once( 'inc/utilities/svg.php' );
require_once( 'inc/utilities/hide_users_rest.php' );
require_once( 'inc/utilities/disable_xmlrpc.php' );

// require_once( 'inc/woocommerce/wc_product_badges.php' );
require_once( 'inc/woocommerce/wc_single_attributes_move_weight_down.php' );
// require_once( 'inc/woocommerce/wc_single_custom_tabs.php' );
// require_once( 'inc/woocommerce/wc_single_merge_product_tabs.php' );
require_once( 'inc/woocommerce/wc_hide_shipping_when_free_is_available.php' );
require_once( 'inc/woocommerce/wc_loop_remove_add_to_cart.php' );
// require_once( 'inc/woocommerce/wc_loop_display_attributes.php' );
