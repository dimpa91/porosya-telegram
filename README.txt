=== KJM Admin Notices ===
Contributors: webmarka
Donate link: https://www.kajoom.ca
Tags: admin notice, admin notices, notices, dashboard, messages, dismissable, management tool, email notifications, maintenance, administration
Requires at least: 3.0.1
Tested up to: 4.6.1
Stable tag: 1.0.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create, manage and display to admin users nice custom dismissable notices with it's own title, author, date, category, tags and more.

== Description ==

KJM Admin Notices helps you communicate with your other website users by providing a complete way of managing and displaying nice admin notices inside the WP admin panel.

= Features: =

* Create, manage and display to admin users nice custom dismissable notices.
* Designed in a will to improve communication between admins and others users and roles.
* Each notice can be styled based on the 4 built-in WordPress notices : info (blue), success (green), warning (yellow), error (red).
* Choose to which roles you want to display / send notice.
* Notices are dismissable by the user, on a per user basis.
* Assign tags, category, author, publish date to your notice.
* Shortcodes : 3 handy shortocdes available as placeholders into the title or the body message : `[kjm_website_domain]`, `[kjm_display_name]` and `[kjm_admin_login]`.
* Email notifications : Send notices by email to your users. Send copy to the admin.
* You can even enable WordPress comments on your notices to turn this into a collaborative system!
* Designed in a will to improve website management and updates by providing a kind of website maintenance log.
* Save general system along with notice : WordPress version, active plugins and versions, theme and version, child-theme and version.

== Installation ==

1. Upload `kjm-admin-notices` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to 'Settings -> KJM Admin Notices' and activate both 'KJM Admin Notices' and 'Notice Post Type'.
1. Start creating your notices by going to 'Manage KJM Admin Notices' and have fun!

== Frequently Asked Questions ==

= Installed plugin but I don't see how I can use it? =

Don't forget to go to 'Settings -> KJM Admin Notices' and activate both 'KJM Admin Notices' and 'Notice Post Type'. Once done, you will be able to add notices.

= Admin Notices don't get sent by email? =

First, make sure the 'Send Email' option is on. Same thing on your notice edit screen, make sure the 'Send Email' option is checked. Also make sure you checked relevant roles in ' Show Notice to Roles'. Lastly, you have to take in account that KJM Admin Notices only send email on publish of an existing post. The suggested way to do it is to first create a notice with 'Draft' state, then when tou are set, you just have to publish it to get the emails sent. You will see a big green button in the 'Sent' column which shows to how many people th notice has been sent.

= Why on publish, Admin Notices always get the 'Private' status? =

This is a built-in feature. At current state, KJM Admin Notices always set the status of a Notice to 'Private' on publish. It is to make sure only logged-in users can see notices and them comments, if 'Allow Comments' option is enabled. Future releases will have more options about it.

= How to use shortcodes? =

There are currently 3 different shortcodes available in KJM Admin Notices.

1. `[kjm_website_domain]` will be replaced with the base website domain name. Eg. 'domain.com'. Can be used in title and content.
1. `[kjm_display_name]` will be replaced with the user Display Name. Eg. 'John Doe'. Can be used in title and content.
1. `[kjm_admin_login]` will be replaced with the login URL to your website. Eg. 'http://domain.com/wp-login.php'. Can be used in content only.

= Are there some future improvements planned? =

* Add readmore management with JS in notices display. Eg : "Show More" toggle.
* Better management of send email option.
* Add an AJAX notes system on notices (different plugin?).
* Remove local-settings.php, or set it to be read from the theme first (this file is for setting local data mainly for developement or customization purposes).

== Screenshots ==

1. Admin Notices display.
2. Settings page. 
3. Edit Notice page. 
4. Post type list page. 

== Changelog ==

= 1.0.5 =

Many small changes, improvements and bug fixes and verified compatibility with WP 4.7

* Compatibility check test with WP 4.7.
* Updated languages files. Replaced "Modify Notice" by "Edit Notice" in translation strings.
* Only call save_metaboxes() method on kjm_notice CTP. Thanks to "Cesar" for reporting this bug :)
* Prevent a PHP Strict Standards message to display.

= 1.0.4 =

* Corrected typos in README.txt file.
* Moved away extra code not intended for this plugin in an external file.
* Versionned admin base class to prevent conflits between plugins.
* Removed unused files and deactivated some unused code.

= 1.0.3 =

* Added an alternate updater to update from custom servers instead of WP.
* Removed local settings data.

= 1.0.2 =

Added possibility to customize display of notices, hardened security, and a lot of new features.

* Only display notices to those in the targeted roles.
* Allow hiding title, metas and dismiss link.
* Updated languages strings. Added language strings to .pot file. Added FR traduction.
* Only send notice to selected user roles.
* Added option to allow Comments system on Notices CPT.
* Added metabox to display global application params : WP version, active plugins, themes.
* Added checkbox on CPT to allow sending a copy to admin email.
* Added "Manage KJM Admin Notices" in the plugin options page.
* Force Notice CPT to be in Private mode (for comments to be private too).
* Added metaboxes and function to manage roles to send / display notices.
* Enhancement of the get_items() admin base method.
* Added filter "kjm_plugin_admin_base_get_items" to allow external modification.
* Cleaning in class-kjm-plugin-admin-base.php
* Do not display "Manage KJM Admin Notices" if CPT isn't activated.
* Js for "show to all / none" toggling in admin edit CPT screen.
* Corrected bugs in send_email_notice() function.
* Reinitialize variables $to, $subject and $body to prevent reuse of data.
* Added role "none" to exclude from emailing notices.
* Added nonces to securize requests. Done on options page and AJAX calls.
* Added an upgrade version automatic detection and process.

= 1.0.1 =

* Fix : Dont send email notice to some users roles (subscriber, contributor, customer).

= 1.0.0 =

* Initial release of kjm-admin-notices. 
* Refactorized to WordPress Plugin Boilerplate 3.0.

== Upgrade Notice ==

= 1.0.4 =

Defined a way to manage extra functionnality.

= 1.0.3 =

Enabled updates with an alternate updater taking updates from custom servers instead of WP as an option.

= 1.0.2 =

New plugin version 1.0.2. Added possibility to customize display of notices, hardened security, and a lot of new features.

