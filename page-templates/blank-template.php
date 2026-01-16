<?php
/*
 *=================================
 * Template Name: Nexsol Blank Template
 *==================================
*/
get_header();
if(get_post_meta( get_the_ID(), 'nexsol_metabox', true)) {
	$nexsol_commonMeta = get_post_meta( get_the_ID(), 'nexsol_metabox', true );
} else {
	$nexsol_commonMeta = array();
}
if(array_key_exists('nexsol_meta_enable_page_title', $nexsol_commonMeta)){
	$nexsol_postBanner = $nexsol_commonMeta['nexsol_meta_enable_page_title'];
}else{
	$nexsol_postBanner = true;
}
?>
<?php if($nexsol_postBanner == true ) : ?>
<!-- Page Title Start -->
<section class="page-title-section">
	<div class="breadcrumb-area">
		<h2 class="page-title"><?php the_archive_title();?></h2>
		<?php if(!is_front_page() && !is_home()):?>
		<ul class="breadcrumbs-link">
			<li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
			<li class="active"><?php the_archive_title();?></li>
		</ul>
		<?php endif; ?>
	</div>
</section>
<!-- Page Title End -->
<?php endif; ?>
<!-- Page Content Start -->

<main id="primary" class="site-main content-area">
<!-- <h4>blank-template.php</h4> -->
	<?php the_content(); ?>
</main><!-- #main -->
<!-- Page Content End -->

<?php get_footer();