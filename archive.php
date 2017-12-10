<?php
/**
* The template for displaying archive pages
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
*/
get_header(); ?>
<main class="page-content">

  <?php if ( have_posts() ) : ?>

    <header class="page-header">
      <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
      <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
    </header><!-- .page-header -->

    <?php while ( have_posts() ) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

          <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
              <?php echo(get_the_date()); ?>
            </div><!-- .entry-meta -->
          <?php endif; ?>
        </header><!-- .entry-header -->

        <div class="entry-summary">
          <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->

        <footer class="entry-footer">
          <?php echo(get_the_category_list('<p>POSTED IN: ',', ','</p>')); ?>
          <?php echo(get_the_tag_list('<p>TAGS: ',', ','</p>')); ?>
        </footer><!-- .entry-footer -->
      </article><!-- #post-<?php the_ID(); ?> -->

    <?php endwhile; ?>

    <?php the_posts_navigation(); ?>

  <?php else : ?>

    <?php get_template_part( 'template-parts/content', 'none' ); ?>

  <?php endif; ?>

</main><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
