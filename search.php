<?php

get_header();

$nexsol_search_banner = nexsol_options('nexsol_search_banner', true);
$nexsol_search_show_pagination = nexsol_options( 'nexsol_search_show_pagination', true );

?>
<?php if($nexsol_search_banner == true ) : ?>
<!-- Page Title Start -->
<section class="page-title-section">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="breadcrumb-area">
					<h2 class="page-title">
					<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'nexsol' ), '<span>' . get_search_query() . '</span>' );
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
<?php endif; ?>
<!-- News With Sidebar Section Start -->
<section class="default__news-with-sidebar">
	<div class="container">
		<div class="row">
			<?php $news_section_column = (is_active_sidebar('blog-sidebar')) ? "col-xl-8 col-lg-7" : "col-xl-12 col-lg-12" ?>
			<div class="<?php echo esc_attr($news_section_column); ?>">
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
						<?php if ( $nexsol_search_show_pagination == true ) : ?>
							<?php nexsol_pagination(); ?>
						<?php endif;?>
						<?php
					else :
						get_template_part('template-parts/content', 'none');
					endif;
					?>
				</div><!-- #main -->
			</div>
			</div>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
				<div class="col-xl-4 col-lg-5 col-md-6">
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