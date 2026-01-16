<?php
if ( post_type_exists( 'wbx_side_panel' ) ) {
	$side_panel_args = array(
		'post_type'      => 'wbx_side_panel',
		'posts_per_page' => 1,
		'orderby'        => 'date',
		'order'          => 'DESC',
	);
	$side_panel_query = new WP_Query( $side_panel_args );
	if ( $side_panel_query->have_posts() ) {
		while ( $side_panel_query->have_posts() ) {
			$side_panel_query->the_post(); ?>
			<div class="side-panel-content">
				<div class="close-icon">
					<button type="button"><i class="webexbase-icon-editor-close"></i></button>
				</div>
				<?php the_content(); ?>
			</div>
		<?php }
		wp_reset_postdata();
	}
}
