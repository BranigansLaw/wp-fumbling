<?php
/**
 * Plugin Name: SMART Leads Pages
 * Plugin URI: http://tyfi.consulting/
 * Description: Create intelligent leads pages that learn.
 * Version: 0.0.2
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
	wp_enqueue_style('tyfi-consulting-smart-leads-pages-css', plugins_url( 'css/tyfi-consulting-smart-leads-pages.css', __FILE__ ), array(), '1.01', 'all' );

    $style = 'bootstrap';
    if( ( ! wp_style_is( $style, 'queue' ) ) && ( ! wp_style_is( $style, 'done' ) ) ) {
        //queue up your bootstrap
        wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), true, true);
    }

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'tyfi-consulting-smart-leads-pages-js', plugins_url( 'js/tyfi-consulting-smart-leads-pages.js', __FILE__ ), array('jquery'), '1.01', true);

    wp_enqueue_script( 'google-recaptcha', 'https://www.google.com/recaptcha/api.js');

    wp_localize_script( 'tyfi-consulting-smart-leads-pages-js', 'tyfiConsultingLeadPages', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' )
    ));
}

add_action( 'wp_enqueue_scripts', 'tyfi_consulting_smart_leads_pages_enque_scripts' );

function smart_pages_admin_enque_shortcode_ads_scripts() {
    wp_enqueue_media();
    wp_enqueue_script( 'shortcode-ads-js', plugins_url( 'js/tyfi-consulting-smart-leads-pages-admin.js', __FILE__ ), array('jquery'), '1.01', true);
}

add_action( 'admin_enqueue_scripts', 'smart_pages_admin_enque_shortcode_ads_scripts' );

function smart_lead_page_template_reg($single) {
    global $post;

    $path = plugin_dir_path( __FILE__ ) . 'template/single-smart-lead-page.php';

    if ($post->post_type == "smart_lead_page") {
        if(file_exists($path)) {
            $single = $path;
        }
    }
    return $single;
}

add_filter('single_template', 'smart_lead_page_template_reg', 99);

add_action( 'wp_ajax_nopriv_tyfi_consulting_post_lead_conversion', 'tyfi_consulting_post_conversion' );
add_action( 'wp_ajax_tyfi_consulting_post_lead_conversion', 'tyfi_consulting_post_conversion' );

function tyfi_consulting_post_conversion() {
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
        check_ajax_referer( 'smart_leads_nonce', 'wp_nonce' );

        $formData = json_decode( stripslashes( $_POST['form_data'] ) );

        $leadPageId = $formData->leadPageId;
        $emailAddress = $formData->email;

        // Get the google recaptcha response
        $grSiteSecret = get_post_meta( $leadPageId, 'gr_site_secret', true );
        $grResponse = wp_safe_remote_post( "https://www.google.com/recaptcha/api/siteverify", array( secret => $grSiteSecret, response => $formData->g_recaptcha_response ) );

        if ( ! $grResponse->success ) {
            http_response_code(400);
            wp_die();
        }

        // Log the conversion
        $conversions = get_post_meta( $leadPageId, 'conversions', true );
        $conversions = (!isset($conversions) || is_null($conversions) || !is_array($conversions)) ? array() : $conversions;

        $found = false;
        foreach ($conversions as $conversion) {
            if ($conversion->email === $emailAddress) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            array_push($conversions, $formData);
            update_post_meta( $leadPageId, 'conversions', $conversions );

            wp_send_json_success( array( 'form_name' => get_the_title( $leadPageId ) ) );
        }

        // Send Email notification of submission
    }

    wp_die();
}

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
            'publicly_queryable' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'revisions' ),
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
    $smart_lead_page_conversions = get_post_meta( $smart_lead_page->ID, 'conversions', true );
    $smart_lead_page_conversions = (!isset($smart_lead_page_conversions) || is_null($smart_lead_page_conversions)) ? array() : $smart_lead_page_conversions;
    $success_message = esc_html( get_post_meta( $smart_lead_page->ID, 'success_message', true ) );
    $gr_site_key = esc_html( get_post_meta( $smart_lead_page->ID, 'gr_site_key', true ) );
    $gr_site_secret = esc_html( get_post_meta( $smart_lead_page->ID, 'gr_site_secret', true ) );
    $background_image_id = esc_html( get_post_meta( $smart_lead_page->ID, 'background_image_id', true ) );
    $logo_image_id = esc_html( get_post_meta( $smart_lead_page->ID, 'logo_image_id', true ) );
    ?>
    <table>
        <tr>
            <td>Number of signups needed before launch</td>
            <td>
                <input type='number' name='num_signups_needed' id='num_signups_needed' value='<?php echo $smart_lead_page_signups_needed; ?>'>
            </td>
        </tr>
        <tr>
            <td>Success Message</td>
            <td>
                <input type='text' name='success_message' id='success_message' value='<?php echo $success_message; ?>'>
            </td>
        </tr>
        <tr>
            <td>Google Recatcha Site Key</td>
            <td>
                <input type='text' name='gr_site_key' id='gr_site_key' value='<?php echo $gr_site_key; ?>'>
            </td>
        </tr>
        <tr>
            <td>Google Recatcha Site Key</td>
            <td>
                <input type='text' name='gr_site_secret' id='gr_site_secret' value='<?php echo $gr_site_secret; ?>'>
            </td>
        </tr>
        <tr>
            <td>Background Image '<?php echo $background_image_id ?>'</td>
            <td>
                <img id='background-image-preview' src='<?php echo wp_get_attachment_url( $background_image_id ) ?>'>
            </td>
            <td>
                <input type="button" class="button upload_image_button" data-meta-data-id="background_image_id" data-image-preview-id="background-image-preview" value="<?php _e( 'Upload image' ); ?>" />
                <input type='hidden' name='background_image_id' id='background_image_id' value=''>
            </td>
        </tr>
        <tr>
            <td>Logo Image '<?php echo $logo_image_id ?>'</td>
            <td>
                <img id='logo-image-preview' src='<?php echo wp_get_attachment_url( $logo_image_id ) ?>'>
            </td>
            <td>
                <input type="button" class="button upload_image_button" data-meta-data-id="logo_image_id" data-image-preview-id="logo-image-preview" value="<?php _e( 'Upload image' ); ?>" />
                <input type='hidden' name='logo_image_id' id='logo_image_id' value=''>
            </td>
        </tr>
        <tr>
            <td >Conversions #</td>
            <td>
                <?php echo count( $smart_lead_page_conversions ); ?>
            </td>
        </tr>
        <tr>
            <td>Conversions</td>
            <td>
                <table>
                <?php 
                    foreach ($smart_lead_page_conversions as $conversion) {
                        ?>
                            <tr>
                                <td><?php echo $conversion->email; ?></td>
                            </tr>
                        <?php
                    }
                ?>
                </table>
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

        if ( isset( $_POST['success_message'] ) && $_POST['success_message'] != '' ) {
            update_post_meta( $smart_lead_page_id, 'success_message', $_POST['success_message'] );
        }

         if ( isset( $_POST['gr_site_key'] ) && $_POST['gr_site_key'] != '' ) {
            update_post_meta( $smart_lead_page_id, 'gr_site_key', $_POST['gr_site_key'] );
        }

        if ( isset( $_POST['gr_site_secret'] ) && $_POST['gr_site_secret'] != '' ) {
            update_post_meta( $smart_lead_page_id, 'gr_site_secret', $_POST['gr_site_secret'] );
        }

        if ( isset( $_POST['background_image_id'] ) && isset( $_POST['background_image_id'] ) && !empty( $_POST['background_image_id'] ) ) {
            update_post_meta( $smart_lead_page_id, 'background_image_id', absint( $_POST['background_image_id'] ) );
        }

        if ( isset( $_POST['logo_image_id'] ) && isset( $_POST['logo_image_id'] ) && !empty( $_POST['logo_image_id'] ) ) {
            update_post_meta( $smart_lead_page_id, 'logo_image_id', absint( $_POST['logo_image_id'] ) );
        }
    }
}

add_action( 'save_post', 'add_smart_lead_pages_fields', 10, 2 );

 ?>