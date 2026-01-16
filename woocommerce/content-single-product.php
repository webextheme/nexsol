<?php
/**
 * The template for displaying product content in the single-product.php template.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
  echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  return;
}
?>

<div id="product-<?php echo esc_attr( get_the_ID() ); ?>" <?php wc_product_class( '', $product ); ?> role="main">
  <div class="row">
    <div class="col-md-6">
      <?php
      /**
       * Hook: woocommerce_before_single_product_summary.
       *
       * @hooked woocommerce_show_product_sale_flash - 10
       * @hooked woocommerce_show_product_images - 20
       */
      do_action( 'woocommerce_before_single_product_summary' );
      ?>
    </div>

    <div class="col-md-6 product-details-col">
      <div class="product-details">

        <!-- Product Title -->
        <h1 class="product_title entry-title" id="product_title_<?php echo esc_attr( get_the_ID() ); ?>">
          <?php woocommerce_template_single_title(); ?>
        </h1>

        <!-- Product Rating -->
        <div class="rating" aria-label="<?php esc_attr_e( 'Product rating', 'nexsol' ); ?>">
          <?php woocommerce_template_single_rating(); ?>
        </div>

        <!-- Product Price -->
        <div class="price" aria-label="<?php esc_attr_e( 'Product price', 'nexsol' ); ?>">
          <?php woocommerce_template_single_price(); ?>
        </div>

        <!-- Stock Status -->
        <?php if ( $product->is_on_backorder( 1 ) ) : ?>
          <span class="badge in-backorder-text mb-3">
            <?php esc_html_e( 'Available on backorder', 'nexsol' ); ?>
          </span>

        <?php elseif ( $product->is_in_stock() ) : ?>
          <span class="badge in-stock-text mb-3">
            <?php
              $qty = $product->get_stock_quantity();

              if ( isset( $qty ) && $qty ) {
                  echo esc_html( $qty ) . ' ' . esc_html__( 'In Stock', 'nexsol' );
              } else {
                  echo esc_html__( 'In Stock', 'nexsol' );
              }
            ?>

          </span>

        <?php else : ?>
          <span class="badge out-stock-text mb-3">
            <?php esc_html_e( 'Out of Stock', 'nexsol' ); ?>
          </span>
        <?php endif; ?>

        <!-- Product Excerpt -->
        <div class="product-excerpt" aria-label="<?php esc_attr_e( 'Product description', 'nexsol' ); ?>">
          <?php woocommerce_template_single_excerpt(); ?>
        </div>

        <!-- Add to Cart -->
        <div class="product-option" aria-label="<?php esc_attr_e( 'Add to cart section', 'nexsol' ); ?>">
          <?php woocommerce_template_single_add_to_cart(); ?>
        </div>

        <!-- Product Summary Hooks -->
        <div class="summary entry-summary">
          <?php
          /**
           * Hook: woocommerce_single_product_summary.
           *
           * @hooked woocommerce_template_single_title - 5
           * @hooked woocommerce_template_single_rating - 10
           * @hooked woocommerce_template_single_price - 10
           * @hooked woocommerce_template_single_excerpt - 20
           * @hooked woocommerce_template_single_add_to_cart - 30
           * @hooked woocommerce_template_single_meta - 40
           * @hooked woocommerce_template_single_sharing - 50
           * @hooked WC_Structured_Data::generate_product_data() - 60
           */
          do_action( 'woocommerce_single_product_summary' );
          ?>
        </div>

        <!-- Product Meta -->
        <div class="thb-product-meta-after mt-20">
          <div class="product_meta" aria-label="<?php esc_attr_e( 'Product metadata', 'nexsol' ); ?>">
            <?php woocommerce_template_single_meta(); ?>
          </div>
        </div>
      </div>
    </div>

    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action( 'woocommerce_after_single_product_summary' );
    ?>
  </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
