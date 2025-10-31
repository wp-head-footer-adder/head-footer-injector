# WordPress.org Plugin Submission Guide

This guide will help you prepare and submit the Head and Footer Injector plugin to the WordPress.org plugin directory.

## Pre-Submission Checklist

Before submitting, please ensure you have completed the following:

### Plugin Details

- [ ] Update `head-footer-injector-simple.php` with your real information:
  - [ ] Plugin URI (change from `https://github.com/yourusername/head-footer-injector`)
  - [ ] Author name (change from `Your Name`)
  - [ ] Author URI (change from `https://yoursite.com`)
  - [ ] Description (update as needed)
- [ ] Update `readme.txt` with:
  - [ ] Contributors field (your WordPress.org username)
  - [ ] Your actual GitHub URL
  - [ ] Your email address
  - [ ] Contact information

### Documentation

- [ ] README.md is complete and up-to-date
- [ ] readme.txt is properly formatted with all sections
- [ ] CHANGELOG section in readme.txt reflects version history
- [ ] Screenshots are placed in `/assets/` directory (see below)

### Code Quality

- [ ] All code follows [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [ ] Code is human-readable (no obfuscation, minification, or uglification)
- [ ] All strings are properly internationalized with `__()` or `_e()`
- [ ] All output is escaped with `esc_html()`, `esc_attr()`, or `esc_url()`
- [ ] All database queries sanitized with `sanitize_text_field()`, etc.
- [ ] Nonces implemented for admin forms (already done)
- [ ] Proper capability checks with `current_user_can()`

### Compliance

- [ ] Plugin complies with [WordPress Plugin Guidelines](https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/)
- [ ] No trialware or crippled functionality (Guideline #5)
- [ ] No user tracking without consent (Guideline #7)
- [ ] No executing code from external systems (Guideline #8)
- [ ] No hijacking admin dashboard (Guideline #11)
- [ ] No spam in readme/documentation (Guideline #12)
- [ ] Uses WordPress default libraries only (Guideline #13)
- [ ] Proper version numbering (Guideline #15)
- [ ] LICENSE file present with GPL2+ text (Guideline #1)

### Security

- [ ] All user input sanitized
- [ ] All output properly escaped
- [ ] No security vulnerabilities
- [ ] Proper error handling
- [ ] No debug code or error logging left in production

### Translations

- [ ] Text Domain set correctly: `head-footer-injector-simple`
- [ ] Domain Path set: `/languages`
- [ ] .pot file generated and included
- [ ] All translatable strings use proper functions

### Directory Structure

Before submitting, ensure your plugin directory structure looks like this:

```
head-footer-injector/
├── head-footer-injector-simple.php      (main plugin file)
├── readme.txt                        (WordPress.org readme)
├── README.md                         (GitHub readme)
├── LICENSE                           (GPL2+ license)
├── CHANGELOG.md                      (version history)
├── SUBMISSION_GUIDE.md               (this file)
├── languages/
│   └── head-footer-injector-simple.pot   (translation template)
└── assets/
    ├── banner-772x250.jpg            (optional plugin banner)
    ├── icon-128x128.jpg              (optional plugin icon)
    └── screenshot-1.jpg              (optional screenshots)
```

## Screenshot Guidelines (Optional but Recommended)

If including screenshots, place them in the `assets/` directory:

1. **screenshot-1.jpg** - Admin Settings Page
2. **screenshot-2.jpg** - Header Meta Configuration
3. **screenshot-3.jpg** - Footer Link Configuration

Screenshots should be:

- Maximum 1200x900 pixels
- Clear and show the plugin in action
- Numbered sequentially (screenshot-1, screenshot-2, etc.)
- Named consistently with dashes (not underscores)

## Submission Steps

### Step 1: Create WordPress.org Account

1. Go to [WordPress.org](https://wordpress.org)
2. Create an account if you don't have one
3. Go to your profile and save your username

### Step 2: Request Plugin Hosting

1. Visit [Plugin Development](https://developer.wordpress.org/plugins/getting-started/)
2. Click "Add your plugin to the directory"
3. Follow the prompts to request plugin hosting
4. You'll receive a **SVN repository URL** - save this!

### Step 3: Set Up SVN

```bash
# Install SVN if not already installed
sudo apt-get install subversion

# Create a local copy of your plugin repository
svn co https://plugins.svn.wordpress.org/head-footer-injector-simple/ head-footer-injector-svn

cd head-footer-injector-svn
```

### Step 4: Prepare Plugin Files

```bash
# Create proper SVN structure
mkdir -p trunk
mkdir -p branches
mkdir -p tags

# Copy your plugin files to trunk/
cp -r /path/to/your/plugin/* trunk/

# Ensure proper structure
ls trunk/
# Should show: head-footer-injector-simple.php, readme.txt, LICENSE, languages/, assets/
```

### Step 5: Add to SVN

```bash
# Add files to SVN
cd head-footer-injector-svn

# Add new files
svn add trunk/*
svn add branches/
svn add tags/

# Commit with a message
svn commit -m "Initial plugin commit - version 1.0.0"
```

### Step 6: Create First Release Tag

```bash
# Tag version 1.0.0
svn copy trunk/ tags/1.0.0/

# Commit tag
svn commit -m "Tagging version 1.0.0"
```

### Step 7: Update readme.txt for Release

1. In `trunk/readme.txt`, ensure:

   - `Stable tag: 1.0.0` matches your first tag
   - Version number is accurate
   - All documentation is complete

2. Commit changes:

```bash
svn commit -m "Preparing for release"
```

## After Submission

### Waiting for Approval

- The WordPress.org plugin review team will review your plugin
- This typically takes 2-7 days depending on queue
- You'll receive an email when approved or if changes are needed
- Check for any feedback and make requested changes

### Making Updates

To update your plugin after approval:

```bash
# Update your plugin files in trunk/
cp -r /path/to/updated/plugin/* trunk/

# Update the version number in head-footer-injector-simple.php
# Update the Stable tag in trunk/readme.txt

# Commit changes
svn commit -m "Update plugin to version 1.0.1"

# Create a new tag for the release
svn copy trunk/ tags/1.0.1/
svn commit -m "Tagging version 1.0.1"
```

## Important Guidelines Summary

Based on the [WordPress Plugin Guidelines](https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/):

1. **GPL Compatible License** ✓ - Your plugin uses GPLv2+
2. **Developer Responsibility** ✓ - You control all plugin code
3. **Stable Version Available** ✓ - Version 1.0.0 is stable
4. **Human Readable Code** ✓ - No obfuscation
5. **No Trialware** ✓ - Full functionality available
6. **SaaS Permitted** ✓ - Your plugin doesn't require external service
7. **User Tracking** ✓ - No user tracking
8. **Executable Code** ✓ - No code execution from third-party systems
9. **Legal/Ethical** ✓ - Plugin is legal and ethical
10. **No Embedded Links** ✓ - No links without permission
11. **Admin Dashboard** ✓ - Plugin doesn't hijack admin
12. **No Spam in Readme** ✓ - Documentation is clean
13. **Default Libraries** ✓ - Uses only WordPress functions
14. **Frequent Commits** ✓ - Only release commits in SVN
15. **Version Numbers** ✓ - Properly incremented
16. **Complete Plugin** ✓ - All code ready at submission
17. **Trademarks** ✓ - No trademark violations
18. **Directory Maintenance** ✓ - Compliant with directory standards

## Troubleshooting

### Plugin Rejected?

- Check the email for specific reasons
- Review the WordPress Plugin Guidelines linked above
- Make requested changes
- Re-submit or update the plugin

### SVN Issues?

- Verify your SVN username and password
- Check that your repository URL is correct
- Ensure proper file permissions
- See [SVN Help](https://developer.wordpress.org/plugins/wordpress-org/how-your-plugin-assets-work/)

### Plugin Not Updating?

- Ensure `Stable tag:` in readme.txt matches your tag
- Wait a few hours for WordPress.org to update
- Check that version numbers are incremented
- Verify SVN commit was successful

## Contact Support

If you need help:

- Email: plugins@wordpress.org
- Forum: https://wordpress.org/support/forum/plugins/
- Documentation: https://developer.wordpress.org/plugins/

## Additional Resources

- [Plugin Handbook](https://developer.wordpress.org/plugins/)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [Security Best Practices](https://developer.wordpress.org/plugins/security/)
- [SVN Instructions](https://developer.wordpress.org/plugins/wordpress-org/how-to-use-subversion/)

---

**Good luck with your plugin submission!** 🚀
