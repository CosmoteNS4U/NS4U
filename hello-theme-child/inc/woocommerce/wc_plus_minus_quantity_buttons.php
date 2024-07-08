<?php
defined('ABSPATH') || die();

if ( is_woocommerce_activated() ) {
  // 1. Show plus minus buttons
  add_action( 'woocommerce_after_quantity_input_field', 'ns4u_display_quantity_plus' );
  function ns4u_display_quantity_plus() {
    echo '<button type="button" class="plus">+</button>';
  }

  add_action( 'woocommerce_before_quantity_input_field', 'ns4u_display_quantity_minus' );
  function ns4u_display_quantity_minus() {
    echo '<button type="button" class="minus">-</button>';
  }
    
  // -------------
  // 2. Trigger update quantity script
    
  add_action( 'wp_footer', 'ns4u_add_cart_quantity_plus_minus' );
  function ns4u_add_cart_quantity_plus_minus() {
  
    if ( ! is_product() && ! is_cart() ) return;
      
    wc_enqueue_js( "
    
        $( '<button type=\"button\" class=\"minus\">-</button>' ).insertBefore( '.tm-quantity input' );
        $( '<button type=\"button\" class=\"plus\">+</button>' ).insertAfter( '.tm-quantity input' );
            
        $(document).on( 'click', 'button.plus, button.minus', function() {
    
          var qty = $( this ).parent( '.quantity' ).find( '.qty' );
          var val = parseFloat(qty.val());
          var max = parseFloat(qty.attr( 'max' ));
          var min = parseFloat(qty.attr( 'min' ));
          var step = parseFloat(qty.attr( 'step' ));
  
          if ( $( this ).is( '.plus' ) ) {
              if ( max && ( max <= val ) ) {
                qty.val( max ).change();
              } else {
                qty.val( val + step ).change();
              }
          } else {
              if ( min && ( min >= val ) ) {
                qty.val( min ).change();
              } else if ( val > 1 ) {
                qty.val( val - step ).change();
              }
          }
  
        });
          
    " );
  }
}
