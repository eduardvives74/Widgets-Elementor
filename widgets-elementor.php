<?php

/**
 * Plugin Name:  Elementor Widgets
 * Description: Custom Elementor extension.
 * Plugin URI: https://eduardvives.com/
 * Version: 1.0.0
 * Author: Eduard Vives
 * Author URI:  https://eduardvives.com/
 * Text Domain: ev-widgets
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function register_new_widgets($widgets_manager)
{
	require_once(__DIR__ . '/widgets/time-line.php');
	$widgets_manager->register(new \Elementor_Timeline_Widget());
}

add_action('elementor/widgets/register', 'register_new_widgets');

function styles_and_functions()
{
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_style( 'evwidgets-style', $plugin_url  . '/assets/ev-widgets.css' );
	wp_enqueue_script( 'evwidgets-style', $plugin_url  . '/assets/ev-functions.js', array(), '1.0', true );
}
add_action('wp_enqueue_scripts', 'styles_and_functions');
