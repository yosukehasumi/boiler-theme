<?php
# include ACF setup functions
require_once 'includes/fields/acf-setup-options.php';
require_once 'includes/fields/acf-setup-flex-content.php';
# include ACF display functions
require_once 'includes/views/acf-display-options.php';
require_once 'includes/views/acf-display-flex-content.php';
# include other functions
require_once 'includes/admin-functions.php';
require_once 'includes/display-functions.php';

//---------------------------------------------------------------
function enqueue_custom_scripts() {
  # I remove jquery since I bundle it in with gulp.
  // wp_deregister_script('jquery');

  # Get File Modified Date for Stylesheet and Enqueue
  $site_style_mtime = filemtime(get_template_directory().'/style.css');
  wp_enqueue_style( 'site-style', get_stylesheet_uri(), false, $site_style_mtime );

  # Get File Modified Date for Site JS and Register
  $site_js_mtime = filemtime(get_template_directory().'/js/site.js');
  wp_register_script( 'site-js', get_template_directory_uri() . '/js/site.js', array('jquery'), $site_js_mtime, true );

  # add local variables that might be helpful
  // wp_localize_script( 'site', 'Site', array(
  //   'home_url' => home_url(),
  // ));

  # now enqueue it.
  wp_enqueue_script( 'site-js' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );
//---------------------------------------------------------------
/**
 * Customizing WP Login Page
 */
function enqueue_login_stylesheet() {
  wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
  // wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'enqueue_login_stylesheet' );
function change_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'change_login_logo_url' );

function change_login_logo_url_title() {
  return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'change_login_logo_url_title' );
//---------------------------------------------------------------
/**
 * Register WP Menu Locations
 */
register_nav_menus( array(
  'primary' => esc_html__( 'Primary Menu' ),
  'mobile-quick-links' => esc_html__( 'Mobile Quick Links' ),
  'footer' => esc_html__( 'Footer Menu' ),
  ) );
//---------------------------------------------------------------
/**
 * Register Sidebars
 */
function register_sidebar_locations() {
  register_sidebar( array(
    'name'          => esc_html__( 'Blog Sidebar'),
    'id'            => 'blog-sidebar',
    'description'   => '',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'register_sidebar_locations' );
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

//---------------------------------------------------------------
// Define the WP default image sizes
update_option( 'thumbnail_size_w', 200 );
update_option( 'thumbnail_size_h', 200 );
update_option( 'thumbnail_crop', 1 );
update_option( 'medium_size_w', 600 );
update_option( 'medium_size_h', 600 );
update_option( 'medium_crop', 0 );
update_option( 'large_size_w', 1200 );
update_option( 'large_size_h', 1200 );
update_option( 'large_crop', 0 );

//---------------------------------------------------------------
# Define image sizes, make sure big goes at the top
# [image-name] => array( [width], [height], [crop])
# When adding a new image size, remember to update
# the placeholder image function.
// $image_sizes = array(
//   'image-banner'  => array(1920, 864, true),
//   'hero-slide'    => array(1920, 1056,  true),
//   'feature-tile'  => array(600, 400,  true),
// );

//---------------------------------------------------------------
# Register each of the images from the array above
// foreach($image_sizes as $name => $attr){
//   add_image_size( $name, $attr[0], $attr[1], $attr[2]);
// }
//---------------------------------------------------------------
