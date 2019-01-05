<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php wp_title(); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<!--[if IE]>
<div class="browsehappy" style="background-color: #B71C1C; color: white; position:fixed; top: 0; left:0; width: 100%; padding:10px; text-align:center; font-family: sans-serif;" onclick="this.style.display='none';">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank" style="color: #64B5F6;">upgrade your browser</a> to improve your experience.</div>
<![endif]-->
<header id="site-header">

  <a href="<?php echo home_url(); ?>" id="logo_link" class="sprite" title="<?php bloginfo(); ?>"><img src="<?php echo(get_template_directory_uri().'/images/logo.png'); ?>" alt="<?php bloginfo(); ?>"></a>

  <button id="mobile-nav-toggle-button"><span class="show-for-sr">MENU </span><span class="fa fa-bars" aria-hidden="true"></span></button>

  <nav id="header-navigation" class="site-navigation">
    <?php wp_nav_menu(array( 'theme_location'=>'primary', 'container'=>false, 'fallback_cb' => false )); ?>
  </nav>

  <nav id="mobile-navigation" class="site-navigation">
    <?php wp_nav_menu(array( 'theme_location'=>'primary', 'container'=>false, 'fallback_cb' => false )); ?>
  </nav>

</header>
