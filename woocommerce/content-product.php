<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product || ! $product->is_visible() ) {
  return;
}
?>

<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
  <div <?php wc_product_class( '', $product ); ?>>

    <div class="product--img">
      <?php woocommerce_template_loop_product_thumbnail(); ?>

      <div class="product--btn">
        <!-- Product Quick View Button -->
        <a
          type="button"
          class="product-action-btn"
          data-bs-toggle="modal"
          data-bs-target="#productModal-<?php echo esc_attr( $product->get_id() ); ?>"
          aria-label="<?php echo esc_attr__( 'Quick view product details', 'nexsol' ); ?>"
          role="button">
          <i class="webexbase-icon-magnifying-glass" aria-hidden="true"></i>
        </a>

        <!-- Add to Cart Button -->
        <a
          href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
          class="btn-icon add_to_cart_button ajax_add_to_cart"
          data-quantity="1"
          data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
          aria-label="<?php echo esc_attr( $product->add_to_cart_description() ); ?>"
          rel="nofollow"
          role="button">
          <i class="webexbase-icon-cart-medium" aria-hidden="true"></i>
          <span class="screen-reader-text"><?php esc_html_e( 'Add to cart', 'nexsol' ); ?></span>
        </a>

        <!-- Wishlist Button -->
        <?php if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) : ?>
          <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
        <?php else : ?>
          <a
            href="#"
            class="btn-icon wishlist-btn"
            title="<?php esc_attr_e( 'Add to Wishlist', 'nexsol' ); ?>"
            aria-label="<?php esc_attr_e( 'Add to Wishlist', 'nexsol' ); ?>"
            role="button">
            <i class="fa fa-heart" aria-hidden="true"></i>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <?php
      /**
       * Hook: woocommerce_before_shop_loop_item.
       *
       * @hooked woocommerce_template_loop_product_link_open - 10
       */
      do_action( 'woocommerce_before_shop_loop_item' );

      /**
       * Hook: woocommerce_before_shop_loop_item_title.
       *
       * @hooked woocommerce_show_product_loop_sale_flash - 10
       * @hooked woocommerce_template_loop_product_thumbnail - 10
       */
      do_action( 'woocommerce_before_shop_loop_item_title' );
    ?>

    <div class="product--holder">
      <h3 class="product--title">
        <a href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>">
          <?php the_title(); ?>
        </a>
      </h3>
      <span class="product--price"><?php woocommerce_template_loop_price(); ?></span>
    </div>

  </div>
</div>

<!-- Product Quick View Modal -->
<div
  class="modal fade"
  id="productModal-<?php echo esc_attr( $product->get_id() ); ?>"
  tabindex="-1"
  aria-labelledby="productModalLabel-<?php echo esc_attr( $product->get_id() ); ?>"
  aria-hidden="true"
  role="dialog">
  <div class="nexsol_product_modal modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg">

      <!-- Modal Header -->
      <div class="modal-header border-0 pb-0">
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="<?php esc_attr_e( 'Close modal', 'nexsol' ); ?>">
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4 p-md-5">
        <div class="row g-4 align-items-center">

          <!-- Product Image -->
          <div class="col-xl-6 col-lg-6">
            <div class="product-modal-image">
              <div class="tp-product-details-nav-main-thumb mb-3">
                <?php
                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'large' );
                if ( $image_url ) :
                ?>
                  <img
                    src="<?php echo esc_url( $image_url[0] ); ?>"
                    alt="<?php echo esc_attr( get_the_title() ); ?>"
                    class="img-fluid rounded" />
                <?php endif; ?>
              </div>

              <div class="product-modal-gallery d-flex gap-2 justify-content-center flex-wrap">
                <?php
                $attachment_ids = $product->get_gallery_image_ids();
                foreach ( $attachment_ids as $attachment_id ) {
                  echo wp_get_attachment_image(
                    $attachment_id,
                    'thumbnail',
                    false,
                    array(
                      'class' => 'thumb-img rounded border',
                      'alt'   => esc_attr( get_the_title() ),
                    )
                  );
                }
                ?>
              </div>
            </div>
          </div>

          <!-- Product Details -->
          <div class="col-xl-6 col-lg-6">
            <div class="tp-product-details-wrapper">
              <p class="text-muted small mb-1">
                <?php echo wp_kses_post( wc_get_product_category_list( $product->get_id(), ', ', '', '' ) ); ?>
              </p>

              <h3 id="productModalLabel-<?php echo esc_attr( $product->get_id() ); ?>" class="fw-bold mb-2">
                <?php echo esc_html( get_the_title() ); ?>
              </h3>

              <?php
              $rating_count = $product->get_rating_count();
              $review_count = $product->get_review_count();
              $average      = $product->get_average_rating();

              if ( $rating_count > 0 ) :
              ?>
                <div class="woocommerce-product-rating d-flex align-items-center mb-2">
                  <?php echo wp_kses_post( wc_get_rating_html( $average, $rating_count ) ); ?>
                  <a href="#reviews" class="woocommerce-review-link ms-2" rel="nofollow">
                    (<?php echo esc_html( $review_count ); ?>
                    <?php echo esc_html( _n( 'Review', 'Reviews', $review_count, 'nexsol' ) ); ?>)
                  </a>
                </div>
              <?php endif; ?>

              <div class="price mb-3">
                <?php echo wp_kses_post( $product->get_price_html() ); ?>
              </div>

              <?php if ( $product->is_on_backorder( 1 ) ) : ?>
                <span class="badge in-backorder-text mb-3"><?php esc_html_e( 'Available on backorder', 'nexsol' ); ?></span>
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
                <span class="badge out-stock-text mb-3"><?php esc_html_e( 'Out of Stock', 'nexsol' ); ?></span>
              <?php endif; ?>

              <p class="text-muted mrt-10 mrb-30">
                <?php echo esc_html( wp_trim_words( get_the_excerpt(), 50 ) ); ?>
              </p>

              <!-- Add to Cart -->
              <div class="mb-4">
                <?php woocommerce_template_single_add_to_cart(); ?>
              </div>

              <div class="modal-wishlist">
                <?php do_action( 'woocommerce_single_product_summary' ); ?>
              </div>

              <!-- SKU & Meta Info -->
              <p class="text-muted mb-1">
                <strong class="text-dark"><?php esc_html_e( 'SKU:', 'nexsol' ); ?></strong>
                <?php echo esc_html( $product->get_sku() ); ?>
              </p>
              <p class="text-muted mb-1">
                <strong class="text-dark"><?php esc_html_e( 'Category:', 'nexsol' ); ?></strong>
                <?php echo wp_kses_post( wc_get_product_category_list( $product->get_id() ) ); ?>
              </p>
              <p class="text-muted mb-3">
                <strong class="text-dark"><?php esc_html_e( 'Tags:', 'nexsol' ); ?></strong>
                <?php echo wp_kses_post( wc_get_product_tag_list( $product->get_id() ) ); ?>
              </p>
            </div>
          </div>
          <!-- /col -->
        </div><!-- /row -->
      </div><!-- /modal-body -->
    </div><!-- /modal-content -->
  </div><!-- /modal-dialog -->
</div><!-- /modal -->
