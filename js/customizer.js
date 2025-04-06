/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function($) {
    // Site title and description.
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });
    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });

    // Header text color.
    wp.customize('header_textcolor', function(value) {
        value.bind(function(to) {
            if ('blank' === to) {
                $('.site-title, .site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title, .site-description').css({
                    'clip': 'auto',
                    'position': 'relative'
                });
                $('.site-title a, .site-description').css({
                    'color': to
                });
            }
        });
    });

    // Primary color.
    wp.customize('primary_color', function(value) {
        value.bind(function(to) {
            // Update custom color CSS
            var style = $('#bolt-theme-primary-color'),
                color = to;

            if (!style.length) {
                style = $('head').append('<style id="bolt-theme-primary-color"></style>')
                    .find('#bolt-theme-primary-color');
            }

            style.html(`
                a { color: ${color}; }
                a:hover { color: ${adjustBrightness(color, 20)}; }
                .main-navigation a:hover, .site-title a:hover { color: ${color}; }
                button, input[type="button"], input[type="reset"], input[type="submit"] { background-color: ${color}; }
                button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { background-color: ${adjustBrightness(color, 20)}; }
            `);
        });
    });

    // Secondary color.
    wp.customize('secondary_color', function(value) {
        value.bind(function(to) {
            // Update custom color CSS
            var style = $('#bolt-theme-secondary-color'),
                color = to;

            if (!style.length) {
                style = $('head').append('<style id="bolt-theme-secondary-color"></style>')
                    .find('#bolt-theme-secondary-color');
            }

            style.html(`
                .site-footer { background-color: ${color}; }
            `);
        });
    });

    // Footer text.
    wp.customize('footer_text', function(value) {
        value.bind(function(to) {
            $('.site-info').html(to);
        });
    });

    /**
     * Adjust brightness of a hex color
     * 
     * @param {string} hex - The hex color to adjust
     * @param {number} steps - The amount to adjust (positive for lighter, negative for darker)
     * @returns {string} - The adjusted hex color
     */
    function adjustBrightness(hex, steps) {
        // Remove # if present
        hex = hex.replace(/^#/, '');
        
        // Parse r, g, b values
        var r = parseInt(hex.substr(0, 2), 16);
        var g = parseInt(hex.substr(2, 2), 16);
        var b = parseInt(hex.substr(4, 2), 16);
        
        // Adjust brightness
        r = Math.max(0, Math.min(255, r + steps));
        g = Math.max(0, Math.min(255, g + steps));
        b = Math.max(0, Math.min(255, b + steps));
        
        // Convert back to hex
        return '#' + 
            ((1 << 24) + (r << 16) + (g << 8) + b)
            .toString(16)
            .slice(1);
    }
})(jQuery);