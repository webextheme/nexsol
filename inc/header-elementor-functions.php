<?php
/**
 * Header Related Functions
 *
 * @package nexsol
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * Get custom Elementor Header ID
 *
 * @param string $type Header type (e.g., 'solid', 'transparent').
 * @return array|false Header data array or false.
 */
function nexsol_get_header_id( $type = 'solid' ) {
  global $post;

  if ( ! $post || ! isset( $post->ID ) ) {
    return false;
  }

  $return = array(
    'id'     => '',
    'source' => '',
  );

  // Check Codestar Framework meta option first
  if ( function_exists( 'cs_get_meta' ) ) {
    $meta_id = cs_get_meta( $post->ID, 'custom_header_builder_' . sanitize_key( $type ) );
  } else {
    // fallback: check serialized post meta
    $metabox = get_post_meta( $post->ID, 'nexsol_metabox', true );
    $meta_id = isset( $metabox[ 'custom_header_builder_' . $type ] ) ? $metabox[ 'custom_header_builder_' . $type ] : '';
  }

  if ( ! empty( $meta_id ) && 'default' !== $meta_id ) {
    $return['id']     = $meta_id;
    $return['source'] = 'meta';
    return $return;
  }

  // fallback → theme option
  if ( function_exists( 'nexsol_options' ) ) {
    $option_id = nexsol_options( 'header_builder_' . $type );
    if ( ! empty( $option_id ) ) {
      $return['id']     = $option_id;
      $return['source'] = 'option';
      return $return;
    }
  }

  return false;
}


//===============================
// Elementor Custom Build Header
//===============================
function nexsol_render_header() {

  $solid_header       = nexsol_get_header_id('solid');
  $transparent_header = nexsol_get_header_id('transparent');
  $sticky_header      = nexsol_get_header_id('sticky');

  // Check if any meta override exists
  $has_meta = (
    ($solid_header && $solid_header['source'] === 'meta') ||
    ($transparent_header && $transparent_header['source'] === 'meta') ||
    ($sticky_header && $sticky_header['source'] === 'meta')
  );

  // Solid header (theme option fallback if no meta)
  if ( ! $has_meta && $solid_header && $solid_header['id'] ) {
    get_template_part( 'inc/header/header', 'solid', array( 'header_id' => $solid_header['id'] ) );
  }

  // Solid meta override
  if ( $solid_header && $solid_header['id'] && $solid_header['source'] === 'meta' ) {
    get_template_part( 'inc/header/header', 'solid', array( 'header_id' => $solid_header['id'] ) );
  }

  // Transparent header (theme option fallback if no meta)
  if ( ! $has_meta && $transparent_header && $transparent_header['id'] ) {
    get_template_part( 'inc/header/header', 'transparent', array( 'header_id' => $transparent_header['id'] ) );
  }

  // Transparent meta override
  if ( $transparent_header && $transparent_header['id'] && $transparent_header['source'] === 'meta' ) {
    get_template_part( 'inc/header/header', 'transparent', array( 'header_id' => $transparent_header['id'] ) );
  }

  // Sticky header (theme option fallback if no meta)
  if ( ! $has_meta && $sticky_header && $sticky_header['id'] ) {
    get_template_part( 'inc/header/header', 'sticky', array( 'header_id' => $sticky_header['id'] ) );
  }

  // Sticky meta override
  if ( $sticky_header && $sticky_header['id'] && $sticky_header['source'] === 'meta' ) {
    get_template_part( 'inc/header/header', 'sticky', array( 'header_id' => $sticky_header['id'] ) );
  }

  // Default fallback
  if (
    ( ! $solid_header || empty( $solid_header['id'] ) ) &&
    ( ! $transparent_header || empty( $transparent_header['id'] ) ) &&
    ( ! $sticky_header || empty( $sticky_header['id'] ) )
  ) {
    get_template_part( 'inc/header/header', 'default' );
  }
}
add_action( 'nexsol_render_header', 'nexsol_render_header' );
