<?php
//---------------------------------------------------------------
# a handy function for determining if the given url is an external link
# if it is determined to be external it will return ' target="_blank" '
# otherwise return an empty string.
function target($url){
  $local = str_replace(array('http://', 'https://'), '', home_url());
  $target = (strpos($url, $local) == false ? ' target="_blank" ' : '');
  return $target;
}
//---------------------------------------------------------------
/**
* Add shortcode to wrap video embeds in content and make them responsive.
*/
function flex_video_shortcode($atts, $content = NULL) {
  $a = shortcode_atts( array(
    'source' => '',
    'aspect' => ''
    ), $atts );
  ($a['source'] == 'vimeo') ? $source = 'vimeo' : $source = '';
  ($a['aspect'] == 'standard') ? $aspect = '' : $aspect = 'widescreen';
  $pre_content = '<div class="flex-video '.$source.' '.$aspect.'">';
  $post_content = '</div>';
  return $pre_content.$content.$post_content;
}
add_shortcode( 'flex-video', 'flex_video_shortcode' );
//---------------------------------------------------------------
function get_placeholder_image_uri($size = 'large') {
  $image_uri = '';
  switch ($size) {
    case 'thumbnail':
    $image_uri = get_stylesheet_directory_uri().'/images/placeholder-300x300.jpg';
    break;
    case 'medium':
    $image_uri = get_stylesheet_directory_uri().'/images/placeholder-570x320.jpg';
    break;
    case 'large':
    $image_uri = get_stylesheet_directory_uri().'/images/placeholder-1200x540.jpg';
    break;
    default:
    $image_uri = get_stylesheet_directory_uri().'/images/placeholder-1920x700.jpg';
    break;
  }
  return  $image_uri;
}
//---------------------------------------------------------------
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
