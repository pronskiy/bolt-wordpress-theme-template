# Bolt WordPress Theme Template

A modern, clean WordPress theme template designed for customization with Bolt.diy.

![Bolt WordPress Theme](screenshot.png)

## Features

- **Clean, Modern Design**: A sleek, professional design that works well for various types of websites
- **Fully Responsive**: Looks great on all devices, from mobile phones to desktop computers
- **Customizable Colors**: Easily change the theme's primary and secondary colors through the WordPress Customizer
- **Custom Logo Support**: Add your own logo through the WordPress Customizer
- **Widget Areas**: Multiple widget areas including sidebar and footer
- **Navigation Menus**: Support for primary and footer navigation menus
- **Featured Images**: Beautiful display of featured images for posts and pages
- **Accessibility Ready**: Built with accessibility in mind
- **Translation Ready**: Fully translatable for multilingual sites
- **SEO Friendly**: Clean code and semantic markup for better search engine visibility

## Installation

### Manual Installation

1. Download the theme zip file from the [GitHub repository](https://github.com/thecodacus/bolt-wordpress-theme-template)
2. Log in to your WordPress admin panel
3. Go to Appearance > Themes
4. Click "Add New"
5. Click "Upload Theme"
6. Choose the downloaded zip file and click "Install Now"
7. After installation, click "Activate" to activate the theme

### Using Git

If you prefer to use Git, you can clone the repository directly into your WordPress themes directory:

```bash
cd wp-content/themes/
git clone https://github.com/thecodacus/bolt-wordpress-theme-template.git
```

Then activate the theme from the WordPress admin panel.

## Customization

### Theme Options

The Bolt WordPress Theme comes with several customization options available through the WordPress Customizer:

1. Go to Appearance > Customize
2. You'll find the following theme-specific options:
   - **Theme Colors**: Change the primary and secondary colors
   - **Site Identity**: Upload a logo, change site title and tagline
   - **Menus**: Set up and configure navigation menus
   - **Widgets**: Add and configure widgets in the sidebar and footer
   - **Homepage Settings**: Choose what to display on your homepage
   - **Footer Options**: Add custom footer text

### Adding Your Own CSS

You can add your own CSS styles by:

1. Going to Appearance > Customize
2. Clicking on "Additional CSS"
3. Adding your custom CSS code

### Child Themes

For more extensive customizations, it's recommended to create a child theme:

1. Create a new folder in your themes directory named `bolt-theme-child`
2. Create a `style.css` file with the following content:

```css
/*
Theme Name: Bolt WordPress Theme Child
Template: bolt-wordpress-theme-template
*/

/* Add your custom styles below this line */
```

3. Create a `functions.php` file with:

```php
<?php
function bolt_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'bolt_child_enqueue_styles');
```

4. Activate the child theme from the WordPress admin panel

## Development

### Prerequisites

- WordPress development environment
- Basic knowledge of PHP, HTML, CSS, and JavaScript
- Code editor

### File Structure

```
bolt-wordpress-theme-template/
├── inc/
│   ├── customizer.php
│   ├── template-functions.php
│   └── template-tags.php
├── js/
│   ├── customizer.js
│   └── navigation.js
├── languages/
├── template-parts/
│   ├── content-none.php
│   └── content.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── sidebar.php
├── style.css
└── README.md
```

## Support

For support, feature requests, or bug reports, please [open an issue](https://github.com/thecodacus/bolt-wordpress-theme-template/issues) on GitHub.

## License

This theme is licensed under the [GNU General Public License v2 or later](http://www.gnu.org/licenses/gpl-2.0.html).

## Credits

- Built with [Bolt.diy](https://bolt.diy)
- Uses code from [Underscores](https://underscores.me/) (_s)