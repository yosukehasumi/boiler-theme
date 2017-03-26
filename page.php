<?php get_header(); ?>
<main class="page_content">
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

  <?php echo get_flex_content(); ?>

</article>
</main>
<?php get_footer(); ?>
