<?php

/**
 * Fired during plugin activation
 *
 * @link       https://mharif.com
 * @since      1.0.0
 *
 * @package    Wp_Goomap
 * @subpackage Wp_Goomap/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Goomap
 * @subpackage Wp_Goomap/includes
 * @author     mh arif <mh.arif.web@gmail.com>
 */
class Wp_Goomap_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	static function activate() {

		// add_option( "db_version", "1.0" );
		//global $db_version;
		
		$db_version = '1.0';
		global $wpdb;
		global $db_version;

		$table_name = $wpdb->prefix . 'goomap';
		
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			name tinytext NOT NULL,
			text text NOT NULL,
			url varchar(55) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		add_option( 'db_version', $db_version );

		// function goomap_db_table_create() {
		// 	global $wpdb;
		// 	global $db_version;

		// 	$table_name = $wpdb->prefix . 'goomap';
			
		// 	$charset_collate = $wpdb->get_charset_collate();

		// 	$sql = "CREATE TABLE $table_name (
		// 		id mediumint(9) NOT NULL AUTO_INCREMENT,
		// 		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		// 		name tinytext NOT NULL,
		// 		text text NOT NULL,
		// 		url varchar(55) DEFAULT '' NOT NULL,
		// 		PRIMARY KEY  (id)
		// 	) $charset_collate;";

		// 	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		// 	dbDelta( $sql );

		// 	add_option( 'db_version', $db_version );
		// }
		//self::projects();
		//self::init_goo();
		//self::goo_flush_rewrites();

		//$this->projects;
		//$this->init_goo;
		//$this->goo_flush_rewrites;


	}





}
