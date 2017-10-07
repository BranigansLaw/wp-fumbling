<?php

/*********************************************************************************************
MASONRY PORTFOLIO 
*********************************************************************************************/	

$labels = array(
	'name' => __( 'Masonry Folio','tdwowbiscaya'),
	'singular_name' => __( 'Masonry Folio' ,'tdwowbiscaya' ),
	'add_new' => __('Add New Item','tdwowbiscaya'),
	'add_new_item' => __('Add New Item','tdwowbiscaya'),
	'edit_item' => __('Edit Item','tdwowbiscaya'),
	'new_item' => __('New Item' ,'tdwowbiscaya'),
	'view_item' => __('View Item','tdwowbiscaya'),
	'search_items' => __('Search Masonry Item' ,'tdwowbiscaya'),
	'not_found' =>  __('No Item Found','tdwowbiscaya'),
	'not_found_in_trash' => __('No Item Found in Trash','tdwowbiscaya'),
	'parent_item_colon' => ''

);  

$args = array(
	'labels' => $labels,
	'public' => true,
	'exclude_from_search' => false,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'menu_position' => null,	
	'menu_icon' => get_template_directory_uri() . '/img/m.png',
	'rewrite' => array('slug' => 'ourportfolio'),
	'supports' =>  array('title', 'editor', 'thumbnail', 'excerpt','custom-fields','comments')
); 

register_post_type( 'masonry-portfolio', $args );
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'pt_';
	
	$meta_boxes[] = array(
		'id'         => 'portfolio_metabox',
		'title'      => __('Portfolio Settings', 'tdwowbiscaya'),
		'pages'      => array( 'masonry-portfolio', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
		)
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'meta-box.php';

}

/* ==  Register Custom Taxonomy  ==============================*/
  $labels = array(
    'name' => __( 'Masonry Categories Filter', 'tdwowbiscaya' ),
    'singular_name' => __( 'Category', 'tdwowbiscaya' ),
    'search_items' =>  __( 'Search Categories', 'tdwowbiscaya' ),
    'all_items' => __( 'All Categories', 'tdwowbiscaya' ),
    'parent_item' => __( 'Parent Category', 'tdwowbiscaya' ),
    'parent_item_colon' => __( 'Parent Category:', 'tdwowbiscaya' ),
    'edit_item' => __( 'Edit Category', 'tdwowbiscaya' ), 
    'update_item' => __( 'Update Category', 'tdwowbiscaya' ),
    'add_new_item' => __( 'Add New Category', 'tdwowbiscaya' ),
    'new_item_name' => __( 'New Category Name', 'tdwowbiscaya' ),
    'menu_name' => __( 'Categories Filter', 'tdwowbiscaya' ),
  ); 	

  register_taxonomy('masonry-portfolio-categories',array('masonry-portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'masonry-portfolio-categories' ),
  ));  

/* ==  List categories for the galleries  ==============================*/
class Category_Walker extends Walker_Category {
   function start_el(&$output, $category, $depth, $args) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
	  $link = '<a href="#" data-filter=".term-'.$category->term_id.'" ';
	  

      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all items under %s', 'tdwowbiscaya' ), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>';

      // $link .= $cat_name . '</a>';

      $link .= $cat_name;
      if(!empty($category->description)) {
         //$link .= ' <span>'.$category->description.'</span>';
      }

      $link .= '</a>';
      if ( (! empty($feed_image)) || (! empty($feed)) ) {
         $link .= ' ';
         if ( empty($feed_image) )
            $link .= '(';
         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';

         if ( empty($feed) )
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'tdwowbiscaya' ), $cat_name ) . '"';
         else {
            $title = ' title="' . $feed . '"';
            $alt = ' alt="' . $feed . '"';
            $name = $feed;
            $link .= $title;
         }

         $link .= '>';
         if ( empty($feed_image) )
            $link .= $name;
         else
            $link .= "<img src='$feed_image'$alt$title" . ' />';
         $link .= '</a>';
         if ( empty($feed_image) )
            $link .= ')';
      }

      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';

      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }

      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= '<li class="segment-'.rand(2, 99).'"';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }

   }

}





















/*********************************************************************************************
TESTIMONIALS 
*********************************************************************************************/	

$labels = array(
	'name' => __( 'Testimonials','tdwowbiscaya'),
	'singular_name' => __( 'Testomonials' ,'tdwowbiscaya' ),
	'add_new' => __('Add New Testimonial','tdwowbiscaya'),
	'add_new_item' => __('Add New Item','tdwowbiscaya'),
	'edit_item' => __('Edit Item','tdwowbiscaya'),
	'new_item' => __('New Item' ,'tdwowbiscaya'),
	'view_item' => __('View Item','tdwowbiscaya'),
	'search_items' => __('Search Item' ,'tdwowbiscaya'),
	'not_found' =>  __('No Item Found','tdwowbiscaya'),
	'not_found_in_trash' => __('No Item Found in Trash','tdwowbiscaya'),
	'parent_item_colon' => ''

);  

$args = array(
	'labels' => $labels,
	'public' => true,
	'exclude_from_search' => false,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'menu_position' => null,	
	'menu_icon' => get_template_directory_uri() . '/img/t.png',
	'rewrite' => array('slug' => 'wtestimonials'),
	'supports' =>  array('title', 'editor', 'thumbnail',)
); 

register_post_type( 'testimonials', $args );
add_filter( 'cmb_meta_boxes', 'cmb_testimonials_metaboxes' );
function cmb_testimonials_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'pt_';
	
	$meta_boxes[] = array(
		'id'         => 'testimonials_metabox',
		'title'      => __('Testimonials Settings', 'tdwowbiscaya'),
		'pages'      => array( 'testimonials'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
		)
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_testimonials_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_testimonials_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'meta-box.php';

}




// Add meta box to the post edit screen.
function example_custom_meta() {

        // Will display on the top right of the edit post page
        add_meta_box( 
                
                'example_meta', 
                'Details', 
                'example_meta_callback', 
                'testimonials',
                'side',
                'high'
        ); 

} // end example_custom_meta

add_action( 'add_meta_boxes', 'example_custom_meta' );

// Output meta box content
function example_meta_callback( $post ) {

        // Verify meta content
        wp_nonce_field( basename( __FILE__ ), 'example_nonce' );
        $example_stored_meta = get_post_meta( $post->ID );
        
        ?>
        
        <p><!-- meta tname -->
        
                <label for="tname" class="example-row-title">Name: </label>
                <input type="text" name="tname" id="tname" value="<?php echo ( isset( $example_stored_meta['tname'] ) ? $example_stored_meta['tname'][0] : '' ); ?>" />
        
        </p>
        
        <p><!-- meta tposition -->
        
                <label for="tposition" class="example-row-title">Position: </label>
                <input type="text" name="tposition" id="tposition" value="<?php echo ( isset( $example_stored_meta['tposition'] ) ? $example_stored_meta['tposition'][0] : '' ); ?>" />
        
        </p>
        
        <?php

} // end meta callback function



// Save custom meta input
function example_meta_save( $post_id ) {

        // Check save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = (isset($_POST[ 'example_nonce' ] ) && wp_verify_nonce( $_POST[ 'example_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
        
        // Exits script depending on save status
        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        
                return;
        
        }
        
        // Checks for and sanitizes text input, saves if needed
        // For name
        if (isset( $_POST['tname'] ) ) {
        
                update_post_meta( $post_id, 'tname', sanitize_text_field( $_POST['tname'] ) );
        
        }
		 // For position
        if (isset( $_POST['tposition'] ) ) {
        
                update_post_meta( $post_id, 'tposition', sanitize_text_field( $_POST['tposition'] ) );
        
        }
        

} // end example_meta_save function

add_action( 'save_post', 'example_meta_save' );
?>