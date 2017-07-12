<?php get_header(); ?>

<div class="row">
  <div class="small-12 columns">
    <main class="page_content">
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>

          <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

        <?php endwhile; ?>

        <?php the_posts_navigation(); ?>

      <?php else : ?>

        <?php get_template_part( 'template-parts/content', 'none' ); ?>

      <?php endif; ?>
    </main>
  </div><!-- .columns -->
</div><!-- .row -->

<?php get_footer(); ?>
