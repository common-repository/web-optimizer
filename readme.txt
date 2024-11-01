=== Plugin Name ===
Contributors: WEBO Software
Donate link: http://sprites.in/donate/
Tags: performance, gzip, compress, css sprites, data:uri, cache, combine, merge, css, javascript, multiple hosts, unobtrusive javascript
Stable tag: trunk
Requires at least: 2.6.0
Tested up to: 2.9.2

This time-proven application speeds up your website by applying all client side performance rules. Make your website faster than lightning!

== Description ==

This application is aimed to automate all clientside improvements for website that significantly increases load speed of its pages.

All about WordPress speedup with a lot of useful tips and manuals: http://www.speedingupwordpress.com/

Join us: [on Twitter](http://twitter.com/wboptimizer "http://twitter.com/wboptimizer"), [in Blog](http://blog.webogroup.com/ "http://blog.webogroup.com/"), [on Facebook](http://www.facebook.com/pages/Web-Optimizer/183974322020 "http://www.facebook.com/pages/Web-Optimizer/183974322020")

= Installation =
Please read [step-by-step How-to with screenshots](http://code.google.com/p/web-optimizator/wiki/InstallingWordPressPlugin "step-by-step How-to with screenshots") about WEBO Site SpeedUp for WordPress installation.

= Functionality =
WEBO Site SpeedUp integrates and exceeds functionality of many other WordPress performance-related plugins:

* Parallelize: http://wordpress.org/extend/plugins/parrallelize/
* W3 Total Cache: http://wordpress.org/extend/plugins/w3-total-cache/
* Autoptimize: http://wordpress.org/extend/plugins/autoptimize/
* JavaScript to Footer: http://wordpress.org/extend/plugins/footer-javascript/
* WP Widget Cache: http://wordpress.org/extend/plugins/wp-widget-cache/
* cSprites: http://wordpress.org/extend/plugins/csprites-for-wordpress/
* Script Compressor: http://wordpress.org/extend/plugins/script-compressor/
* WP Minify: http://wordpress.org/extend/plugins/wp-minify/
* WP CSS: http://wordpress.org/extend/plugins/wp-css/
* WP JS: http://wordpress.org/extend/plugins/wp-js/
* CSS Compress: http://wordpress.org/extend/plugins/css-compress/
* Head Cleaner: http://wordpress.org/extend/plugins/head-cleaner/
* GZippy: http://wordpress.org/extend/plugins/gzippy/
* 1 Blog Cacher: http://wordpress.org/extend/plugins/1-blog-cacher/
* WP Smush.it: http://wordpress.org/extend/plugins/wp-smushit/
* Cache Images: http://wordpress.org/extend/plugins/cache-images/
* CSS Cache Buster: http://wordpress.org/extend/plugins/css-cache-buster/
* cos-html-cache: http://wordpress.org/extend/plugins/cos-html-cache/
* Speed-Cache: http://wordpress.org/extend/plugins/speed-cache/
* Free CDN: http://wordpress.org/extend/plugins/free-cdn/
* and more

But you don't need to install them all. Just the only WEBO Site SpeedUp.

= Main Features =

= Simple 1-click installation =
* overall website acceleration in 1 minute;
* express install requires no advanced knowledge;
* default options guarantee completely safe performance;
* choose from 3 pre-defined configuration sets;
* monitor for traffic / visitor's time savings;
* average speed up is 300-500% (up to 1000% or 98 by YSlow).
= Powerful and fast algorithm =
* caching for minimized files;
* caching for gzipped files;
* fast HTML code parsing (1-5 ms in full version);
* server side load decrease (by number of requests).
= CSS / JS files merging =
* dozens of JavaScript files are combined into 1;
* dozens of CSS files are combined into 1;
* different cache files for different browsers;
* conditional comments parsing;
* libraries can be excluded;
* inline code and external scripts are included by default;
* all code is minified and compressed.
= Unobtrusive JS and dynamic loading =
* by default scripts are moved to `</head>`;
* scripts can be moved to `</body>`;
* scripts can be loaded on `onDOMready`;
* counters can be moved to `</body>`;
* ads can be moved to `</body>`;
* no blocking scripts!
= HTML minify / strip comments =
* simple and fast regexp for HTML code;
* comments can be striped;
* one-string mode for HTML code.
= Earlier flush of content (first 1-2 Kb) =
* can help for CPU intensive websites.
= CSS Tidy / simple regexp for CSS =
* CSS Tidy 1.4 to minify CSS;
* if no CSS Sprites and data:URI simple regexp is used;
* minimization up to 50%.
= JSMin / Packer / YUI Compressor for JavaScript =
* YUI Compressor if java is installed;
* JSMin by default (with conditional compilation);
* Packer for non-gzip systems;
* minimization up to 50%.
= GZIP for HTML / CSS / JS / ICO files =
* via .htaccess if it is possible;
* via PHP for HTML / CSS / JS (ob_gzhandler);
* static gzip to prevent CPU wasting;
* additional check via cookie;
* all types of font files are supported;
* advanced support for old and tricky browsers;
* minimization up to 85%.
= Optimized .htaccess for Apache =
* mod_gzip;
* mod_deflate (+ mod_filter);
* mod_mime;
* mod_rewrite;
* mod_headers;
* mod_expires.
= Client side caching =
* 10 years for CSS / JavaScript / fonts / images;
* GET parameter / new filename to clear cache;
* full proxy caching support;
* optional HTML caching;
* customizable time for HTML;
* conditional caching (ETag);
* docs / video / other files via `.htaccess`.
= Server side caching for minified CSS / JS / HTML files =
* static gzip;
* static combine & minify;
* prepared HTML file.
= CSS Sprites (background images merging) =
* up to 3 images from 100+;
* optimized via smush.it;
* no initial Sprites required.
= data:URI (+ mhtml) =
* data:URI up to 24 Kb in size;
* mhtml up to 50 Kb in size;
* .cur, .htc, .eot, .ttf, .otf, .svg files excluded;
* mhtml for IE6 and IE7;
* optional CSS files separation;
* optional resource file load on `DOMready` event;
= Multiple hosts for static assets =
* HTML images + CSS images;
* 15+ default hosts;
* optional auto-check for availability;
* need only DNS records and aliases in server configuration.
= CSS Images optimization (via smush.it) =
* PNG can be reduced by 30%;
* GIF can be reduced by 60%;
* JPEG can be reduced by 20%.
= PHP4/5 -- Apache module or CGI =
* tested on Denwer;
* tested on VPS;
* tested on shared hosting;
* tested on collocation;
* PHP4 backward compatibility.
= Auto-update =
* additional security;
* no need to download & install;
* all options are saved.

== Installation ==

Here is [step-by-step How-to with screenshots](http://code.google.com/p/web-optimizator/wiki/InstallingWordPressPlugin "step-by-step How-to with screenshots") about WEBO Site SpeedUp for WordPress installation.

1. Upload `web.optimizer.wordpress.php` to the `/wp-content/plugins/` directory
1. Make folder `/wp-content/plugins/` writable for your web server.
1. Make sure that there is writable .htaccess in the website root, or website root is writable for your web server (only if Apache is used).
1. Activate the WEBO Site SpeedUp plugin through the 'Plugins' menu in WordPress.
1. Go to WEBO Site SpeedUp and tune plugin settings in debug mode or activate WEBO Site SpeedUp.
1. Enjoy your fast website!

Please note that WEBO Site SpeedUp for WordPress requires WEBO Site SpeedUp core package. It will be downloaded automatically on plugin activation or else you will need to do it manually from [WEBO Site SpeedUp Storage](http://code.google.com/p/web-optimizator/downloads/list "WEBO Site SpeedUp Storage"), version 1.0.0+. For this:

1. Please select full archive (not Mini Installer), it's usually about 1 Mb in size, and its file name is webo.site.speedup.vX.X.X.zip (X is a number).
1. Download this package.
1. Unzip package inside `/wp-content/plugins/` directory. So you will have the following structure:
 - plugins
 - |__ web.optimizer.wordpress.php
 - |__ web-optimizer
 - . |__ cache
 - . |__ controller
 - . |__ ...

After creating such a structure please:

1. Make directories `web-optimizer/`, `web-optimizer/cache` and file `web-optimizer/config.webo.php` writable for your web server.
1. Deactivate GZIP in WordPress global settings. WEBO Site SpeedUp itself has better compression support.
1. Activate the WEBO Site SpeedUp plugin through the 'Plugins' menu in WordPress.

Also please deactivate (or delete) WEBO Site SpeedUp itself (if it's installed for your website).

Please clear cache in WP-Super-Cache, Hyper Cache, W3 Total Cache, or any other cache plugins to see result. Or just disable them - cache files are not affected. After applying all changes in WEBO Site SpeedUp configuration you can enable cache plugins back - HTML documents will be saved as optimized ones.

Please note that WEBO Site SpeedUp Premium Edition has also its own server side cache engine, which can be better than the mentioned above.

== Frequently Asked Questions ==

All additional information is located in [WEBO Site SpeedUp Wiki](http://code.google.com/p/web-optimizator/w/list "WEBO Site SpeedUp Wiki")
There are also [WEBO Site SpeedUp Troubleshooter](http://code.google.com/p/web-optimizator/wiki/TroubleshootingAndSupport "WEBO Site SpeedUp Troubleshooter") and [WEBO Site SpeedUp Configuration](http://code.google.com/p/web-optimizator/wiki/Configuring "WEBO Site SpeedUp Configuration")

Please note: WEBO Site SpeedUp plugin isn't compatible with PHP Speedy or Web Optimizer plugins or their standalone installations.

You can also download and install [standalone WEBO Site SpeedUp product](http://code.google.com/p/web-optimizator/downloads/list "standalone WEBO Site SpeedUp product").

If you want to order Lite or Premium Edition of product or plugin installation and tuning for your website, please visit [WEBO Site SpeedUp purchase page](http://www.webogroup.com/store/ "WEBO Site SpeedUp purchase page").

== Screenshots ==

1. WEBO Site SpeedUp Box Shot.
2. WEBO Site SpeedUp Control Panel.
3. WEBO Site SpeedUp Cache Management.
4. WEBO Site SpeedUp Activation.
5. WEBO Site SpeedUp System Status.
6. WEBO Site SpeedUp Image Optimization.
7. WEBO Site SpeedUp Configuration Sets.
8. WEBO Site SpeedUp Detailed Configuration.

== Changelog ==

= 1.1.0 =
* Speedup achievements added.
* Improved server side caching.
* Minor compatibility fixes.

= 1.0.5 =
* Minor UI and compatibility fixes.

= 1.0.2 =
* Added compatibility support for HTML Sprites.

= 0.9.6 =
* Fixed favicon.ico download.

= 0.9.5.1 =
* Fixed bug with .htaccess cleanup on deactivation.

= 0.9.5 =
* Completely new UI.
* 3 default configuration sets.
* Cache manage page.
* Separate system status information.
* Internal localization.
* Internal update.
* Acceleration statistics.
* Improved stability.
* Improved .htaccess-related actions.
* Improved server side caching (now as fast as WP Super Cache).

= 0.6.7 =
* Improved files merging.
* Separated stable version from beta.

= 0.6.6 =
* Improved installation directories check / calculation.
* Several files' fetching issues fixed (in core).

= 0.6.5 =
* Added options save w/o cache refresh.

= 0.6.4 =
* Added safe cache refresh on options save.
* Added safe cache create on activation.

= 0.6.3.1 =
* Fixed multiple requests for website grade.

= 0.6.3 =
* Added link to Web Optimizer image on Settings page.

= 0.6.2.2 =
* Fixed minor interface bug with hidden inputs.

= 0.6.2.1 =
* Replaced split with explode.
* Fixed paths calculation.
* Fixed mess of slashes for Windows-based systems.

= 0.6.2 =
* Fixed critical error with cache directory invalid rights (caused 'unstyled' website).

= 0.6.1.5 =
* Added possible fix (can't check properly) to save options on WP plugin update.

= 0.6.1.4 =
* Added copying of static assets PHP proxy file to activation stage.

= 0.6.1.3 =
* Improved paths calculation (mostly in core).

= 0.6.1.2 =
* Fixed message about not available .htaccess. Fixed paths on deinstallation for relative document root.

= 0.6.1.1 =
* Added link to Hyper Cache plugin.

= 0.6.1 =
* Fixed 502 error on internal redirect from www host.

= 0.6.0 =
* Fixed some issues with false errors on activation/deactivation.
* Corrected activation process in some cases, thx to knichol.
* Fixed paths (document_root) calculation on non-root WordPress installations, thx to knichol.

= 0.5.9.9 =
* Added favicon.ico download if it doesn't exist for the website.

= 0.5.9.8 =
* Added counter to check Web Optimizer installations.

= 0.5.9.7 =
* Added compatibility with basic/full versions separation.

= 0.5.9.6 =
* Fixed white screen on logging to WP admin.
* Fixed saving 'Minify JS (with)' group of params.
* Improved paths calculation (now relates to ABSPATH WP variable).
* Added unset for a number of unused variables.

= 0.5.9.5 =
* Improved initial configuration saving. Should fix a number of problems with 'white screen'.

= 0.5.9.4 =
* Added possibility to write to .htaccess (only with Web Optimizer 0.5.9.4+ core package).

= 0.5.9.3 =
* CSS rules included directly to PHP.

= 0.5.9.2 =
* Added fix for double web-optimizer directory.

= 0.5.9 =
* Added safety checks for function names.
* Fixed settings save.

= 0.5.8 =
* Initial version (as a branch of Web Optimizer core package).

== Upgrade Notice ==

How to update from version 0.6.7-

1. Deactivate Web Optimizer plugin.
1. Upload WEBO Site SpeedUp over it or just update via internal WordPress interface.
1. Delete folder `wp-content/plugins/web-optimizer/`.
1. Activate plugin. All files should be downloaded from repository automatically.
1. After activation please go to WEBO Site SpeedUp settings page, then to *System Status*, then to tab *Update* (left menu), then check *Show information about beta versions*.
1. Update to the latest beta version. Configuration file will be altered for the new version.
1. Delete file `wp-content/plugins/web.optimizer.wordpress.config.php`.
1. Now all product updates can be safely done via WEBO Site SpeedUp interface.