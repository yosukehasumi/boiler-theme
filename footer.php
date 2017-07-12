<footer id="site_footer">
  <div class="row">
    <div class="small-12 medium-6 large-3 columns">
      [col one]<br>
      <nav id="footer-navigation" class="site-navigation">
        <?php wp_nav_menu(array( 'theme_location'=>'footer', 'container'=>false, 'fallback_cb' => false )); ?>
      </nav>
    </div><!-- .columns -->
    <div class="small-12 medium-6 large-3 columns">
      [col two]
    </div><!-- .columns -->
    <div class="small-12 medium-6 large-3 columns">
      [col three]
    </div><!-- .columns -->
    <div class="small-12 medium-6 large-3 columns">
      [col four]
    </div><!-- .columns -->
  </div><!-- .row -->
  <div class="row">
    <div class="small-12 columns text-center">
      <small>&copy;&nbsp;<?php echo date('Y'); ?>&nbsp;<strong><?php bloginfo(); ?></strong> | Site Development by <strong><a href="http://mediumrareinc.com" target="_blank">Medium Rare Interactive Inc.</a></strong></small>
    </div><!-- .columns -->
  </div><!-- .row -->
</footer>
<?php wp_footer(); ?>
</body>
</html>
