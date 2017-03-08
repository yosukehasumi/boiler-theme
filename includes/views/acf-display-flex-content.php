<?php
//---------------------------------------------------------------
# get the fields inputed for flexible content blocks
function get_flex_content(){
  global $post;
  $output = '';
  if($flex_contents = get_field('page_flex_content')){
    foreach($flex_contents as $flex_content){
      switch($flex_content['acf_fc_layout']){
        case 'one_column' :
        $output .= flex_full_width($flex_content);
        break;
        case 'two_columns' :
        $output .= flex_two_col($flex_content);
        break;
        case 'three_columns' :
        $output .= flex_three_col($flex_content);
        break;
        case 'two_columns_sidebar_left' :
        $output .= flex_two_columns_sidebar_left($flex_content);
        break;
        case 'two_columns_sidebar_right' :
        $output .= flex_two_columns_sidebar_right($flex_content);
        break;
        case 'hero_slider' :
        $output .= flex_hero_slider($flex_content);
        break;
        case 'triple_stacked_tiles' :
        $output .= flex_triple_stacked_tiles($flex_content);
        break;
        case 'dual_promo_tiles' :
        $output .= flex_dual_promo_tiles($flex_content);
        break;
        case 'testimonial_slider' :
        $output .= flex_testimonial_slider($flex_content);
        break;
      }
    }
  }
  return $output;
}
//---------------------------------------------------------------
function flex_full_width($flex_content){
  $output = '';
  $output .= '<section class="layout-section one_column">';
  $output .= '<div class="row">';
  $output .= '<div class="small-12 columns">';
  $output .= apply_filters( 'the_content', $flex_content['column1'] );
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
//---------------------------------------------------------------
function flex_two_col($flex_content){
  $output = '';
  $output .= '<section class="layout-section two_columns">';
  $output .= '<div class="row">';
  $output .= '<div class="small-12 medium-6 columns">'.apply_filters( 'the_content', $flex_content['column1'] ).'</div>';
  $output .= '<div class="small-12 medium-6 columns">'.apply_filters( 'the_content', $flex_content['column2'] ).'</div>';
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
//---------------------------------------------------------------
function flex_three_col($flex_content){
  $output = '';
  $output .= '<section class="layout-section three_columns">';
  $output .= '<div class="row">';
  $output .= '<div class="small-12 medium-4 columns">'.apply_filters( 'the_content', $flex_content['column1'] ).'</div>';
  $output .= '<div class="small-12 medium-4 columns">'.apply_filters( 'the_content', $flex_content['column2'] ).'</div>';
  $output .= '<div class="small-12 medium-4 columns">'.apply_filters( 'the_content', $flex_content['column3'] ).'</div>';
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
//---------------------------------------------------------------
function flex_two_columns_sidebar_left($flex_content){
  $output = '';
  $output .= '<section class="layout-section two_columns_sidebar_left">';
  $output .= '<div class="row">';
  $output .= '<div class="small-12 medium-4 columns">'.apply_filters( 'the_content', $flex_content['column1'] ).'</div>';
  $output .= '<div class="small-12 medium-8 columns">'.apply_filters( 'the_content', $flex_content['column2'] ).'</div>';
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
//---------------------------------------------------------------
function flex_two_columns_sidebar_right($flex_content){
  $output = '';
  $output .= '<section class="layout-section two_columns_sidebar_right">';
  $output .= '<div class="row">';
  $output .= '<div class="small-12 medium-8 columns">'.apply_filters( 'the_content', $flex_content['column1'] ).'</div>';
  $output .= '<div class="small-12 medium-4 columns">'.apply_filters( 'the_content', $flex_content['column2'] ).'</div>';
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
//---------------------------------------------------------------
function flex_hero_slider($flex_content){
  $output = '';
  if(count($flex_content['slides']) > 0) {
    $output .= '<section class="layout-section hero_slider padded-extra">';
    $output .= '<div class="row">';
    $output .= '<div class="hero-slider cycle-slideshow" data-cycle-auto-height="container" data-cycle-fx="scrollHorz" data-cycle-timeout="8000" data-cycle-slides="> div.hero-slide">';
    foreach ($flex_content['slides'] as $slide) {
      $background = (!empty($slide['slide_background'])) ? 'style="background-image: url('.$slide['slide_background']['sizes']['hero-slide'].')";': '';
      $output .= '<div class="hero-slide" '.$background.'>';
      if(!empty($slide['slide_image'])) {
      $output .= '<div class="hero-slide-image-wrapper">';
      $output .= '<img src="'.$slide['slide_image']['sizes']['medium'].'" alt="'.$slide['slide_image']['alt'].'">';
      $output .= '</div>';
      }
      $output .= '<div class="hero-slide-content">';

      if(!empty($slide['slide_link'])) $output .= '<a href="'.$slide['slide_link'].'" class="hero-slide-link">';
      if(!empty($slide['slide_title'])) $output .= '<h2 class="hero-slide-title">'.$slide['slide_title'].'</h2>';
      if(!empty($slide['slide_link'])) $output .= '</a>';
      if(!empty($slide['slide_description'])) $output .= $slide['slide_description'];
      $output .= '</div>';
      $output .= '</div>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';
  }
  return $output;
}
//---------------------------------------------------------------
function flex_triple_stacked_tiles($flex_content) {
  $output = '';
  $output .= '<section class="layout-section triple_stacked_tiles padded">';
  $output .= '<div class="row make-it-flex">';
  $output .= '<div class="tile_column_left">';
  $output .= '<div class="tile_one">';
  $output .= '<div class="tile-inner">';
  $output .= '<h4>'.$flex_content['tile_1_title'].'</h4>';
  $output .= $flex_content['tile_1_description'];
  $output .= '<a href="'.$flex_content['tile_1_link'].'">'.$flex_content['tile_1_link'].'</a>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '<div class="tile_column_right">';
  $output .= '<div class="tile_two">';
  $output .= '<div class="tile-inner">';
  $output .= '<h4>'.$flex_content['tile_2_title'].'</h4>';
  $output .= $flex_content['tile_2_description'];
  $output .= '<a href="'.$flex_content['tile_2_link'].'">'.$flex_content['tile_2_link'].'</a>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '<div class="tile_three">';
  $output .= '<div class="tile-inner">';
  $output .= '<h4>'.$flex_content['tile_3_title'].'</h4>';
  $output .= $flex_content['tile_3_description'];
  $output .= '<a href="'.$flex_content['tile_3_link'].'">'.$flex_content['tile_3_link'].'</a>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
//---------------------------------------------------------------
function flex_dual_promo_tiles($flex_content) {
  $output = '';
  $output .= '<section class="layout-section dual_promo_tiles padded-extra">';
  $output .= '<div class="row collapse">';
  $tile_1_background = (!empty($flex_content['tile_1_image'])) ? 'style="background-image: url('.$flex_content['tile_1_image']['sizes']['promo-tile'].')";' : '';
  $output .= '<div class="small-12 medium-6 columns">';
  $output .= '<div class="tile_one" '.$tile_1_background.'>';
  $output .= '<div class="tile-inner">';
  $output .= '<h4>'.$flex_content['tile_1_title'].'</h4>';
  $output .= $flex_content['tile_1_description'];
  $output .= '<a href="'.$flex_content['tile_1_link'].'">'.$flex_content['tile_1_link'].'</a>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $tile_2_background = (!empty($flex_content['tile_2_image'])) ? 'style="background-image: url('.$flex_content['tile_2_image']['sizes']['promo-tile'].')";' : '';
  $output .= '<div class="small-12 medium-6 columns">';
  $output .= '<div class="tile_two" '.$tile_2_background.'>';
  $output .= '<div class="tile-inner">';
  $output .= '<h4>'.$flex_content['tile_2_title'].'</h4>';
  $output .= $flex_content['tile_2_description'];
  $output .= '<a href="'.$flex_content['tile_2_link'].'">'.$flex_content['tile_2_link'].'</a>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
//---------------------------------------------------------------
function flex_testimonial_slider($flex_content) {
  $output = '';
  $testimonials = get_posts(array(
    'post_type' => 'testimonial',
    'posts_per_page' => -1,
    ));
  if($testimonials) {
    $output .= '<section class="layout-section testimonial_slider padded">';
    $output .= '<div class="row">';
    $output .= '<div class="testimonial-slider cycle-slideshow" data-cycle-fx="fade" data-cycle-timeout="8000" data-cycle-slides="> div.testimonial-slide" data-cycle-pager=".testimonial-pager" data-cycle-pager-template="<span class=\'testimonial-pager-icon\'></span>">';
    $output .= '<div class="testimonial-pager"></div>';
    foreach ($testimonials as $testimonial) {
      $testimonial_id = $testimonial->ID;
      $background_image = get_field('slide_background', $testimonial_id);
      $background = ($background_image) ? 'style="background-image: url('.$background_image['sizes']['hero-slide'].')";': '';
      $output .= '<div class="testimonial-slide" '.$background.'>';
      $slide_image = get_field('slide_image', $testimonial_id);
      if($slide_image) {
      $output .= '<div class="testimonial-slide-image-wrapper">';
      $output .= '<img src="'.$slide_image['sizes']['medium'].'" alt="'.$slide_image['alt'].'">';
      $output .= '</div>';
      }
      $output .= '<div class="testimonial-slide-content">';

      $output .= '<blockquote class="testimonial-slide-blockquote">';
      $description = get_field('testimonial_description', $testimonial_id);
      if($description) $output .= $description;
      $byline = get_field('testimonial_byline', $testimonial_id);
      if($byline) $output .= '<cite>'.$byline.'</cite>';
      $output .= '</blockquote>';

      $output .= '</div>';
      $output .= '</div>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';
  }
  return $output;
}
