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
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/css/style.css', array( 'parent-style' ), '0.2' );
}
add_action( 'wp_enqueue_scripts', 'wpstarter_child_style');

/**
 * Enqueue our child-theme scripts - Priority set high to load before wpforge-functions.php file.
 */
function wpstarter_child_scripts() {
    wp_enqueue_script( 'wpstarter-js', get_stylesheet_directory_uri() . '/js/wpstarter-functions.js', array(), '3.0', true );
    wp_enqueue_script( 'wpstarter-isotope', '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.0/isotope.pkgd.min.js' );
}
add_action( 'wp_enqueue_scripts', 'wpstarter_child_scripts', 0);

function wpforge_entry_meta_categories() {
    // Translators: used between list items, there is a space after the comma.
    /*$categories_list = get_the_category_list( __( ', ', 'wp-forge' ) );
    if ( $categories_list ) {
        echo '<div class="entry-meta-categories"><span class="categories-links">' . $categories_list . '</span></div>';
    }*/
}


// enable html markup in user profiles
// remove_filter('pre_user_description', 'wp_filter_kses');

function add_custom_types_to_tax( $query ) {
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {

        // Get all your post types
        $post_types = get_post_types();

        $query->set( 'post_type', $post_types );
        return $query;
    }
}
add_filter( 'pre_get_posts', 'add_custom_types_to_tax' );

function expandingBoxHolder($attr, $content= null){
    global $item;
    global $count;
    global $newFlag;
    $newFlag = $count;
    $item++;
    $default = array(
          'style' => 'default'
        );

    $data = shortcode_atts($default, $attr);

    $content = do_shortcode($content);

    return '<ul class="schedule-overview '.$data['style'].'">' . $content . '</ul>';
}

function expandingBox_nested($attr, $content= null){
    global $count;
    global $item;
    global $newFlag;

    $default = array(
        'time' => '',
        'title' => 'Insert Your Title'
        );
    $data = shortcode_atts($default, $attr);
    $content = do_shortcode($content);
    $class = ( $count === $newFlag ) ? ' in' : '';
    
    $count++;

    if ($data['time']) $title = '<b>' . $data['time'] . '</b></span><span>' . $data['title'];
    else $title = $data['title'];

    return '<li><div class="schedule-title"><span>' . $title .
    '</span></div><div class="schedule-text">' . $content .
    '</div><div class="marker-pin">
        <div class="top"></div>
        <div class="middle"></div>
        <div class="bottom"></div>
    </div></li>';
}
add_filter( 'the_content', 'shortcode_unautop' );
add_shortcode('ex_box_holder','expandingBoxHolder');
add_shortcode('ex_box','expandingBox_nested');

function load_pgr_quicktags() {
 
    wp_enqueue_script( 'exbox-quicktags', get_stylesheet_directory_uri() . '/js/ex_box_quicktags.js' , array( 'quicktags' ) );
 
}
 
add_action( 'admin_enqueue_scripts', 'load_pgr_quicktags' );

?>