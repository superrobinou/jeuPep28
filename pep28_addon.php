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

add_action( 'elementor/widgets/register', 'register_widgets' );
?>