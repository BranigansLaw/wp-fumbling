<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://tyficonsulting.com/
 * @since      1.0.0
 *
 * @package    Ren_Find_Blog_Link_Dropdown
 * @subpackage Ren_Find_Blog_Link_Dropdown/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ren_Find_Blog_Link_Dropdown
 * @subpackage Ren_Find_Blog_Link_Dropdown/public
 * @author     TyFi Consulting Inc. <tyler@tyficonsulting.com>
 */
class Ren_Find_Blog_Link_Dropdown_Public {

	/**
	 * The tags that this plugin will display
	 */
	private $tags;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->tags = array( 'Select city', 'Calgary', 'Edmonton', 'Vancouver', 'Winnipeg' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ren_Find_Blog_Link_Dropdown_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ren_Find_Blog_Link_Dropdown_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ren-find-blog-link-dropdown-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ren_Find_Blog_Link_Dropdown_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ren_Find_Blog_Link_Dropdown_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ren-find-blog-link-dropdown-public.js', array( 'jquery' ), $this->version, false );

	}

	public function blog_select_shortcode( $attrs ) {

		$selectOptions = '';
		foreach ( $this->tags as $tag ) {
			$tagObj = get_term_by( 'name', $tag, 'post_tag' );

			if ( $tagObj ) {
				$tagLink = get_tag_link( $tagObj->term_id );

				$selectOptions .= '<option value="' . $tagLink . '">' . $tag . '</option>';
			}
			else {
				$selectOptions .= '<option>' . $tag . '</option>';
			}
		}

		return '<select id="BlogLinks">' . $selectOptions . '</select>';
	}

}
