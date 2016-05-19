<?php
# Define image sizes, make sure big goes at the top
# [image-name] => array( [width], [height], [crop])
$image_sizes = array(
  'wp-wide'   => array(1920, 1200, true),
  'wp-large'  => array(1280, 800,  true),
  'wp-medium' => array(960,  720,  true),
  'wp-small'  => array(640,  640,  true),
);

//---------------------------------------------------------------
# Register each of the images from the array above
foreach($image_sizes as $name => $attr){
  add_image_size( $name, $attr[0], $attr[1], $attr[2]);
}

//---------------------------------------------------------------
# use this function in your page templates to get fancy HTML5 responsive images
function picture($attachment_id){
  $min_width = 0;
  if(!$alt){
    $post = get_post($attachment_id);
    $alt = $post->post_title;
  }

  echo '<picture>';
  echo '<!--[if IE 9]><video style="display: none;"><![endif]-->';

  foreach($image_sizes as $name => $attr){
    $srcset = wp_get_attachment_image_src($attachment_id, $name);
    echo '<source srcset="'.$srcset[0].'" media="(min-width: '.$min_width.'px)">';
    $min_width = $attr[0];
  }

  $default_name = key($image_sizes);
  $default_srcset = wp_get_attachment_image_src($attachment_id, $default_name);
  echo '<img srcset="'.$default_srcset[0].'" alt="'.$alt.'">';

  echo '<!--[if IE 9]></video><![endif]-->';
  echo '</picture>';
}
