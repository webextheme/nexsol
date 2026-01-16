<?php
/**
 * The Template for displaying product archives, including the main shop page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$nexsol_page_title_breadcrumb_enable = nexsol_options( 'nexsol_page_title_breadcrumb_enable', true );
?>

<!-- Page Title Start -->
<section class="page-title-section" role="banner" aria-label="<?php esc_attr_e( 'Shop Page Banner', 'nexsol' ); ?>">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="breadcrumb-area">
          <h2 class="page-title">
            <?php esc_html_e( 'All Products', 'nexsol' ); ?>
          </h2>
          <?php if ( ! is_front_page() && ! is_home() && true === $nexsol_page_title_breadcrumb_enable ) : ?>
            <ul class="breadcrumbs-link" aria-label="<?php esc_attr_e( 'Breadcrumb', 'nexsol' ); ?>">
              <li>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <?php esc_html_e( 'Home', 'nexsol' ); ?>
                </a>
              </li>
              <li class="active">
                <?php the_archive_title(); ?>
              </li>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Page Title End -->

<section class="all-products pdt-110 pdb-120" role="region" aria-label="<?php esc_attr_e( 'All Products Section', 'nexsol' ); ?>">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
        <p class="woocommerce-result-count">
          <?php woocommerce_result_count(); ?>
        </p>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 mb-5">
        <div class="tp-product-filter d-flex align-items-center justify-content-sm-end">
          <?php do_action( 'woocommerce_before_shop_loop' ); ?>
        </div>
      </div>

      <?php if ( woocommerce_product_loop() ) : ?>
        <?php woocommerce_product_loop_start(); ?>

        <?php while ( have_posts() ) : the_post(); ?>
          <?php wc_get_template_part( 'content', 'product' ); ?>
        <?php endwhile; ?>

        <?php woocommerce_product_loop_end(); ?>

        <?php
          /**
           * Hook: woocommerce_after_shop_loop.
           *
           * @hooked woocommerce_pagination - 10
           */
          do_action( 'woocommerce_after_shop_loop' );
        ?>
      <?php else : ?>
        <?php
          /**
           * Hook: woocommerce_no_products_found.
           *
           * @hooked wc_no_products_found - 10
           */
          do_action( 'woocommerce_no_products_found' );
        ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer( 'shop' ); ?>
