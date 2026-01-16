<div class="search-popup">
  <div class="search-popup-overlay search-toggler"></div>
  <div class="search-popup-content">
    <form method="get" id="searchform-all" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
      <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search …', 'nexsol' ) ?>"
        value="<?php echo get_search_query() ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'nexsol' ) ?>" />
      <button id="submit" type="submit" class="search-submit">
        <i class="webexbase-icon-search-11"></i>
      </button>
    </form>
  </div>
</div>