# Head and Footer Injector

Add custom meta tags to page headers and inject links into footer navigation effortlessly. Perfect for adding verification codes, tracking scripts, analytics tags, and custom footer links.

## Description

Head and Footer Injector is a lightweight, user-friendly WordPress plugin that allows you to:

- **Add Meta Tags to Header**: Insert custom meta tags (like Google Site Verification, verification codes, or custom tracking identifiers) into the `<head>` section of your website
- **Inject Footer Links**: Automatically add custom links to your footer navigation menu
- **No Coding Required**: Manage all settings through a simple, intuitive WordPress admin interface
- **REST API Support**: All settings are accessible via the WordPress REST API
- **Works with All Themes**: Compatible with block-based themes, traditional themes, and custom footer implementations

### Use Cases

- Google Site Verification
- Bing Webmaster Tools Verification
- Facebook Domain Verification
- Custom tracking codes
- Analytics meta tags
- Brand link placement in footer
- Partner/affiliate links in footer
- Call-to-action links

## Features

✅ **Simple Settings Page** - Easy-to-use admin interface to configure all options  
✅ **Header Meta Tags** - Add unlimited custom meta tags to the page header  
✅ **Footer Link Injection** - Automatically insert links into footer navigation  
✅ **Smart Detection** - Works with multiple footer structures (block navigation, traditional menus, custom divs)  
✅ **Full Sanitization** - All input is properly sanitized and validated  
✅ **REST API Ready** - All settings are exposed via the WordPress REST API  
✅ **Lightweight** - Minimal code footprint with no dependencies  
✅ **Translation Ready** - Fully internationalized with `.pot` file for translations  
✅ **WordPress Coding Standards** - Follows WordPress best practices and coding standards  

## Installation

### From WordPress Plugin Directory

1. Go to **Plugins > Add New** in your WordPress admin
2. Search for "Head and Footer Injector"
3. Click **Install Now** and then **Activate**

### Manual Installation

1. Download the plugin ZIP file
2. Extract it to `/wp-content/plugins/` directory
3. Go to **Plugins** in your WordPress admin
4. Find "Head and Footer Injector" and click **Activate**

### From GitHub (Development)

```bash
git clone https://github.com/yourusername/head-footer-injector.git
cd head-footer-injector
# Copy to your plugins directory
cp -r . /path/to/wp-content/plugins/head-footer-injector/
```

## Usage

### Basic Setup

1. After activation, go to **Settings > Head & Footer Injector** in your WordPress admin dashboard
2. Configure the following options:

#### Header Meta Tag Settings

- **Header Meta Key**: Enter the name attribute of the meta tag (e.g., `google-site-verification`, `msvalidate.01`)
- **Header Meta Value**: Enter the content value for the meta tag (e.g., your verification code)

#### Footer Link Settings

- **Footer Link URL**: Enter the full URL where the link should point to
- **Footer Link Text**: Enter the text to display for the link

3. Click **Save Changes**
4. View your website's front end - the meta tag should appear in the `<head>` and the link should appear in the footer navigation

### Examples

#### Adding Google Site Verification

1. Meta Key: `google-site-verification`
2. Meta Value: `google1234567890abcdef.html` (your actual verification code)
3. Click Save

#### Adding a Footer Link

1. Footer Link URL: `https://example.com/partner`
2. Footer Link Text: `Partner Site`
3. Click Save

## Frequently Asked Questions

### Q: Where does the meta tag appear?
A: The meta tag appears in the `<head>` section of your website, just before the closing `</head>` tag.

### Q: Where does the footer link appear?
A: The link is injected into your footer navigation menu. The plugin uses multiple strategies to find the best location:
- Block-based navigation menus
- Traditional WordPress menus
- Custom footer lists
- Footer divs with links

### Q: Will this work with my theme?
A: Yes! The plugin is designed to work with virtually all modern WordPress themes, including block-based themes and traditional themes.

### Q: Can I add multiple meta tags?
A: The current version supports one meta tag. For multiple meta tags, you can use this plugin multiple times or contact the developer for custom solutions.

### Q: Is the plugin safe to use?
A: Yes! All user input is properly sanitized and validated. The plugin follows WordPress security best practices.

### Q: Can I use this with custom post types?
A: The footer link injection works on all public-facing pages. The meta tag appears on every page of your site.

### Q: Is there a REST API for this plugin?
A: Yes! All settings are available via the WordPress REST API at the `/wp-json/` endpoint.

## Technical Requirements

- **WordPress**: 5.0 or higher
- **PHP**: 7.4 or higher
- **No Additional Dependencies**: The plugin uses only WordPress core functions

## Settings

All plugin settings are stored as WordPress options:

- `head_footer_injector_header_key` - Meta tag name attribute
- `head_footer_injector_header_value` - Meta tag content attribute
- `head_footer_injector_footer_link_url` - URL for the footer link
- `head_footer_injector_footer_link_text` - Text for the footer link

## Hooks and Filters

### Action Hooks

- `head_footer_injector_before_settings_page` - Fires before settings page content
- `head_footer_injector_after_settings_page` - Fires after settings page content

### Filter Hooks

- `head_footer_injector_header_key` - Filter the header meta key
- `head_footer_injector_header_value` - Filter the header meta value
- `head_footer_injector_footer_link_url` - Filter the footer link URL
- `head_footer_injector_footer_link_text` - Filter the footer link text

## Changelog

### 1.0.0 (Initial Release)
- Initial release
- Header meta tag support
- Footer link injection
- Admin settings page
- REST API support
- Full WordPress internationalization support

## License

This plugin is licensed under the GNU General Public License v2.0 or later. See the LICENSE file for details.

## Support

For support, bug reports, and feature requests, please visit:
- **GitHub Issues**: https://github.com/yourusername/head-footer-injector/issues
- **WordPress.org Plugin Forum**: https://wordpress.org/support/plugin/head-footer-injector/
- **Email**: support@yoursite.com

## Contributing

We welcome contributions! Please feel free to:
- Report bugs
- Suggest improvements
- Submit pull requests

## Credits

- Plugin developed by Your Name
- Built with WordPress best practices
- Follows WordPress Coding Standards

## Disclaimer

This plugin is provided as-is. While we test thoroughly, always backup your database before installing or updating plugins. The developers are not responsible for any data loss or issues that may arise from using this plugin.

---

**Looking for more features?** Consider hiring a developer to customize this plugin for your specific needs, or submit a feature request on GitHub!
