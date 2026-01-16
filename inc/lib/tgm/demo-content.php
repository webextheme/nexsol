<?php
/**
 * One Click Demo Import Setup
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Security: Prevent direct access
}

/**
 * Register Demo Import Files
 */
function nexsol_ocdi_import_files() {
  return array(
    array(
      'import_file_name'             => 'Home Layout1',
      'categories'                   => array( 'Multipage' ),
      'local_import_file'            => get_theme_file_path( 'inc/lib/tgm/demo-1/xml.xml' ),
      'local_import_widget_file'     => get_theme_file_path( 'inc/lib/tgm/demo-1/wie.wie' ),
      'local_import_customizer_file' => get_theme_file_path( 'inc/lib/tgm/demo-1/dat.dat' ),
      'local_import_json'            => array(
        array(
          'file_path'   => get_theme_file_path( 'inc/lib/tgm/demo-1/json.json' ),
          'option_name' => 'nexsol_Theme_Option',
        ),
      ),
      'import_preview_image_url'     => get_theme_file_uri( 'inc/lib/tgm/demo-1/demo.png' ),
      'preview_url'                  => 'https://webextheme.com/wp/nexsol/',
      'import_notice'                => esc_html__( 'Import this demo on a fresh install with all required plugins activated.', 'nexsol' ),
    ),
  );
}
add_filter( 'ocdi/import_files', 'nexsol_ocdi_import_files' );

/**
 * After Import Setup
 */
if ( ! function_exists( 'nexsol_after_import' ) ) {
  function nexsol_after_import() {

    // ===== Theme Options Fallback =====
    $opt_key   = 'nexsol_Theme_Option';
    $json_path = get_theme_file_path( 'inc/lib/tgm/demo-1/json.json' );
    if ( file_exists( $json_path ) ) {
      $raw  = file_get_contents( $json_path );
      $data = json_decode( $raw, true );
      if ( is_array( $data ) && ! empty( $data ) ) {
        update_option( $opt_key, $data );
      }
    }

    // ===== Assign Menus =====
    $primary              = get_term_by( 'name', 'Header Primary Menu', 'nav_menu' );
    $sidebar_service_menu = get_term_by( 'name', 'Sidebar Service Nav Menu', 'nav_menu' );
    $footer_service_menu  = get_term_by( 'name', 'Footer Service Nav Menu', 'nav_menu' );

    set_theme_mod(
      'nav_menu_locations',
      array(
        'primary'              => $primary ? $primary->term_id : 0,
        'sidebar_service_menu' => $sidebar_service_menu ? $sidebar_service_menu->term_id : 0,
        'footer_service_menu'  => $footer_service_menu ? $footer_service_menu->term_id : 0,
      )
    );

    // ===== Set Front & Blog Pages =====
    $front = get_page_by_title( 'Home Layout1' );
    $blog  = get_page_by_title( 'News Standard' );
    if ( $front && $blog ) {
      update_option( 'show_on_front', 'page' );
      update_option( 'page_on_front',  $front->ID );
      update_option( 'page_for_posts', $blog->ID );
    }

    // ===== Elementor CPT Support =====
    $elementor_cpt_support = array(
      'post',
      'page',
      'wbx_header_builder',
      'wbx_footer_builder',
      'wbx_side_panel',
      'webex_projects',
      'webex_gallery',
    );
    update_option( 'elementor_cpt_support', $elementor_cpt_support );

    // ===== Elementor Defaults =====
    update_option( 'elementor_disable_color_schemes', 'yes' );
    update_option( 'elementor_disable_typography_schemes', 'yes' );
    update_option( 'elementor_allow_tracking', 'no' );
    update_option( 'elementor_global_image_lightbox', 'yes' );

    // ===== Permalink Structure =====
    global $wp_rewrite;
    $desired_structure = '/%postname%/';
    if ( $wp_rewrite->permalink_structure !== $desired_structure ) {
      $wp_rewrite->set_permalink_structure( $desired_structure );
      update_option( 'permalink_structure', $desired_structure );
    }
    flush_rewrite_rules( true );
  }
  add_action( 'ocdi/after_import', 'nexsol_after_import' );
}
