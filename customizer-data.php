<?php 

/**
 * Theme Customizer Data
 * 
 *
 * @author 		Alispx
 * @since 		1.0
 */
add_filter( 'mie_customizer_data', 'mie_standard_settings_data' );
function mie_standard_settings_data( $mie_options ) {

	/* =====================================================================================================*
	 *  General Panel + Settings + data 										 												*
	 * =====================================================================================================*/
	$mie_options[] = array(
		'slug'		=> 'mie_standard_Option',
		'label'		=> __( 'Panel - Standard Settings', '_mie' ),
		'priority'	=> 1,
		'type' 		=> 'panel'
	);
		// Section Header Settings
		$mie_options[] = array(
			'slug'		=> 'mie_header_settings',
			'label'		=> __( 'Header Settings', '_mie' ),
			'panel' 	=> 'mie_standard_Option',
			'priority'	=> 10,
			'type' 		=> 'section'
		);
			$mie_options[] = array( 
				'slug'		=> 'mie_header_background', 
				'default'	=> '#f5f5f5', 
				'priority'	=> 1, 
				'label'		=> __( 'Header Background', '_mie' ),
				'section'	=> 'mie_header_settings',
				'selector'	=> '.site-header',
				'property'	=> 'background',
				'type' 		=> 'color'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_site_title', 
				'default'	=> '#6fa81e', 
				'priority'	=> 2, 
				'label'		=> __( 'Site Title Color', '_mie' ),
				'section'	=> 'mie_header_settings',
				'selector'	=> '.site-title a',
				'property'	=> 'color',
				'type' 		=> 'color'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_site_description', 
				'default'	=> '#333', 
				'priority'	=> 3, 
				'label'		=> __( 'Site Description Color', '_mie' ),
				'section'	=> 'mie_header_settings',
				'selector'	=> '.site-description',
				'property'	=> 'color',
				'type' 		=> 'color'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_menu_background', 
				'default'	=> '#fff', 
				'priority'	=> 4, 
				'label'		=> __( 'Menu Background', '_mie' ),
				'section'	=> 'mie_header_settings',
				'selector'	=> '.main-navigation, .main-navigation ul',
				'property'	=> 'background',
				'type' 		=> 'color'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_menu_hover_background', 
				'default'	=> '#6fa81e', 
				'priority'	=> 5, 
				'label'		=> __( 'Menu Hover Background', '_mie' ),
				'section'	=> 'mie_header_settings',
				'selector'	=> '.main-navigation a:hover',
				'property'	=> 'background',
				'type' 		=> 'color'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_menu_color', 
				'default'	=> '#fff', 
				'priority'	=> 6, 
				'label'		=> __( 'Menu Hover Background', '_mie' ),
				'section'	=> 'mie_header_settings',
				'selector'	=> '.main-navigation a',
				'property'	=> 'background',
				'type' 		=> 'color'
			);

		// Section Footer Settings
		$mie_options[] = array(
			'slug'		=> 'mie_footer_settings',
			'label'		=> __( 'Footer Settings', '_mie' ),
			'panel' 	=> 'mie_standard_Option',
			'priority'	=> 20,
			'type' 		=> 'section'
		);

			$mie_options[] = array( 
				'slug'		=> 'mie_footer_background', 
				'default'	=> '#222', 
				'priority'	=> 1, 
				'label'		=> __( 'Footer Background', '_mie' ),
				'section'	=> 'mie_footer_settings',
				'selector'	=> '.site-footer',
				'type' 		=> 'color'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_footer_color', 
				'default'	=> '#fff', 
				'priority'	=> 2, 
				'label'		=> __( 'Footer Text Color', '_mie' ),
				'section'	=> 'mie_footer_settings',
				'selector'	=> '.site-info',
				'type' 		=> 'color'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_footer_link_color', 
				'default'	=> '#6fa81e', 
				'priority'	=> 2, 
				'label'		=> __( 'Footer Link Color', '_mie' ),
				'section'	=> 'mie_footer_settings',
				'selector'	=> '.site-info a',
				'type' 		=> 'color'
			);

	return $mie_options;
}

/**
 * Custom Settings
 *
 * @return void
 * @author alispx
 **/
add_filter( 'mie_customizer_data', 'mie_custom_settings_data' );
function mie_custom_settings_data( $mie_options ) {
	/* =====================================================================================================*
	 *  General Panel + Settings + data 										 												*
	 * =====================================================================================================*/
	$mie_options[] = array(
		'slug'		=> 'mie_custom_settings',
		'label'		=> __( 'Panel - Custom Settings', '_mie' ),
		'priority'	=> 2,
		'type' 		=> 'panel'
	);
		// Section Color Settings
		$mie_options[] = array(
			'slug'		=> 'mie_color_settings',
			'label'		=> __( 'Colors', '_mie' ),
			'panel' 	=> 'mie_custom_settings',
			'priority'	=> 10,
			'type' 		=> 'section'
		);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_color_hex', 
				'default'	=> '#250D07', 
				'priority'	=> 1, 
				'label'		=> __( 'Hexa Color', '_mie' ),
				'section'	=> 'mie_color_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'type' 		=> 'color'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_color_rgb', 
				'default'	=> '#250D07', 
				'priority'	=> 1, 
				'label'		=> __( 'RGB Color', '_mie' ),
				'section'	=> 'mie_color_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'property2'	=> 'opacity:0.5',
				'type' 		=> 'color_rgb'
			);

		// Section Text
		$mie_options[] = array(
			'slug'		=> 'mie_text_settings',
			'label'		=> __( 'Text Settings', '_mie' ),
			'panel' 	=> 'mie_custom_settings',
			'priority'	=> 20,
			'type' 		=> 'section'
		);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_text_field', 
				'default'	=> '', 
				'priority'	=> 1, 
				'label'		=> 'Textfield example',
				'section'	=> 'mie_text_settings',
				'selector'	=> '.site-title a',
				'type' 		=> 'text'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_email_field', 
				'default'	=> 'alispx@gmail.com', 
				'priority'	=> 2, 
				'label'		=> __( 'Email Field Example', '_mie' ),
				'section'	=> 'mie_text_settings',
				'type' 		=> 'email'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_url_field', 
				'default'	=> 'http://alispx.me', 
				'priority'	=> 3, 
				'label'		=> __( 'URL Field Example', '_mie' ),
				'section'	=> 'mie_text_settings',
				'type' 		=> 'url'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_password_field', 
				'default'	=> 'batmanxxx', 
				'priority'	=> 4, 
				'label'		=> __( 'Password Field Example', '_mie' ),
				'section'	=> 'mie_text_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'type' 		=> 'password'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_textarea_field', 
				'default'	=> __( 'Lorem ipsum dolor sit amet', '_mie' ), 
				'priority'	=> 5, 
				'label'		=> 'Tetxarea Field Example',
				'section'	=> 'mie_text_settings',
				'type' 		=> 'textarea'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_date_field', 
				'default'	=> '', 
				'priority'	=> 6, 
				'label'		=> __( 'Date Field Example', '_mie' ),
				'section'	=> 'mie_text_settings',
				'type' 		=> 'date'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_wysiwyg_field', 
				'default'	=> '', 
				'priority'	=> 7, 
				'label'		=> __( 'Example Editor Field', '_mie' ),
				'section'	=> 'mie_text_settings',
				'type' 		=> 'editor'
			);

		// Section Dropdown
		$mie_options[] = array(
			'slug'		=> 'mie_dropdown_settings',
			'label'		=> __( 'Dropdown Settings', '_mie' ),
			'panel' 	=> 'mie_custom_settings',
			'priority'	=> 30,
			'type' 		=> 'section'
		);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_dropdown_pages', 
				'default'	=> '', 
				'priority'	=> 1, 
				'label'		=> __( 'Dropdown Page List', '_mie' ),
				'section'	=> 'mie_dropdown_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'type' 		=> 'dropdown-pages'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_select_option', 
				'default'	=> '', 
				'priority'	=> 2, 
				'label'		=> __( 'General Select Option', '_mie' ),
				'section'	=> 'mie_dropdown_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'type' 		=> 'select',
				'choices'  => array(
					'option_1' => __( 'Option 1', '_mie' ),
					'option_2' => __( 'Option 2', '_mie' ),
					'option_3' => __( 'Option 3', '_mie' ),
					'option_4' => __( 'Option 4', '_mie' ),
				),
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_category_dropdown', 
				'default'	=> '', 
				'priority'	=> 3, 
				'label'		=> __( 'List Categories Field', '_mie' ),
				'section'	=> 'mie_dropdown_settings',
				'type' 		=> 'category_dropdown'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_menu_dropdown', 
				'default'	=> '', 
				'priority'	=> 4, 
				'label'		=> __( 'List Menus', '_mie' ),
				'section'	=> 'mie_dropdown_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'type' 		=> 'menu_dropdown'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_post_dropdown', 
				'default'	=> '', 
				'priority'	=> 5, 
				'label'		=> __( 'Post list', '_mie' ),
				'section'	=> 'mie_dropdown_settings',
				'type' 		=> 'post_dropdown'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_post_type_dropdown', 
				'default'	=> '', 
				'priority'	=> 6, 
				'label'		=> __( 'Post Type Dropdown', '_mie' ),
				'section'	=> 'mie_dropdown_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'type' 		=> 'post_type_dropdown'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_gfont', 
				'default'	=> '', 
				'priority'	=> 7, 
				'label'		=> __( 'Google Font Dropdown', '_mie' ),
				'section'	=> 'mie_dropdown_settings',
				'selector'	=> '.site-title',
				'property'	=> 'font-family',
				'type' 		=> 'google_font'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_chosen', 
				'default'	=> '', 
				'priority'	=> 8, 
				'label'		=> __( 'Chosen Select Option', '_mie' ),
				'section'	=> 'mie_dropdown_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'type' 		=> 'select_chosen',
				'choices'  => array(
					'option_1' => __( 'Option 1', '_mie' ),
					'option_2' => __( 'Option 2', '_mie' ),
					'option_3' => __( 'Option 3', '_mie' ),
					'option_4' => __( 'Option 4', '_mie' ),
				),
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_chosen2', 
				'default'	=> '', 
				'priority'	=> 9, 
				'label'		=> __( 'Chosen Select Option2', '_mie' ),
				'section'	=> 'mie_dropdown_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'type' 		=> 'select_chosen',
				'choices'  => array(
					'option_1' => __( 'Option 1', '_mie' ),
					'option_2' => __( 'Option 2', '_mie' ),
					'option_3' => __( 'Option 3', '_mie' ),
					'option_4' => __( 'Option 4', '_mie' ),
				),
			);
 		
			$mie_options[] = array( 
				'slug'		=> 'mie_example_dropdown_user', 
				'default'	=> '', 
				'priority'	=> 11, 
				'label'		=> __( 'Dropdown User List', '_mie' ),
				'section'	=> 'mie_dropdown_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'type' 		=> 'dropdown_user'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_radio_images', 
				'default'	=> '', 
				'priority'	=> 12, 
				'label'		=> 'Field Radio Images',
				'section'	=> 'mie_dropdown_settings',
				'type' 		=> 'image_select',
				'choices'  => array(
					'option_1' => 'http://placehold.it/200x50',
					'option_2' => 'http://placehold.it/200x50',
					'option_3' => 'http://placehold.it/200x50',
					'option_4' => 'http://placehold.it/200x50',
				),
			);

		// Section Image 
		$mie_options[] = array(
			'slug'		=> 'mie_image_settings',
			'label'		=> __( 'Image Settings', '_mie' ),
			'panel' 	=> 'mie_custom_settings',
			'priority'	=> 40,
			'type' 		=> 'section'
		);

			$mie_options[] = array( 
				'slug'		=> 'mie_contoh_image', 
				'default'	=> '', 
				'priority'	=> 3, 
				'label'		=> __( 'Contoh Images', '_mie' ),
				'section'	=> 'mie_image_settings',
				'type' 		=> 'images'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_contoh_file', 
				'default'	=> '', 
				'priority'	=> 3, 
				'label'		=> __( 'Example File Upload', '_mie' ),
				'section'	=> 'mie_image_settings',
				'type' 		=> 'file'
			);
		
		// Section Checkbox Radio
		$mie_options[] = array(
			'slug'		=> 'mie_checkbox_settings',
			'label'		=> __( 'Checkbox / Radio Settings', '_mie' ),
			'panel' 	=> 'mie_custom_settings',
			'priority'	=> 50,
			'type' 		=> 'section'
		);
		
			$mie_options[] = array( 
				'slug'		=> 'mie_example_checkbox_field', 
				'default'	=> '', 
				'priority'	=> 1, 
				'label'		=> __( 'Checkbox Field', '_mie' ),
				'section'	=> 'mie_checkbox_settings',
				'type' 		=> 'checkbox'
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_dependency', 
				'default'	=> '', 
				'priority'	=> 2, 
				'label'		=> __( 'Dependency Field', '_mie' ),
				'section'	=> 'mie_checkbox_settings',
				'selector'	=> '.site-header',
				'property'	=> 'background',
				'type' 		=> 'text',
				'dependson' => 'mie_example_checkbox_field',
				'condition' => 'checked',
				'value' 	=> true,
					
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_radio_field', 
				'default'	=> '', 
				'priority'	=> 2, 
				'label'		=> __( 'Radio Field', '_mie' ),
				'section'	=> 'mie_checkbox_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'type' 		=> 'radio',
				'choices'  => array(
					'option_1' => __( 'Option 1', '_mie' ),
					'option_2' => __( 'Option 2', '_mie' ),
					'option_3' => __( 'Option 3', '_mie' ),
					'option_4' => __( 'Option 4', '_mie' ),
				),
			);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_dependency3', 
				'default'	=> '', 
				'priority'	=> 9, 
				'label'		=> __( 'Dependency Field3', '_mie' ),
				'section'	=> 'mie_checkbox_settings',
				'selector'	=> '.site-headers',
				'property'	=> 'background',
				'type' 		=> 'text',
				'dependson' => 'mie_example_checkbox_field',
				'condition' => 'checked',
				'value' 	=> true,
					
			);

		// Section Test
		$mie_options[] = array(
			'slug'		=> 'mie_section_without_panel',
			'label'		=> __( 'Section Without Panel', '_mie' ),
			'priority'	=> 10,
			'type' 		=> 'section'
		);

			$mie_options[] = array( 
				'slug'		=> 'mie_example_section_without_panel', 
				'default'	=> '', 
				'priority'	=> 1, 
				'label'		=> __( 'Just Test', '_mie' ),
				'section'	=> 'mie_section_without_panel',
				'type' 		=> 'text'
			);

	return $mie_options;
}


	
