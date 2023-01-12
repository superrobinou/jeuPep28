<?php
/**
 * Plugin Name: Elementor Addon
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-addon
 */

function register_memory_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/memory_widget.php' );
	$widgets_manager->register( new \Memory_Widget() );
}
   function register_memory_widget_scripts() {
	wp_register_script( 'memory_widget', plugins_url( 'memory_widget.js', __FILE__ ) );
}
function register_widget_styles() {
	wp_register_style( 'memory_widget', plugins_url( 'assets/css/memory_widget.css', __FILE__ ) );
}

add_action( 'elementor/widgets/register', 'register_hello_world_widget' );
add_action( 'wp_enqueue_scripts', 'register_widget_scripts' );
add_action( 'wp_enqueue_scripts', 'register_widget_styles' );
?>
