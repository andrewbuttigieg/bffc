<?php
	/*
	Plugin Name: BalzanFC Latest Match Results
	Description: Latest Match Results Builder
	Author: Andrew Buttigieg
	Version: 0.1
	*/

	function wp_gear_manager_admin_scripts2() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery');
	}

	function wp_gear_manager_admin_styles2() {
		wp_enqueue_style('thickbox');
	}

	function custom_post_section2() {
		$labels = array(
			'name' => _x('Results', 'post type general name'),
			'singluar_name' => _x('Results', 'post type singular name'),
			'add_new' => _x('Add New', 'Results'),
			'add_new_item' => __('Add New Results'),
			'edit_item' => __('Edit Results'),
			'new_item' => __('New Results'),
			'all_items' => __('All Results'),
			'view_item' => __('View Results'),
			'search_items' => __('Search Results'),
			'not_found' => __('No Results found'),
			'not_found_in_trash' => __('No Results found in Trash'),
			'parent_item_colon' => '',
			'menu_name' => 'Last Match Results'
		);

		$args = array(
			'labels' => $labels,
			'description' => 'Stores the home page Results',
			'public' => true,
			'menu_position' => 10,
			'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
			'has_archive' => true
		);
		
		register_post_type('section2', $args);
	}
	add_action('init', 'custom_post_section2');
	add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts2');
	add_action('admin_print_styles', 'wp_gear_manager_admin_styles2');

	function my_updated_messages2($messages) {
		global $post, $post_ID;

		$messages['section'] = array(
			0 => '',
			1 => sprintf(__('Section updated. <a href="%s">View Section</a>'), esc_url(get_permalink($post_ID))),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __('Section updated.'),
			5 => isset($_GET['revision']) ? sprintf(__('Section restored to revision from %s'), wp_post_revision_title((int)$_GET['section'], false)) : false,
			6 => sprintf(__('Section published. <a href="%s">View section</a>'), esc_url(get_permalink($post_ID))),
			7 => __('Section saved.'),
			8 => sprintf(__('Section submitted. <a target="_blank" href="%s">Preview section</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
			9 => sprintf( __('Section scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview section</a>'), date_i18n( __( 'M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			10 => sprintf( __('Section draft updated. <a target="_blank" href="%s">Preview section</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID))))
		);

		return $messages;
	}
	add_filter('post_updated_messages', 'my_updated_messages2');
	add_action('load-post.php', 'section_post_meta_box_setup2');
	add_action('load-post-new.php', 'section_post_meta_box_setup2');

	// Meta box setup function
	function section_post_meta_box_setup2() {
		// Add meta boxes on the 'add_meta_boxes' hook
		add_action('add_meta_boxes', 'section_add_post_meta_box2');
		// Save post meta on the 'save_post' hook
		add_action('save_post', 'section_save_post_meta2', 10, 2);
	}

	// Create one or more meta boxes to be displayed on the post editor screen
	function section_add_post_meta_box2() {
		add_meta_box(
			'section2-post-data',	// Unique ID
			'Section Details',	// Title
			'show_section_post_meta_box2',	// Callback function
			'section2',		// post type
			'normal',		// context
			'default'		// priority
		);
	}

	// Field Array
	$prefix = 'section_post_';
	$custom_meta_fields = array(
		/*array(
			'label' => 'Show',
			'desc' 	=> 'Show on home page',
			'id' 	=> $prefix.'show',
			'type'		=> 'checkbox'
		),
		array(
			'label' => 'Background Colour',
			'desc' 	=> 'Set background colour',
			'id' 	=> $prefix.'background_colour',
			'type' 	=> 'text'
		),
		array(
			'label' => 'Title Colour',
			'desc' 	=> 'Set title colour',
			'id' 	=> $prefix.'title_colour',
			'type' 	=> 'text'
		),
		array(
			'label' => 'Special Offer',
			'desc' 	=> 'Set section as Special Offer',
			'id' 	=> $prefix.'special_offer',
			'type' 	=> 'checkbox'
		)*/
	);

	// Display the post meta box
	$special_offer_disabled = false;
	function show_section_post_meta_box2() {
		global $custom_meta_fields, $post, $special_offer_disabled;
		// use nonce for verification
		echo '<input type="hidden" name="section_post_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

		// begin the field table and loop
		echo '<table class="form-table">';
		
		$args = array(
			'post_type' => 'section2',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'section_post_special_offer',
					'value' => 'on',
					'compare' => '='
				)
			)
		);
		
		$query = new WP_Query($args);
		
		if($query->have_posts()) {
			$special_offer_disabled = true;
		}
		
		foreach ($custom_meta_fields as $field) {
			// get value of this field if it exists for this post
			$meta = get_post_meta($post->ID, $field['id'], true);
			
			// begin a table row with
			echo '<tr>
					<th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
					<td colspan="2">';
					section_post_get_field($field, $meta);
			echo '</td></tr>';
		}
		
		get_Results2();
		
		echo '</table>';
	}

	function section_post_get_field2($field, $meta) {
		switch ($field['type']) {
			// text
			case 'text':
				echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
					<br /><span class="description">'.$field['desc'].'</span';
				break;
			case 'date':
				echo '<input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
					<br /><span class="description">'.$field['desc'].'</span>';
				break;
			case 'image':
				$image = get_template_directory_uri().'/images/image.png';
				echo '<span class="custom_default_image" style="display: none">'.$image.'</span>';

				if ($meta) {
					$image = wp_get_attachment_image_src($meta, 'medium');
					$image = $image[0];
				}

				echo '<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
						<img src="'.$image.'" class="custom_preview_image" alt="" /><br />
							<input class="custom_upload_image_button button" type="button" value="Choose Image" />
							<small><a href="#" class="custom_clear_image_button">Remove Image</a></small>
							<br class="all" /><span class="description">'.$field['desc'].'';
				break;
			case 'radio':  
			    foreach ( $field['options'] as $option ) {
			        echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' /> 
			                <label for="'.$option['value'].'">'.$option['label'].'</label><br />';
			    }
			    echo '<span class="description">'.$field['desc'].'</span>';
				break;
			case 'checkbox':
				global $special_offer_disabled;
				if($field['label'] == 'Special Offer' && $special_offer_disabled == true) {
					echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : 'disabled="disabled"',' />
								<label for="'.$field['id'].'">'.$field['desc'].'</label>';
				} else {
					echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
								<label for="'.$field['id'].'">'.$field['desc'].'</label>';
				}
				break;
		}
	}
	
	function get_Results2() {
		global $wpdb, $post, $special_offers_cnt;
		
		$meta = get_post_meta($post->ID, 'special_offers', true);
		$special_offers = json_decode($meta);
		$special_offers_cnt = sizeof($special_offers);
		
		//$sql_query_menu = 'SELECT * FROM wp_wprmm_items WHERE active=1';
		//$menu_result = $wpdb->get_results($sql_query_menu);

		$output = '<style>#postdivrich{display:none;}</style>';
		$output .= '<tr>';
		$output .= '<th style="display:none"><label>Select Results</label><input id="special_offers_cnt" name="special_offers_cnt" type="hidden" value="'
			.$special_offers_cnt.'" /></th>';
		
		if($special_offers_cnt > 0) {
			for($i=0; $i < $special_offers_cnt; $i++) {
				/*
				if($i == 0) {
					$output .= '<tr>';
					$output .= '<th>&nbsp;</th>';
				}*/
				
				$output .= '<td>';
				$output .= '<input id="upload_title" type="text" size="18" name="the_title_'.$i.'" value="' . $special_offers[$i]->title . '" />';
				$output .= '</td>';
				$output .= '<td>';
				$output .= '<input id="upload_text" type="text" size="18" name="the_text_'.$i.'" value="' . $special_offers[$i]->text . '" />';
				$output .= '</td>';
				$output .= '<td>';
				$output .= '<input id="upload_text" type="text" size="18" name="the_result_'.$i.'" value="' . $special_offers[$i]->result . '" />';
				$output .= '</td>';
				$output .= '<td><a class="section_link remove_item" data-cnt="2" href="javascript:void(0)">Remove</a></td>';
				$output .= '</tr>';
			}
		}
		
		if($special_offers_cnt > 0) {
			$output .= '<tr>';
			//$output .= '<th>&nbsp;</th>';
		}
		$output .= '<td>';
		//$output .= '<input class="disabled_textbox" type="text" placeholder="Enter Price" disabled="disabled" /><a class="add_item" href="javascript:void(0)">Add</a>';
		//$output .= '<input name="special_offer_price_'.$special_offers_cnt.'" type="text" placeholder="Enter Price" />';

		$output .= '<input id="upload_title" type="text" size="18" name="the_title_'.$special_offers_cnt.'" value="" /><br/>';
		$output .= '<label>Division</label><label for="upload_title">';
		$output .= '</td><td>';
		$output .= '<input type="text" size="18" name="the_text_'.$special_offers_cnt.'" value="" /><br/><label>Teams</label></td>';
		$output .= '<td>';
		$output .= '<input type="text" size="18" name="the_result_'.$special_offers_cnt.'" value="" /><br/><label>Results</label></td>';
		$output .= '<td><a class="add_item section_link" href="javascript:void(0)" data-cnt="'.$special_offers_cnt.'">Add</a>';
		$output .= '</td>';
		$output .= '</tr>';
		
		echo $output;
	}
	
	// Save the meta box's post metadata
	function section_save_post_meta2($post_id) {
		global $custom_meta_fields;

		// Verify once
		if (!wp_verify_nonce($_POST['section_post_nonce'], basename(__FILE__)))
			return $post_id;

		// Check autosave
		if (defined('DOING AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;

		// Check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
				return $post_id;
			elseif (!current_user_can('edit_post', $post_id))
				return $post_id;
		}

		// loop through fields and save the data
		foreach ($custom_meta_fields as $field) {
	        $old = get_post_meta($post_id, $field['id'], true);
	        $new = $_POST[$field['id']];

	        // If the new meta value does not match the old value, update it
			if ($new && $new != $old){
				update_post_meta($_POST["ddl_holding"], $field['id'], $new);
				update_post_meta($post_id, $field['id'], $new);
			}
			// If there is no new meta value but an old value exists, delete it
			elseif ('' == $new && $old){
				delete_post_meta($_POST["ddl_holding"], $field['id'], $old);
				delete_post_meta($post_id, $field['id'], $old);
			}
	    }
			
		$array_to_save = Array();
		for($i=0;$i<$_POST["special_offers_cnt"];$i++) {
			$item_id = $_POST["ddl_".$i];
			$text = $_POST["the_text_".$i];
			$title = $_POST["the_title_".$i];
			$result = $_POST["the_result_".$i];
						
			$obj_to_save = new stdClass();
			$obj_to_save->item_id = $item_id;
			$obj_to_save->text = ($text);
			$obj_to_save->title = ($title);
			$obj_to_save->result = ($result);
			
			array_push($array_to_save, $obj_to_save);
		}
		
		update_post_meta($_POST["ddl_holding"], 'special_offers', json_encode($array_to_save, JSON_UNESCAPED_UNICODE));
		update_post_meta($post_id, 'special_offers', json_encode($array_to_save, JSON_UNESCAPED_UNICODE));
	}

	/*function create_user_dir($company, $email) {

		$wp_upload_dir = wp_upload_dir();
		$basedir = $wp_upload_dir['basedir'] . "/brief-files";
		$baseurl = $wp_upload_dir['baseurl'] . "/brief-files";

		$_dir = dirname(__FILE__) . "/brief-files";

		$company_dir = $basedir . "/" . $company;
		$user_dir = $company_dir . "/" . $email;

		if (!file_exists($company_dir) && !is_dir($company_dir))
			mkdir($company_dir, 0777, true);

		if (!file_exists($user_dir) &&
				!is_dir($user_dir))
			mkdir($user_dir, 0777, true);

		clearstatcache();
	}
	//add_action('user_register', 'create_user_dir');*/

	if (is_admin()) {
		/*wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-ui-custom', get_template_directory_uri().'/css/jquery-ui-custom.css');
		wp_enqueue_script('autoresize-js', get_template_directory_uri().'/js/autoresize.jquery.js');
		wp_enqueue_script('custom-js', get_template_directory_uri().'/js/custom-js.js');*/

		wp_enqueue_script('plugin_js', home_url().'/wp-content/plugins/balzan-Results/js/plugin_js.js');

		// validation
		wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery');
		wp_enqueue_script('validation');
	}

	/*add_action('admin_head', 'add_custom_scripts');
	function add_custom_scripts() {
		global $custom_meta_fields, $post;

		$output = '<script type="text/javascript">
					jQuery(function() {';

		foreach ($custom_meta_fields as $field) {
			if ($field['type'] == 'date')
				$output .= 'jQuery(".datepicker").datepicker();';
		}

		$output .= '});
				</script>';

		echo $output;
	}*/

	function todo_enqeue_scripts2() 
	{
		/*wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-ui-custom', get_template_directory_uri().'/css/jquery-ui-custom.css');
		wp_enqueue_script('autoresize-js', get_template_directory_uri().'/js/autoresize.jquery.js');
		wp_enqueue_script('custom-js', get_template_directory_uri().'/js/custom-js.js');*/

		wp_enqueue_script('plugin_js', home_url().'/wp-content/plugins/balzan-Results.php_/js/plugin_js.js');
		
		// validation
		wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery');
		wp_enqueue_script('validation');

	}

	add_action('wp_enqueue_scripts', 'todo_enqeue_scripts2');
?>