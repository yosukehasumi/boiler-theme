<?php get_header(); ?>
<main class="page-content">

  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="post-header">
          <h1><?php the_title(); ?></h1>
        </header>

        <section class="layout-section the_content">
          <?php the_content(); ?>
        </section>

        <footer class="entry-footer">
          <?php echo(get_the_category_list('<p>POSTED IN: ',', ','</p>')); ?>
          <?php echo(get_the_tag_list('<p>TAGS: ',', ','</p>')); ?>
        </footer><!-- .entry-footer -->

      </article>

    <?php endwhile; ?>
  <?php endif; ?>

</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
