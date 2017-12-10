<?php
//---------------------------------------------------------------
# A handy function for determining if the given url is an external link
# if it is determined to be external it will return ' target="_blank" '
# otherwise return an empty string.

function target($url){
  $local = str_replace(array('http://', 'https://'), '', home_url());
  $target = (strpos($url, $local) == false ? ' target="_blank" ' : '');
  return $target;
}

//---------------------------------------------------------------
// Add shortcode to wrap video embeds in content and make them responsive.

function flex_video_shortcode($atts, $content = NULL) {
  $a = shortcode_atts( array(
    'aspect' => ''
    ), $atts );
  $aspect = ($a['aspect'] == 'standard') ?  '' : 'widescreen';
  $content = '<div class="flexvideo '.$aspect.'">'.$content.'</div>';
  return $content;
}
add_shortcode( 'flexvideo', 'flex_video_shortcode' );

//---------------------------------------------------------------
// Add shortcode to insert styled buttons.

function button_shortcode($atts, $content = NULL) {
  $a = shortcode_atts( array(
    'class' => ''
    ), $atts );
  $content = '<span class="button '.$class.'">'.$content.'</span>';
  return $content;
}
add_shortcode( 'button', 'button_shortcode' );

//---------------------------------------------------------------
// Add shortcode to insert a FontAwesome icon.

function icon_shortcode($atts, $content = NULL) {
  $a = shortcode_atts( array(
    'class' => ''
    ), $atts );
  $content = '<i class="fa '.$class.'"></i>';
  return $content;
}
add_shortcode( 'icon', 'icon_shortcode' );

//---------------------------------------------------------------
// Gets a theme-defined placeholder image of a specific size to take the
// place of a missing Featured Image for example.

// function get_placeholder_image_uri($size = 'large') {
//   $image_uri = '';
//   switch ($size) {
//     case 'thumbnail':
//     $image_uri = get_stylesheet_directory_uri().'/images/placeholders/placeholder-300x300.jpg';
//     break;
//     case 'medium':
//     $image_uri = get_stylesheet_directory_uri().'/images/placeholders/placeholder-570x320.jpg';
//     break;
//     case 'large':
//     $image_uri = get_stylesheet_directory_uri().'/images/placeholders/placeholder-1200x540.jpg';
//     break;
//     default:
//     $image_uri = get_stylesheet_directory_uri().'/images/placeholders/placeholder-1920x700.jpg';
//     break;
//   }
//   return  $image_uri;
// }

//---------------------------------------------------------------
// A more powerful excerpt function

function get_excerpt($limit, $content = false, $post_id = false) {
  global $post;
  if(empty($post_id)) {
    $post_id = $post->ID;
  }
  $excerpt = get_post_field('post_excerpt', $post_id, 'raw');
  if(empty($content) && !empty($excerpt)) {
    $content = $excerpt;
  } else {
    $content = get_the_content($post_id);
  }
  $content = strip_tags($content);
  $content = explode(' ', $content, $limit);
  if (count($content) >= $limit) {
    array_pop($content);
    $content = implode(" ",$content).'&hellip;';
  } else {
    $content = implode(" ",$content);
  }
  $content = apply_filters('excerpt', $content);
  return $content;
}

//---------------------------------------------------------------
