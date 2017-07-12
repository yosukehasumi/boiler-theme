<form method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <div class="input-group">
    <span class="show-for-sr"><?php echo _x( 'Search for:', 'label' ) ?></span>
    <input type="search" class="input-group-field search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    <div class="input-group-button">
      <input type="submit" class="search-submit button postfix" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
    </div>
  </div>
</form>
