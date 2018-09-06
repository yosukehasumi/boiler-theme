<?php
//---------------------------------------------------------------
// Wordpress injects emojis when you type stuff like :)
// This function disables this and prevents unecessary http requests.

function disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emojis' );

//---------------------------------------------------------------
// Wordpress adds extra scripting for embeds, I don't know what this means,
// but I've never needed them, so I disable them to reduce http requests.

function custom_disable_embeds_init() {
  remove_action('rest_api_init', 'wp_oembed_register_route');
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'custom_disable_embeds_init', 9999);

//---------------------------------------------------------------
// Add helpful css classes to <body> here

function body_classes( $classes ){
  if(is_singular()) {
    global $post;
    array_push( $classes, "{$post->post_type}-{$post->post_name}" );
  }
  return $classes;
}
add_filter( 'body_class', 'body_classes' );

//---------------------------------------------------------------
// Moving Yoast SEO Metabox Down

add_filter( 'wpseo_metabox_prio', 'send_yoast_seo_metabox_to_bottom' );
function send_yoast_seo_metabox_to_bottom() {
  return 'low';
}

//---------------------------------------------------------------
// Public-facing AJAX handler functions need to be passed like 'my_action'.

// add_action( 'wp_ajax_my_action', 'my_action' );
// add_action( 'wp_ajax_nopriv_my_action', 'my_action' );

//---------------------------------------------------------------
// Disable WP Responsive SRCSET on Images
add_filter( 'wp_calculate_image_srcset', '__return_false' );

//---------------------------------------------------------------
// Add New Query Vars
// function add_custom_query_vars( $vars ) {
//  $vars[] = 'new_var_name';
//  return $vars;
// }
// add_filter('query_vars', 'add_custom_query_vars');
