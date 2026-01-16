<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Nexsol for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/inc/lib/tgm/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'nexsol_register_required_plugins' );

function nexsol_register_required_plugins() {
	$plugins = array(
		array(
			'name'                     => esc_html__( 'Nexsol Elementor Widgets', 'nexsol' ),
			'slug'                     => 'nexsol-core',
			'required'                 => true,
			'source'                   => get_template_directory() . '/inc/lib/tgm/plugins/nexsol-core.zip',
		),
		array(
			'name'                     => esc_html__( 'Nexsol Theme Core', 'nexsol' ),
			'slug'                     => 'nexsol-elementor-core',
			'required'                 => true,
			'source'                   => get_template_directory() . '/inc/lib/tgm/plugins/nexsol-elementor-core.zip',
		),
		array(
			'name'      => esc_html__( 'Elementor Page Builder', 'nexsol' ),
			'slug'      => 'elementor',
			'required'  => true,
		),
		array(
			'name'      => esc_html__( 'Widget Importer & Exporter', 'nexsol' ),
			'slug'      => 'widget-importer-exporter',
			'required'  => false,
		),
		array(
			'name'      => esc_html__( 'SVG Support', 'nexsol' ),
			'slug'      => 'svg-support',
			'required'  => false,
		),
		array(
			'name'      => esc_html__( 'One Click Demo Import', 'nexsol' ),
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),
		array(
			'name'      => esc_html__('Mailchimp','nexsol'),
			'slug'      => 'mailchimp-for-wp',
			'required'  => false,
		),
		array(
			'name'      => esc_html__( 'Contact Form 7', 'nexsol' ),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		array(
			'name'      => esc_html__( 'WooCommerce', 'nexsol' ),
			'slug'      => 'woocommerce',
			'required'  => true,
		),
		array(
			'name'      => esc_html__( 'YITH WooCommerce Quick View', 'nexsol' ),
			'slug'      => 'yith-woocommerce-quick-view',
			'required'  => true,
		),
		array(
			'name'      => esc_html__( 'YITH WooCommerce Wishlist', 'nexsol' ),
			'slug'      => 'yith-woocommerce-wishlist',
			'required'  => true,
		),

	);
	$config = array(
		'id'           => 'nexsol',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

tgmpa( $plugins, $config );
}
