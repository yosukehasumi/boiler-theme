<?php
# include functions
require_once 'includes/acf-display-functions.php';
require_once 'includes/acf-setup.php';
require_once 'includes/admin-functions.php';
require_once 'includes/display-functions.php';
require_once 'includes/picture.php';

//---------------------------------------------------------------
# wordpress injects emojis when you type stuff like :)
# This function disables this and prevents unecessary http requests
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
# wordpress adds extra scripting for embeds, i don't know what this means
# but I've never needed them, so i disable them to reduce http requests
function custom_disable_embeds_init() {
  remove_action('rest_api_init', 'wp_oembed_register_route');
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'custom_disable_embeds_init', 9999);

//---------------------------------------------------------------
# Add helpful css classes to <body> here
function body_classes( $classes ){
  if(is_singular()) {
    global $post;
    array_push( $classes, "{$post->post_type}-{$post->post_name}" );
  }
  return $classes;
}
add_filter( 'body_class', 'body_classes' );

//---------------------------------------------------------------
function enqueue_custom_scripts() {
  # I remove jquery since I bundle it in with gulp.
  wp_deregister_script('jquery');

  # register site.js but don't enqueue it yet
  wp_register_script( 'site', get_template_directory_uri() . '/js/site.js', false, '1.0.0', true );

  # add local variables that might be helpful
  // wp_localize_script( 'site', 'Site', array(
  //   'home_url' => home_url(),
  // ));

  # now enqueue it.
  wp_enqueue_script( 'site' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );
//---------------------------------------------------------------

# Handy function for registering new post types
# dashicons can be found here: https://developer.wordpress.org/resource/dashicons/
// function register_post_types() {
//   $args = array(
//     'public' => true,
//     'menu_icon' => 'dashicons-admin-users',
//     'label'  => 'Team',
//     'supports' => array('title', 'thumbnail')
//   );
//   register_post_type( 'team', $args );
// }
// add_action( 'init', 'register_post_types' );

