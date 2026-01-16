<?php
/**
 * Dark Mood Related Functions
 *
 * @package nexsol
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Get Current Page/Post ID
if ( ! function_exists( 'nexsol_get_page_id' ) ) {
	function nexsol_get_page_id() {
		$page_id = 0;
		if ( is_singular() ) {
			$page_id = get_the_ID();
		} elseif ( is_home() && get_option( 'page_for_posts' ) ) {
			$page_id = (int) get_option( 'page_for_posts' );
		} elseif ( is_front_page() && get_option( 'page_on_front' ) ) {
			$page_id = (int) get_option( 'page_on_front' );
		}
		return $page_id;
	}
}

// Get Theme Option Values
if ( ! function_exists( 'nexsol_get_option' ) ) {
  function nexsol_get_option( $key = '', $default = false ) {
    $option_key = 'nexsol_Theme_Option';
    $options    = get_option( $option_key, [] );
    if ( isset( $options[$key] ) ) {
      return $options[$key];
    }
    return $default;
  }
}

// Get Page Meta Value
if ( ! function_exists( 'nexsol_get_meta' ) ) {
  function nexsol_get_meta( $key, $post_id = null ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    //Codestar Save All Meta Together As A Option Array
    $meta = get_post_meta( $post_id, 'nexsol_metabox', true );
    if ( isset( $meta[$key] ) ) {
      return $meta[$key];
    }
    return false;
  }
}

if ( ! function_exists( 'nexsol_layout_settings_add_attr_to_html' ) ) {
  function nexsol_layout_settings_add_attr_to_html( $output ) {
    $current_page_id = function_exists( 'nexsol_get_page_id' ) ? (int) nexsol_get_page_id() : 0;

    // 1) Page meta (dark|light|default)
    $page_layout_mode = '';
    if ( function_exists( 'nexsol_get_meta' ) ) {
      $page_layout_mode = (string) nexsol_get_meta( 'layout_mode', $current_page_id );
      $page_layout_mode = strtolower( trim( $page_layout_mode ) );
    }

    // 2) Global option (bool)
    $global_dark_mode = false;
    if ( function_exists( 'nexsol_get_option' ) ) {
      $global_dark_mode = (bool) nexsol_get_option( 'general-settings-enable-dark-mode', false );
    }

    // 3) Fresh install default (true = dark, false = light)
    $fresh_install_dark = false;

    // Only check your custom plugin (ThemeForest-safe)
    $plugin_slug = 'nexsol-core/webex-core.php';
    $active_plugins = (array) get_option( 'active_plugins', array() );
    $nexsol_plugin_active = in_array( $plugin_slug, $active_plugins, true );

    // ===== Decision order =====
    if ( $page_layout_mode === 'dark' ) {
      $layout = 'dark';
    } elseif ( $page_layout_mode === 'light' ) {
      $layout = 'light';
    } elseif ( $global_dark_mode ) {
      $layout = 'dark';
    } elseif ( ! $nexsol_plugin_active && $fresh_install_dark ) {
      $layout = 'dark';
    } else {
      $layout = 'light';
    }

    // Append valid HTML5 data attribute
    $output .= ' data-layout-mood="' . esc_attr( $layout ) . '"';

    return $output;
  }
  add_filter( 'language_attributes', 'nexsol_layout_settings_add_attr_to_html', 999 );
}

if ( ! function_exists( 'nexsol_layout_settings_body_class' ) ) {
  function nexsol_layout_settings_body_class( $classes ) {
    $current_page_id = function_exists( 'nexsol_get_page_id' ) ? (int) nexsol_get_page_id() : 0;

    $page_layout_mode = '';
    if ( function_exists( 'nexsol_get_meta' ) ) {
      $page_layout_mode = strtolower( trim( (string) nexsol_get_meta( 'layout_mode', $current_page_id ) ) );
    }

    $global_dark_mode = false;
    if ( function_exists( 'nexsol_get_option' ) ) {
      $global_dark_mode = (bool) nexsol_get_option( 'general-settings-enable-dark-mode', false );
    }

    $fresh_install_dark = false;

    $plugin_slug = 'nexsol-core/webex-core.php';
    $active_plugins = (array) get_option( 'active_plugins', array() );
    $nexsol_plugin_active = in_array( $plugin_slug, $active_plugins, true );

    if ( $page_layout_mode === 'dark' || ( $page_layout_mode !== 'light' && ( $global_dark_mode || ( ! $nexsol_plugin_active && $fresh_install_dark ) ) ) ) {
      $classes[] = 'mood-dark';
    } else {
      $classes[] = 'mood-light';
    }

    return $classes;
  }
  add_filter( 'body_class', 'nexsol_layout_settings_body_class', 20 );
}

