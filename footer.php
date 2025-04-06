<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bolt_WordPress_Theme
 */

?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
            
            <nav class="footer-navigation">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer-menu',
                        'menu_id'        => 'footer-menu',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    )
                );
                ?>
            </nav>
            
            <div class="site-info">
                <a href="<?php echo esc_url(__('https://wordpress.org/', 'bolt-theme')); ?>">
                    <?php
                    /* translators: %s: CMS name, i.e. WordPress. */
                    printf(esc_html__('Proudly powered by %s', 'bolt-theme'), 'WordPress');
                    ?>
                </a>
                <span class="sep"> | </span>
                <?php
                /* translators: 1: Theme name, 2: Theme author. */
                printf(esc_html__('Theme: %1$s by %2$s.', 'bolt-theme'), 'Bolt WordPress Theme', '<a href="https://bolt.diy">Bolt.diy</a>');
                ?>
            </div><!-- .site-info -->
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>