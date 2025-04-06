<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Bolt_WordPress_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bolt_theme_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'bolt_theme_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bolt_theme_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'bolt_theme_pingback_header');

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function bolt_theme_post_classes($classes) {
    // Add a class if there is a featured image.
    if (has_post_thumbnail()) {
        $classes[] = 'has-thumbnail';
    }

    return $classes;
}
add_filter('post_class', 'bolt_theme_post_classes');

/**
 * Changes the default excerpt length.
 *
 * @param int $length Excerpt length.
 * @return int Modified excerpt length.
 */
function bolt_theme_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'bolt_theme_excerpt_length');

/**
 * Changes the excerpt more string.
 *
 * @param string $more The string shown within the more link.
 * @return string
 */
function bolt_theme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'bolt_theme_excerpt_more');