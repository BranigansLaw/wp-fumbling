<?php
function theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function enqueue_my_scripts() {
	// Register theme JavaScript
	wp_enqueue_script( 'renovationfind-js', get_stylesheet_directory_uri() . '/js/renovationfind.js', array('jquery'), true, true);
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');
?>