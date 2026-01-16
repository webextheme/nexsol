<?php
/*
 * Template Name: Home Template
 * Description: A Page Template with a Page Builder design.
 */

get_header(); ?>

<div class="home-template-area">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if ( class_exists( 'CSF' )) : ?>
			<div class="nexsol-grid-lines">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
			<?php endif; ?>

			<?php if(have_posts()) : ?>
				<?php	while(have_posts()) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			<?php endif; ?>

		</main>
	</div>
</div>

<?php get_footer();
