<footer id="site-footer">

  <nav id="footer-navigation" class="site-navigation">
    <?php wp_nav_menu(array( 'theme_location'=>'footer', 'container'=>false, 'fallback_cb' => false )); ?>
  </nav>

  <small>&copy;&nbsp;<?php echo date('Y'); ?>&nbsp;<strong><?php bloginfo(); ?></strong> | Site Development by <strong><a href="http://mediumrareinc.com" target="_blank">Medium Rare Interactive Inc.</a></strong></small>

</footer>

<?php wp_footer(); ?>

</body>
</html>
