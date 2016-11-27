<?php
/**
 * Plugin Name: WordPress AJAX Example for Beginners
 * Plugin URI: https://shellcreeper.com/wp-ajax-for-beginners/
 * Description: Example plugin from tutorial "WordPress AJAX for Beginners"
 * Version: 1.0.0
 * Author: David Chandra Purnama
 * Author URI: https://shellcreeper.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wp-ajax-noob
 * Domain Path: /languages/
 *
 * @author David Chandra Purnama <david@genbumedia.com>
 * @copyright Copyright (c) 2016, Genbu Media
**/
if ( ! defined( 'WPINC' ) ) { die; }


/* 1. REGISTER SHORTCODE
------------------------------------------ */

/* Init Hook */
add_action( 'init', 'my_wp_ajax_noob_plugin_init', 10 );

/**
 * Init Hook to Register Shortcode.
 * @since 1.0.0
 */
function my_wp_ajax_noob_plugin_init(){

	/* Register Shortcode */
	add_shortcode( 'john-cena', 'my_wp_ajax_noob_john_cena_shortcode_callback' );

}

/**
 * Shortcode Callback
 * Just display empty div. The content will be added via AJAX.
 */
function my_wp_ajax_noob_john_cena_shortcode_callback(){

	/* Enqueue JS only if this shortcode loaded. */
	wp_enqueue_script( 'my-wp-ajax-noob-john-cena-script' );

	/* Output empty div. */
	return '<div id="john-cena"></div>';
}


/* 2. REGISTER SCRIPT
------------------------------------------ */

/* Enqueue Script */
add_action( 'wp_enqueue_scripts', 'my_wp_ajax_noob_scripts' );

/**
 * Scripts
 */
function my_wp_ajax_noob_scripts(){

	/* Plugin DIR URL */
	$url = trailingslashit( plugin_dir_url( __FILE__ ) );

	/* JS + Localize */
	wp_register_script( 'my-wp-ajax-noob-john-cena-script', $url . "assets/script.js", array( 'jquery' ), '1.0.0', true );
	wp_localize_script( 'my-wp-ajax-noob-john-cena-script', 'john_cena_ajax_url', admin_url( 'admin-ajax.php' ) );
}


/* 3. AJAX CALLBACK
------------------------------------------ */

/* AJAX action callback */
add_action( 'wp_ajax_john_cena', 'my_wp_ajax_noob_john_cena_ajax_callback' );
add_action( 'wp_ajax_nopriv_john_cena', 'my_wp_ajax_noob_john_cena_ajax_callback' );


/**
 * Ajax Callback
 */
function my_wp_ajax_noob_john_cena_ajax_callback(){
	$first_name = isset( $_POST['first_name'] ) ? $_POST['first_name'] : 'N/A';
	$last_name = isset( $_POST['last_name'] ) ? $_POST['last_name'] : 'N/A';
	?>
	<p>Hello. Your first name is <?php echo strip_tags( $first_name ); ?>.</p>
	<p>And your last name is <?php echo strip_tags( $last_name ); ?>.</p>
	<?php
	wp_die(); // required. to end AJAX request.
}

