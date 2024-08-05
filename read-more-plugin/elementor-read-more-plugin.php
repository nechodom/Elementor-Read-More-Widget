<?php
/*
Plugin Name: Elementor Read More Plugin
Description: A plugin to add a read more button with expandable content in Elementor.
Version: 1.4.1
Author: Matěj Kevin Nechodom
Author URI: https://www.nechodom.cz
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Enqueue the CSS file
function elementor_read_more_plugin_enqueue_styles() {
    wp_enqueue_style( 'elementor-read-more-plugin-style', plugins_url( '/css/style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'elementor_read_more_plugin_enqueue_styles' );

// Enqueue the JS file
function elementor_read_more_plugin_enqueue_scripts() {
    wp_enqueue_script( 'elementor-read-more-plugin-script', plugins_url( '/js/elementor-read-more-plugin.js', __FILE__ ), array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'elementor_read_more_plugin_enqueue_scripts' );

// Include the widget file
function register_elementor_read_more_widget( $widgets_manager ) {
    require_once( __DIR__ . '/widgets/read-more-widget.php' );
    $widgets_manager->register( new \Elementor_Read_More_Widget() );
}
add_action( 'elementor/widgets/register', 'register_elementor_read_more_widget' );
