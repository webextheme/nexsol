<?php
$nexsol_copyright_text = nexsol_options( 'nexsol_copyright_text', true );
?>
<!-- Footer Area Start -->
<footer class="footer footer-style1">
	<div class="footer-main-area">
		<div class="container">
			<div class="row pdb-65">
				<div class="col-xl-4 col-lg-6">
					<?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?>
						<?php dynamic_sidebar( 'footer-widget-1' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-xl-2 col-lg-6">
					<?php if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>
						<?php dynamic_sidebar( 'footer-widget-2' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-xl-3 col-lg-6">
					<?php if ( is_active_sidebar( 'footer-widget-3' ) ) : ?>
						<?php dynamic_sidebar( 'footer-widget-3' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-xl-3 col-lg-6">
					<?php if ( is_active_sidebar( 'footer-widget-4' ) ) : ?>
						<?php dynamic_sidebar( 'footer-widget-4' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="row pdt-30 pdb-30 footer-copyright-area">
				<div class="col-xl-12">
					<div class="text-center">
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
</footer>
<!-- Footer Area End -->
<!-- Header Search Popup Start -->
<?php get_template_part('template-parts/parts/' . 'search-popup'); ?>
<!-- Header Search Popup End -->