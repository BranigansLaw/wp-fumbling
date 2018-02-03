<?php

$sectionId = 'seeds-theme-contact-options';
function theme_enqueue_styles() {

    	wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css' );

    	$parent_style = 'parent-style';

    	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array('bootstrap') );

		wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), '1.0.10' );

    	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:300%7CSource+Sans+Pro%7COpen+Sans%7CFjord+One%7COpen+Sans:700%7COpen+Sans:600%7CFjord+One:300%7CFjord+One:600' );

	// Fonts
	//wp_enqueue_style( 'lane-narrow-font', get_stylesheet_directory_uri() . '/font/LANENAR_stylesheet.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function enqueue_my_scripts() {
	// Reregister jQuery so it is modern, uses CDN, and is at the bottom
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://code.jquery.com/jquery-1.12.3.min.js', false, null, true );
	wp_enqueue_script( 'jquery' );

	// Register Bootstrap
	wp_enqueue_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array('jquery'), null, true); // all the bootstrap javascript goodness

	// Register theme JavaScript
	wp_enqueue_script( 'seeds-of-health-js', get_stylesheet_directory_uri() . '/js/seeds-of-health.js', array('bootstrap-js'), '1.0.4', true);


	if ( is_front_page() ) {
	 	// Register the slider
		wp_enqueue_script( 'jssor-slider-js', get_stylesheet_directory_uri() . '/js/jssor.slider.min.js', array('bootstrap-js'), '1.0.0', true);

		// Register theme JavaScript
		wp_enqueue_script( 'seeds-homepage-js', get_stylesheet_directory_uri() . '/js/seeds-homepage.js', array('jssor-slider-js'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');

function seedsofhealth_customize_register( $wp_customize ) {
	/**
	 * Company Info Options.
	 */
	$wp_customize->add_section( 'company_info_options', array(
		'title'    => __( 'Company Info', 'seedsofhealth' ),
		'priority' => 140, // Before Additional CSS.
	) );

	/**
	 * Company Info Options.
	 */
	$wp_customize->add_section( 'google_tag_manager_options', array(
		'title'    => __( 'Google Tag Manager', 'seedsofhealth' ),
		'priority' => 160, // Before Additional CSS.
	) );

	$wp_customize->add_setting( 'company_address' );

	$wp_customize->add_control( 'company_address', array(
		'label'       => __( 'Company Address', 'seedsofhealth' ),
		'section'     => 'company_info_options',
		'type'        => 'text',
		'description' => __( 'Address of the company.', 'seedsofhealth' ),
	) );

	$wp_customize->add_setting( 'company_phone' );

	$wp_customize->add_control( 'company_phone', array(
		'label'       => __( 'Company Phone', 'seedsofhealth' ),
		'section'     => 'company_info_options',
		'type'        => 'text',
		'description' => __( 'Phone number of the company.', 'seedsofhealth' ),
	) );

	$wp_customize->add_setting( 'company_email' );

	$wp_customize->add_control( 'company_email', array(
		'label'       => __( 'Company Email', 'seedsofhealth' ),
		'section'     => 'company_info_options',
		'type'        => 'text',
		'description' => __( 'Email of the company.', 'seedsofhealth' ),
	) );

	$wp_customize->add_setting( 'company_facebook' );

	$wp_customize->add_control( 'company_facebook', array(
		'label'       => __( 'Company Facebook', 'seedsofhealth' ),
		'section'     => 'company_info_options',
		'type'        => 'text',
		'description' => __( 'Facebook of the company.', 'seedsofhealth' ),
	) );

	$wp_customize->add_setting( 'company_linkedin' );

	$wp_customize->add_control( 'company_linkedin', array(
		'label'       => __( 'Company LinkedIn', 'seedsofhealth' ),
		'section'     => 'company_info_options',
		'type'        => 'text',
		'description' => __( 'LinkedIn of the company.', 'seedsofhealth' ),
	) );

	$wp_customize->add_setting( 'tagmanger_head' );

	$wp_customize->add_control( 'tagmanger_head', array(
		'label'       => __( 'Google Tag Manager Head', 'seedsofhealth' ),
		'section'     => 'google_tag_manager_options',
		'type'        => 'textarea',
		'description' => __( 'The head block for Google Tag Manager.', 'seedsofhealth' ),
	) );

	$wp_customize->add_setting( 'tagmanger_body' );

	$wp_customize->add_control( 'tagmanger_body', array(
		'label'       => __( 'Google Tag Manager Body', 'seedsofhealth' ),
		'section'     => 'google_tag_manager_options',
		'type'        => 'textarea',
		'description' => __( 'The body block for Google Tag Manager.', 'seedsofhealth' ),
	) );

}
add_action( 'customize_register', 'seedsofhealth_customize_register' );
?>