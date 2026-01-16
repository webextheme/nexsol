<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

$nexsol_enable_404_banner = nexsol_options('nexsol_enable_404_banner', true);
$nexsol_404_background_options = nexsol_options('nexsol_404_background_options');
$nexsol_404_error_text = nexsol_options('nexsol_404_error_text');
$nexsol_404_title = nexsol_options('nexsol_404_title');
$nexsol_404_description = nexsol_options('nexsol_404_description');
$nexsol_enable_return_home_button = nexsol_options('nexsol_enable_return_home_button');
$nexsol_404_return_home_button_text = nexsol_options('nexsol_404_return_home_button_text');
get_header();
?>

<?php if($nexsol_enable_404_banner == true ) : ?>
<!-- Page Title Start -->
<section class="page-title-section">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="breadcrumb-area">
					<h2 class="page-title"><?php the_archive_title();?></h2>
					<?php if(!is_front_page() && !is_home()):?>
					<ul class="breadcrumbs-link">
						<li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
						<li class="active"><?php the_archive_title();?></li>
					</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Page Title End -->
<?php endif; ?>
<!-- Error Section Start -->
<div class="error-area d-flex">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="error-inner text-center">
          <h1 class="error-title">
            <?php
              if(!empty($nexsol_404_error_text)){
                echo esc_html( $nexsol_404_error_text );
              }else{
                esc_html_e( '404', 'nexsol' );
              }
            ?>
          </h1>
          <h2 class="error-text">
            <?php
              if(!empty($nexsol_404_title)){
                echo esc_html( $nexsol_404_title );
              }else{
                esc_html_e( 'Sorry, something went wrong!', 'nexsol' );
              }
            ?>
          </h2>
          <p>
            <?php
              if(!empty($nexsol_404_description)){
                echo esc_html( $nexsol_404_description );
              }else{
                echo esc_html( 'This page is temporarily unavailable due to maintenance. We will back very soon thanks for your patien', 'nexsol' );
              }
            ?>
          </p>
          <?php if( $nexsol_enable_return_home_button == true ) : ?>
          <a class="cs-btn-one nexsol_btn default default " href="<?php echo esc_url(home_url('/')); ?>">
            <?php
              if(!empty($nexsol_404_return_home_button_text)){
                echo esc_html( $nexsol_404_return_home_button_text );
              }else{
                echo esc_html( 'Return Home' );
              }
            ?>
          </a>
					<?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Error Section End -->
<?php get_footer(); ?>

