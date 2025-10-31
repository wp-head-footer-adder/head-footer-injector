=== Head and Footer Injector ===
Contributors: yourname
Tags: meta-tag, header, footer, verification, tracking
Requires at least: 5.0
Requires PHP: 7.4
Tested up to: 6.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add custom meta tags to page headers and inject links into footer navigation effortlessly. Perfect for adding verification codes, tracking scripts, and custom footer links.

== Description ==

Head and Footer Injector is a lightweight, user-friendly WordPress plugin that allows you to:

* **Add Meta Tags to Header** - Insert custom meta tags (like Google Site Verification, verification codes, or custom tracking identifiers) into the `<head>` section of your website
* **Inject Footer Links** - Automatically add custom links to your footer navigation menu
* **No Coding Required** - Manage all settings through a simple, intuitive WordPress admin interface
* **REST API Support** - All settings are accessible via the WordPress REST API
* **Works with All Themes** - Compatible with block-based themes, traditional themes, and custom footer implementations

= Use Cases =

* Google Site Verification
* Bing Webmaster Tools Verification
* Facebook Domain Verification
* Custom tracking codes
* Analytics meta tags
* Brand link placement in footer
* Partner/affiliate links in footer
* Call-to-action links

= Features =

* Simple Settings Page - Easy-to-use admin interface to configure all options
* Header Meta Tags - Add custom meta tags to the page header
* Footer Link Injection - Automatically insert links into footer navigation
* Smart Detection - Works with multiple footer structures (block navigation, traditional menus, custom divs)
* Full Sanitization - All input is properly sanitized and validated
* REST API Ready - All settings are exposed via the WordPress REST API
* Lightweight - Minimal code footprint with no dependencies
* Translation Ready - Fully internationalized with `.pot` file for translations
* WordPress Coding Standards - Follows WordPress best practices and coding standards

== Installation ==

= From WordPress Plugin Directory =

1. Go to **Plugins > Add New** in your WordPress admin
2. Search for "Head and Footer Injector"
3. Click **Install Now** and then **Activate**

= Manual Installation =

1. Download the plugin ZIP file
2. Extract it to `/wp-content/plugins/` directory
3. Go to **Plugins** in your WordPress admin
4. Find "Head and Footer Injector" and click **Activate**

== Usage ==

1. After activation, go to **Settings > Head & Footer Injector** in your WordPress admin dashboard
2. Configure the following options:

= Header Meta Tag Settings =

* **Header Meta Key**: Enter the name attribute of the meta tag (e.g., `google-site-verification`, `msvalidate.01`)
* **Header Meta Value**: Enter the content value for the meta tag (e.g., your verification code)

= Footer Link Settings =

* **Footer Link URL**: Enter the full URL where the link should point to
* **Footer Link Text**: Enter the text to display for the link

3. Click **Save Changes**
4. View your website's front end - the meta tag should appear in the `<head>` and the link should appear in the footer navigation

= Example: Google Site Verification =

1. Meta Key: `google-site-verification`
2. Meta Value: `google1234567890abcdef.html` (your actual verification code)
3. Click Save

== Frequently Asked Questions ==

= Where does the meta tag appear? =
The meta tag appears in the `<head>` section of your website, just before the closing `</head>` tag.

= Where does the footer link appear? =
The link is injected into your footer navigation menu. The plugin uses multiple strategies to find the best location:
- Block-based navigation menus
- Traditional WordPress menus
- Custom footer lists
- Footer divs with links

= Will this work with my theme? =
Yes! The plugin is designed to work with virtually all modern WordPress themes, including block-based themes and traditional themes.

= Can I add multiple meta tags? =
The current version supports one meta tag. For multiple meta tags, you can use this plugin multiple times or contact the developer for custom solutions.

= Is the plugin safe to use? =
Yes! All user input is properly sanitized and validated. The plugin follows WordPress security best practices.

= Is there a REST API for this plugin? =
Yes! All settings are available via the WordPress REST API at the `/wp-json/` endpoint.

== Technical Requirements ==

* WordPress: 5.0 or higher
* PHP: 7.4 or higher
* No Additional Dependencies: The plugin uses only WordPress core functions

== Screenshots ==

1. Admin Settings Page - Simple and intuitive settings interface
2. Header Meta Settings - Configure meta tags
3. Footer Link Settings - Configure footer links

== Changelog ==

= 1.0.0 =
* Initial release
* Header meta tag support
* Footer link injection
* Admin settings page
* REST API support
* Full WordPress internationalization support

== Upgrade Notice ==

= 1.0.0 =
Initial release. No upgrades yet.

== Support ==

For support, bug reports, and feature requests:
* WordPress.org Plugin Forum: https://wordpress.org/support/plugin/head-footer-injector/
* GitHub Issues: https://github.com/wp-head-footer-adder/head-footer-injector/issues

== License ==

This plugin is licensed under the GNU General Public License v2.0 or later.
