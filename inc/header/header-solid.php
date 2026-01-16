<?php
if ( ! empty( $args['header_id'] ) ) :
  $query = new WP_Query(array(
    'post_type' => 'wbx_header_builder',
    'p'         => $args['header_id'],
  ));
  if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post(); ?>
      <div class="custom_elementor_header header_solid"><?php the_content(); ?></div>
    <?php endwhile;
    wp_reset_postdata();
  endif;
endif;
