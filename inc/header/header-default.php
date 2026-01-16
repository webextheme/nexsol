<?php
$main_logo = nexsol_options('main_logo');
?>
<header class="header-default-style">
	<nav class="main-menu sticky-header">
		<div class="container">
			<div class="main-menu-inner">
				<div class="main-menu-logo">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<?php if(isset($main_logo['url']) && $main_logo['url'] != ''){?>
							<img id="logo-image" class="img-center" src="<?php echo esc_url($main_logo['url']); ?>" alt="<?php echo esc_attr(get_bloginfo());?>">
						<?php }else{ ?>
							<img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/logo-dark.svg' ?>" alt="<?php echo esc_attr(get_bloginfo());?>">
						<?php } ?>
					</a>
				</div>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container' => '',
						'menu_class' => 'main-nav-menu',
						'menu_id' => '',
						'menu'            => '',
						'container_class' => '',
						'container_id'    => '',
						'echo'            => true,
						'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
						'walker'            => new nexsol_wp_bootstrap_navwalker(),
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul  class="%2$s">%3$s</ul>',
						'depth'           => 0,
					)
				); ?>
				<div class="main-menu-right">
					<a href="#" aria-label="Mobile Nav" class="mobile-nav-toggler">
						<span></span>
						<span></span>
						<span></span>
					</a>
				</div>
			</div>
		</div>
	</nav>
</header>