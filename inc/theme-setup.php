<?php
/*
 * After setup theme
 */

 if ( ! function_exists( 'nexsol_theme_support' ) ) :

	function nexsol_theme_support() {

		// make the theme available for translation
		// $lang_dir = BLO_THEME_DIR . '/languages';
		load_theme_textdomain( 'nexsol', NEXSOL_THEME_DIR . '/languages' );

		// add support for automatic feed links
		add_theme_support('automatic-feed-links');

		// let WordPress manage the document title
		add_theme_support('title-tag');

		// Switches default core markup for search form, comment form, and comments
		// to output valid HTML5.
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		add_theme_support( 'responsive-embeds' );

		// remove block widget support
		remove_theme_support( 'widgets-block-editor' );

		// Add support for core custom logo
		function nexsol_theme_custom_logo() {
			add_theme_support('custom-logo', array(
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array('site-title', 'site-description'),
			));
		}
		add_action('after_setup_theme', 'nexsol_theme_custom_logo');

		// Align wide
		add_theme_support( 'align-wide' );

		// Block style
		add_theme_support( 'wp-block-styles' );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'nexsol_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Editor style
		function nexsol_add_editor_styles() {
			add_editor_style('editor-style.css');
		}
		add_action('after_setup_theme', 'nexsol_add_editor_styles');

		// register_block_style
		function nexsol_register_block_styles() {
			register_block_style(
				'core/paragraph',
				array(
					'name'  => 'fancy-paragraph',
					'label' => __( 'Fancy Paragraph', 'nexsol' ),
				)
			);
		}
		add_action( 'init', 'nexsol_register_block_styles' );

		// custom-header
		function nexsol_custom_header_setup() {
			add_theme_support( 'custom-header', array(
					'default-image' => get_template_directory_uri() . '/assets/images/header/1.png',
					'width'         => 1000,
					'height'        => 250,
					'flex-width'    => true,
					'flex-height'   => true,
			) );
		}
		add_action( 'after_setup_theme', 'nexsol_custom_header_setup' );

		// register_block_pattern
		function nexsol_register_block_patterns() {
			register_block_pattern(
				'nexsol/hero-section',
				array(
					'title'       => __( 'Hero Section', 'nexsol' ),
					'description' => _x( 'A custom hero section with image and text', 'Block pattern description', 'nexsol' ),
					'content'     => '<!-- wp:paragraph --><p>Your content here...</p><!-- /wp:paragraph -->',
				)
			);
		}
		add_action( 'init', 'nexsol_register_block_patterns' );


    // Set post thumbnail size.
		set_post_thumbnail_size(1200, 640, true);

		// add support for post thumbnails
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'nexsol-image(1320x620)', 1320, 620, true );
		add_image_size( 'nexsol-image(1520x775)', 1520, 775, true );
		add_image_size( 'nexsol-image(730x430)', 730, 430, true );
		add_image_size( 'nexsol-image(750x320)', 750, 320, true );
		add_image_size( 'nexsol-image(340x600)', 340, 600, true );
		add_image_size( 'nexsol-image(630x630)', 630, 630, true );
		add_image_size( 'nexsol-image(545x645)', 545, 645, true );
		add_image_size( 'nexsol-image(480x570)', 480, 570, true );
		add_image_size( 'nexsol-image(530x370)', 530, 370, true );
		add_image_size( 'nexsol-image(315x375)', 315, 370, true );
		add_image_size( 'nexsol-image(420x420)', 420, 420, true );
		add_image_size( 'nexsol-image(300x300)', 300, 300, true );
		add_image_size( 'nexsol-image(90x90)', 90, 90, true );
		add_image_size( 'nexsol-image(72x72)', 72, 72, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'    => esc_html__( 'Primary Menu', 'nexsol' ),
			'header_topbar_menu' => esc_html__( 'Header Topbar Menu', 'nexsol' ),
			'footer_menu' => esc_html__( 'Footer Menu', 'nexsol' ),
			'sidebar_service_menu' => esc_html__( 'Sidebar Service Menu', 'nexsol' ),
			'footer_service_menu' => esc_html__( 'Footer Service Menu', 'nexsol' ),
		) );

	}
endif;
add_action('after_setup_theme', 'nexsol_theme_support');


//Set the content width in pixels, based on the theme's design and stylesheet.
function nexsol_content_width() {

	//Default content width.
	$GLOBALS['content_width'] = apply_filters( 'nexsol_content_width', 1140 );
}
add_action( 'after_setup_theme', 'nexsol_content_width', 0 );

// wp_body_open
if ( !function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/*
* Remove Extra p tag from contact form 7
*/
add_filter('wpcf7_autop_or_not', '__return_false');

// remove block widget support
remove_theme_support( 'widgets-block-editor' );