<?php
if (is_page() || is_singular('post') && get_post_meta($post->ID, 'nexsol_metabox', true)) {
    $nexsol_meta = get_post_meta($post->ID, 'nexsol_metabox', true);
} else {
    $nexsol_meta = array();
}
if (is_array($nexsol_meta) && array_key_exists('meta_footer_style', $nexsol_meta) && array_key_exists('nexsol_builder_deta', $nexsol_meta) && $nexsol_meta['meta_footer_layout'] != 'no') {
    $wbx_footer_builder = $nexsol_meta['nexsol_builder_deta'];
} else {
    $wbx_footer_builder = nexsol_options('nexsol_builder_deta');
}

if (true == post_type_exists('wbx_footer_builder')):
    $footer_args = array(
        'p' => $wbx_footer_builder,
        'post_type' => 'wbx_footer_builder',
    );
    $footer_has_style = new WP_Query($footer_args);
    if ($footer_has_style->have_posts()):
        while ($footer_has_style->have_posts()):
            $footer_has_style->the_post(); ?>
            <div class="nexsol-footer-builder">
                <?php the_content(); ?>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    endif;
endif;

?>
<!-- Header Search Popup Start -->
<?php get_template_part('template-parts/parts/' . 'search-popup'); ?>
<!-- Header Search Popup End -->