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
require_once 'includes/picture.php';

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

