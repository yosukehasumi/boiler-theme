<?php get_header(); ?>
<main class="page-content">

  <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <section class="layout-section the_content">
          <?php the_content(); ?>
        </section>

        <?php echo get_flex_content(); ?>

      </article>

    <?php endwhile; ?>
  <?php endif; ?>

</main>
<?php get_footer(); ?>
