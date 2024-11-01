<?php

// ==============================================================================================
// Licensed under the MIT license
// ==============================================================================================
// @author     WEBO Software (http://www.webogroup.com/)
// @version    1.1.0
// @copyright  Copyright &copy; 2009-2010 WEBO Software, All Rights Reserved
// ==============================================================================================
// To install WEBO Site SpeedUp please:
// 1. copy this file to /wp-content/plugins/ directory,
// 2. make this directory writable,
// 3. make document root writable for your web server (or create writable .htaccess file, or make
//    .htaccess file writable),
// 4. to provide the best usage of compression please disable GZIP in Wordpress global settings,
// 5. and activate the WEBO Site SpeedUp plugin through the 'Plugins' menu in WordPress.
// ==============================================================================================
/*
Plugin Name: WEBO Site SpeedUp
Plugin URI: http://www.webogroup.com/home/site-speedup/
Description: WEBO Site SpeedUp - complete website acceleration in seconds. Make your website faster than lightning!
Author: WEBO Software
Version: 1.1.0
Author URI: http://www.webogroup.com/
*/
	if (!function_exists('web_optimizer_download')) {
		function web_optimizer_download ($file, $install_directory, $timeout = 60) {
			if (function_exists('curl_init')) {
				if ($timeout == 60) {
					$ch = @curl_init('http://web-optimizator.googlecode.com/svn/trunk-stable/' . $file);
				} else {
					$ch = @curl_init($file);
				}
				$dir = $file;
/* remember current directory */
				$current_directory = @getcwd();
				@chdir($install_directory);
				if ($timeout == 60) {
/* create directory */
					while (preg_match("/\//", $dir)) {
						$directory = preg_replace("/\/.*/", "", $dir);
						if (!@is_dir($directory)) {
							@mkdir($directory);
							if (!@is_dir($directory)) {
								return;
							}
						}
						@chmod($directory, octdec("0755"));
						@chdir($directory);
						$dir = substr($dir, strlen($directory) + 1, strlen($dir));
					}
/* return to the initial directory */
					@chdir($current_directory);
					$fp = @fopen($install_directory . $file, "w");
				} else {
					$fp = @fopen($install_directory . preg_replace("@.*/@", "", $file), "w");
				}
				if ($fp && $ch) {
					@curl_setopt($ch, CURLOPT_FILE, $fp);
					@curl_setopt($ch, CURLOPT_HEADER, 0);
					@curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (WEBO Site SpeedUp; Speed Up Your Website; http://www.webogroup.com/) Firefox 3.5.3");
					@curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
					@curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
					@curl_exec($ch);
					@curl_close($ch);
					@fclose($fp);
/* set correct rights for a new file */
					@chmod($install_directory . $file, octdec("0644"));
				}
			}
		}
	}

	if (!function_exists('web_optimizer_activate')) {
/* main activation function */
		function web_optimizer_activate () {
			$install_directory = realpath(ABSPATH) . '/wp-content/plugins/web-optimizer/';
			$download_package = 'download and unpack the latest WEBO Site SpeedUp full package at <a href="http://code.google.com/p/web-optimizator/downloads/list" rel="nofollow">http://code.google.com/p/web-optimizator/downloads/list</a> to the wp-content/plugins/ directory.';
			$messages = array(
				'curl_not_installed' => 'Curl isn\'t installed. Please ' . $download_package,
				'directory_not_writable' => 'Can\'t write to the current directory. Please chmod ' . @dirname(__FILE__) . ' to 0775.',
				'connection_error' => 'Can\'t download files list. It seems there are some troubles with WEBO Site SpeedUp repository. Please try again later or ' . $download_package,
				'dir_not_writable' => 'Can\'t write to the directory (please chmod it to 0775): ',
				'file_not_writable' => 'Can\'t write to the file (please chmod it to 0664): '
			);
/* check if directory already exists */
			if (!@is_dir($install_directory) || !@is_file($install_directory . 'web.optimizer.php')) {
/* check for curl installed */
				if (in_array('curl', @get_loaded_extensions()) && function_exists('curl_init')) {
					@mkdir($install_directory, octdec("0755"));
					if (!@is_dir($install_directory)) {
/* try to make current directory writable for group */
						@chmod("./", octdec("0775"));
						$return_writable = 1;
					}
					@mkdir($install_directory, octdec("0755"));
					if (!empty($return_writable)) {
						@chmod("./", octdec("0755"));
					}
					if (@is_dir($install_directory)) {
/* get list of files */
						web_optimizer_download('files', $install_directory);
						if (@is_file($install_directory . 'files')) {
							$files = explode("\n", @file_get_contents($install_directory . 'files'));
							foreach ($files as $file) {
								if (!empty($file) && !@is_file($install_directory . $file)) {
									web_optimizer_download($file, $install_directory);
								}
							}
/* check if download was succsessful */
							if (!@is_file($install_directory . 'web.optimizer.php')) {
								$error = $messages['connection_error'];
							}
						} else {
							$error = $messages['connection_error'];
						}
					} else {
						$error = $messages['directory_not_writable'];
					}
				} else {
					$error = $messages['curl_not_installed'];
				}
			}
/* check for download error */
			if (!empty($error)) {
				echo '<strong>' . $error . '</strong>';
				die();
			}
			$config_file = $install_directory . 'config.webo.php';
/* try to restore previous settings */
			@copy($install_directory . '../web.optimizer.wordpress.config.php', $install_directory . 'config.webo.php');
/* activate application */
			if (@is_dir($install_directory) && @is_file($install_directory . 'web.optimizer.php') && @is_file($config_file)) {
/* include generic libraries */
				require($install_directory . "controller/admin.php");
				require($install_directory . "libs/php/view.php");
/* Con. the view library */
				$view = new compressor_view();
				$view->set_paths(substr(0, strlen(ABSPATH) - strlen(preg_replace("!/wp-admin/[^/]*\?.*$!", "/", $_SERVER['REQUEST_URI'])), strlen(ABSPATH)));
				$view->paths['full']['current_directory'] = $install_directory;
				require($config_file);
/* calculate default directories, it fixes cases with manual WBBO Site SpeedUp directory creation */
				$compress_options['css_cachedir'] = empty($compress_options['css_cachedir']) ?
					$install_directory . 'cache/' :
					$compress_options['css_cachedir'];
				$compress_options['javascript_cachedir'] = empty($compress_options['javascript_cachedir']) ?
					$install_directory . 'cache/' :
					$compress_options['javascript_cachedir'];
				$compress_options['html_cachedir'] = empty($compress_options['html_cachedir']) ?
					$install_directory . 'cache/' :
					$compress_options['html_cachedir'];
				$compress_options['website_root'] = empty($compress_options['website_root']) ?
					$view->paths['absolute']['document_root'] :
					$compress_options['website_root'];
				$compress_options['document_root'] = empty($compress_options['document_root']) ?
					$view->paths['full']['document_root'] :
					$compress_options['document_root'];
				$compress_options['host'] = empty($compress_options['host']) ?
					(empty($_SERVER['HTTP_HOST']) ? '' : $_SERVER['HTTP_HOST']) :
					$compress_options['host'];
/* proof index.php existence in website_root either switch to document_root */
				if (!@is_file($compress_options['website_root'] . 'index.php')) {
					$compress_options['website_root'] = $compress_options['document_root'];
				}
/* check if CSS cache directory is writable */
				if (@is_writable($compress_options['css_cachedir'])) {
					@copy($install_directory . 'images/web.optimizer.stamp.png', $compress_options['css_cachedir'] . 'web.optimizer.stamp.png');
/* check if JavaScript cache directory is writable */
					if (@is_writable($compress_options['javascript_cachedir'])) {
						@copy($install_directory . 'libs/js/wo.cookie.php', $compress_options['javascript_cachedir'] . 'wo.cookie.php');
						@copy($install_directory . 'libs/js/yass.loader.js', $compress_options['javascript_cachedir'] . 'yass.loader.js');
/* check if HTML cache directory is writable */
						if (@is_writable($compress_options['html_cachedir'])) {
							@copy($install_directory . 'libs/php/wo.static.php', $compress_options['html_cachedir'] . 'wo.static.php');
							@copy($install_directory . 'libs/php/0.gif', $compress_options['html_cachedir'] . '0.gif');
							if (empty($compress_options['password'])) {
/* generate random 10-chars string */
								$str = '';
								for ($i=0; $i<10; $i++) {
									$str .= sprintf("%c", mt_rand(32, 127));
								}
/* generate random password to protect web access */
								$compress_options['password'] = md5($str);
							}
/* fill user's info */
							global $current_user;
							get_currentuserinfo();
							$compress_options['email'] = $current_user->user_email;
							$compress_options['name'] = $current_user->user_firstname .
								" " . $current_user->user_lastname;
							if ($compress_options['name'] == ' ') {
								$compress_options['name'] = $current_user->display_name;
							}
							$input = array(
								'wss__password' => 'd41d8cd98f00b204e9800998ecf8427e',
								'wss_page' => 'install_wordpress'
							);
/* Con. the admin controller */
							$admin = new admin(array(
								'input' => $input,
								'view' => $view,
								'basepath' => $install_directory,
								'skip_render' => 1)
							);
							$admin->error = array();
							foreach (array(
								'password',
								'html_cachedir',
								'javascript_cachedir',
								'css_cachedir',
								'document_root',
								'website_root',
								'email',
								'name',
								'host') as $key) {
									$admin->save_option("['" . $key . "']",
										$compress_options[$key]);
							}
							if (!empty($admin->error[0])) {
								$error = $messages['file_not_writable'] . $config_file;
							}
							$admin->view->paths['full']['current_directory'] = $install_directory;
							$webo_grade = 'index2.php?url=' .
								$_SERVER['HTTP_HOST'] .
								str_replace($compress_options['document_root'], "/",
								$compress_options['website_root']) .
								'&mode=xml&source=wo&first=1&email=' .
								$compress_options['email'];
							$index_before = $install_directory . 'index.before';
							if (!@is_file($index_before)) {
/* download initial website state */
								$admin->view->download('http://webo.name/check/' .
									$webo_grade, $index_before, 1);
							}
/* download favicon if it doesn't exist */
							$admin->install_favicon();
						} else {
							$error = $messages['dir_not_writable'] . $compress_options['html_cachedir'];
						}
					} else {
						$error = $messages['dir_not_writable'] . $compress_options['javascript_cachedir'];
					}
				} else {
					$error = $messages['dir_not_writable'] . $compress_options['css_cachedir'];
				}
			} else {
				$error = $messages['curl_not_installed'];
			}
			if (!empty($error)) {
				echo '<strong>' . $error . '</strong>';
				die();
			}
		}
	}
/* download full WEBO Site SpeedUp package inside plugins directory and activate it */
	register_activation_hook(__FILE__, 'web_optimizer_activate');

	if (!function_exists('web_optimizer_deactivate')) {
/* main deactivation function */
		function web_optimizer_deactivate () {
			$install_directory = realpath(ABSPATH) . '/wp-content/plugins/web-optimizer/';
			if (@is_file($install_directory . "controller/admin.php")) {
/* include generic libraries */
				require($install_directory . "controller/admin.php");
				require($install_directory . "libs/php/view.php");
/* Con. the view library */
				$view = new compressor_view();
				$view->set_paths(substr(0, strlen(ABSPATH) - strlen(preg_replace("!/wp-admin/[^/]*\?.*$!", "/", $_SERVER['REQUEST_URI'])), strlen(ABSPATH)));
				$view->paths['full']['current_directory'] = $install_directory;
/* Con. the admin controller */
				$admin = new admin(array(
					'view' => $view,
					'basepath' => $install_directory,
					'skip_render' => 1)
				);
/* clean all rules from .htaccess file */
				$admin->htaccess = $admin->detect_htaccess();
				if (!@is_file($admin->htaccess . '.backup')) {
					$content = $admin->clean_htaccess();
					$admin->write_file($admin->htaccess, $content);
				} else {
					@copy($admin->htaccess . '.backup', $admin->htaccess);
				}
/* deactivate WEBO Site SpeedUp */
				$admin->save_option('[\'active\']', 0, 0);
			}
		}
	}
/* deactivate WEBO Site SpeedUp */
	register_deactivation_hook(__FILE__, 'web_optimizer_deactivate');

	if (!function_exists('web_optimizer_add_css')) {
		function web_optimizer_add_css() {
			$version = @file_get_contents(realpath(ABSPATH) . '/wp-content/plugins/web-optimizer/version');
			echo '<link rel="stylesheet" type="text/css" href="../wp-content/plugins/web-optimizer/libs/css/wss.css?' . $version . '"/>';
		}
	}

	if (!function_exists('web_optimizer_add_menu')) {
/* general function to add all items to admin section */
		function web_optimizer_add_menu () {
			if ($_GET['page'] == 'web_optimizer_manager') {
				add_action('admin_print_styles','web_optimizer_add_css');
			}
			add_menu_page('WEBO Site SpeedUp', 'WEBO Site SpeedUp', 5, 'web_optimizer_manager', 'web_optimizer_manager', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACEklEQVQ4T3WST0iTcRjHf3nwtNOC/twW6kGvMXArYd1EN9pi4C5BJHRYSO80oqRAGsgGleDy1Nb8c8j0IpMVYjDqEhP6g77uUnpZHhL0IKRbyz3t8wuHbe4LDzw838/nfbcxpWqSzea8y8vZz/Pz7wrT0+kyw86NrpavJpNZt6RSH8xY7LWMj8+eOHQwsHVyMrm4Mzr6UqLRSVla+ihbW9tSLP7Ww86NDiaZTO3+95CpqUVzeHhCIpFJDTcKHQwsjpYXFt73GMZTGRwck3z+Z0P5KDCwOLgqFpv91N//WGZm0nVwqfRHDg/LdXdYHFxlGE8KgcAD2dj4IWtrm6JOuSrf8a0G4/G0HpJIvNEdDCwOrvL775XdbkMODgoavNw1IM5Lt/XbbRcCetg7HUHdEVgcXNXdPVB2uW7J/v6/B8zNZfSbjNBzsZ726GHnRkdgcXCVz3e3YLdfl1xuU5fFYknOnPVqIRp9pYedGx2BxcFVwWDkS3u7X8LhePVHevgoIefOX6t81KIedm5HgcXBVeHwix6bzS1tbT4xze8ayOe3qz8eYedGYFpargoOrv4v9PXdN63WK9LR4ZfV1W/SKHQwsDjVf+LIyITF6by509zcKRZLl4RCz2RlZV329n7pYedGB+Nw3NjFUcfDobf3jtnUZBelLp44dDB18vEMDY15PZ7Q19ZWb6HyxjLDzo2ulv8LN6Bqnkiu8fYAAAAASUVORK5CYII=');
		}
	}
/* add hook to admin panel and all styles */
	if (is_admin()) {
		add_action('admin_menu', 'web_optimizer_add_menu');
	}

	if (!function_exists('web_optimizer_shutdown')) {
/* envelope output buffer with optimization actions */
		function web_optimizer_shutdown ($content) {
			global $web_optimizer;
			if (!empty($content)) {
				$not_buffered = 1;
				if (!empty($web_optimizer)) {
					return $web_optimizer->finish($content);
				} else {
					return $content;
				}
			}
		}
	}
	
	if (!function_exists('web_optimizer_init') && function_exists('web_optimizer_shutdown')) {
/* main function for every page execution */
		function web_optimizer_init() {
			global $web_optimizer;
			if (!is_admin() && !strpos($_SERVER['REQUEST_URI'], 'wp-login.php')) {
				$not_buffered = 1;
/* set correct Content-Type for various feeds */
				if (is_feed()) {
					$type = get_query_var('feed');
					$type = str_replace('/', '', $type);
					switch ($type) {
						case 'atom':
							$type = "application/atom+xml";
							break;
						case 'rdf':
							$type = "application/rdf+xml";
							break;
						case 'rss':
						case 'rss2':
						default:
							$type = "application/rss+xml";
							break;
					}
				} else {
					$type = get_option('html_type');
					if ($type == '') {
						$type = 'text/html';
					}
				}
				header("Content-Type: ". $type ."; charset=\"" . get_option('blog_charset') . "\"");
				if (@is_file(ABSPATH . '/wp-content/plugins/web-optimizer/web.optimizer.php')) {
					require(ABSPATH . '/wp-content/plugins/web-optimizer/web.optimizer.php');
/* fix for directories detecting, thx to Jeromy Darling */
				} elseif (@is_file(dirname(__FILE__) . '/web-optimizer/web.optimizer.php')) {
					require(dirname(__FILE__) . '/web-optimizer/web.optimizer.php');
				}
				ob_start('web_optimizer_shutdown');
			}
		}
	}
/* add init and finish hook */
	add_action('plugins_loaded', 'web_optimizer_init');
	
	if (!function_exists('web_optimizer_manager')) {
/* manage all options through WP interface */
		function web_optimizer_manager () {
			$basepath = realpath(ABSPATH) . '/wp-content/plugins/web-optimizer/';
/* We need these */
			require($basepath . "controller/admin.php");
			require($basepath . "libs/php/view.php");
/* include language file */
			$language = strtolower(preg_replace("/[-,;].*/", "",
				empty($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ? 'en' : $_SERVER["HTTP_ACCEPT_LANGUAGE"]));
			$language = preg_replace("/[^a-z]/", "", $language);
			$language = str_replace(array('uk'), array('ua'), $language);
			if (!empty($_COOKIE['wss_lang'])) {
				$language = strtolower($_COOKIE['wss_lang']);
			}
			if (@is_file($basepath . "libs/php/lang/" . $language . ".php")) {
				require($basepath . "libs/php/lang/" . $language . ".php");
			} else {
				require($basepath . "libs/php/lang/en.php");
			}
/* make authorized access */
			require($basepath . 'config.webo.php');
			$input = array(
				'wss__password' => $compress_options['password'],
				'wss_page' => 'install_dashboard'
			);
/* Con. the view library */
			$view = new compressor_view();
			$view->set_paths($_SERVER['DOCUMENT_ROOT']);
			$view->paths['full']['current_directory'] = $basepath;
			$version = @file_get_contents($basepath . 'version');
			@chdir($basepath);
/* Con. the admin controller */
			$web_optimizer_admin = new admin(array(
				'view' => $view,
				'input' => $input,
				'basepath' => $basepath,
				'language' => $language,
				'skip_render' => 1)
			);
/* inslude scripts */
			echo '<script type="text/javascript">wss_root="' .
			str_replace($compress_options['document_root'], "/", $compress_options['website_root']) .
			'wp-content/plugins/web-optimizer/"</script><script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAcDjjgL6gyYUwSrkesv6c7RRPj_C4VnSBVCqcbcH6fyxpcL8EhxSiDicBRQUIZJ32TB5Qr_cb3UjZXg"></script><script type="text/javascript" src="../wp-content/plugins/web-optimizer/libs/js/yass.loadbar.js?' .
			$version .
			'"></script><script type="text/javascript">if(_("#wss_feed")[0]){(function(){google.load("feeds","1");function a(){var f=new google.feeds.Feed("http://feeds.feedburner.com/WebOptimizerBlog");f.load(function(r){if(!r.error){_.feeds[0]=r.feed}})}google.setOnLoadCallback(a)}());(function(){google.load("feeds","1");function a(){var f=new google.feeds.Feed("http://sitespeedupupdates.blogspot.com/feeds/posts/default?alt=rss");f.load(function(r){if(!r.error){_.feeds[1]=r.feed}})};google.setOnLoadCallback(a)}())}</script>';
		}
	}

	if (!function_exists('web_optimizer_init_clean_cache')) {
/* delete item from HTML cache on changes */
		function web_optimizer_init_clean_cache ($id) {
			include(realpath(ABSPATH) . '/wp-content/plugins/web-optimizer/config.webo.php');
/* remove files from cache */
			$file = $compress_options['html_cachedir'] . str_replace(
				array('/', '?', '&'),
				array('+', '+', '+'),
				post_permalink($id)) . '.html';
			@unlink($file);
			@unlink($file . '.gz');
			@unlink($file . '.df');
/* remove home page from cache */
			$file = $compress_options['html_cachedir'] . '+.html';
			@unlink($file);
			@unlink($file . '.gz');
			@unlink($file . '.df');
		}
	}

/* add actions to clear cache */
	add_action('publish_post', 'web_optimizer_init_clean_cache');
	add_action('edit_post', 'web_optimizer_init_clean_cache');
	add_action('delete_post', 'web_optimizer_init_clean_cache');
	add_action('publish_phone', 'web_optimizer_init_clean_cache');
?>