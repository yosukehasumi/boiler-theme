<?php get_header(); ?>
<main id="page_content">
  <section class="error-404 not-found">
    <header class="post-header">
      <h1 class="post-title"><i class="fa fa-fw fa-lg fa-chain-broken"></i><?php esc_html_e( 'Oops! That page can&rsquo;t be found.'); ?></h1>
    </header>
    <div class="post-content">
      <p><em><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links in the main menu or a search?'); ?></em></p>
      <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="button"><i class="fa fa-fw fa-home"></i>&nbsp;<?php _e('Go Back to the Homepage') ?></a></p>
      <?php get_search_form(); ?>
    </div>
  </section>
</div>
<?php get_footer(); ?>
