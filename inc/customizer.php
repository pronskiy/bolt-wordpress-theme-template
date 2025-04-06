<?php
/**
 * Bolt WordPress Theme Theme Customizer
 *
 * @package Bolt_WordPress_Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bolt_theme_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'bolt_theme_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'bolt_theme_customize_partial_blogdescription',
            )
        );
    }

    // Add Theme Colors Section
    $wp_customize->add_section(
        'bolt_theme_colors',
        array(
            'title'    => __('Theme Colors', 'bolt-theme'),
            'priority' => 30,
        )
    );

    // Primary Color Setting
    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#0073aa',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'    => __('Primary Color', 'bolt-theme'),
                'section'  => 'bolt_theme_colors',
                'settings' => 'primary_color',
            )
        )
    );

    // Secondary Color Setting
    $wp_customize->add_setting(
        'secondary_color',
        array(
            'default'           => '#23282d',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'secondary_color',
            array(
                'label'    => __('Secondary Color', 'bolt-theme'),
                'section'  => 'bolt_theme_colors',
                'settings' => 'secondary_color',
            )
        )
    );

    // Footer Text Setting
    $wp_customize->add_section(
        'bolt_theme_footer',
        array(
            'title'    => __('Footer Options', 'bolt-theme'),
            'priority' => 90,
        )
    );

    $wp_customize->add_setting(
        'footer_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'footer_text',
        array(
            'label'    => __('Custom Footer Text', 'bolt-theme'),
            'section'  => 'bolt_theme_footer',
            'type'     => 'text',
        )
    );
}
add_action('customize_register', 'bolt_theme_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bolt_theme_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bolt_theme_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bolt_theme_customize_preview_js() {
    wp_enqueue_script('bolt-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'bolt_theme_customize_preview_js');

/**
 * Generate CSS for the color settings.
 */
function bolt_theme_customizer_css() {
    $primary_color = get_theme_mod('primary_color', '#0073aa');
    $secondary_color = get_theme_mod('secondary_color', '#23282d');
    ?>
    <style type="text/css">
        a {
            color: <?php echo esc_attr($primary_color); ?>;
        }
        a:hover {
            color: <?php echo esc_attr(bolt_theme_adjust_brightness($primary_color, 20)); ?>;
        }
        .main-navigation a:hover,
        .site-title a:hover {
            color: <?php echo esc_attr($primary_color); ?>;
        }
        .site-footer {
            background-color: <?php echo esc_attr($secondary_color); ?>;
        }
        button, input[type="button"], input[type="reset"], input[type="submit"] {
            background-color: <?php echo esc_attr($primary_color); ?>;
        }
        button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover {
            background-color: <?php echo esc_attr(bolt_theme_adjust_brightness($primary_color, 20)); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'bolt_theme_customizer_css');

/**
 * Adjust brightness of a color.
 *
 * @param string $hex Hex color code.
 * @param int $steps Steps to adjust brightness (positive for lighter, negative for darker).
 * @return string Adjusted hex color.
 */
function bolt_theme_adjust_brightness($hex, $steps) {
    // Remove # if present
    $hex = ltrim($hex, '#');

    // Convert to RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    // Adjust brightness
    $r = max(0, min(255, $r + $steps));
    $g = max(0, min(255, $g + $steps));
    $b = max(0, min(255, $b + $steps));

    // Convert back to hex
    return '#' . sprintf('%02x%02x%02x', $r, $g, $b);
}