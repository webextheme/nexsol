<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
  return;
}

if ( $product->is_in_stock() ) : ?>
  <form class="cart" method="post" enctype="multipart/form-data" role="form" aria-label="<?php esc_attr_e( 'Add to cart form', 'nexsol' ); ?>">
    <div class="quantity-wrapper" role="group" aria-label="<?php esc_attr_e( 'Product quantity selection', 'nexsol' ); ?>">
      <button type="button" class="qty-btn qty-minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'nexsol' ); ?>">−</button>

      <input
        type="number"
        class="qty-input"
        step="1"
        min="1"
        name="quantity"
        value="1"
        title="<?php esc_attr_e( 'Quantity', 'nexsol' ); ?>"
        inputmode="numeric"
        aria-label="<?php esc_attr_e( 'Product quantity input', 'nexsol' ); ?>"
      />

      <button type="button" class="qty-btn qty-plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'nexsol' ); ?>">+</button>
    </div>

    <button
      type="submit"
      class="button tg-btn-gradient add_to_cart_button ajax_add_to_cart"
      data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
      data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
      aria-label="<?php echo esc_attr( $product->add_to_cart_description() ); ?>"
      rel="nofollow"
    >
      <i class="far fa-shopping-bag" aria-hidden="true"></i>
      <span class="screen-reader-text"><?php echo esc_html( $product->add_to_cart_text() ); ?></span>
      <?php echo esc_html( $product->add_to_cart_text() ); ?>
    </button>

    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
  </form>
<?php endif; ?>
