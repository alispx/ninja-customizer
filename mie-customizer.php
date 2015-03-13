<?php

/**
 * @version   1.0
 * @author    alispx
 * @copyright Copyright (c) 2014, alispx
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class Mie_Customizer {
  	
	protected static $default_data = array(
			'default' 		=> '',
			'slug' 			=> '',
			'panel'			=> '', 
			'label' 		=> '',
			'description'	=> '',
			'transport' 	=> 'postMessage',
			'priority' 		=> '',
			'type' 			=> 'color',
			'selector' 		=> '',
			'property' 		=> '',
			'property2' 	=> '',
			'output' 		=> true,
			'font_amount' 	=> 500,
		);

	function __construct() {

		add_action( 'customize_register', array( &$this, 'mie_theme_customizer_register' ), 10 );
		add_action( 'customize_preview_init', array( &$this, 'mie_customizer_live_preview' ) , 1 );
		add_action( 'wp_head', array( &$this, 'mie_customizer_print_css' ), 10 );
		add_action( 'wp_head', array( &$this, 'mie_customizer_font_output' ), 15 );
		add_action( 'customize_controls_enqueue_scripts', array( &$this, 'mie_customizer_enqueue_scripts' ), 20 );
	}

	/**
	 * Get all registered data
	 *
	 * @since 1.0
	 */
	function mie_get_customizer_data() {
		$mie_options= array();
		return apply_filters( 'mie_customizer_data', $mie_options );
	}

	/**
	 * Register Custom Sections, Settings, And Controls
	 *
	 * @since 1.0
	 */
	function mie_theme_customizer_register( $wp_customize ) {
		
		// Rename Colors Sections Into General Colors
		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'header_image' );
		$wp_customize->remove_section( 'background_image' );
		
		$mie_get_data 	= array();
		$mie_data 		= $this->mie_get_customizer_data( $mie_get_data );

		//create the componen from array data
		foreach ( $mie_data as $data ) {

			$data = wp_parse_args( $data, self::$default_data );
			
			// Define each customizer type 
			switch ( $data['type'] ) {
				
				case 'panel':
					// Add Panel
					$wp_customize->add_panel( $data['slug'], array(
						'priority'			=> $data['priority'],
						'capability'		=> 'edit_theme_options',
						'theme_supports'	=> '',
						'title'				=> $data['label'],
						'description'		=> $data['description'],
					) );

					break;

				case 'section':
					// Add Section
					$wp_customize->add_section( $data['slug'], 
						array(
							'title'    	=> $data['label'],
							'priority' 	=> $data['priority'],
							'panel' 	=> $data['panel']
					));
					break;

				case 'color':
				case 'color_rgb':
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'type' 				=> 'theme_mod', 
							'capability' 		=> 'edit_theme_options', 
							'transport'			=> $data['transport'], 
							'sanitize_callback'	=> 'sanitize_hex_color', 
							) 
						);
					$wp_customize->add_control( new WP_Customize_Color_Control( 
						$wp_customize, $data['slug'], 
						array( 
							'label' 		=> $data['label'], 
							'section' 		=> $data['section'], 
							'priority'		=> $data['priority'], 
							'settings' 		=> $data['slug'] 
							) 
						) );
					break;
				
				case 'text' :
					$wp_customize->add_setting( $data['slug'], 
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod', 
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> 'sanitize_text_field',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 		=> $data['label'], 
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'], 
							'type'			=> 'text'
							)
						));
					break;

				case 'email' :
					$wp_customize->add_setting( $data['slug'], 
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod', 
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> 'sanitize_email',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 		=> $data['label'], 
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'], 
							'type'			=> 'email'
							)
						));
					break;

				case 'url' :
					$wp_customize->add_setting( $data['slug'], 
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod', 
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> 'esc_url',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 		=> $data['label'], 
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'], 
							'type'			=> 'url'
							)
						));
					break;

				case 'password' :
					$wp_customize->add_setting( $data['slug'], 
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod', 
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> 'sanitize_text_field',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 		=> $data['label'], 
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'], 
							'type'			=> 'password'
							)
						));
					break;

				case 'textarea' :
					$wp_customize->add_setting( $data['slug'], 
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod', 
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> 'esc_textarea',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 		=> $data['label'], 
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'], 
							'type'			=> 'textarea'
							)
						));
					break;

				case 'date' :
					$wp_customize->add_setting( $data['slug'], 
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod', 
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> 'sanitize_text_field',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 		=> $data['label'], 
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'], 
							'type'			=> 'date'
							)
						));
					break;

				case 'select' :
					$wp_customize->add_setting( $data['slug'], 
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod', 
							'transport'   		=> $data['transport'],
							'capability' 		=> 'edit_theme_options',
							'sanitize_callback'	=> '',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'default' 	=> $data['default'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug'], 
							'choices'	=> $data['choices'], 
							'type'		=> 'select'
							)
						));
					break;

				case 'radio' :
					$wp_customize->add_setting( $data['slug'], 
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod', 
							'transport'   		=> $data['transport'],
							'capability' 		=> 'edit_theme_options',
							'sanitize_callback'	=> '',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'default' 	=> $data['default'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug'], 
							'choices'	=> $data['choices'], 
							'type'		=> 'radio'
							)
						));
					break;

				case 'dropdown-pages' :
					$wp_customize->add_setting( $data['slug'], 
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod', 
							'transport'   		=> $data['transport'],
							'capability' 		=> 'edit_theme_options',
							'sanitize_callback'	=> '',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'default' 	=> $data['default'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug'], 
							'type'		=> 'dropdown-pages'
							)
						));
					break;

				case 'checkbox' :
					$wp_customize->add_setting( $data['slug'], 
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod', 
							'transport'   		=> $data['transport'],
							'capability' 		=> 'edit_theme_options',
							'sanitize_callback'	=> '',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'default' 	=> $data['default'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug'], 
							'type'		=> 'checkbox'
							)
						));
					break;

				case 'images' :
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_url_raw', 
							));   
					$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'], 
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'image_select' :
					require_once( trailingslashit ( MIE_DIR ) . 'includes/image-select-custom-control.php' );
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr', 
							));   
					$wp_customize->add_control( new Image_Select_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'], 
							'settings' 	=> $data['slug'],
							'choices' 	=> $data['choices']
							 )));
					break;

				case 'file' :
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_url_raw', 
							));   
					$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'], 
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'category_dropdown' :
					require_once( trailingslashit ( MIE_DIR ) . 'includes/category-dropdown-custom-control.php' );
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> '', 
							));   
					$wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'], 
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'menu_dropdown' :
					require_once( trailingslashit ( MIE_DIR ) . 'includes/menu-dropdown-custom-control.php' );
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> '', 
							));   
					$wp_customize->add_control( new Menu_Dropdown_Custom_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'], 
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'post_dropdown' :
					require_once( trailingslashit ( MIE_DIR ) . 'includes/post-dropdown-custom-control.php' );
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> '', 
							));   
					$wp_customize->add_control( new Post_Dropdown_Custom_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'], 
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'post_type_dropdown' :
					require_once( trailingslashit ( MIE_DIR ) . 'includes/post-type-dropdown-custom-control.php' );
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> '', 
							));   
					$wp_customize->add_control( new Post_Type_Dropdown_Custom_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'], 
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'dropdown_user' :
					require_once( trailingslashit ( MIE_DIR ) . 'includes/user-dropdown-custom-control.php' );
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr', 
							));   
					$wp_customize->add_control( new User_Dropdown_Custom_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'], 
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'editor' :
					require_once( trailingslashit ( MIE_DIR ) . 'includes/text-editor-custom-control.php' );
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_textarea', 
							));   
					$wp_customize->add_control( new Text_Editor_Custom_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'], 
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'google_font' :
					require_once( trailingslashit ( MIE_DIR ) . 'includes/googlefont-control.php' );
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr', 
							));   
					$wp_customize->add_control( new Google_Font_Dropdown_Custom_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'], 
							'settings' 	=> $data['slug'],
							'amount' 	=> $data['font_amount']
							 )));
					break;

				case 'select_chosen' :
					require_once( trailingslashit ( MIE_DIR ) . 'includes/chosen-custom-control.php' );
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr', 
							));   
					$wp_customize->add_control( new Chosen_Custom_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 	=> $data['label'], 
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'], 
							'settings' 	=> $data['slug'],
							'choices' 	=> $data['choices'],
							 )));
					break;

				case 'image_select' :
					require_once( trailingslashit ( MIE_DIR ) . 'includes/image-select-custom-control.php' );
					$wp_customize->add_setting( $data['slug'], 
						array( 
							'default' 			=> $data['default'], 
							'capability' 		=> 'edit_theme_options', 
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr', 
							));   
					$wp_customize->add_control( new Image_Select_Control( $wp_customize, 
						$data['slug'], 
						array( 
							'label' 		=> $data['label'], 
							'section' 		=> $data['section'],
							'priority'		=> $data['priority'], 
							'settings' 		=> $data['slug'],
							'choices' 		=> $data['choices']
							 )));
					break;
					
				default:
					break;
			}
		}
	}

	/**
	 * Used by hook: 'customize_preview_init'
	 *
	 * @see add_action( 'customize_preview_init', $func )
	 */
	function mie_customizer_live_preview() {
		
		$mie_options	= array();
		$mie_options	= $this->mie_get_customizer_data( $mie_options );

		wp_enqueue_script( 'customizer-preview', MIE_URI . 'assets/js/customizer-preview.js', array( 'jquery', 'customize-preview' ), '', true );
		wp_localize_script(	'customizer-preview', 'mieStyle', $mie_options );

	}

	/**
	* Enqueue Scripts
	*
	* @return void
	* @author alispx
	**/
	function mie_customizer_enqueue_scripts() {
		$mie_options	= array();
		$mie_options	= $this->mie_get_customizer_data( $mie_options );

		wp_enqueue_script( 'mie-plugins', MIE_URI . 'assets/js/plugins.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'mie-methods', MIE_URI . 'assets/js/mie-methods.js', array( 'jquery' ), '', true );
		wp_localize_script( 'mie-methods', 'mieScript', $mie_options );
		wp_enqueue_style( 'mie-style', MIE_URI . 'assets/css/mie-styles.css' );
		wp_enqueue_style( 'mie-plugins', MIE_URI . 'assets/css/plugins.min.css' );
	}

	/**
	 * Sanitize and Print To Head
	 *
	 * @since 1.0
	 */
	function mie_customizer_print_css() { 
		
		$mie_options= array();
		$mie_options= $this->mie_get_customizer_data( $mie_options );
		$style 		= '';

		foreach ( $mie_options as $data ) {

			$data = wp_parse_args( $data, self::$default_data );

			$selectors 	= $data['selector'];
			$newvalue	= get_theme_mod( $data['slug'] );

			if ( isset( $newvalue ) && ! empty( $newvalue ) ) {
				switch ( $data['type'] ) {

					case 'color':
						if ( true == $data['output'] ) {
							$style .=  
								$selectors. '{'
								.$data['property'].':'.$newvalue.' '.$data['property2'].'}';
						}
						break;

					case 'color_rgb':
						if ( true == $data['output'] ) {
							$get_rgb_color 	= $this->mie_hex2RGB( $newvalue );
							$red 			= $get_rgb_color['r']; 
							$green 			= $get_rgb_color['g']; 
							$blue 			= $get_rgb_color['b'];
							$property2 		= $data['property2']; 
							$rgb_color 		= 'rgb('.$red.','.$green.','.$blue.', ' . $property2 . ')';

							$style .=  
								$selectors. '{'
								.$data['property'].':'.$rgb_color.'}';
						}
						break;

					case 'images':
						if ( true == $data['output'] ) {
							$style .=  $selectors. '{' 
							.$data['property'].':url("'.$newvalue.'") '.' '.$data['property2'].'}';
						}
						break;

					case 'google_font':
							$style .=  $selectors.'{' 
							.$data['property'].':'.$newvalue.' '.$data['property2'].'}';
						break;

					default:
						break;
				}
			}
		}
		$style = "\n".'<style type="text/css">'.trim( $style ).'</style>'."\n";
		printf( '%s', $style );
	}

	/**
	 * Enqueue Google Font Base on Customizer Data
	 *
	 * @return void
	 * @author alispx
	 **/
	function mie_customizer_font_output() {

		$mie_options	= array();
		$mie_data 		= $this->mie_get_customizer_data( $mie_options );
		$loaded_font 	= '';

		foreach ( $mie_data as $data ) {

			$data = wp_parse_args( $data, self::$default_data );

			$selectors 	= $data['selector'];
			$newvalue	= get_theme_mod( $data['slug'] );

			if ( $data['type'] == 'select_font' ) {
				if ( isset( $newvalue ) && ! empty( $newvalue ) ) {
					$get_selected_font = str_replace(' ', '+', $newvalue );
					$loaded_font .= '@import url(//fonts.googleapis.com/css?family='.$get_selected_font.');';
				}
			}
		} 
		$loaded_font = "\n".'<style type="text/css">'.trim( $loaded_font ).'</style>'."\n";
		printf( '%s', $loaded_font );
	}

	/**
	 * Convert Hexa to RGB
	 *
	 * @return void
	 * @author alispx
	 **/
	function mie_hex2RGB( $hex ) {
		preg_match( "/^#{0,1}([0-9a-f]{1,6})$/i", $hex, $match );
		
		if ( ! isset( $match[1] ) ) {
			return false;
		}

		if ( strlen( $match[1] ) == 6 ) {
			list( $r, $g, $b ) = array( $hex[0] . $hex[1], $hex[2] . $hex[3], $hex[4] . $hex[5] );
		} elseif ( strlen( $match[1] ) == 3 ) {
			list( $r, $g, $b ) = array( $hex[0] . $hex[0], $hex[1] . $hex[1], $hex[2] . $hex[2] );
		} else if ( strlen( $match[1] ) == 2 ) {
			list( $r, $g, $b ) = array( $hex[0] . $hex[1], $hex[0] . $hex[1], $hex[0] . $hex[1] );
		} else if ( strlen( $match[1] ) == 1 ) {
			list( $r, $g, $b ) = array( $hex . $hex, $hex . $hex, $hex . $hex );
		} else {
			return false;
		}

		$color 		= array();
		$color['r'] = hexdec( $r );
		$color['g'] = hexdec( $g );
		$color['b'] = hexdec( $b );

		return $color;
	}

}

new Mie_Customizer();