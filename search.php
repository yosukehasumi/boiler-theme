<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 */
get_header(); ?>
<div class="row">
  <div class="small-12 medium-8 columns">
   <section id="primary" class="content-area">
     <main id="main" class="site-main" role="main">

       <?php
       if ( have_posts() ) : ?>

       <header class="page-header">
         <h1 class="page-title"><?php
           printf( esc_html__( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' );
           ?></h1>
         </header><!-- .page-header -->

         <?php
         /* Start the Loop */
         while ( have_posts() ) : the_post();
         get_template_part( 'template-parts/content', 'search' );
         endwhile;
         the_posts_navigation();
         else :
           get_template_part( 'template-parts/content', 'none' );
         endif; ?>

       </main><!-- #main -->
     </section><!-- #primary -->
   </div><!-- .columns -->
   <div class="small-12 medium-4 columns">

    <?php get_sidebar(); ?>

  </div><!-- .columns -->
</div><!-- .row -->

<?php get_footer(); ?>
