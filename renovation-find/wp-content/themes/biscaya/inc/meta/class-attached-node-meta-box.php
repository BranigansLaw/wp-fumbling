<?php
require_once("class-advanced-meta-box.php");

class Attached_Node_Meta_Box extends Advanced_Meta_Box {
	protected $attachment;
	function __construct($metabox) {	
		if (!is_admin()) return;
		parent::__construct($metabox);	
		add_action('admin_print_styles', array(__CLASS__, 'js_css'));
		$this->attachment = $metabox['attachment'];
		//Ajax hooks
		add_action('wp_ajax_'.$this->_meta_box['id'].'_node_add', array(&$this, 'add_node'),5, 1);	
		add_action('wp_ajax_'.$this->_meta_box['id'].'_node_update', array(&$this, 'update_nodes'),5, 1);
		add_action('wp_ajax_'.$this->_meta_box['id'].'_node_delete', array(&$this, 'delete_nodes'),5, 1);	
	}
	
	 static function js_css() {
		//Load parent scripts
		parent::js_css();
		// change '\' to '/' in case using Windows
		$content_dir = str_replace('\\', '/', WP_CONTENT_DIR);
		$script_dir = str_replace('\\', '/', dirname(__FILE__));
		
		// get URL of the directory of current file, this works in both theme or plugin
		$base_url = str_replace($content_dir, WP_CONTENT_URL, $script_dir);
		//Load current scripts
		wp_enqueue_script('attached-node-meta-box', $base_url. '/class-attached-node-meta-box.js');
	}

	function delete_nodes() {
		$nonce = $_POST['nonce'];
		if(!wp_verify_nonce( $nonce, 'attached_node_meta_box_delete' ))  die(-1);
		if (!isset($_POST['data'])) die(-1);
		if(!wp_delete_post($_POST['data']))
			exit(-1);
		exit(0);
	}
	
	function show() {
		wp_nonce_field(basename(__FILE__), 'attached_node_meta_box_nonce');
		echo "<div class='attached_nodes'>";
		//New nodes
		//echo '<h4>Add New '.$this->attachment['labels']['name'].'</h4>';
		echo '<div class = "new_nodes">',"\n";
		$this->show_node();
		echo "</div>";
		
		
		//Current nodes/Attachments
		global $post;
		global $wpdb;
		$query ="
			SELECT p.ID 
			FROM $wpdb->posts p 
			WHERE (p.post_status='publish' OR p.post_status = 'inherit') AND p.post_type = %s AND p.post_parent = %d;";
		$node_ids = $wpdb->get_col($wpdb->prepare($query, $this->attachment['type'], $post->ID));
		echo '<h4>Edit '.$this->attachment['labels']['name'].'</h4>';
		echo '<div class = "current_nodes">';
		//echo '<input type="hidden" name="attached_node_meta_box_nonce" value="', wp_create_nonce('attached_node_meta_box_nonce'), '" />';
		if(sizeof($node_ids) <=0){
			echo 'No '.$this->attachment['labels']['name'];
		} 
		foreach ($node_ids as $node_id) {
			$this->show_node($node_id);
		}
		echo "</div>";
		echo "</div>";		
	}
	
	function is_new_att($post_id) {
		return (empty($post_id) || !is_numeric($post_id));	
	}

	function get_field_name($field, $post_id='') {
		if(empty($post_id) || !is_numeric($post_id)) {
			$id = "_" . $field['id']."[new]";
		} else {
			$id = $this->_meta_box['id'] . "[{$post_id}][" . $field['id'] . "]";
		}
		return $id . (($field['multiple'] || $field['type'] === 'taxonomy') ? "[]" : "");
	}
	
	function get_field_id($field, $post_id='') {
		if(empty($post_id) || !is_numeric($post_id)) {
			return  "_" . $field['id'];
		} else {
			return $this->_meta_box['id'] . "_{$post_id}_" . $field['id'];
		}
	}
	 function show_node($post_id='') {
		 global $post, $typenow;
		$save_nonce = wp_create_nonce( 'attached_node_meta_box_save' );
		$delete_nonce = wp_create_nonce( 'attached_node_meta_box_delete' );
		$update_nonce = wp_create_nonce( 'attached_node_meta_box_update' );
		echo '<table class="form-table',($this->is_new_att($post_id) ? ' new_node':''),'">';
		echo '<thead ',($this->is_new_att($post_id) ? ' class="toggle_body"':''),'><tr><th colspan = "2" class="colapse_body">'; 
		echo '<label>',($this->is_new_att($post_id) ? 'Add New ':''), $this->attachment['labels']['singular_name'], ($this->is_new_att($post_id) ? ' (Click to Expand) ':''),'</label></th>' ;
		echo '</tr></thead>';
		echo '<tbody class="',($this->is_new_att($post_id) ? 'hidden':''),'">';
		foreach ($this->_fields as $field) {
			echo "<tr>";
			$meta = $this->get_meta($post_id, $field, !$field['multiple']);
			// call separated methods for displaying each type of field
			$this->show_field_begin($field, $meta, $post_id);
			$this->show_field($field, $meta, $post_id);
			if(isset($field['fields'])) {
				foreach ($field['fields'] as $f) {
					$meta = get_post_meta($post_id, $f['id'], !$f['multiple']);
					echo '<label>', $f['name'];
					$this->show_field($f, $meta, $post_id);
					echo '</label>';
					echo "\t";
				}
			}
			$this->show_field_end($field, $meta);
			echo "<tr />";

		}
		echo '<tr ><td colspan = "2">';
		if(!$this->is_new_att($post_id)){
			echo '<a href="#" class="update_node button-secondary" rel = "'.$this->_meta_box['id'].'_node_update|',$update_nonce,'|',$post->ID,'|',$post->post_type,'">Update</a>';			
			echo '<a href="#" class="delete_node button-secondary" rel = "'.$this->_meta_box['id'].'_node_delete|',$delete_nonce,'">Delete</a>';
			echo '<input type="hidden" name = "node_id[]" value="',$post_id,'"/>';
		} else {
			echo '<a href="#" class="save_node button-secondary" rel = "'.$this->_meta_box['id'].'_node_add|',$save_nonce,'|',$post->ID,'|',$post->post_type,'">Save</a>';			
			echo '<a href="#" class="clear_node button-secondary">Cancel</a>';

		}
		echo '</td></tr></tbody>';
		echo '</table>';
	}
	
	function save($post_id) {
		global $wpdb;
		global $post;

		$post_type_object = get_post_type_object($_POST['post_type']);

		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)						// check autosave
		|| (!isset($_POST['post_ID']) || $post_id != $_POST['post_ID'])			// check revision
		|| (!in_array($_POST['post_type'], $this->_meta_box['pages']))			// check if current post type is supported
		|| (!check_admin_referer(basename(__FILE__), 'attached_node_meta_box_nonce'))		// verify nonce
		|| (!current_user_can($post_type_object->cap->edit_post, $post_id))) {	// check permission
			return $post_id;
		}
		
		//Get current nodes
		$nodes = $_POST[$this->_meta_box['id']];
		
		if(is_array($nodes)) {
			foreach ($nodes as $node_id => $data) {
				if(is_numeric($node_id)) {
					$this->save_post_data($node_id, $this->_fields, $data);
				}
			}
		}
	}
	
	function update_nodes() {
		$post_type_object = get_post_type_object($_POST['post_type']);
		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)						// check autosave
		|| (!isset($_POST['post_ID']))			// check revision
		|| (!in_array($_POST['post_type'], $this->_meta_box['pages']))			// check if current post type is supported
		|| (!wp_verify_nonce($_POST['nonce'], 'attached_node_meta_box_update'))		// verify nonce
		|| (!current_user_can($post_type_object->cap->edit_post, $_POST['post_ID']))
		|| (empty($_POST['data']))) {	// check permission
			exit(-1);
		}
		$post_id = $_POST['post_ID'];
		$nodes = $_POST['data'];

		if(is_array($nodes)) {
			foreach ($nodes as $data) {
				$node_id = $node['node_id'];
				$this->save_post_data($node_id, $this->_fields, $data);
			}
		}
		echo "Node(s) Updated";
		die(0);
		
	}
	function add_node() {	
		$post_type_object = get_post_type_object($_POST['post_type']);

		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)						// check autosave
		|| (!isset($_POST['post_ID']))			// check revision
		|| (!in_array($_POST['post_type'], $this->_meta_box['pages']))			// check if current post type is supported
		|| (!wp_verify_nonce($_POST['nonce'], 'attached_node_meta_box_save'))		// verify nonce
		|| (!current_user_can($post_type_object->cap->edit_post, $_POST['post_ID']))
		|| (empty($_POST['data']))) {	// check permission
			exit(-1);
		}
		$post_id = $_POST['post_ID'];
		$new = $_POST['data'];
		if(is_array($new)) {
			foreach ($new as $data) {	
				$new_node = array(
					'post_title' => $this->attachment['labels']['singular_name'],
					'post_content' => $this->attachment['labels']['singular_name'],
					'post_status' => 'publish',
					'post_type' => $this->attachment['type'],
					'post_parent'=> $post_id
				);					
				$new_id = wp_insert_post($new_node, false);
				if(!is_wp_error($new_id) && is_numeric($new_id) && $new_id >0) {
					$this->save_post_data($new_id, $this->_fields, $data);
				}
				$this->show_node($new_id);
			}
		}	
		
		die(0);
	}

}

?>