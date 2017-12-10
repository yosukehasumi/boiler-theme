<?php get_header(); ?>
<div class="row">
  <div class="small-12 medium-8 columns">
    <main class="page-content">
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>

          <?php get_template_part( 'template-parts/content', 'short-format' ); ?>

        <?php endwhile; ?>

        <?php the_posts_navigation(); ?>

      <?php else : ?>

        <?php get_template_part( 'template-parts/content', 'none' ); ?>

      <?php endif; ?>
    </main>
  </div><!-- .columns -->
  <div class="small-12 medium-8 columns">
    <?php get_sidebar(); ?>
  </div><!-- .columns -->
</div><!-- .row -->
<?php get_footer(); ?>
