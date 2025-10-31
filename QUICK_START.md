# Quick Start Guide - WordPress.org Submission

## ⚡ 5-Minute Submission Preparation

### Step 1: Update Your Information (2 minutes)

Edit these placeholder values in the files:

**In `head-footer-injector-simple.php` (lines 1-23):**

```php
Plugin URI: https://github.com/yourusername/head-footer-injector  → Your repo
Author: Your Name                                              → Your name
Author URI: https://yoursite.com                              → Your website
```

**In `readme.txt` (lines 2-3, 18-21):**

```
Contributors: yourname          → Your WordPress.org username
GitHub Issues: https://github.com/yourusername/...
Email: support@yoursite.com     → Your email
```

### Step 2: Create WordPress.org Account

- Visit https://wordpress.org
- Create account if needed
- Save your username

### Step 3: Request Plugin Directory Access

- Go to https://developer.wordpress.org/plugins/getting-started/
- Click "Add your plugin to the directory"
- Complete the form
- **Save the SVN URL you receive!**

### Step 4: Set Up SVN & Submit

```bash
# Install SVN (if needed)
sudo apt-get install subversion

# Checkout your plugin repo (use your SVN URL)
svn co https://plugins.svn.wordpress.org/head-footer-injector-simple/ ./head-footer-injector-svn

cd head-footer-injector-svn

# Create directory structure
mkdir -p trunk branches tags

# Copy your plugin files to trunk/
cp -r /home/ubuntu/Projects/wp-plugin-head-footer-injector/* trunk/

# Verify structure
ls trunk/
# Should show: head-footer-injector-simple.php, readme.txt, LICENSE, languages/, etc.

# Add files to SVN
svn add trunk/*
svn add branches/
svn add tags/

# Commit (first time uploads everything)
svn commit -m "Initial plugin commit - version 1.0.0"
```

### Step 5: Tag the Release

```bash
cd /path/to/head-footer-injector-svn

# Create tag for version 1.0.0
svn copy trunk/ tags/1.0.0/

# Commit the tag
svn commit -m "Tagging version 1.0.0"
```

**Done!** ✅ Your plugin is submitted and in the review queue (2-7 days)

---

## 📋 What's Included

| File                                    | Purpose                            |
| --------------------------------------- | ---------------------------------- |
| `head-footer-injector-simple.php`           | Main plugin file - fully compliant |
| `readme.txt`                            | WordPress.org plugin page          |
| `README.md`                             | GitHub documentation               |
| `LICENSE`                               | GPL2+ license                      |
| `COMPLIANCE_SUMMARY.md`                 | All 18 guidelines verified ✅      |
| `SUBMISSION_GUIDE.md`                   | Detailed submission steps          |
| `languages/head-footer-injector-simple.pot` | Translation template               |
| `QUICK_START.md`                        | This file                          |

---

## 🔐 Plugin Features

✅ **Complies with all 18 WordPress.org guidelines**
✅ **GPL2+ Licensed**
✅ **No external dependencies**
✅ **Fully secure** - Input sanitized, output escaped
✅ **Internationalized** - Ready for translations
✅ **REST API support** - Settings via API
✅ **Easy admin interface** - Simple settings page
✅ **Production ready** - No placeholder code

---

## ❓ Common Questions

**Q: What if my plugin gets rejected?**
A: The review team will email you with specific reasons. Fix the issues and update via SVN using the same steps above.

**Q: How often should I update?**
A: Only when needed. Make one SVN commit per version release.

**Q: Can I have multiple versions?**
A: Yes - that's what tags are for. Each tag represents a released version.

**Q: Where's my plugin page?**
A: After approval, it's at: `https://wordpress.org/plugins/head-footer-injector-simple/`

---

## 📞 Support

- **WordPress.org Plugins**: plugins@wordpress.org
- **Forum**: https://wordpress.org/support/plugin/head-footer-injector-simple/
- **GitHub Issues**: https://github.com/yourusername/head-footer-injector/issues

---

## ✅ Pre-Submission Checklist

- [ ] Updated plugin author info
- [ ] Updated readme.txt with your details
- [ ] Created WordPress.org account
- [ ] Requested plugin directory access
- [ ] Have SVN URL saved
- [ ] SVN installed on your machine
- [ ] Ready to commit via SVN

**Once all checked:** Follow Step 4 above to submit!

---

## 📚 Full Guides

For more detailed information:

- `SUBMISSION_GUIDE.md` - Complete submission walkthrough
- `COMPLIANCE_SUMMARY.md` - All guidelines verification
- `README.md` - User documentation
- Official: https://developer.wordpress.org/plugins/

---

**Your plugin is ready! 🚀 Submit it now.**
