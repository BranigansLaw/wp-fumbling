<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://tyficonsulting.com/
 * @since             1.0.2
 * @package           Ren_Find_Blog_Link_Dropdown
 *
 * @wordpress-plugin
 * Plugin Name:       RenovationFind Blog Link Dropdown
 * Plugin URI:        https://tyficonsulting.com/service/create-custom-wordpress-plugin/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.2
 * Author:            TyFi Consulting Inc.
 * Author URI:        https://tyficonsulting.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ren-find-blog-link-dropdown
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_VERSION', '1.0.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ren-find-blog-link-dropdown-activator.php
 */
function activate_ren_find_blog_link_dropdown() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ren-find-blog-link-dropdown-activator.php';
	Ren_Find_Blog_Link_Dropdown_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ren-find-blog-link-dropdown-deactivator.php
 */
function deactivate_ren_find_blog_link_dropdown() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ren-find-blog-link-dropdown-deactivator.php';
	Ren_Find_Blog_Link_Dropdown_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ren_find_blog_link_dropdown' );
register_deactivation_hook( __FILE__, 'deactivate_ren_find_blog_link_dropdown' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ren-find-blog-link-dropdown.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ren_find_blog_link_dropdown() {

	$plugin = new Ren_Find_Blog_Link_Dropdown();
	$plugin->run();

}
run_ren_find_blog_link_dropdown();
