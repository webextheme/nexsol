	<?php
/**
 * Theme header
 * @subpackage Nexsol
 */
 $nexsol_enable_back_to_top_button = nexsol_options('nexsol_enable_back_to_top_button');
?>
	</div>
	<?php if (is_page() || is_singular('post') && get_post_meta($post->ID, 'nexsol_metabox', true)) {
		$nexsol_meta = get_post_meta($post->ID, 'nexsol_metabox', true);
	} else {
		$nexsol_meta = array();
	}
	$footer_custom = nexsol_options('footer_layout_style');
	if (is_array($nexsol_meta) && array_key_exists('meta_footer_style', $nexsol_meta) && $nexsol_meta['meta_footer_layout'] != 'no') {
		$footer_layout = $nexsol_meta['meta_footer_style'];
	} else if (!empty($footer_custom) && class_exists( 'CSF' )) {
		$footer_layout = nexsol_options('footer_layout_style');
	}
	else {
		$footer_layout = 'footer-default';
	}
	?>
	<?php get_template_part('inc/footer/' .  $footer_layout . ''); ?>
	<?php get_template_part('template-parts/parts/' . 'scroll-to-top'); ?>
	<?php get_template_part('template-parts/parts/' . 'side-panel'); ?>
	<?php wp_footer(); ?>
	</div>
	<!-- smooth-conten-ses -->
	</div>

</body>
</html>