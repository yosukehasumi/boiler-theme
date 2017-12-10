<?php
// Admin Functions
//---------------------------------------------------------------
function site_init() {
  # Add menus support
  add_theme_support( 'menus' );

  # Add thumbnail support, define custom post types that it should apply to
  add_theme_support( 'post-thumbnails' );

  # set the default image link in wordpress to none so images don't have stupid links going to attachment pages
  update_option('image_default_link_type','none');

  # Hide the admin bar on the front end even when you are logged in
  if(isset($_ENV['MRI_ENVIRONMENT']) && $_ENV['MRI_ENVIRONMENT'] == 'development' ) {
    add_filter('show_admin_bar', '__return_false');
  }
}
add_action( 'init', 'site_init' );

//---------------------------------------------------------------
# Function for removing menus on the dashboard
function remove_menus(){
  // remove_menu_page( 'index.php' );                  //Dashboard
  // remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit.php' );                   //Pages
  remove_menu_page( 'edit-comments.php' );             //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'users.php' );                  //Users
  // remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'options-general.php' );        //Settings
  remove_submenu_page( 'themes.php', 'themes.php' );
  remove_submenu_page( 'themes.php', 'theme-editor.php' );
  remove_submenu_page( 'themes.php', 'customize.php' );

  global $submenu;
  // unset($submenu['edit.php'][7]); // Available Tools
  // unset($submenu['tools.php'][5]); // Available Tools
  // unset($submenu['tools.php'][10]); // Import
  // unset($submenu['tools.php'][15]); // Export
  unset($submenu['plugins.php'][15]); // Editor
  // unset($submenu['themes.php'][5]); // Themes
  unset($submenu['themes.php'][6]); // Customize
  // unset($submenu['themes.php'][11]); // Editor
}
add_action( 'admin_menu', 'remove_menus', 110 );

//---------------------------------------------------------------
# Remove admin bar links
function remove_admin_bar_nodes( $wp_admin_bar ) {
  $wp_admin_bar->remove_node( 'wp-logo' );
  $wp_admin_bar->remove_node( 'comments' );
  $wp_admin_bar->remove_node( 'new-content' );
}
add_action( 'admin_bar_menu', 'remove_admin_bar_nodes', 999 );

//---------------------------------------------------------------
# A function for adding admin styles to the backend, this will look for admin.css in the template directory
// function admin_styles() {
//   wp_enqueue_style('admin_styles' , get_template_directory_uri().'/admin.css');
// }
// add_action('admin_head', 'admin_styles');
