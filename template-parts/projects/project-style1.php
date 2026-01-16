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

$post_id = get_the_ID();
$item_classes = 'all ';
$post_category = ''; $separator = ', '; $output = '';
$item_cats = get_the_terms( get_the_ID(), 'webex_projects_cats' );

if(!empty($item_cats) && !is_wp_error($item_cats)){
	foreach((array)$item_cats as $item_cat){
		$item_classes .= $item_cat->slug . ' ';
		$output .= '<a href="'.get_category_link( $item_cat->term_id ).'" title="' . esc_attr( sprintf( esc_attr__( "View all posts in %s", 'nexsol' ), $item_cat->name ) ) . '">'.$item_cat->name.'</a>'.$separator;
	}
	$post_category = trim($output, $separator);
}
$thumbnail = 'nexsol-image(420x420)';
if(isset($thumbnail_size) && $thumbnail_size){
	 $thumbnail = $thumbnail_size;
}
?>
<div class="project-block project-style1 mrb-30">
	<div class="project-thumb">
		<?php if ( has_post_thumbnail()) {
			the_post_thumbnail($thumbnail);
		}?>
		<div class="project-link-icon">
			<a href="<?php echo esc_url( get_the_permalink() ) ?>"><i class="webexbase-icon-link1"></i></a>
		</div>
		<div class="project-category"><?php echo wp_kses($post_category, true) ?></div>
	</div>
	<div class="project-details">
		<h4 class="project-title"><a href="<?php echo esc_url( get_the_permalink() ) ?>"><?php the_title(); ?></a></h4>
	</div>
</div>