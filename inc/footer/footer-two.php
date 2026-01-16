<?php
$nexsol_copyright_text = nexsol_options( 'nexsol_copyright_text', true );
?>
<!-- Footer Area Start -->
<footer class="footer footer-default-style">
	<div class="footer-main-area default">
		<div class="container">
			<div class="row pdb-65">
				<div class="col-xl-3 col-lg-6">
					<?php if ( is_active_sidebar( 'footer-default-widget-1' ) ) : ?>
						<?php dynamic_sidebar( 'footer-default-widget-1' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-xl-3 col-lg-6">
					<?php if ( is_active_sidebar( 'footer-default-widget-2' ) ) : ?>
						<?php dynamic_sidebar( 'footer-default-widget-2' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-xl-3 col-lg-6">
					<?php if ( is_active_sidebar( 'footer-default-widget-3' ) ) : ?>
						<?php dynamic_sidebar( 'footer-default-widget-3' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-xl-3 col-lg-6">
					<?php if ( is_active_sidebar( 'footer-default-widget-4' ) ) : ?>
						<?php dynamic_sidebar( 'footer-default-widget-4' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="row pdt-30 pdb-30 footer-copyright-area">
				<div class="col-xl-12">
					<div class="text-center">
						<?php if (!empty( $nexsol_copyright_text == true ) && class_exists( 'CSF' )) {?>
							<span class="copyright-text"><?php echo wp_kses($nexsol_copyright_text,'nexsol_allowed_html'); ?></span>
						<?php } else {?>
							<span><?php esc_html_e( 'Copyright © 2025 by WebexTheme - All rights reserved', 'nexsol' ); ?></span>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- Footer Area End -->
<!-- Header Search Popup Start -->
<?php get_template_part('template-parts/parts/' . 'search-popup'); ?>
<!-- Header Search Popup End -->