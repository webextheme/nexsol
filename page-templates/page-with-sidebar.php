<?php
/*
 * Template Name: Page With Sidebar
 * Description: A Page Template with a Page Builder design.
 */

get_header(); ?>
<!-- News Details Section Start -->
<div class="news__details">
  <div class="container">
    <div class="row">
      <?php $news_section_column = (is_active_sidebar('blog-sidebar')) ? "col-xl-8 col-lg-7" : "col-xl-12 col-lg-12" ?>
      <div class="<?php echo esc_attr($news_section_column); ?>">
        <div class="news__details-content">
          <div id="primary" class="site-main">
						<?php if(have_posts()) : ?>
						<?php	while(have_posts()) : the_post(); ?>
							<?php the_content(); ?>
							<?php endwhile; ?>
						<?php endif; ?>
          </div><!-- #main -->
        </div>
      </div>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
        <div class="col-xl-4 col-lg-5">
          <div class="sidebar">
            <?php get_sidebar(); ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- News Details Section End -->

<?php get_footer();
