<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arvilax
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="default__post-thumb">
		<?php if (has_post_thumbnail()) { ?>
			<img class="img-full" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>" alt="">
		<?php } ?>
	</div>
	<div class="default__news-content-area">
		<ul class="default__news-post-meta">
			<li><?php nexsol_posted_by(); ?></li>
			<li><?php nexsol_posted_on(); ?></li>
			<?php if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) : ?>
			<li><?php nexsol_comment_count(); ?></li>
		<?php endif; ?>
	</ul>
	<h4 class="default__news-post-title">
		<a href="<?php echo esc_url( get_permalink() ) ?>"><?php the_title(); ?></a>
	</h4>
	<div class="default__news-post-excerpt">
		<?php the_excerpt(); ?>
	</div>
	<div class="default__news-readmore-btn">
		<a href="<?php echo esc_url( get_permalink() ) ?>" class="btn readmore-btn"> Read more</a>
	</div>
</div>
</article><!-- #post-<?php the_ID(); ?> -->