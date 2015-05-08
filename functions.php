<?php
/**
 * WP-Starter functions and definitions
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage WP_Starter
 * @since WP-Starter 3.0
 */

/**
 * Declare a textdomain for your child theme.
 * Translations can be filed in the /languages/ directory.
 *
 * @see https://codex.wordpress.org/Function_Reference/load_child_theme_textdomain
 * @since WP-Starter 3.0
 */
function wpstarter_theme_setup() {
	load_child_theme_textdomain( 'wp-forge', get_stylesheet_directory() . '/language' );
}
add_action( 'after_setup_theme', 'wpstarter_theme_setup' );

/**
 * Enqueue our child-theme style sheets
 */
function wpstarter_child_style() {
    wp_dequeue_style('wpforge');
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', '', '3.0' );
    // wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'parent-style' ), '3.0' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/css/style.css', array( 'parent-style' ), '3.0' );
}
add_action( 'wp_enqueue_scripts', 'wpstarter_child_style');

/**
 * Enqueue our child-theme scripts - Priority set high to load before wpforge-functions.php file.
 */
function wpstarter_child_scripts() {
    wp_enqueue_script( 'wpstarter-js', get_stylesheet_directory_uri() . '/js/wpstarter-functions.js', array(), '3.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpstarter_child_scripts', 0);

if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'name' => 'Center Footerbar',
            'id'   => 'footerbar-center',
            'before_widget' => '<div class="medium-3">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>'
        ));
}
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Right Footerbar',
        'id'   => 'footerbar-right',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>'
    ));
}

?>