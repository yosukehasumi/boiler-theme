<?php get_header(); ?>
<main class="page-content">

  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
          <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
              <?php echo(get_the_date()); ?>
            </div><!-- .entry-meta -->
            <?php
            endif; ?>
          </header><!-- .entry-header -->

          <div class="entry-content">
            <?php
            the_content( sprintf(
              wp_kses(
                __( 'Continue reading<span class="show-for-sr"> "%s"</span>' ),
                array(
                  'span' => array(
                    'class' => array(),
                  ),
                )
              ),
              get_the_title()
            ) );
            wp_link_pages( array(
              'before' => '<div class="page-links">' . esc_html__( 'Pages:' ),
              'after'  => '</div>',
            ) );
            ?>
          </div><!-- .entry-content -->

          <footer class="entry-footer">
            <?php echo(get_the_category_list('<p>POSTED IN: ',', ','</p>')); ?>
            <?php echo(get_the_tag_list('<p>TAGS: ',', ','</p>')); ?>
          </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->

      <?php endwhile; ?>
    <?php endif; ?>

  </main>
  <?php get_footer(); ?>
