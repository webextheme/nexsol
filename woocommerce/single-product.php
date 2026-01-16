<?php
/**
 * The Template for displaying all single products.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 1.6.4
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$nexsol_page_title_breadcrumb_enable = nexsol_options( 'nexsol_page_title_breadcrumb_enable', true );
?>

<!-- Page Title Start -->
<section class="page-title-section" role="banner" aria-label="<?php esc_attr_e( 'Single Product Header', 'nexsol' ); ?>">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="breadcrumb-area">
          <h2 class="page-title">
            <?php echo esc_html( get_the_title() ); ?>
          </h2>
          <?php if ( ! is_front_page() && ! is_home() && true === $nexsol_page_title_breadcrumb_enable ) : ?>
            <ul class="breadcrumbs-link" aria-label="<?php esc_attr_e( 'Breadcrumb', 'nexsol' ); ?>">
              <li>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <?php esc_html_e( 'Home', 'nexsol' ); ?>
                </a>
              </li>
              <li class="active">
                <?php echo esc_html( get_the_title() ); ?>
              </li>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Page Title End -->

<section class="shop-single-section pdt-120 pdb-120" role="main" aria-label="<?php esc_attr_e( 'Single Product Section', 'nexsol' ); ?>">
  <div class="container">
    <?php
      /**
       * Hook: woocommerce_before_main_content.
       *
       * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
       * @hooked woocommerce_breadcrumb - 20
       */
      do_action( 'woocommerce_before_main_content' );
    ?>

    <?php while ( have_posts() ) : ?>
      <?php the_post(); ?>

      <?php wc_get_template_part( 'content', 'single-product' ); ?>

    <?php endwhile; // end of the loop. ?>

    <?php
      /**
       * Hook: woocommerce_after_main_content.
       *
       * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
       */
      do_action( 'woocommerce_after_main_content' );
    ?>
  </div>
</section>

<?php get_footer( 'shop' ); ?>
