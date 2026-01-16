<?php
/**
 *
 * @author     WebexTheme
 * @copyright  Copyright (C) 2025 WebexTheme. All Rights Reserved.
 *
 */
get_header();
$nexsol_archive_project_banner = nexsol_options( 'nexsol_archive_project_banner', true );
$nexsol_archive_project_banner_title = nexsol_options( 'nexsol_archive_project_banner_title' );
$nexsol_archive_project_show_pagination = nexsol_options( 'nexsol_archive_project_show_pagination', true );
$site_layout      = nexsol_options('projects_archive_layout', 'right-sidebar');
if ($site_layout == 'left-sidebar' || $site_layout == 'right-sidebar' ) {
	$content_layout = 'col-xl-8 col-lg-7';
} else {
	$content_layout = 'col-xl-12 col-lg-12';
}
?>
<?php if ( $nexsol_archive_project_banner == true ) : ?>
<!-- Page Title Start -->
<section class="page-title-section">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="breadcrumb-area">
					<h2 class="page-title">
						<?php
							if (!empty( $nexsol_archive_project_banner_title == true ) && class_exists( 'CSF' )){
								echo esc_html( $nexsol_archive_project_banner_title );
							}else{
								the_archive_title();
							}
						?>
					</h2>
					<?php if(!is_front_page() && !is_home()):?>
					<ul class="breadcrumbs-link">
						<li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
						<li class="active">
						<?php
							if (!empty( $nexsol_archive_project_banner_title == true ) && class_exists( 'CSF' )){
								echo esc_html( $nexsol_archive_project_banner_title );
							}else{
								the_archive_title();
							}
						?>
						</li>
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
<section class="default__news-with-sidebar project_archive_page">
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
						<div class="row">
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
									?>
								<?php if ($site_layout == 'left-sidebar' || ($site_layout == 'right-sidebar')): ?>
									<div class="col-xl-6 col-lg-12 col-md-12">
										<?php get_template_part('template-parts/projects/project', 'style1');?>
									</div>
									<?php else :?>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
										<?php get_template_part('template-parts/projects/project', 'style1');?>
									</div>
								<?php endif; ?>
							<?php endwhile;
							else :
								get_template_part('template-parts/projects/content', 'none');
							endif;
							?>
						</div>
					</div>
					<?php if ( $nexsol_archive_project_show_pagination == true ) : ?>
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
