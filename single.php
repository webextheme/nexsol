<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package nexsol
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

$site_layout      = nexsol_options('single_blog_layout', 'right-sidebar');
if ($site_layout == 'left-sidebar' || $site_layout == 'right-sidebar' ) {
	$content_layout = 'col-xl-8 col-lg-7';
} else {
	$content_layout = 'col-xl-12 col-lg-12';
}
?>
<?php if($nexsol_postBanner == true ) : ?>
<!-- Page Title Start -->
<section class="page-title-section">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="breadcrumb-area">
					<h2 class="page-title"><?php the_archive_title();?></h2>
					<?php if(!is_front_page() && !is_home()):?>
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

<!-- News Details Section Start -->
<section class="news__details">
  <div class="container">
    <div class="row">
      <?php if ($site_layout == 'left-sidebar'): ?>
				<div class="col-lg-4 order-last order-lg-first">
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
      <div class="<?php echo esc_attr($content_layout); ?>">
        <div class="news__details-content">
          <div id="primary" class="site-main">
            <?php
            while (have_posts()) :
              the_post();
              get_template_part('template-parts/content', get_post_type());
              // If comments are open or we have at least one comment, load up the comment template.
							if (comments_open() || get_comments_number()) :
								comments_template();
							endif;
            endwhile; // End of the loop.
            ?>
          </div><!-- #main -->
        </div>
      </div>

      <?php if ($site_layout == 'right-sidebar'): ?>
				<div class="col-xl-4 col-lg-5">
					<div class="sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php endif; ?>
    </div>
  </div>
</div>
</section>
<!-- News Details Section End -->
<?php get_footer();