<?php
/**
 * Plugin Name: Pep28 addon
 * Description: Addon officiel pour Pep28.
 * Version:     1.0.0
 * Author:      voir Sharepoint Dev28	
 * Author URI:  https://pep28.sharepoint.com/sites/DevZone
 * Text Domain: pep28-addon
 */

function register_widgets( $widgets_manager ) {
	require_once( __DIR__ . '/widgets/memory/memory_widget.php' );
	require_once( __DIR__ . '/widgets/sound/sound_widget.php' );
	$widgets_manager->register( new \Memory_Widget() );
	$widgets_manager->register(new \Sound_Widget());
}
   function register_memory_widget_scripts() {
	wp_register_script( 'memory_widget_js', plugins_url( '/widgets/memory/memory_widget.js', __FILE__ ) );
}
function register_memory_widget_styles() {
	wp_register_style( 'memory_widget_css', plugins_url( '/widgets/memory/memory_widget.css', __FILE__ ) );
}

add_action( 'elementor/widgets/register', 'register_widgets' );
add_action( 'wp_enqueue_scripts', 'register_memory_widget_scripts' );
add_action( 'wp_enqueue_scripts', 'register_memory_widget_styles' );
?>