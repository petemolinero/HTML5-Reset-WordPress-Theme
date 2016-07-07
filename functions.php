<?php
/**
 * @package WordPress
 * @subpackage Unshackled-Theme
 * @since 1.0
 */






// Theme Setup (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
function unshackled_setup() {
	load_theme_textdomain( 'unshackled', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
	register_nav_menu( 'primary', __( 'Navigation Menu', 'unshackled' ) );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'unshackled_setup' );

// Scripts & Styles
function unshackled_scripts_styles() {

	// Load Stylesheets
	wp_enqueue_style( 'unshackled-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'unshackled_scripts_styles' );

/**
 * Provides a standard format for the page title depending on the view. This is
 * filtered so that plugins can provide alternative title formats.
 *
 * @since       1.0.0
 * @link        https://tommcfarlin.com/filter-wp-title/
 *
 * @param       string    $title    Default title text for current view.
 * @param       string    $sep      Optional separator.
 * @return      string              The filtered title.
 */
function improved_wp_title( $title, $sep ) {

    global $paged, $page;

    if ( is_feed() ) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );

    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 ) {
        $title = sprintf( __( 'Page %s', 'mayer' ), max( $paged, $page ) ) . " $sep $title";
    }

    return $title;
}
add_filter( 'wp_title', 'improved_wp_title', 10, 2 );

?>
