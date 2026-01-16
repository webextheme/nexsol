<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
  return;
}
?>

<div id="reviews" class="woocommerce-Reviews review-section" role="region" aria-label="<?php esc_attr_e( 'Product reviews', 'nexsol' ); ?>">
  <div id="comments">
    <h3 class="review-title">
      <?php
        if ( have_comments() ) {
          esc_html_e( 'Reviews', 'nexsol' );
        } else {
          printf(
            esc_html__( 'Be the first to review “%s”', 'nexsol' ),
            esc_html( get_the_title() )
          );
        }
      ?>
    </h3>

    <?php if ( have_comments() ) : ?>
      <ol class="commentlist" aria-label="<?php esc_attr_e( 'Customer reviews list', 'nexsol' ); ?>">
        <?php
        wp_list_comments(
          apply_filters(
            'woocommerce_product_review_list_args',
            array(
              'callback' => 'woocommerce_comments',
            )
          )
        );
        ?>
      </ol>
    <?php endif; ?>

    <?php
    // Review form visibility: only verified buyers (if required).
    if (
      'no' === get_option( 'woocommerce_review_rating_verification_required' ) ||
      wc_customer_bought_product( '', get_current_user_id(), $product->get_id() )
    ) :

      $commenter = wp_get_current_commenter();

      $comment_form = array(
        'title_reply'         => '',
        'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'nexsol' ),
        'comment_notes_after' => '',
        'fields'              => array(
          'author' => '
            <div class="comment-form-author">
              <label for="author">' . esc_html__( 'Name', 'nexsol' ) . ' <span class="required">*</span></label>
              <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" required />
            </div>',
          'email'  => '
            <div class="comment-form-email mrb-20">
              <label for="email">' . esc_html__( 'Email', 'nexsol' ) . ' <span class="required">*</span></label>
              <input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" required />
            </div>',
        ),
        'label_submit'  => esc_html__( 'Submit', 'nexsol' ),
        'logged_in_as'  => '',
        'comment_field' => '',
      );

      // Rating section (if enabled).
      if ( 'yes' === get_option( 'woocommerce_enable_review_rating' ) ) {
        $comment_form['comment_field'] = '
          <div class="comment-form-rating" role="group" aria-label="' . esc_attr__( 'Rate this product', 'nexsol' ) . '">
            <label for="rating">' . esc_html__( 'Your rating', 'nexsol' ) . ' <span class="required">*</span></label>
            <span class="custom-star-rating" aria-hidden="true">
              <input type="radio" id="star5" name="rating" value="5" />
              <label for="star5" title="' . esc_attr__( '5 stars', 'nexsol' ) . '">★</label>
              <input type="radio" id="star4" name="rating" value="4" />
              <label for="star4" title="' . esc_attr__( '4 stars', 'nexsol' ) . '">★</label>
              <input type="radio" id="star3" name="rating" value="3" />
              <label for="star3" title="' . esc_attr__( '3 stars', 'nexsol' ) . '">★</label>
              <input type="radio" id="star2" name="rating" value="2" />
              <label for="star2" title="' . esc_attr__( '2 stars', 'nexsol' ) . '">★</label>
              <input type="radio" id="star1" name="rating" value="1" />
              <label for="star1" title="' . esc_attr__( '1 star', 'nexsol' ) . '">★</label>
            </span>
          </div>';
      }

      // Review textarea.
      $comment_form['comment_field'] .= '
        <div class="comment-form-comment">
          <label for="comment">' . esc_html__( 'Your review', 'nexsol' ) . ' <span class="required">*</span></label>
          <textarea id="comment" name="comment" cols="45" rows="6" required></textarea>
        </div>';

      comment_form(
        apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form )
      );

    else :
      echo '<div class="must-log-in">' . esc_html__( 'Only logged in customers who have purchased this product may leave a review.', 'nexsol' ) . '</div>';
    endif;
    ?>
  </div>
</div>
