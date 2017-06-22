<?php get_header(); ?>
<main id="page_content">
  <section class="error-404 not-found">
    <header class="post-header">
     <div class="row">
       <div class="small-12 columns">
         <h1 class="post-title"><i class="fa fa-fw fa-lg fa-chain-broken"></i><?php esc_html_e( 'Oops! That page can&rsquo;t be found.'); ?></h1>
       </div><!-- .columns -->
     </div><!-- .row -->
   </header>
   <div class="row">
    <div class="small-12 columns">
      <p><em><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links in the main menu or a search?'); ?></em></p>
      <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="button"><i class="fa fa-fw fa-home"></i>&nbsp;<?php _e('Go Back to the Homepage') ?></a></p>
      <?php get_search_form(); ?>
    </div><!-- .columns -->
  </div><!-- .row -->
</section>
</main>
<?php get_footer(); ?>
