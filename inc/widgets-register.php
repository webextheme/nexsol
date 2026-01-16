<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

// Widget Sidebar
function nexsol_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'nexsol' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in Blog Sidebar', 'nexsol' ),
		'before_widget' => '<div id="%1$s" class="blog-sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Service Sidebar', 'nexsol' ),
		'id'            => 'service-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in Service Sidebar', 'nexsol' ),
		'before_widget' => '<div id="%1$s" class="service-sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="service__widget-title">',
		'after_title'   => '</h4>'
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Project Sidebar', 'nexsol' ),
		'id'            => 'project-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in Project Sidebar', 'nexsol' ),
		'before_widget' => '<div id="%1$s" class="project-sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="project__widget-title">',
		'after_title'   => '</h4>'
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget One', 'nexsol' ),
		'id'            => 'footer-widget-1',
		'description'   => esc_html__( 'Add widgets here to appear in Footer Widget.', 'nexsol' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget mrr-60 mrr-md-0 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Two', 'nexsol' ),
		'id'            => 'footer-widget-2',
		'description'   => esc_html__( 'Add widgets here to appear in Footer Widget.', 'nexsol' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Three', 'nexsol' ),
		'id'            => 'footer-widget-3',
		'description'   => esc_html__( 'Add widgets here to appear in Footer Widget.', 'nexsol' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Four', 'nexsol' ),
		'id'            => 'footer-widget-4',
		'description'   => esc_html__( 'Add widgets here to appear in Footer Widget.', 'nexsol' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	//Default Footer Widgets
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Default Widget One', 'nexsol' ),
		'id'            => 'footer-default-widget-1',
		'description'   => esc_html__( 'Add widgets here to appear in Footer Default Widget.', 'nexsol' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Default Widget Two', 'nexsol' ),
		'id'            => 'footer-default-widget-2',
		'description'   => esc_html__( 'Add widgets here to appear in Footer Default Widget.', 'nexsol' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Default Widget Three', 'nexsol' ),
		'id'            => 'footer-default-widget-3',
		'description'   => esc_html__( 'Add widgets here to appear in Footer Default Widget.', 'nexsol' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Default Widget Four', 'nexsol' ),
		'id'            => 'footer-default-widget-4',
		'description'   => esc_html__( 'Add widgets here to appear in Footer Default Widget.', 'nexsol' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

}
add_action( 'widgets_init', 'nexsol_widgets_init' );
