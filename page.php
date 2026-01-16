<?php
/*
 *=================================
 * The page template file
 * @package nexsol WordPress Theme
 *==================================
*/
get_header();
$nexsol_page_title_banner_enable = nexsol_options( 'nexsol_page_title_banner_enable', true );
$nexsol_page_title_breadcrumb_enable = nexsol_options( 'nexsol_page_title_breadcrumb_enable', true );
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
<?php if($nexsol_postBanner == true && $nexsol_page_title_banner_enable == true ) : ?>
<!-- Page Title Start -->
<section class="page-title-section">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="breadcrumb-area">
					<h2 class="page-title"><?php the_archive_title();?></h2>
					<?php if(!is_front_page() && !is_home() && $nexsol_page_title_breadcrumb_enable == true ):?>
					<ul class="breadcrumbs-link">
						<li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
						<li class="active"><?php the_archive_title();?></li>
					</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Page Title End -->
<?php endif; ?>
<!-- Page Content Start -->
<section class="webex-page-content-area">
  <div class="<?php container(); ?>">
		<div class="row">
			<div class="col-xl-12">
				<div class="webex-page-content">
					<?php
						if ( have_posts() ):
							while ( have_posts() ): the_post();
								get_template_part( 'template-parts/content', 'page' );
							endwhile;
							// If comments are open or we have at least one comment, load up the comment template.
							if (comments_open() || get_comments_number()) :?>
									<?php comments_template();?>
							<?php endif;
						else:
							get_template_part( 'template-parts/content', 'none' );
						endif;
					?>
				</div>
			</div>
		</div>
  </div>
</section>
<!-- Page Content End -->
<?php get_footer();