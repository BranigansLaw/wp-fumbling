<?php
function theme_enqueue_styles() {

    	wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css' );

    	$parent_style = 'parent-style';

    	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array('bootstrap'), '1.0.0' );

	// Fonts
	//wp_enqueue_style( 'lane-narrow-font', get_stylesheet_directory_uri() . '/font/LANENAR_stylesheet.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function body_begin() {
	do_action('body_begin');
}

function before_scripts() {
	do_action('before_scripts');
}

function enqueue_my_scripts() {
	// Reregister jQuery so it is modern, uses CDN, and is at the bottom
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://code.jquery.com/jquery-1.12.3.min.js', false, null, true );
	wp_enqueue_script( 'jquery' );

	// Register Bootstrap
	wp_enqueue_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array('jquery'), null, true); // all the bootstrap javascript goodness

	// Register theme JavaScript
	wp_enqueue_script( 'seeds-of-health-js', get_stylesheet_directory_uri() . '/js/seeds-of-health.js', array('jquery'), '1.0.1', true);
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');

function seeds_register_google_tag_manager_header_snippet() {
?>
<!-- Google Tag Manager -->

<!-- End Google Tag Manager -->
<?php
}
add_action( 'before_scripts', 'seeds_register_google_tag_manager_header_snippet' );

function seeds_register_google_tag_manager_body_snippet() {
?>
<!-- Google Tag Manager (noscript) -->

<?php
}
add_action( 'body_begin', 'seeds_register_google_tag_manager_body_snippet' );
?>