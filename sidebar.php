<?php if ( ! is_active_sidebar( 'blog-sidebar' ) ) {
  return;
}
?>

<aside class="secondary-content">
  <?php dynamic_sidebar( 'blog-sidebar' ); ?>
</aside>
