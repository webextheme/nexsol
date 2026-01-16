<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nexsol
 */

get_header();
$nexsol_blog_banner_enable = nexsol_options( 'nexsol_blog_banner_enable', true );
$nexsol_blog_title = nexsol_options( 'nexsol_blog_title' );
$nexsol_show_pagination = nexsol_options( 'nexsol_show_pagination', true );
$site_layout      = nexsol_options('blog_layout', 'right-sidebar');

if ($site_layout == 'left-sidebar' || $site_layout == 'right-sidebar' ) {
	$content_layout = 'col-xl-8 col-lg-7';
} else {
	$content_layout = 'col-xl-12 col-lg-12';
}
?>
<?php if ( $nexsol_blog_banner_enable == true ) : ?>
<!-- Page Title Start -->
<section class="page-title-section">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="breadcrumb-area">
					<h2 class="page-title">
						<?php
							if (!empty( $nexsol_blog_title == true ) && class_exists( 'CSF' )){
								echo esc_html( $nexsol_blog_title );
							}else{
								the_archive_title();
							}
						?>
					</h2>
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
<?php endif;?>
<!-- News With Sidebar Section Start -->
<section class="default__news-with-sidebar">
	<div class="container">
		<div class="row">
			<?php if ($site_layout == 'left-sidebar'): ?>
				<div class="col-lg-4 order-last order-lg-first">
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
			<div class="<?php echo esc_attr($content_layout); ?>">
				<div class="default__news-wrapper">
					<div id="primary" class="site-main">
						<?php
						if (have_posts()) :
							/* Start the Loop */
							while (have_posts()) :
								the_post();
								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
								get_template_part('template-parts/content', 'index');
							endwhile;
							?>
						<?php
						else :
							get_template_part('template-parts/content', 'none');
						endif;
						?>
					</div>
					<?php if ( $nexsol_show_pagination == true ) : ?>
						<?php nexsol_pagination(); ?>
					<?php endif;?>
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
<!-- News With Sidebar Section Start -->
<?php get_footer();