<?php
$nexsol_copyright_text = nexsol_options( 'nexsol_copyright_text', true );
$nexsol_htmls = array(
	'a'      => array(
		'href'   => array(),
		'target' => array()
	),
	'strong' => array(),
	'small'  => array(),
	'span'   => array(),
	'p'      => array(),
);
?>


<div class="footer-default">
	<div class="copyright_bottom">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<?php if (!empty( $nexsol_copyright_text == true ) && class_exists( 'CSF' )) {?>
						<span class="copyright-text"><?php echo wp_kses($nexsol_copyright_text,'nexsol_allowed_html'); ?></span>
					<?php } else {?>
						<span><?php esc_html_e( 'Copyright by WebexTheme © 2025. All rights reserved', 'nexsol' ); ?></span>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Header Search Popup Start -->
<?php get_template_part('template-parts/parts/' . 'search-popup'); ?>
<!-- Header Search Popup End -->