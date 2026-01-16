<?php
/**
 * Product quantity inputs.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 *
 * @var bool   $readonly If the input should be set to readonly mode.
 * @var string $type     The input type attribute.
 */

defined( 'ABSPATH' ) || exit;

/* translators: %s: Product name. */
$label = ! empty( $args['product_name'] )
  ? sprintf(
    esc_html__( '%s quantity', 'nexsol' ),
    wp_strip_all_tags( $args['product_name'] )
  )
  : esc_html__( 'Quantity', 'nexsol' );
?>

<div class="quantity" role="group" aria-label="<?php echo esc_attr( $label ); ?>">
  <?php
  /**
   * Hook: woocommerce_before_quantity_input_field.
   *
   * @since 7.2.0
   */
  do_action( 'woocommerce_before_quantity_input_field' );
  ?>

  <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>">
    <?php echo esc_html( $label ); ?>
  </label>

  <button type="button" class="minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'nexsol' ); ?>">
    <i class="fas fa-minus" aria-hidden="true"></i>
  </button>

  <input
    type="<?php echo esc_attr( $type ); ?>"
    <?php if ( ! empty( $readonly ) && $readonly ) : ?>
    readonly="readonly"
    <?php endif; ?>

    id="<?php echo esc_attr( $input_id ); ?>"
    class="<?php echo esc_attr( implode( ' ', (array) $classes ) ); ?>"
    name="<?php echo esc_attr( $input_name ); ?>"
    value="<?php echo esc_attr( $input_value ); ?>"
    aria-label="<?php esc_attr_e( 'Product quantity input', 'nexsol' ); ?>"
    <?php if ( in_array( $type, array( 'text', 'search', 'tel', 'url', 'email', 'password' ), true ) ) : ?>
      size="4"
    <?php endif; ?>
    min="<?php echo esc_attr( $min_value ); ?>"
    <?php if ( 0 < $max_value ) : ?>
      max="<?php echo esc_attr( $max_value ); ?>"
    <?php endif; ?>
    <?php if ( ! $readonly ) : ?>
      step="<?php echo esc_attr( $step ); ?>"
      placeholder="<?php echo esc_attr( $placeholder ); ?>"
      inputmode="<?php echo esc_attr( $inputmode ); ?>"
      autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
    <?php endif; ?>
  />

  <button type="button" class="plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'nexsol' ); ?>">
    <i class="fas fa-plus" aria-hidden="true"></i>
  </button>

  <?php
  /**
   * Hook: woocommerce_after_quantity_input_field.
   *
   * @since 3.6.0
   */
  do_action( 'woocommerce_after_quantity_input_field' );
  ?>
</div>
