<?php
/**
 * Register custom Google Fonts.
 *
 * @since Nexsol
 * @return string Google Fonts URL for the theme.
 */
if ( ! function_exists( 'nexsol_fonts_url' ) ) :
  function nexsol_fonts_url() {
    $fonts_url = '';
    $font_families = array();

    // Translators: If there are characters in your language that are not supported by these fonts, translate this to 'off'.
    if ( 'off' !== _x( 'on', 'Bebas Neue font: on or off', 'nexsol' ) ) {
      $font_families[] = 'Bebas Neue:wght@400;500;600;700;800;900';
    }
    if ( 'off' !== _x( 'on', 'Work Sans font: on or off', 'nexsol' ) ) {
      $font_families[] = 'Work Sans:wght@400;500;600;700;800;900';
    }
    if ( 'off' !== _x( 'on', 'Lora font: on or off', 'nexsol' ) ) {
      $font_families[] = 'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
    }
    if ( ! empty( $font_families ) ) {
      $query_args = array(
        'family' => implode( '&family=', $font_families ),
        'display' => 'swap',
      );
      $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );
    }

    return esc_url_raw( $fonts_url );
  }
endif;
