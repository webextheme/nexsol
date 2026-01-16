<?php

// File Security Check
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
function nexsol_dynamic_styles() {
	/*
	* ====================================
	* =======  Enque Dynamic Styles ======
	* ====================================
	*/
	wp_enqueue_style( 'nexsol-theme-dynamic-styles', get_template_directory_uri() . '/assets/css/dynamic-styles.css', array(), '1.0.0', 'all' );
	$css_output = '';

	$body_font_color = nexsol_options('body_font_color');
	$heading_font_color = nexsol_options('heading_font_color');
	$webex_primary_color = nexsol_options('webex_primary_color');
	$webex_primary_color2 = nexsol_options('webex_primary_color2');
	$webex_primary_color3 = nexsol_options('webex_primary_color3');
	$webex_primary_color4 = nexsol_options('webex_primary_color4');
	$webex_secondary_color = nexsol_options('webex_secondary_color');
	$webex_secondary_color2 = nexsol_options('webex_secondary_color2');
	$webex_secondary_color3 = nexsol_options('webex_secondary_color3');
	$nexsol_header_button_bg = nexsol_options('nexsol_header_button_bg');
	$nexsol_header_button_bg_hover = nexsol_options('nexsol_header_button_bg_hover');
	$nexsol_header_button_text_color_normal = nexsol_options('nexsol_header_button_text_color_normal');
	$nexsol_header_button_text_color_hover = nexsol_options('nexsol_header_button_text_color_hover');

	if(!empty($webex_primary_color) || !empty($webex_primary_color2) || !empty($webex_primary_color3) || !empty($webex_primary_color4) || !empty($webex_secondary_color) || !empty($webex_secondary_color2) || !empty($webex_secondary_color3)){
		$css_output .= '
			:root {
				--body-font-color:'.esc_attr($body_font_color).';
				--heading-font-color:'.esc_attr($heading_font_color).';
				--webex-primary-color:'.esc_attr($webex_primary_color).';
				--webex-primary-color2:'.esc_attr($webex_primary_color2).';
				--webex-primary-color3:'.esc_attr($webex_primary_color3).';
				--webex-primary-color4:'.esc_attr($webex_primary_color4).';
				--webex-secondary-color:'.esc_attr($webex_secondary_color).';
				--webex-secondary-color2:'.esc_attr($webex_secondary_color2).';
				--webex-secondary-color3:'.esc_attr($webex_secondary_color3).';
			}
		';
	}

	if(!empty($nexsol_header_button_bg) || !empty($nexsol_header_button_bg_hover) || !empty($nexsol_header_button_text_color_normal) || !empty($nexsol_header_button_text_color_hover) || !empty($breadcrumb_bg)){
		$css_output .= '
			.header-contact-btn .cs-btn-one {
				background-color:'.esc_attr($nexsol_header_button_bg).';
			}
			.header-contact-btn .cs-btn-one:hover {
				background-color:'.esc_attr($nexsol_header_button_bg_hover).';
			}
			.header-contact-btn .cs-btn-one {
				color:'.esc_attr($nexsol_header_button_text_color_normal).';
			}
			.header-contact-btn .cs-btn-one:hover {
				color:'.esc_attr($nexsol_header_button_text_color_hover).';
			}
		';
	}

	wp_add_inline_style( 'nexsol-theme-dynamic-styles', $css_output );
}
add_action( 'wp_enqueue_scripts', 'nexsol_dynamic_styles' );
