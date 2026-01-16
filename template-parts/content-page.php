<?php
/**
 * Template part for displaying page content in page.php
 * @package Nexsol
 * Version: 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php nexsol_post_thumbnail(); ?>
	<div class="entry-content">
	<?php
		the_content();
		wp_link_pages( [
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'nexsol' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'nexsol' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text"> </span>',
		] );
	?>
</div>
<!-- .entry-content -->
</article>