<?php

/**
 * Enqueue CSS and JS
 * @subpackage Nexsol
 */
function nexsol_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'nexsol-fonts', nexsol_fonts_url(), array(), null );

	/** All frontend css files **/
	if( is_rtl() ) {
		wp_enqueue_style( 'bootstrap', NEXSOL_DIR_CSS . 'bootstrap.rtl.min.css', [], NEXSOL_VERSION, 'all' );
	} else {
		wp_enqueue_style( 'bootstrap', NEXSOL_DIR_CSS . 'bootstrap.min.css', [], NEXSOL_VERSION, 'all' );
	}


	wp_enqueue_style( 'fontawesome', NEXSOL_DIR_FONTS . 'fontawesome/css/all.css', [], NEXSOL_VERSION, 'all' );
	wp_enqueue_style( 'webex-baseicon', NEXSOL_DIR_FONTS . 'webexbaseicon/style.css', [], NEXSOL_VERSION, 'all' );
	wp_enqueue_style( 'nice-select', NEXSOL_DIR_CSS . 'nice-select.css', [], NEXSOL_VERSION, 'all' );
	wp_enqueue_style( 'splitting', NEXSOL_DIR_CSS . 'splitting.css', [], NEXSOL_VERSION, 'all' );
	wp_enqueue_style( 'owl-carosel', NEXSOL_DIR_CSS . 'owl.carousel.min.css', [], NEXSOL_VERSION, 'all' );
	wp_enqueue_style( 'magnific-popup', NEXSOL_DIR_CSS . 'magnific-popup.css', [], NEXSOL_VERSION, 'all' );
	wp_enqueue_style( 'fancybox', NEXSOL_DIR_CSS . 'jquery.fancybox.min.css', [], NEXSOL_VERSION, 'all' );
	wp_enqueue_style( 'animate', NEXSOL_DIR_CSS . 'animate.css', [], NEXSOL_VERSION, 'all' );
	// theme stylesheet
	$style_rtl_suffix = is_rtl() ? '-rtl' : '';
	wp_enqueue_style( 'nexsol-style', NEXSOL_DIR_CSS . 'style' . $style_rtl_suffix . '.css', array(), NEXSOL_VERSION );

	$responsive_rtl_suffix = is_rtl() ? '-rtl' : '';
	wp_enqueue_style( 'nexsol-responsive', NEXSOL_DIR_CSS . 'responsive' . $responsive_rtl_suffix . '.css', array(), NEXSOL_VERSION );

	if ( ! function_exists( 'nexsol_enqueue_woocommerce_styles' ) ) {
		function nexsol_enqueue_woocommerce_styles() {
			if ( class_exists( 'WooCommerce' ) ) {
				wp_enqueue_style( 'custom-woocommerce-style', NEXSOL_DIR_CSS . 'custom-woocommerce.css', [], NEXSOL_VERSION, 'all' );
			}
		}
		add_action( 'wp_enqueue_scripts', 'nexsol_enqueue_woocommerce_styles', 20 );
	}

	//===========//
	/** All frontend javascripts files **/
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'nice-select', NEXSOL_DIR_JS . 'jquery.nice-select.min.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'bootstrap', NEXSOL_DIR_JS . 'bootstrap.min.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'appear', NEXSOL_DIR_JS . 'jquery.appear.min.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'wow', NEXSOL_DIR_JS . 'wow.min.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'owl-carousel', NEXSOL_DIR_JS . 'owl.carousel.min.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'event-move', NEXSOL_DIR_JS . 'jquery.event.move.js', array( 'jquery' ), NEXSOL_VERSION, true );
	//=== Gsap Animation Start ===//
	wp_enqueue_script( 'Split-Type', NEXSOL_DIR_JS . 'split-type.js', array( 'jquery' ), NEXSOL_VERSION, true );
	//=== Gsap Animation Start ===//
	wp_enqueue_script( 'gsap-plugins', NEXSOL_DIR_JS . 'gsap-plugins.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'SmoothScroll', NEXSOL_DIR_JS . 'SmoothScroll.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'gsap-trigger', NEXSOL_DIR_JS . 'gsap-trigger.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'gsap-title-animations', NEXSOL_DIR_JS . 'gsap-title-animations.js', array( 'jquery' ), NEXSOL_VERSION, true );
	//=== Parallax Start ===//
	wp_enqueue_script( 'ukiyo', NEXSOL_DIR_JS . 'ukiyo.min.js', array( 'jquery' ), NEXSOL_VERSION, true );
	//=== Image Distortion Effect Start ===//
	wp_enqueue_script( 'three', NEXSOL_DIR_JS . 'three.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'hover-effect-umd', NEXSOL_DIR_JS . 'hover-effect.umd.js', array( 'jquery' ), NEXSOL_VERSION, true );
	//=== Splitt Animation Start ===//
	wp_enqueue_script( 'sticky-content', NEXSOL_DIR_JS . 'sticky-content.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'tilt', NEXSOL_DIR_JS . 'tilt.jquery.min.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'magnific-popup', NEXSOL_DIR_JS . 'magnific-popup.min.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'fancybox', NEXSOL_DIR_JS . 'jquery.fancybox.min.js', array( 'jquery' ), NEXSOL_VERSION, true );
	wp_enqueue_script( 'backtotop', NEXSOL_DIR_JS . 'backtotop.js', array( 'jquery' ), NEXSOL_VERSION, true );
	// enqueue the javascript that performs in-link comment reply fanciness
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'trigger-scripts', NEXSOL_DIR_JS . 'trigger.js', array( 'jquery' ), NEXSOL_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'nexsol_scripts' );

/**
 * Admin Enqueue Scripts.
 */
if(!function_exists('nexsol_admin_scripts')) {
	/** Admin css **/
	function nexsol_admin_scripts() {
		wp_enqueue_style( 'nexsol-custom-admin', NEXSOL_DIR_ADMID_CSS . 'admin-styles.css', [], NEXSOL_VERSION, 'all' );
	}
}
add_action( 'admin_enqueue_scripts',  'nexsol_admin_scripts' );
