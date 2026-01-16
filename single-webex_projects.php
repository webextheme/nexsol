<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package nexsol
 */

get_header();
$nexsol_project_banner_enable = nexsol_options( 'nexsol_project_banner_enable', true );
$nexsol_project_title = nexsol_options( 'nexsol_project_title' );
$nexsol_project_home_title = nexsol_options( 'nexsol_project_home_title' );
$nexsol_related_project_title = nexsol_options( 'nexsol_related_project_title' );
$nexsol_project_single_next_prev_post = nexsol_options('nexsol_project_single_next_prev_post', true);
$nexsol_project_related_post_show_hide = nexsol_options('nexsol_project_related_post_show_hide', true);

?>
<?php if ( $nexsol_project_banner_enable == true ) : ?>
<!-- Page Title Start -->
<section class="page-title-section">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="breadcrumb-area">
          <h2 class="page-title">
            <?php
							if (!empty( $nexsol_project_title == true ) && class_exists( 'CSF' )){
								echo esc_html( $nexsol_project_title );
							}else{
								the_archive_title();
							}
						?>
          </h2>
          <?php if(!is_front_page() && !is_home()):?>
          <ul class="breadcrumbs-link">
            <li>
              <a href="<?php echo esc_url(home_url('/')); ?>">
              <?php
                if (!empty($nexsol_project_home_title)) {
                  echo esc_html($nexsol_project_home_title);
                } else {
                  esc_html_e('Home', 'nexsol');
                }
              ?>
              </a>
            </li>
            <li class="active">
              <?php
							if (!empty( $nexsol_project_title == true ) && class_exists( 'CSF' )){
								echo esc_html( $nexsol_project_title );
							}else{
								the_archive_title();
							}
						?>
            </li>
          </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Page Title End -->
<?php endif; ?>
<!-- Project Details Section Start -->
<section class="project__details">
  <div class="<?php container(); ?>">
    <div class="row">
      <div class="col-xl-12 col-lg-12">
        <div class="project__details-content">
          <div id="primary" class="site-main">
            <?php while ( have_posts() ) : the_post(); ?>
            <?php the_content() ?>
            <div class="custom-ele-container">

              <?php if ( $nexsol_project_single_next_prev_post == true ) : ?>
              <div class="project-post-navigation">
                <div class="navigation-links">
                  <div class="nav-previous nav-btn">
                    <?php echo get_previous_post_link('%link', '<i class="fa fa-angle-left"></i> &nbsp; ' . __('Previous', 'nexsol'))  ?>
                  </div>
                  <div class="nav-next nav-btn">
                    <?php echo get_next_post_link('%link', __('Next', 'nexsol') . '&nbsp;<i class="fa fa-angle-right"></i>') ?>
                  </div>
                </div>
              </div>
              <?php endif;?>

              <?php if ( $nexsol_project_related_post_show_hide == true ) : ?>
              <div class="row clearfix mrt-60">
                <h3 class="mrb-30">
                <?php
                  if (!empty($nexsol_related_project_title)) {
                    echo esc_html($nexsol_related_project_title);
                  } else {
                      esc_html_e('Related Projects', 'nexsol');
                  }
                ?>
                </h3>
                <?php
								$nexsol_portfolio_post_query = new WP_Query(array(
									'post_type' => 'webex_projects',
									'posts_per_page' => 3,
								));
								?>
                <?php while ($nexsol_portfolio_post_query->have_posts()) : ?>
                <?php $nexsol_portfolio_post_query->the_post(); ?>
                <?php $nexsol_similar_post_category =  get_the_terms(get_the_iD(), 'webex_projects_cats');

								$allowed_tags = wp_kses_allowed_html('post');
								$get_id             = get_the_ID();
								$categories_list = get_the_term_list( $get_id, 'webex_projects_cats', '', '', '' );
								$the_title = get_the_title();
								?>
                <div class="col-xl-4 col-lg-4 col-md-6">
                  <div class="project-block project-block-style_3 mrb-lg-30">
                    <div class="project-thumb">
                      <?php the_post_thumbnail('nexsol-image(480x570)'); ?>
                      <div class="project-link-icon">
                        <a href="<?php echo esc_url( get_the_permalink() ) ?>"><i class="webexbase-icon-up-right-arrow"></i></a>
                      </div>
                      <div class="project-details">
                        <div class="project-category"><?php echo wp_kses($categories_list, true) ?></div>
                        <h4 class="project-title"><a href="<?php echo esc_url( get_the_permalink() ) ?>"><?php echo esc_html( $the_title ) ?></a></h4>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
              </div>
              <?php endif;?>

            </div>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<!-- Project Details Section End -->
<?php get_footer();