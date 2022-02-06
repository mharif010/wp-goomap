<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mharif.com
 * @since             1.0.0
 * @package           Wp_Goomap
 *
 * @wordpress-plugin
 * Plugin Name:       Wp Goomap
 * Plugin URI:        https://wordpress.org/plugins/wp-goomap
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            mh arif
 * Author URI:        https://mharif.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-goomap
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_GOOMAP_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-goomap-activator.php
 */
function activate_wp_goomap() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-goomap-activator.php';
	Wp_Goomap_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-goomap-deactivator.php
 */
function deactivate_wp_goomap() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-goomap-deactivator.php';
	Wp_Goomap_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_goomap' );
register_deactivation_hook( __FILE__, 'deactivate_wp_goomap' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-goomap.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_goomap() {

	$plugin = new Wp_Goomap();
	$plugin->run();


	/**
 * start the plugin custom code
 */
function wp_goomap_own_settings_page() {
	add_options_page( 
		'Wp Goomap Settings',
		'Wp Goomap', 
		'manage_options', 
		'wp-goomap', 
		'goomap_render_plugin_settings_page' 
	);
}
add_action( 'admin_menu', 'wp_goomap_own_settings_page' );

function goomap_render_plugin_settings_page() {
	?>
	<h2>Wp Google map Settings</h2>
	<form action="options.php" method="post">
		<?php 
		settings_fields( 'goomap_example_plugin_options' );
		do_settings_sections( 'goomap_example_plugin' ); 
		?>
		<input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save Changes' ); ?>" />
	</form>
	<?php
}

function goomap_register_settings() {
	register_setting( 
		'goomap_example_plugin_options', 
		'goomap_example_plugin_options', 
		'' 
	);
	add_settings_section( 
		'goomap_settings', 
		'Map view using this Shortcode', 
		'goomap_plugin_section_text', 
		'goomap_example_plugin' 
	);

	add_settings_field( 
		'goomap_embeded_code_settings', 
		'Map embeded code', 
		'goomap_embeded_code_settings', 
		'goomap_example_plugin', 
		'goomap_settings' 
	);
	
}
add_action( 'admin_init', 'goomap_register_settings' );


function goomap_plugin_section_text() {
	echo '<p>Here you can see the shortcode : [wp-goomap] </p>';
}

function goomap_embeded_code_settings() {
	$options = get_option( 'goomap_example_plugin_options' );
	echo "<input id='goomap_embeded_code_settings' name='goomap_example_plugin_options[wp_goomap]' type='text' value='" . esc_attr( $options['wp_goomap'] ) . "' />";
	return $options['wp_goomap'];
}

add_shortcode('wp-goomap', 'goomap_embeded_code_settings');

}
return run_wp_goomap();

//add_shortcode('wp-goomap', 'run_wp_goomap');







