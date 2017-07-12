<?php get_header(); ?>
<main class="page_content">
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="post-header">
          <div class="row">
            <div class="small-12 columns">
              <h1><?php the_title(); ?></h1>
            </div><!-- .columns -->
          </div><!-- .row -->
        </header>
        <section class="layout-section the_content">
          <div class="row">
            <div class="small-12 columns">
              <?php the_content(); ?>
            </div><!-- .columns -->
          </div><!-- .row -->
        </section>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
