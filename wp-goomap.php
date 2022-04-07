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

function projects(){
		$args = array(
            'label' => 'Goo Projects',
            'public' => true,
            'show_in_rest' => true,
            'register_meta_box_cb' => 'employee_id_meta_box',
            'show_ui' => true,
            'hierarchical' => true,
            'rewrite' => array(
                'slug' => 'gooproject'
                ),
            'query_var' => true,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'author'
                )
            );
		register_post_type( 'gooproject', $args );
	}
function goo_flush_rewrites() {
        projects();
        flush_rewrite_rules();
}
add_action( 'init', 'projects' );


function employee_id_meta_box() {

    add_meta_box(
        'employee-id',
        __( 'Latitude Value', 'wp-goomap' ),
        'employee_id_meta_box_callback'
    );
    add_meta_box(
        'employee-designation',
        __( 'Longitude Value', 'wp-goomap' ),
        'employee_designation_meta_box_callback'
    );

}

function employee_id_meta_box_callback( $emp ) {
    wp_nonce_field( 'employee_id_nonce', 'employee_id_nonce' );
    $value = get_post_meta( $emp->ID, '_employee_id', true );
    echo '<input style="width:100%" id="employee_id" name="employee_id" value="'. esc_attr( $value ) .'">';
}
function employee_designation_meta_box_callback( $emp ) {
    wp_nonce_field( 'employee_designation_nonce', 'employee_designation_nonce' );
    $value_1 = get_post_meta( $emp->ID, '_employee_designation', true );
    echo '<input style="width:100%" id="employee_designation" name="employee_designation" value="'. esc_attr( $value_1 ) .'">';
}

function save_employee_id_meta_box_data( $post_id ) {

    if ( ! isset( $_POST['employee_id_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['employee_id_nonce'], 'employee_id_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( isset( $_POST['post_type'] ) && 'employee' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    }
    else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    if ( ! isset( $_POST['employee_id'] ) ) {
        return;
    }

    //for designation
    if ( ! isset( $_POST['employee_designation_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['employee_designation_nonce'], 'employee_designation_nonce' ) ) {
        return;
    }  
    if ( ! isset( $_POST['employee_designation'] ) ) {
        return;
    }



    $id_data = sanitize_text_field( $_POST['employee_id'] );
    $des_data = sanitize_text_field( $_POST['employee_designation'] );
    update_post_meta( $post_id, '_employee_id', $id_data );
    update_post_meta( $post_id, '_employee_designation', $des_data );
}

add_action( 'save_post', 'save_employee_id_meta_box_data' );

// add_action('rest_api_init', function () {
//   register_rest_route( 'wp-json/wp/v2/', 'gooproject/',array(
//                 'methods'  => 'GET',
//                 'callback' => 'get_latest_posts_by_category'
//       ));
// });

// function get_latest_posts_by_category( WP_REST_Request $request) {

//     $args = array(
//             'category' => $request['category_id'],
//             'post_type' => 'gooproject',
//     );

//     $posts = get_posts($args);
//     if (empty($posts)) {
//     return new WP_Error( 'empty_category', 'There are no posts to display', array('status' => 404) );

//     }

//     $response = new WP_REST_Response($posts);
//     $response->set_status(200);

//     return $response;
// }

add_filter( 'get_terms', 'wpa104168_all_terms', 10, 3 );

function wpa104168_all_terms ( $terms, $taxonomies, $args ){

        if ( is_admin() && function_exists( 'get_current_screen' ) && ! is_wp_error( $screen = get_current_screen() ) && in_array( $screen->base, array( 'gooproject', 'edit-post', 'edit' ) ) ) {

            if( in_array( 'gooproject', ( array ) $taxonomies ) ) {

                $all_terms = __( 'All Projects' );

                $all = (object) array( 'term_id' => 'all', 'slug' => 'all', 'name' => $all_terms, 'parent' => '0' );

                $terms['all'] = $all;
            }
        }
        return $terms;
    }

add_action( 'save_post', 'wpa104168_save_all_terms', 10, 3 );

function wpa104168_save_all_terms ( $post_id ){

// verify this came from our screen and with proper authorization.

    if ( !wp_verify_nonce( $_POST['_wpnonce'], 'update-post_' . $post_id )) {
        return $post_id;
    }

    // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    // Check permissions
    if ( 'page' == $_POST['gooproject'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } else {
        if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;
    }

    // OK, we're authenticated: we need to find and save the data
   if ( isset( $_POST['tax_input']['gooproject'] ) && is_array( $_POST['tax_input']['gooproject'] ) && in_array( 'all', $_POST['tax_input']['gooproject'] ) ){

    $args = array( 'hide_empty'    => false );
        $terms = get_terms( 'gooproject', $args );


        if ( ! is_wp_error( $terms ) ){

            foreach ( $terms as $term ){
                $update[] = $term->slug;
            }

            wp_set_object_terms( $post_id, $update, 'gooproject' );

        }

   }

    return $post_id;

}   
add_action( 'admin_print_footer_scripts', 'wpa104168_js_solution' );

function wpa104168_js_solution(){ ?>

<script type="text/javascript">

jQuery(document).ready(function($) {

    $('ul#genrechecklist').append('<li><label class="selectit"><input type="checkbox" class="toggle-all-terms"/> Check All</label>');

    $('.toggle-all-terms').on('change', function(){
        $(this).closest('ul').find(':checkbox').prop('checked', this.checked );
    });

});
</script>

<?php } 







/**
 * Register a taxonomy MDB
 *
 * @see register_post_type() for registering post types.
 */
add_action( 'init', 'goo_private_taxonomy_mdb', 30 );

function goo_private_taxonomy_mdb() {
 
  $args = array(
    'hierarchical'          => true,
    'label'        => __( 'Multilateral Development Bank', 'wp-goomap' ),
    'show_ui'               => true,
    'show_admin_column'     => true,
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'mdb' ),
    'show_in_rest'          => true,
    'rest_base'             => 'mdb',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
  );
 
  register_taxonomy( 'mdb', array( 'gooproject' ), $args );
 
}

/**
 * Register a taxonomy Countries
 *
 * @see register_post_type() for registering post types.
 */
function goo_private_taxonomy_countries() {
    $args = array(
        'label'                 => __( 'Countries', 'wp-goomap' ),
        'public'                => true,
        'rewrite'               => array( 'slug' => 'countries' ),
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'countries',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'hierarchical'          => true
    );
     
    register_taxonomy( 'countries', array('gooproject'), $args );
}
add_action( 'init', 'goo_private_taxonomy_countries', 0 );

/**
 * Register a taxonomy Year of Investment
 *
 * @see register_post_type() for registering post types.
 */
function goo_private_taxonomy_yoi() {
    $args = array(
        'label'        => __( 'Year of Investment', 'wp-goomap' ),
        'public'       => true,
        'rewrite'      => array( 'slug' => 'yoi' ),
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'yoi',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'hierarchical'          => true
    );
     
    register_taxonomy( 'yoi', array('gooproject'), $args );
}
add_action( 'init', 'goo_private_taxonomy_yoi', 0 );

/**
 * Register a taxonomy Status
 *
 * @see register_post_type() for registering post types.
 */
function goo_private_taxonomy_Status() {
    $args = array(
        'label'        => __( 'Status', 'wp-goomap' ),
        'public'       => true,
        'rewrite'      => array( 'slug' => 'status' ),
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'status',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'hierarchical'          => true
    );
     
    register_taxonomy( 'status', array('gooproject'), $args );
}
add_action( 'init', 'goo_private_taxonomy_Status', 0 );

/**
 * Register a taxonomy 100% Sport Related
 *
 * @see register_post_type() for registering post types.
 */
function goo_private_taxonomy_SR() {
    $args = array(
        'label'        => __( '100% Sport Related', 'wp-goomap' ),
        'public'       => true,
        'rewrite'      => array( 'slug' => '100-sr' ),
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => '100-sr',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'hierarchical'          => true
    );
     
    register_taxonomy( '100-sr', array('gooproject'), $args );
}
add_action( 'init', 'goo_private_taxonomy_SR', 0 );

/**
 * Register a taxonomy Sector
 *
 * @see register_post_type() for registering post types.
 */
function goo_private_taxonomy_Sector() {
    $args = array(
        'label'        => __( 'Sector', 'wp-goomap' ),
        'public'       => true,
        'rewrite'      => array( 'slug' => 'sector' ),
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'sector',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'hierarchical'          => true
    );
     
    register_taxonomy( 'sector', array('gooproject'), $args );
}
add_action( 'init', 'goo_private_taxonomy_Sector', 0 );

/**
 * Register a taxonomy Type of Sport Project
 *
 * @see register_post_type() for registering post types.
 */
function goo_private_taxonomy_tosp() {
    $args = array(
        'label'        => __( 'Type of Sport Project', 'wp-goomap' ),
        'public'       => true,
        'rewrite'      => array( 'slug' => 'tosp' ),
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'tosp',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'hierarchical'          => true
    );
     
    register_taxonomy( 'tosp', array('gooproject'), $args );
}
add_action( 'init', 'goo_private_taxonomy_tosp', 0 );

/**
 * Register a taxonomy Size
 *
 * @see register_post_type() for registering post types.
 */
function goo_private_taxonomy_Size() {
    $args = array(
        'label'        => __( 'Size', 'wp-goomap' ),
        'public'       => true,
        'rewrite'      => array( 'slug' => 'size' ),
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'size',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'hierarchical'          => true
    );
     
    register_taxonomy( 'size', array('gooproject'), $args );
}
add_action( 'init', 'goo_private_taxonomy_Size', 0 );

/**
 * Register a taxonomy Covid-19 [Was an investment in sport-based solutions made as a result of 
 *
 * @see register_post_type() for registering post types.
 */
function goo_private_taxonomy_Covid_19() {
    $args = array(
        'label'        => __( 'Covid-19', 'wp-goomap' ),
        'public'       => true,
        'rewrite'      => array( 'slug' => 'Covid-19' ),
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'Covid-19',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'hierarchical'          => true
    );
     
    register_taxonomy( 'covid-19', array('gooproject'), $args );
}
add_action( 'init', 'goo_private_taxonomy_Covid_19', 0 );

/**
 * Register a taxonomy Key Partner 
 *
 * @see register_post_type() for registering post types.
 */
function goo_private_taxonomy_Key_Partner() {
    $args = array(
        'label'        => __( 'Key Partner', 'wp-goomap' ),
        'public'       => true,
        'rewrite'      => array( 'slug' => 'key-partner' ),
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'key-partner',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'hierarchical'          => true
    );
     
    register_taxonomy( 'key-partner', array('gooproject'), $args );
}
add_action( 'init', 'goo_private_taxonomy_Key_Partner', 0 );

/**
 * Register a taxonomy Key Terms
 *
 * @see register_post_type() for registering post types.
 */
function goo_private_taxonomy_Key_Terms() {
    $args = array(
        'label'        => __( 'Key Terms', 'wp-goomap' ),
        'public'       => true,
        'rewrite'      => array( 'slug' => 'key-terms' ),
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'key-terms',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'hierarchical'          => true
    );
     
    register_taxonomy( 'key-terms', array('gooproject'), $args );
}
add_action( 'init', 'goo_private_taxonomy_Key_Terms', 0 );

/**
 * Register a taxonomy Financial Instrument
 *
 * @see register_post_type() for registering post types.
 */
function goo_private_taxonomy_financial() {
    $args = array(
        'label'        => __( 'Financial Instrument', 'wp-goomap' ),
        'public'       => true,
        'rewrite'      => array( 'slug' => 'financial' ),
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'financial',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'hierarchical'          => true
    );
     
    register_taxonomy( 'financial', array('gooproject'), $args );
}
add_action( 'init', 'goo_private_taxonomy_financial', 0 );
	

register_activation_hook( __FILE__, 'goo_flush_rewrites' );
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

}

//registering styles
 

function goo_tem_style_n_script(){
    wp_register_style( 'goo_main_style', plugin_dir_url( __FILE__ ) . 'assets/style.css', array(), 1.0, 'all' );
    wp_register_style( 'goo_bs_style', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', array(), 1.0, 'all' );
    wp_register_style( 'goo_awesome_style', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css', array(), 1.0, 'all' );
    
    wp_register_script( 'goo_jquery_script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), 1.0, false );
    wp_register_script( 'goo_popper_script', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array(), 1.0, false );
    wp_register_script( 'goo_bs_script', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array(), 1.0, false );
    wp_register_script( 'goo_main_script', plugin_dir_url( __FILE__ ) . 'assets/main.js', array(), 1.0, false );
}

add_action( 'wp_enqueue_scripts', 'goo_tem_style_n_script' );


function goo_template_shortcode($attr){

    $args = shortcode_atts( array(
     
        'url' => '#'

    ), $attr );

    //$audio_url = get_option('awesome_audio_url');

    wp_enqueue_style( 'goo_main_style' );
    wp_enqueue_style( 'goo_bs_style' );
    wp_enqueue_style( 'goo_awesome_style' );

    wp_enqueue_script('goo_jquery_script');
    wp_enqueue_script('goo_popper_script');
    wp_enqueue_script('goo_bs_script');
    wp_enqueue_script('goo_main_script');

    ob_start();
    require_once(plugin_dir_path( __FILE__ ) . 'includes/page-map.php');
    $includedhtml = ob_get_contents();
    ob_end_clean();

    return $includedhtml;

}

add_shortcode('show_template', 'goo_template_shortcode'); 

/**
 * Start the plugin custom code
 */
function wp_goomap_menu_settings() {
	add_menu_page( 
		'Goomap Settings',
		'GooMap', 
		'manage_options', 
		'wp-goomap', 
		'goomap_settings_page',
		'',
		75 
	);

	add_submenu_page( 
		'wp-goomap', 
		'Goomap settings Options', 
		'Settings', 
		'manage_options', 
		'goomap-settings', 
		'goomap_settings_sub_page'
	);

}
add_action( 'admin_menu', 'wp_goomap_menu_settings' );


function goomap_settings_page() {
	?>
	<h2>Google map options page</h2>
	
	<?php
}

function goomap_settings_sub_page(){ 
	?>
	<h2>Google map Settings Page</h2>
<?php 
}











