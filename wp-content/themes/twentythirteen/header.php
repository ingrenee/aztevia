<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/foundation/css/foundation.css" />
    <script src="<?php echo get_template_directory_uri(); ?>/foundation/js/modernizr.js"></script>
	
	<?php wp_head(); ?>
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/custom.css" />
	
</head>

<body <?php body_class(); ?>>

<div class="toptheme">
<div class="row">

<div class="large-2 columns border-r">
<span class="central">Llamanos 0800-123-645</span>
</div>

<div class="large-2 columns border-r">
<span class="contactanos">Contactanos</span>
</div>


<div class="large-2 columns">
Enlaces sociales
</div>

<div class="large-3 columns">
<div class="search">
<?php get_search_form(); ?>
</div>
</div>




</div>
</div>

<div class="headertheme">
<div class="row">
<div class="large-4 medium-4 columns">
		<a href="#" class="logo">
				<span>Aztevia.com</span>
				</a>
</div>
		
		<div class="large-4 medium-4 columns">
				<a href="#" class="link-car">Ver Carrito de compras</a>
		</div>

</div>

<div class="row">
		<div class="large-10 columns">
				
				
				
				<div id="navbar" class="navbar">
						<nav id="site-navigation" class="navigation main-navigation" role="navigation">
								<h3 class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></h3>
								<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>
								<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
								
								</nav><!-- #site-navigation -->
						</div>
				
				
				
				</div>
</div>


</div>




	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</a>

			<!-- #navbar -->
		</header><!-- #masthead -->

		<div id="main" class="site-main">
