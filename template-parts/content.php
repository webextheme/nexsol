<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arvilax
 */
$nexsol_single_next_prev_post = nexsol_options('nexsol_single_next_prev_post', true);
$nexsol_single_post_author = nexsol_options( 'nexsol_single_post_author', true );
$nexsol_single_post_date = nexsol_options( 'nexsol_single_post_date', true );
$nexsol_single_post_comments = nexsol_options( 'nexsol_single_post_comments', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php nexsol_post_thumbnail(); ?>
	<div class="news__details-content news__details_content-wrapper clearfix ">
		<?php
		if ('post' === get_post_type()) :
			?>
			<ul class="news__details-post-meta">
				<?php if($nexsol_single_post_author == true ) : ?>
				<li><?php nexsol_posted_by(); ?></li>
				<?php endif; ?>
				<?php if($nexsol_single_post_date == true ) : ?>
				<li><?php nexsol_posted_on(); ?></li>
				<?php endif; ?>
				<?php if($nexsol_single_post_comments == true && get_comments_number() != 0) : ?>
				<li class="comment-number"><i class="far fa-comments"></i><?php comments_number( 'no responses', '1 Comment', '% Comments' ); ?>.</li>
				<?php endif; ?>
		</ul>
	<?php endif; ?>
	<?php
	the_content(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				esc_html__('Continue reading', 'nexsol') . '<span class="screen-reader-text"> "%s"</span>',
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post(get_the_title())
		)
	);
	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'nexsol'),
			'after'  => '</div>',
		)
	);
	?>
</div>
	<?php if( has_tag() || has_category() ) : ?>
	<div class="news-details__bottom">
		<?php nexsol_entry_meta_tags(); ?>
	</div>
	<?php endif; ?>
	<?php if($nexsol_single_next_prev_post == true ) : ?>
	<?php
		$prevpost = get_previous_post();
		$nextpost = get_next_post();
		if( ! empty( $prevpost ||  $nextpost ) ):
	?>
	<div class="single-post-navigation">
		<div class="navigation-links">
			<?php if( ! empty( $nextpost ) ) { ?>
			<div class="nav-next">
				<a href="<?php echo esc_url( get_permalink( $nextpost->ID ) ) ?>" class="text-primary-color"><i class="fa fa-angle-left"></i><?php echo esc_html("Prev Post",'nexsol');?> </a>
			</div>
			<?php } ?>
			<?php if( ! empty( $prevpost ) ) { ?>
			<div class="nav-previous">
				<a href="<?php echo esc_url( get_permalink( $prevpost->ID ) ) ?>" class="text-primary-color"> <?php echo esc_html("Next Post",'nexsol');?> <i class="fa fa-angle-right"></i></a>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php
    endif;
  ?>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->



