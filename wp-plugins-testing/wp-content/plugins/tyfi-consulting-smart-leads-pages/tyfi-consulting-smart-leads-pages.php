<?php
/**
 * Plugin Name: SMART Leads Pages
 * Plugin URI: http://tyfi.consulting/
 * Description: Create intelligent leads pages that learn.
 * Version: 0.0.1
 * Author: TyFi Consulting
 * Author URI: http://tyfi.consulting/
 * License: GPL2
 */

require 'plugin-update-checker/plugin-update-checker.php';
$MyUpdateChecker = PucFactory::buildUpdateChecker(
    'https://tyficonsulting.com/wp-private-plugins/tyfi-consulting-smart-leads-pages/update-metadata.json',
    __FILE__,
    'tyfi-consulting-smart-leads-pages'
);


function tyfi_consulting_smart_leads_pages_enque_scripts() {
	//wp_enqueue_style('tyfi-consulting-smart-leads-pages-css', '/wp-content/plugins/tyfi-consulting-smart-leads-pages/tyfi-consulting-smart-leads-pages.css', false);

	//wp_enqueue_script('jquery');
	//wp_enqueue_script( 'tyfi-consulting-smart-leads-pages-js', '/wp-content/plugins/tyfi-consulting-smart-leads-pages/tyfi-consulting-smart-leads-pages.js', array('jquery'), false, true );
}

add_action( 'wp_enqueue_scripts', 'tyfi_consulting_smart_leads_pages_enque_scripts' );

function smart_lead_page_template_reg($single) {
    global $post;

    echo "Hello World 2";

    $path = plugin_dir_url( __FILE__ ) . 'single-smart-lead-page.php';
    if ($post->post_type == "smart_lead_page"){
        if(file_exists($path))
            $single = $path;
    }
    return $single;
}

echo "Hello World 1";
add_filter('single_template', 'smart_lead_page_template_reg', 99);

echo var_dump( $wp_filter['single_template'] );

/*
Shortcode Registration
function shortcode_ad_shortcode( $atts ) {
    $postId = $atts['id'];

    if ( empty( $postId ) ) {
        return 'Error: Invalid Shortcode Ad Id';
    }

    $shortcodeAd = get_post( $postId );

    if ($shortcodeAd->post_type != 'shortcode_ad' ) {
        return 'Error: Post ID is not a Shortcode Ad';
    }

    return '<a href="' . get_page_link( get_post_meta( $postId , 'target_url', true ) ) . '"><img class="shortcode-banner-ad-image" src="' . wp_get_attachment_url( get_post_meta( $postId , 'image_id', true ) ) . '" /></a>';
}
*/


function create_tyfi_consulting_lead_page_post_type() {
    register_post_type( 'smart_lead_page',
        array(
            'labels' => array(
                'name' => 'SMART Lead Pages',
                'singular_name' => 'SMART Lead Page',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New SMART Lead Page',
                'edit' => 'Edit',
                'edit_item' => 'Edit SMART Lead Page',
                'new_item' => 'New SMART Lead Page',
                'view' => 'View',
                'view_item' => 'View SMART Lead Page',
                'search_items' => 'Search SMART Lead Pages',
                'not_found' => 'No SMART Lead Pages found',
                'not_found_in_trash' => 'No SMART Lead Pages found in Trash',
                'parent' => 'Parent SMART Lead Pages'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title' ),
            'taxonomies' => array( '' ),
            'menu_icon' => null,
            'has_archive' => true
        )
    );
}

add_action( 'init', 'create_tyfi_consulting_lead_page_post_type' );

function smart_lead_pages_my_admin() {
    add_meta_box( 'smart_lead_pages_meta_box',
        'SMART Lead Pages Details',
        'display_smart_lead_pages_meta_box',
        'smart_lead_page', 'normal', 'high'
    );
}

add_action( 'admin_init', 'smart_lead_pages_my_admin' );

function display_smart_lead_pages_meta_box( $smart_lead_page ) {
    $smart_lead_page_signups_needed = esc_html( get_post_meta( $smart_lead_page->ID, 'num_signups_needed', true ) );
    ?>
    <table>
        <tr>
            <td style="width: 100%">Number of signups needed before launch</td>
            <td>
                <input type='number' name='num_signups_needed' id='num_signups_needed' value='<?php echo $smart_lead_page_signups_needed; ?>'>
            </td>
        </tr>
    </table>
    <?php
}

function add_smart_lead_pages_fields( $smart_lead_page_id, $smart_lead_page ) {
    // Check post type for smart lead pages
    if ( $smart_lead_page->post_type == 'smart_lead_page' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['num_signups_needed'] ) && $_POST['num_signups_needed'] != '' ) {
            update_post_meta( $smart_lead_page_id, 'num_signups_needed', $_POST['num_signups_needed'] );
        }
    }
}

add_action( 'save_post', 'add_smart_lead_pages_fields', 10, 2 );

 ?>