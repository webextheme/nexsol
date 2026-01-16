<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package nexsol
 */
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function nexsol_body_classes( $classes ) {
  // Adds a class of hfeed to non-singular pages.
  if ( !is_singular() ) {
      $classes[] = 'hfeed';
  }

  // Adds a class of no-sidebar when there is no sidebar present.
  if ( !is_active_sidebar( 'sidebar' ) ) {
      $classes[] = 'no-sidebar';
  }
  //Check Elementor Page Builder Used or not
  $elementor_active = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

  if ( is_archive() ) {
      $classes[] = !!$elementor_active ? 'page-builder-deactivate' : 'page-builder-deactivate';
  } else {
      $classes[] = !!$elementor_active ? 'page-builder-activate' : 'page-builder-deactivate';
  }
  return $classes;
}
add_filter( 'body_class', 'nexsol_body_classes' );

//Layout Container Width
function add_global_body_class($classes) {
	$webex_get_option = get_option( 'nexsol_Theme_Option' );
	if ( !empty( $webex_get_option['nexsol_container_width'] ) ) {
		$classes[] = 'custom-e-con-container-' . esc_attr( $webex_get_option['nexsol_container_width'] );
	}
  if ( !empty( $webex_get_option['nexsol_dark_light_mood'] ) ) {
		$classes[] = 'layout-' . esc_attr( $webex_get_option['nexsol_dark_light_mood'] );
	}
	return $classes;
}
add_filter('body_class', 'add_global_body_class');


//Pagination
function nexsol_pagination($pages='') {
  global $wp_query, $wp_rewrite;
  $current = isset($wp_query->query_vars['paged']) && $wp_query->query_vars['paged'] > 1 ? $wp_query->query_vars['paged'] : 1;

  if ($pages == '') {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if (!$pages) {
          $pages = 1;
      }
  }

  $pagination = array(
      'base'      => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
      'format'    => '',
      'current'   => max( 1, get_query_var('paged') ),
      'total'     => $pages,
      'prev_text' => '<i class="fa fa-angle-left"></i>',
      'next_text' => '<i class="fa fa-angle-right"></i>',
      'type'      => 'list',
      'end_size'  => 1,
      'mid_size'  => 1
  );

  $return = paginate_links( $pagination );
  if ($return === null) {
      $return = ''; // Ensure $return is a string
  }

  echo str_replace("<ul class='page-numbers'>", '<ul class="pagination-list">', $return);
}


//News Widget Pagination
function nexsol_ele_pagination($ele_pages='') {
  global $wp_ele_query;
  $wp_ele_query->query_vars['paged'] > 1 ? $current = $wp_ele_query->query_vars['paged'] : $current = 1;
  if($ele_pages==''){
    global $wp_ele_query;
    $ele_pages = $wp_ele_query->max_num_pages;
    if(!$ele_pages)
    {
      $pages = 1;
    }
  }
  $pagination = array(
    'base'      => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
    'format'    => '',
    'current'     => max( 1, get_query_var('paged') ),
    'total'     => $ele_pages,
    'prev_text' => '<i class="fa fa-angle-left"></i>',
    'next_text' => '<i class="fa fa-angle-right"></i>',
    'type'      => 'list',
    'end_size'    => 1,
    'mid_size'    => 1
  );
  $return =  paginate_links( $pagination );
  echo str_replace( "<ul class='page-numbers'>", '<ul class="pagination-list">', $return );
}

// Comment Form
function nexsol_theme_comment($comment, $args, $depth) {
    //echo 's';
  $GLOBALS['comment'] = $comment; ?>
  <li class="comment">
    <article class="comment-body">
      <div class="comment-author-thumb f-left">
        <?php echo get_avatar($comment,$size='70' ); ?>
      </div>
      <div class="comment-content">
        <h6 class="comment-author"><?php printf( get_comment_author_link()) ?></h6>
        <div class="comment-meta">
          <div class="comment-metadata">
            <a href="#">
              <span><i class="fa fa-calendar mrr-5"></i> <?php comment_time('F j, Y'); ?> <i class="fa fa-clock-o mrr-5 mrl-5"></i> <?php comment_time('g:i a'); ?> </span>
            </a>
          </div>
        </div>
        <?php comment_text() ?>
        <div class="reply">
          <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
      </div>
    </article>
  </li>
  <?php
}

// Search Form
function nexsol_search_form( $form ) {
  $form = '
  <form action="' . esc_url(home_url('/')) . '" id="searchform-all" method="get">
  <div>
  <input type="search" class="form-control" placeholder="'.esc_html__('Search...', 'nexsol').'" name="s" id="s">
  <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
  </div>
  </form>
  ';
  return $form;
}
add_filter( 'get_search_form', 'nexsol_search_form' );


// Posted By
if (!function_exists('nexsol_posted_by')) :
  /**
   * Prints HTML with meta information for the current author.
   */
  function nexsol_posted_by()
  {
    $posted_by = sprintf(
      /* translators: %s: post author. */
      esc_html_x('%s', 'post author', 'nexsol'),
      '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );
    echo '<span class="byline"><i class="far fa-user"></i> ' . $posted_by . '</span>';
  }
endif;

// Posted On
if (!function_exists('nexsol_posted_on')) :
  /**
   * Prints HTML with meta information for the current post-date/time.
   */
  function nexsol_posted_on()
  {
    $nexsol_posted_time = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
      $nexsol_posted_time = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    }

    $nexsol_posted_time = sprintf(
      $nexsol_posted_time,
      esc_attr(get_the_date(DATE_W3C)),
      esc_html(get_the_date()),
      esc_attr(get_the_modified_date(DATE_W3C)),
      esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
      /* translators: %s: post date. */
      esc_html_x(' %s', 'post date', 'nexsol'),
      '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $nexsol_posted_time . '</a>'
    );
    echo '<span class="posted-on"><i class="far fa-calendar-alt"></i>' . $posted_on . '</span>';
  }
endif;

//Comment Counting
if (!function_exists('nexsol_comment_count')) {
  function nexsol_comment_count()
  {
    if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
      echo '<span class="comments-link"><i class="far fa-comments"></i> ';
      comments_popup_link(
        sprintf(
          wp_kses(
            /* translators: %s: post title */
            esc_html__('Leave a comment', 'nexsol') . '<span class="screen-reader-text">' . esc_html__('on', 'nexsol') . ' %s</span>',
            array(
              'span' => array(
                'class' => array(),
              ),
            )
          ),
          wp_kses_post(get_the_title())
        )
      );
      echo '</span>';
    }
  }
}
//Remove Comment Cookies
add_filter( 'comment_form_default_fields', 'tu_comment_form_hide_cookies_consent' );
function tu_comment_form_hide_cookies_consent( $fields ) {
  unset( $fields['cookies'] );
  return $fields;
}

// Remove comment notes
add_filter('comment_form_defaults', 'jltwp_adminify_remove_comments_notes');
function jltwp_adminify_remove_comments_notes($defaults)
{
  $defaults['comment_notes_before'] = '';
  return $defaults;
}

//Links Pages
function nexsol_link_pages(){
  wp_link_pages( array(
    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'nexsol' ) . '</span>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'nexsol' ) . ' </span>%',
    'separator'   => '',
  ) );
}

//Page Title / Page Header
function nexsol_the_archive_title($title){
  if(is_search()):
    $title = sprintf(esc_html__('Search Results', 'nexsol'));
  elseif(is_404()):
    $title = sprintf(esc_html__('Page Not Found', 'nexsol'));
  elseif(is_page()):
    $title = get_the_title();
  elseif(is_single()):
    $title = get_the_title();
  elseif (is_home() && is_front_page()):
    $title = esc_html__('Blog Posts', 'nexsol');
elseif (is_home() && !is_front_page()):
  $title = get_the_title(get_option('page_for_posts'));
elseif(is_tax() || is_category()  || is_tag()):
  $title = single_term_title('', false);
elseif(is_singular('post')):
  $title = get_the_title(get_the_ID());
endif;
return $title;
}
add_filter('get_the_archive_title', 'nexsol_the_archive_title');


if (!function_exists('nexsol_entry_meta_tags')) :
  /**
   * Prints HTML with meta information for the categories, tags and comments.
   */
  function nexsol_entry_meta_tags()
  {
    // Hide category and tag text for pages.
    if ('post' === get_post_type()) {
      /* translators: used between list items, there is a space after the comma */
      $categories_list = get_the_category_list(esc_html__(' ', 'nexsol'));
      if ($categories_list) {
        /* translators: 1: list of categories. */
        printf('<span class="news__details-cats"><span>' . esc_html__('Categories: %1$s', 'nexsol') . '</span>', '</span>' . $categories_list);
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
      }
      /* translators: used between list items, there is a space after the comma */
      $tags_list = get_the_tag_list('', esc_html_x(' ', 'list item separator', 'nexsol'));
      if ($tags_list) {
        /* translators: 1: list of tags. */
        printf('<span class="news__details-tags"><span>' . esc_html__('Tags: %1$s', 'nexsol') . '</span>', '</span>' . $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
      }
    }
  }
endif;

//Post Thumbnail
if (!function_exists('nexsol_post_thumbnail')) :
  /**
  * Displays an optional post thumbnail.
  *
  * Wraps the post thumbnail in an anchor element on index views, or a div
  * element when on single views.
  */
  function nexsol_post_thumbnail()
  {
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
      return;
    }
    if (is_singular()) : ?>
      <div class="default__news-post-thumbnail news__details-content-img news__details-post-thumbnail no-filter">
        <?php the_post_thumbnail(); ?>
      </div><!-- .post-thumbnail -->

    <?php else : ?>
      <div class="default__news-post-thumbnail-area">
        <a class="default__news-post-thumbnail news__details-content-img  no-filter" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
          <?php
          the_post_thumbnail(
            'post-thumbnail',
            array(
              'alt' => the_title_attribute(
                array(
                  'echo' => false,
                )
              ),
            )
          );
          ?>
        </a>
      </div>
      <?php
    endif; // End is_singular().
  }
endif;

// custom kses allowed html
if (!function_exists('nexsol_allowed_tags')) :
	function nexsol_allowed_tags($tags, $context)
	{
		switch ($context) {
			case 'nexsol_allowed_tags':
				$tags = array(
					'a' => array('href' => array(), 'class' => array()),
					'b' => array(),
					'br' => array(),
					'span' => array('class' => array(), 'data-count' => array()),
					'img' => array('class' => array()),
					'i' => array('class' => array()),
					'p' => array('class' => array()),
					'ul' => array('class' => array()),
					'li' => array('class' => array()),
					'div' => array('class' => array()),
					'strong' => array()
				);
				return $tags;
			default:
				return $tags;
		}
	}

	add_filter('wp_kses_allowed_html', 'nexsol_allowed_tags', 10, 2);

endif;

//Post Excerpt
if (!function_exists('nexsol_excerpt')) :
  // Post's excerpt text
  function nexsol_excerpt($get_limit_value, $echo = true)
  {
    $opt = $get_limit_value;
    $excerpt_limit = !empty($opt) ? $opt : 40;
    $excerpt = wp_trim_words(get_the_content(), $excerpt_limit, '');
    if ($echo == true) {
      echo esc_html($excerpt);
    } else {
      return esc_html($excerpt);
    }
  }
endif;


if ( !function_exists( 'nexsol_options' ) ) {
  function nexsol_options( $option = '', $default = null ) {
    $options = get_option( 'nexsol_Theme_Option' );
    $default = ( !isset( $default ) && isset( $defaults[$option] ) ) ? $defaults[$option] : $default;
    return ( isset( $options[$option] ) ) ? $options[$option] : $default;
  }
}
add_filter( 'csf_welcome_page', '__return_false' );


function nexsol_kses_allowed_html( $tags, $context ) {
  switch ( $context ) {
  case 'nexsol_allowed_html':
    $tags = array(
      'a'  => array(
        'class'  => array(),
        'href'   => array(),
        'rel'    => array(),
        'title'  => array(),
        'target' => array(),
      ),
      'abbr'  => array(
        'title' => array(),
      ),
      'b'  => array(),
      'blockquote'  => array(
        'cite' => array(),
      ),
      'cite'  => array(
        'title' => array(),
      ),
      'code'  => array(),
      'del'  => array(
        'datetime' => array(),
        'title'    => array(),
      ),
      'dd'  => array(),
      'div' => array(
        'class' => array(),
        'title' => array(),
        'style' => array(),
      ),
      'dl'  => array(),
      'dt'  => array(),
      'em'  => array(),
      'h1'  => array(),
      'h2'  => array(),
      'h3'  => array(),
      'h4'  => array(),
      'h5'  => array(),
      'h6'  => array(),
      'i'  => array(
        'class' => array(),
      ),
      'img'  => array(
        'alt'    => array(),
        'class'  => array(),
        'height' => array(),
        'src'    => array(),
        'width'  => array(),
      ),
      'li'  => array(
        'class' => array(),
      ),
      'ol'  => array(
        'class' => array(),
      ),
      'p'  => array(
        'class' => array(),
      ),
      'q'  => array(
        'cite'  => array(),
        'title' => array(),
      ),
      'span'  => array(
        'class' => array(),
        'title' => array(),
        'style' => array(),
      ),
      'iframe' => array(
        'width'       => array(),
        'height'      => array(),
        'scrolling'   => array(),
        'frameborder' => array(),
        'allow'       => array(),
        'src'         => array(),
      ),
      'strike'  => array(),
      'br'  => array(),
      'small'  => array(),
      'strong'  => array(),
      'ul' => array(
          'class' => array(),
      ),
    );
    return $tags;
  default:
  return $tags;
  }
}
add_filter( 'wp_kses_allowed_html', 'nexsol_kses_allowed_html', 10, 2 );

function is_elementor_page() {
  global $post;
  $is_elementor = false;
  if ( \class_exists( '\Elementor\Plugin' ) ) {
    $is_elementor = \Elementor\Plugin::$instance->documents->get( $post->ID )->is_built_with_elementor();
  }
  return $is_elementor;
}

function container() {
  $classes = ['container'];
  if ( is_page() ) {
    if ( is_elementor_page() ) {
      $classes[] = 'container-elementor';
    } else {
      $classes[] = 'container-gap';
    }
  } elseif ( is_single() || 'webex_projects' == get_post_type() ) {
    if ( is_elementor_page() ) {
      $classes[] = 'container-elementor';
    } else {
      $classes[] = 'container-gap';
    }
  } else {
    $classes[] = 'container-gap';
  }
  echo esc_attr( implode( ' ', $classes ) );
}

//woo Pagination Override
add_filter('woocommerce_pagination_args', function($args) {
  $args['prev_text'] = '<i class="webexbase-icon-left-arrow1"></i>';
  $args['next_text'] = '<i class="webexbase-icon-next"></i>';
  return $args;
});

// =============================
// Live Cart Count (AJAX Safe)
// =============================
add_filter( 'woocommerce_add_to_cart_fragments', 'nexsol_cart_count_fragments' );
function nexsol_cart_count_fragments( $fragments ) {
	ob_start();
	?>
	<span class="cart-count" aria-live="polite">
		<?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>
	</span>
	<?php
	$fragments['.cart-count'] = ob_get_clean();
	return $fragments;
}

add_action( 'wp_ajax_update_cart_count', 'nexsol_update_cart_count' );
add_action( 'wp_ajax_nopriv_update_cart_count', 'nexsol_update_cart_count' );
function nexsol_update_cart_count() {
	echo WC()->cart->get_cart_contents_count();
	wp_die();
}
