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
$nexsol_show_excerpt = nexsol_options( 'nexsol_show_excerpt', true );
$nexsol_excerpt_length = nexsol_options( 'nexsol_excerpt_length', 48 );
$nexsol_post_author = nexsol_options( 'nexsol_post_author', true );
$nexsol_post_date = nexsol_options( 'nexsol_post_date', true );
$nexsol_show_comments = nexsol_options( 'nexsol_show_comments', true );
$nexsol_show_category = nexsol_options( 'nexsol_show_category', true );
$nexsol_show_pagination = nexsol_options( 'nexsol_show_pagination', true );
$nexsol_show_readmore = nexsol_options( 'nexsol_show_readmore', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('default__news-single'); ?>>
	<?php nexsol_post_thumbnail(); ?>
	<div class="default__news-content-area">
		<ul class="default__news-post-meta">
			<?php if($nexsol_post_author == true ) : ?>
			<li><?php nexsol_posted_by(); ?></li>
			<?php endif; ?>
			<?php if($nexsol_post_date == true ) : ?>
			<li><?php nexsol_posted_on(); ?></li>
			<?php endif; ?>
			<?php if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) : ?>
			<?php if($nexsol_show_comments == true ) : ?>
			<li><?php nexsol_comment_count(); ?></li>
			<?php endif; ?>
			<?php endif; ?>
			<?php if($nexsol_show_category == true) : ?>
			<li class="post-cat"><i class="far fa-edit"></i><?php the_category(','); ?></li>
			<?php endif; ?>
		</ul>
		<h4 class="default__news-post-title">
			<a href="<?php echo esc_url( get_permalink() ) ?>"><?php the_title(); ?></a>
		</h4>
		<?php if( $nexsol_show_excerpt == true && $nexsol_excerpt_length == true ) : ?>
		<div class="default__news-post-excerpt">
			<p class="news-excerpt__text"><?php echo wp_trim_words( get_the_content(), $nexsol_excerpt_length ); ?></p>
		</div>
		<?php elseif ( $nexsol_show_excerpt == true ): ?>
		<div class="default__news-post-excerpt">
			<p class="news-excerpt__text"><?php echo wp_trim_words( get_the_content(), 24 ); ?></p>
		</div>
		<?php endif; ?>
		<?php if($nexsol_show_readmore == true ) : ?>
		<div class="default__news-readmore-btn">
			<a href="<?php the_permalink(); ?>" class="btn readmore-btn"><?php esc_html_e('Read More', 'nexsol') ?></a>
		</div>
		<?php endif; ?>
	</div>
</article>
