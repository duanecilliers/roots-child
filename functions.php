<?php
/**
 * Roots Child functions and definitions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * @package roots-child
 * @since 0.1.0
 */

 // Useful global constants
define( 'ROOTSCHILD_VERSION', '0.1.0' );

require_once( get_stylesheet_directory() . '/lib/theme-functions.php' );

/**
 * Require plugins
 */
require_once( get_stylesheet_directory() . '/lib/class-tgm-plugin-activation.php' );
require_once( get_stylesheet_directory() . '/lib/theme-require-plugins.php' );

add_action( 'tgmpa_register', 'rootschild_register_required_plugins' );

 /**
  * Set up theme defaults and register supported WordPress features.
  *
  * @uses load_theme_textdomain() For translation/localization support.
  *
  * @since 0.1.0
  */
function rootschild_setup() {
	/**
	 * Makes roots-child available for translation.
	 *
	 * Translations can be added to the /lang directory.
	 * If you're building a theme based on roots-child, use a find and replace
	 * to change 'rootschild' to the name of your theme in all template files.
	 */
	load_theme_textdomain( 'roots-child', get_template_directory() . '/languages' );

	/****************************************
	Backend
	*****************************************/

	/**
	 * filter Yoast SEO metabox priority
	 */
	add_filter( 'wpseo_metabox_prio', 'rootschild_filter_yoast_seo_metabox' );

	/**
	 * Customize contact methods
	 */
	add_filter( 'user_contactmethods', 'rootschild_change_contactmethod', 10, 1 );

	/**
	 * Don't update theme if theme with same name exists in WP theme repo
	 */
	add_filter( 'http_request_args', 'rootschild_dont_update_theme', 5, 2 );

	/**
	 * Remove dashboard metaboxes
	 */
	add_action('wp_dashboard_setup', 'rootschild_remove_dashboard_widgets' );

	/**
	 * Change Admin Menu Order
	 */
	add_filter( 'custom_menu_order', 'rootschild_custom_menu_order' );
	add_filter( 'menu_order', 'rootschild_custom_menu_order' );

	/**
	 * Hide admin areas that aren't used
	 */
	add_action( 'admin_menu', 'rootschild_remove_menu_pages' );

	/**
	 * Remove default link for images
	 */
	add_action( 'admin_init', 'rootschild_imagelink_setup', 10 );

	/**
	 * Show kitchen Sink in WYSIWYG editor
	 */
	add_filter( 'tiny_mce_before_init', 'rootschild_unhide_kitchensink' );

	/****************************************
	Frontend
	*****************************************/

	/**
	  * Add humans.txt to the <head> element.
	  */
	add_action( 'wp_head', 'rootschild_header_meta' );

	/**
	 * Remove Query Strings From Static Resources
	 */
	add_filter( 'script_loader_src', 'rootschild_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', 'rootschild_remove_script_version', 15, 1 );

	/**
	 * Remove Read More Jump
	 */
	add_filter( 'the_content_more_link', 'rootschild_remove_more_jump_link' );
}
add_action( 'after_setup_theme', 'rootschild_setup' );
