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
