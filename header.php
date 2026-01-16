<?php
/**
 * Theme header
 * @subpackage Nexsol
 */
$nexsol_enable_preloader = nexsol_options('nexsol_enable_preloader', true);
$nexsol_meta_enable_banner = nexsol_options('nexsol_meta_enable_banner');

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="cursor"></div>
<div id="smooth-wrapper" class="nexsol-body-content">
	<div id="smooth-content">
	<?php if($nexsol_enable_preloader == true ) : ?>
	<!-- Start Preloader -->
	<?php get_template_part('template-parts/content', 'preloader'); ?>
	<!-- End Preloader -->
	<?php endif; ?>

	<div class="offcanvas-overlay"></div>
	<header id="headers">
		<?php do_action( 'nexsol_render_header' ); ?>
	</header>

	<!-- End Header Styles -->

	<div id="content" class="site-content">