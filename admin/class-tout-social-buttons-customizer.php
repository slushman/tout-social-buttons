<?php

/**
 * The customizer-specific functionality of the plugin.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/customizer
 */

/**
 * The customizer-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the customizer-specific stylesheet and JavaScript.
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/customizer
 * @author 			slushman <chris@slushman.com>
 */
class Tout_Social_Buttons_Customizer {

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$plugin_name 		The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$version 		The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$plugin_name 		The name of this plugin.
	 * @param 		string 		$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	} // __construct()

	/**
	 * Register the stylesheets for the customizer.
	 *
	 * @hooked 		enqueue_customizer_styles
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tout-social-buttons-customizer.css', array(), $this->version, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the customizer controls.
	 *
	 * @hooked 		customize_controls_enqueue_scripts
	 * @since 		1.0.0
	 */
	public function enqueue_controls_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tout-social-buttons-customizer-controls.min.js', array(), $this->version, true );

	} // enqueue_controls_scripts()

	/**
	 * Register the JavaScript for the customizer.
	 *
	 * @hooked 		enqueue_customizer_scripts
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tout-social-buttons-customizer.min.js', array(), $this->version, true );

	} // enqueue_scripts()

	/**
	 * Removes button set classes, based on the selected customizer settings.
	 *
	 * @hooked 		tout_social_buttons_button_set_classes
	 * @since 		1.0.0
	 * @param 		array 		$classes 		The button set classes.
	 * @return 		array 						The modified button set classes.
	 */
	public function filter_button_set_classes( $classes ) {

		$mods = get_theme_mods();

		// Filter classes here.

		return $classes;

	} // filter_button_set_classes()

	/**
	 * Registers custom panels for the Customizer
	 *
	 * @hooked 		customize_register
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_panels( $wp_customize ) {

		// Tout.Social Buttons Panel
		// $wp_customize->add_panel( 'tout_social_buttons',
		// 	array(
		// 		'capability'  		=> 'theme_options',
		// 		'description'  		=> esc_html__( 'Customize the appearance of the Tout.Social Buttons.', 'tout-social-buttons' ),
		// 		'priority'  		=> 10,
		// 		'theme_supports'  	=> '',
		// 		'title'  			=> esc_html__( 'Tout.Social Buttons', 'tout-social-buttons' ),
		// 	)
		// );

	} // register_panels()

	/**
	 * Registers custom sections for the Customizer
	 *
	 * Existing sections:
	 *
	 * Slug 				Priority 		Title
	 *
	 * title_tagline 		20 				Site Identity
	 * colors 				40				Colors
	 * header_image 		60				Header Image
	 * background_image 	80				Background Image
	 * nav_menus			100 			Navigation
	 * widgets 				110 			Widgets
	 * static_front_page 	120 			Static Front Page
	 * default 				160 			all others
	 *
	 * @hooked 		customize_register
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_sections( $wp_customize ) {

		// Tout.Social Buttons Pro Text Section
		$wp_customize->add_section( 'tout_social_buttons',
			array(
				'active_callback' 	=> '',
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'tout-social-buttons' ),
				'panel' 			=> '',
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Button Type', 'tout-social-buttons' ),
			)
		);

	} // register_sections()

	/**
	 * Registers controls/fields for the Customizer
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * Note: To use active_callbacks, don't add these to the selecting control, it apepars these conflict:
	 * 		'transport' => 'postMessage'
	 * 		$wp_customize->get_setting( 'field_name' )->transport = 'postMessage';
	 *
	 * @hooked 		customize_register
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_fields( $wp_customize ) {

		// Icon BG Shape Field
		$wp_customize->add_setting(
			'tout_social_buttons_button_type',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> 'icon',
				'transport' 		=> 'postMessage',
				'type' 				=> 'option'
			)
		);
		$wp_customize->add_control(
			'tout_social_buttons_button_type',
			array(
				'active_callback' 	=> '',
				'choices' 			=> array(
					'icon' 		=> esc_html__( 'Icon', 'tout-social-buttons' ),
					'text' 		=> esc_html__( 'Text', 'tout-social-buttons' ),
				),
				'description' 		=> esc_html__( '', 'tout-social-buttons' ),
				'label'  			=> esc_html__( 'Button Type', 'tout-social-buttons' ),
				'priority' 			=> 10,
				'section'  			=> 'tout_social_buttons',
				'settings' 			=> 'tout_social_buttons_button_type',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'tout_social_buttons_button_type' )->transport = 'postMessage';

	} // register_fields()

	/**
	 * Resets Customizer to blank slate.
	 *
	 * Checks if we're on the special Customizer page, returns if not.
	 * Removes all the Customizer actions, then registers the ones
	 * needed to move forward.
	 * Resets and returns the $components array.
	 *
	 * To add panels, sections, and/or controls to this custom Customizer page,
	 * add them at priority 9.
	 *
	 * @link 		https://make.xwp.co/2016/09/11/resetting-the-customizer-to-a-blank-slate/
	 * @since 		1.0.0
	 * @return 		array 		$components 		The blank components array.
	 */
	public function reset_customizer() {

		if ( FALSE === array_key_exists( 'tout-social-buttons-customizer', $_GET ) ) { return; }

		global $wp_customize;



        remove_all_actions( 'customize_register' );

		/*
		 * Register the panel, section, and control types that would normally have  been
		 * registered at customizer_register by WP_Customize_Manager::register_controls().
		 */
		$wp_customize->register_panel_type( 'WP_Customize_Panel' );
		$wp_customize->register_section_type( 'WP_Customize_Section' );
		$wp_customize->register_section_type( 'WP_Customize_Sidebar_Section' );
		$wp_customize->register_control_type( 'WP_Customize_Color_Control' );
		$wp_customize->register_control_type( 'WP_Customize_Media_Control' );
		$wp_customize->register_control_type( 'WP_Customize_Upload_Control' );
		$wp_customize->register_control_type( 'WP_Customize_Image_Control' );
		$wp_customize->register_control_type( 'WP_Customize_Background_Image_Control' );
		$wp_customize->register_control_type( 'WP_Customize_Cropped_Image_Control' );
		$wp_customize->register_control_type( 'WP_Customize_Site_Icon_Control' );
		$wp_customize->register_control_type( 'WP_Customize_Theme_Control' );

	    // Short-circuit widgets, nav-menus, etc from loading.
	    $components = array();

	    return $components;

	} // reset_customizer()

} // class
