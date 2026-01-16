<?php
/**
 * Nexsol functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nexsol
 */

$theme   = wp_get_theme();
$name    = $theme->parent() == false ? wp_get_theme()->get( 'Name' ) : wp_get_theme()->parent()->get( 'Name' );
$version = $theme->parent() == false ? wp_get_theme()->get( 'Version' ) : wp_get_theme()->parent()->get( 'Version' );

/*
 * Constants
 *
 * Define Default Path Variables
 */
define('NEXSOL_NAME', $name );
define('NEXSOL_VERSION', $version );
define('NEXSOL_THEME_URI', get_template_directory_uri());
define('NEXSOL_THEME_DIR', get_template_directory());
define('NEXSOL_DIR_CSS', get_template_directory_uri(). '/assets/css/');
define('NEXSOL_DIR_JS', get_template_directory_uri(). '/assets/js/');
define('NEXSOL_DIR_FONTS', get_template_directory_uri(). '/assets/fonts/');
define('NEXSOL_DIR_IMAGES', get_template_directory_uri(). '/assets/images/');
define('NEXSOL_DIR_ADMID_CSS', get_template_directory_uri(). '/admin/assets/css/');

/*
 * After setup theme
 */
require NEXSOL_THEME_DIR . '/inc/theme-setup.php';

/*
 * Woo Theme Support
 */
if ( ! function_exists( 'nexsol_woocommerce_support' ) ) {
	function nexsol_woocommerce_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
	add_action( 'after_setup_theme', 'nexsol_woocommerce_support' );
}

/**
 * Remove Action Hook
 */

function nexsol_woo_theme_init(){
    $nexsol_exlude_hooks = require NEXSOL_THEME_DIR . '/inc/remove_actions.php';
    foreach( $nexsol_exlude_hooks as $k => $v )
    {
        foreach( $v as $value )
            remove_action( $k, $value[0], $value[1] );
    }
}
add_action( 'init', 'nexsol_woo_theme_init');

/*
* Include Externel PHP Files
*/
require NEXSOL_THEME_DIR . '/inc/lib/wp_bootstrap_navwalker.php';
require NEXSOL_THEME_DIR . '/inc/enqueue.php';
require NEXSOL_THEME_DIR . '/inc/widgets-register.php';
require NEXSOL_THEME_DIR . '/inc/google-fonts-register.php';
require NEXSOL_THEME_DIR . '/inc/helper-functions.php';
require NEXSOL_THEME_DIR . '/inc/dark-mood-functions.php';
require NEXSOL_THEME_DIR . '/inc/header-elementor-functions.php';
require NEXSOL_THEME_DIR . '/inc/helper-hooks.php';

/**
 * TGM Plugin Activation Path.
 */
require NEXSOL_THEME_DIR . '/inc/lib/tgm/plugin-activation.php';
require NEXSOL_THEME_DIR . '/inc/lib/tgm/demo-content.php';

