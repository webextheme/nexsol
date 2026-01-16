<?php
	$nexsol_enable_scroll_to_top = nexsol_options('nexsol_enable_scroll_to_top');
	if (($nexsol_enable_scroll_to_top ==  false) && class_exists( 'CSF' )) {
		$scroll_to_top = 'd-none';
	} else {
		$scroll_to_top = 'd-block';
	}
?>

<!-- Scroll to Top Start -->
<div class="anim-scroll-to-top <?php echo esc_attr($scroll_to_top); ?>">
	<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
		<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
	</svg>
</div>
<!-- Scroll to Top end -->