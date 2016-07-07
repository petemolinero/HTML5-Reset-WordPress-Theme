<?php
/**
 * @package WordPress
 * @subpackage Unshackled-Theme
 * @since 1.0
 */
?><!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="" <?php language_attributes(); ?>><!--<![endif]-->

<head data-template-set="html5-reset-wordpress-theme">

	<meta charset="<?php bloginfo('charset'); ?>">

	<!-- Always force latest IE rendering engine (even in intranet) -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->

	<?php
		if (is_search())
			echo '<meta name="robots" content="noindex, nofollow" />';
	?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">

	<!--Google will often use this as its description of your page/site. Make it good.-->
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<meta name="Copyright" content="Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All Rights Reserved.">

	<!-- concatenate and minify for production -->
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<!-- not needed? up to you: http://camendesign.com/code/developpeurs_sans_frontieres -->
	<div id="wrapper">

		<header id="header" role="banner">
			<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<div class="description"><?php bloginfo( 'description' ); ?></div>
		</header>

		<nav id="nav" role="navigation">
			<?php wp_nav_menu( array('theme_location' => 'primary') ); ?>
		</nav>

