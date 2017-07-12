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
        case 'accordion_group' :
        $output .= flex_accordion_group($flex_content);
        break;
        case 'tab_group' :
        $output .= flex_tab_group($flex_content);
        break;
        case 'thumbnail_gallery' :
        $output .= flex_thumbnail_gallery($flex_content);
        break;
      }
    }
  }
  return $output;
}
//---------------------------------------------------------------
function flex_full_width($flex_content){
  $output = '';
  $space_before = (!empty($flex_content['space_before'])) ? 'space_before_'.$flex_content['space_before'] : '';
  $space_after = (!empty($flex_content['space_after'])) ? 'space_after_'.$flex_content['space_after'] : '';
  $section_highlight = (!empty($flex_content['section_highlight']) && $flex_content['section_highlight'] != "none") ? 'padded section_highlight_'.$flex_content['section_highlight'] : '';
  $output .= '<section class="layout-section one_column '.$space_before.' '.$space_after.' '.$section_highlight.'">';
  if(!empty($flex_content['section_title'])) {
    $output .= '<div class="row">';
    $output .= '<div class="small-12 columns">';
    $output .= '<h3 class="section-title">'.$flex_content['section_title'].'</h3>';
    $output .= '</div>';
    $output .= '</div>';
  }
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
  $space_before = (!empty($flex_content['space_before'])) ? 'space_before_'.$flex_content['space_before'] : '';
  $space_after = (!empty($flex_content['space_after'])) ? 'space_after_'.$flex_content['space_after'] : '';
  $section_highlight = (!empty($flex_content['section_highlight']) && $flex_content['section_highlight'] != "none") ? 'padded section_highlight_'.$flex_content['section_highlight'] : '';
  $output .= '<section class="layout-section two_columns '.$space_before.' '.$space_after.' '.$section_highlight.'">';
  if(!empty($flex_content['section_title'])) {
    $output .= '<div class="row">';
    $output .= '<div class="small-12 columns">';
    $output .= '<h3 class="section-title">'.$flex_content['section_title'].'</h3>';
    $output .= '</div>';
    $output .= '</div>';
  }
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
  $space_before = (!empty($flex_content['space_before'])) ? 'space_before_'.$flex_content['space_before'] : '';
  $space_after = (!empty($flex_content['space_after'])) ? 'space_after_'.$flex_content['space_after'] : '';
  $section_highlight = (!empty($flex_content['section_highlight']) && $flex_content['section_highlight'] != "none") ? 'padded section_highlight_'.$flex_content['section_highlight'] : '';
  $output .= '<section class="layout-section three_columns '.$space_before.' '.$space_after.' '.$section_highlight.'">';
  if(!empty($flex_content['section_title'])) {
    $output .= '<div class="row">';
    $output .= '<div class="small-12 columns">';
    $output .= '<h3 class="section-title">'.$flex_content['section_title'].'</h3>';
    $output .= '</div>';
    $output .= '</div>';
  }
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
  $space_before = (!empty($flex_content['space_before'])) ? 'space_before_'.$flex_content['space_before'] : '';
  $space_after = (!empty($flex_content['space_after'])) ? 'space_after_'.$flex_content['space_after'] : '';
  $section_highlight = (!empty($flex_content['section_highlight']) && $flex_content['section_highlight'] != "none") ? 'padded section_highlight_'.$flex_content['section_highlight'] : '';
  $output .= '<section class="layout-section two_columns_sidebar_left '.$space_before.' '.$space_after.' '.$section_highlight.'">';
  if(!empty($flex_content['section_title'])) {
    $output .= '<div class="row">';
    $output .= '<div class="small-12 columns">';
    $output .= '<h3 class="section-title">'.$flex_content['section_title'].'</h3>';
    $output .= '</div>';
    $output .= '</div>';
  }
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
  $space_before = (!empty($flex_content['space_before'])) ? 'space_before_'.$flex_content['space_before'] : '';
  $space_after = (!empty($flex_content['space_after'])) ? 'space_after_'.$flex_content['space_after'] : '';
  $section_highlight = (!empty($flex_content['section_highlight']) && $flex_content['section_highlight'] != "none") ? 'padded section_highlight_'.$flex_content['section_highlight'] : '';
  $output .= '<section class="layout-section two_columns_sidebar_right '.$space_before.' '.$space_after.' '.$section_highlight.'">';
  if(!empty($flex_content['section_title'])) {
    $output .= '<div class="row">';
    $output .= '<div class="small-12 columns">';
    $output .= '<h3 class="section-title">'.$flex_content['section_title'].'</h3>';
    $output .= '</div>';
    $output .= '</div>';
  }
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
  $space_before = (!empty($flex_content['space_before'])) ? 'space_before_'.$flex_content['space_before'] : '';
  $space_after = (!empty($flex_content['space_after'])) ? 'space_after_'.$flex_content['space_after'] : '';
  $section_highlight = (!empty($flex_content['section_highlight']) && $flex_content['section_highlight'] != "none") ? 'padded section_highlight_'.$flex_content['section_highlight'] : '';
  if(count($flex_content['slides']) > 0) {
    $output .= '<section class="layout-section hero_slider '.$space_before.' '.$space_after.' '.$section_highlight.'">';
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
function flex_accordion_group($flex_content) {
  $output = '';
  $space_before = (!empty($flex_content['space_before'])) ? 'space_before_'.$flex_content['space_before'] : '';
  $space_after = (!empty($flex_content['space_after'])) ? 'space_after_'.$flex_content['space_after'] : '';
  $section_highlight = (!empty($flex_content['section_highlight']) && $flex_content['section_highlight'] != "none") ? 'padded section_highlight_'.$flex_content['section_highlight'] : '';
  $output .= '<section class="layout-section accordion_group '.$space_before.' '.$space_after.' '.$section_highlight.'">';
  if(!empty($flex_content['section_title'])) {
    $output .= '<div class="row">';
    $output .= '<div class="small-12 columns">';
    $output .= '<h3 class="section-title">'.$flex_content['section_title'].'</h3>';
    $output .= '</div>';
    $output .= '</div>';
  }
  $output .= '<div class="row">';
  $output .= '<div class="small-12 columns">';
  if($flex_content['panels']) {
    $output .= '<div class="accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">';
    foreach ($flex_content['panels'] as $panel) {
      $is_active = ($panel['panel_open_by_default']) ? 'is-active' : '';
      $output .= '<div class="accordion-item '.$is_active.'" data-accordion-item>';
      $output .= '<a href="#" class="accordion-title">'.$panel['panel_title'].'</a>';
      $output .= '<div class="accordion-content" data-tab-content>';
      $output .= apply_filters('the_content', $panel['panel_content']);
      $output .= '</div>';
      $output .= '</div>';
    }
    $output .= '</div>';
  }
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
//---------------------------------------------------------------
function flex_tab_group($flex_content) {
  $output = '';
  $space_before = (!empty($flex_content['space_before'])) ? 'space_before_'.$flex_content['space_before'] : '';
  $space_after = (!empty($flex_content['space_after'])) ? 'space_after_'.$flex_content['space_after'] : '';
  $section_highlight = (!empty($flex_content['section_highlight']) && $flex_content['section_highlight'] != "none") ? 'padded section_highlight_'.$flex_content['section_highlight'] : '';
  $output .= '<section class="layout-section tab_group '.$space_before.' '.$space_after.' '.$section_highlight.'">';
  if(!empty($flex_content['section_title'])) {
    $output .= '<div class="row">';
    $output .= '<div class="small-12 columns">';
    $output .= '<h3 class="section-title">'.$flex_content['section_title'].'</h3>';
    $output .= '</div>';
    $output .= '</div>';
  }
  $output .= '<div class="row">';
  if($flex_content['panels']) {
    $tab_group_id = uniqid();
    $collapsable = ($flex_content['collapsable_tabs']) ? 'data-active-collapse="true"' : '';
    if($flex_content['tab_orientation'] == 'vertical') {
      // Tabs Are Vertical
      $output .= '<div class="medium-3 columns">';
      $output .= '<ul class="tabs vertical" data-tabs '.$collapsable.' id="'.$tab_group_id.'">';
      foreach ($flex_content['panels'] as $key => $panel) {
        $is_active = ($panel['panel_open_by_default']) ? 'is-active' : '';
        $flex_content['panels'][$key]['panel_id'] = uniqid();
        $output .= '<li class="tabs-title '.$is_active.'"><a href="#'.$flex_content['panels'][$key]['panel_id'].'" aria-selected="true">'.$panel['panel_title'].'</a></li>';
      }
      $output .= '</ul>';
      $output .= '</div>';

      $output .= '<div class="medium-9 columns">';
      $output .= '<div class="tabs-content vertical" data-tabs-content="'.$tab_group_id.'">';
      foreach ($flex_content['panels'] as $key => $panel) {
        $is_active = ($panel['panel_open_by_default']) ? 'is-active' : '';
        $output .= '<div class="tabs-panel '.$is_active.'" id="'.$flex_content['panels'][$key]['panel_id'].'">';
        $output .= apply_filters('the_content', $panel['panel_content']);
        $output .= '</div>';
      }
      $output .= '</div>';
      $output .= '</div>';

    } else {
      // Tabs Are Horizontal
      $output .= '<div class="small-12 columns">';
      $output .= '<ul class="tabs" data-tabs '.$collapsable.' id="'.$tab_group_id.'">';
      foreach ($flex_content['panels'] as $key => $panel) {
        $is_active = ($panel['panel_open_by_default']) ? 'is-active' : '';
        $flex_content['panels'][$key]['panel_id'] = uniqid();
        $output .= '<li class="tabs-title '.$is_active.'"><a href="#'.$flex_content['panels'][$key]['panel_id'].'" aria-selected="true">'.$panel['panel_title'].'</a></li>';
      }
      $output .= '</ul>';
      $output .= '</div>';

      $output .= '<div class="small-12 columns">';
      $output .= '<div class="tabs-content" data-tabs-content="'.$tab_group_id.'">';
      foreach ($flex_content['panels'] as $key => $panel) {
        $is_active = ($panel['panel_open_by_default']) ? 'is-active' : '';
        $output .= '<div class="tabs-panel '.$is_active.'" id="'.$flex_content['panels'][$key]['panel_id'].'">';
        $output .= apply_filters('the_content', $panel['panel_content']);
        $output .= '</div>';
      }
      $output .= '</div>';
      $output .= '</div>';
    }
  }
  $output .= '</div>';
  $output .= '</section>';
  return $output;
}
//---------------------------------------------------------------
function flex_thumbnail_gallery($flex_content) {
  $output = '';
  $space_before = (!empty($flex_content['space_before'])) ? 'space_before_'.$flex_content['space_before'] : '';
  $space_after = (!empty($flex_content['space_after'])) ? 'space_after_'.$flex_content['space_after'] : '';
  $section_highlight = (!empty($flex_content['section_highlight']) && $flex_content['section_highlight'] != "none") ? 'padded section_highlight_'.$flex_content['section_highlight'] : '';
  $output .= '<section class="layout-section thumbnail_gallery '.$space_before.' '.$space_after.' '.$section_highlight.'">';
  if(!empty($flex_content['section_title'])) {
    $output .= '<div class="row">';
    $output .= '<div class="small-12 columns">';
    $output .= '<h3 class="section-title">'.$flex_content['section_title'].'</h3>';
    $output .= '</div>';
    $output .= '</div>';
  }
  if($flex_content['gallery']) {
    $output .= '<div class="row small-up-2 medium-up-3 large-up-6">';
    $lightbox_group_id = uniqid();
    foreach ($flex_content['gallery'] as $image) {
      $output .= '<div class="column column-block">';
      $output .= '<a href="'.$image['url'].'" data-imagelightbox="'.$lightbox_group_id.'"><img src="'.$image['sizes']['thumbnail'].'" alt="'.$image['alt'].'"></a>';
      $output .= '</div>';
    }
    $output .= '</div>';
  }
  $output .= '</section>';
  return $output;
}
