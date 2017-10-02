<?php

/**
 * The customizer-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the customizer-specific stylesheet and JavaScript.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Admin
 * @author 			slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Admin;

class Customizer {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		//

	} // __construct()

	/**
	 * Registers all the WordPress hooks and filters related to this class.
	 *
	 * @hooked 		init
	 * @since 		1.0.0
	 */
	public function hooks() {

		add_action( 'enqueue_customizer_styles', 				array( $this, 'enqueue_styles' ) );
		add_action( 'customize_preview_init', 					array( $this, 'enqueue_scripts' ) );
		add_action( 'customize_controls_enqueue_scripts', 		array( $this, 'enqueue_controls_scripts' ) );
		add_action( 'tout_social_buttons_button_set_classes', 	array( $this, 'filter_button_set_classes' ), 10, 1 );
		add_action( 'customize_register', 						array( $this, 'register_panels' ) );
		add_action( 'customize_register', 						array( $this, 'register_sections' ) );
		add_action( 'customize_register', 						array( $this, 'register_fields' ) );

	} // hooks()

	/**
	 * Register the stylesheets for the customizer.
	 *
	 * @hooked 		enqueue_customizer_styles
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( TOUT_SOCIAL_BUTTONS_SLUG, plugin_dir_url( __FILE__ ) . 'css/tout-social-buttons-customizer.css', array(), TOUT_SOCIAL_BUTTONS_VERSION, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the customizer controls.
	 *
	 * @hooked 		customize_controls_enqueue_scripts
	 * @since 		1.0.0
	 */
	public function enqueue_controls_scripts() {

		wp_enqueue_script( TOUT_SOCIAL_BUTTONS_SLUG, plugin_dir_url( __FILE__ ) . 'js/tout-social-buttons-customizer-controls.min.js', array(), TOUT_SOCIAL_BUTTONS_VERSION, true );

	} // enqueue_controls_scripts()

	/**
	 * Register the JavaScript for the customizer.
	 *
	 * @hooked 		enqueue_customizer_scripts
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( TOUT_SOCIAL_BUTTONS_SLUG, plugin_dir_url( __FILE__ ) . 'js/tout-social-buttons-customizer.min.js', array(), TOUT_SOCIAL_BUTTONS_VERSION, true );

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
	 * Registers custom panels for the Customizer.
	 *
	 * @hooked 		customize_register
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_panels( $wp_customize ) {

		// Tout.Social Buttons Panel
		$wp_customize->add_panel( TOUT_SOCIAL_BUTTON_CUSTOMIZER,
			array(
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'tout-social-buttons' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Tout.Social Buttons', 'tout-social-buttons' ),
			)
		);

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

		// Button Type Section
		$wp_customize->add_section( 'tout_social_buttons_general',
			array(
				'active_callback' 	=> '',
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'tout-social-buttons' ),
				'panel' 			=> TOUT_SOCIAL_BUTTON_CUSTOMIZER,
				'priority'  		=> 9,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'General', 'tout-social-buttons' ),
			)
		);

		// Click to Tweet Section
		$wp_customize->add_section( 'tout_social_buttons_clicktotweet',
			array(
				'active_callback' 	=> '',
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'tout-social-buttons' ),
				'panel' 			=> TOUT_SOCIAL_BUTTON_CUSTOMIZER,
				'priority'  		=> 9,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Click to Tweet', 'tout-social-buttons' ),
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

		$types['icon'] 	= esc_html__( 'Icon', 'tout-social-buttons' );
		$types['text'] 	= esc_html__( 'Text', 'tout-social-buttons' );
		$button_types 	= apply_filters( 'tout_social_buttons_types_of_buttons', $types );

		// Button Type Field
		$wp_customize->add_setting(
			TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[button_type]',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> 'icon',
				'transport' 		=> 'postMessage',
				'type' 				=> 'option'
			)
		);
		$wp_customize->add_control(
			TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[button_type]',
			array(
				'active_callback' 	=> '',
				'choices' 			=> $button_types,
				'description' 		=> esc_html__( '', 'tout-social-buttons' ),
				'label'  			=> esc_html__( 'Button Type', 'tout-social-buttons' ),
				'priority' 			=> 10,
				'section'  			=> 'tout_social_buttons_general',
				'settings' 			=> TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[button_type]',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[button_type]' )->transport = 'postMessage';





		$styles['none'] 		= esc_html__( 'None', 'tout-social-buttons' );
		$styles['default'] 		= esc_html__( 'Default', 'tout-social-buttons' );
		$styles['border'] 		= esc_html__( 'Border', 'tout-social-buttons' );
		$styles['solid'] 		= esc_html__( 'Solid Color', 'tout-social-buttons' );
		$styles['shadow'] 		= esc_html__( 'Shadow', 'tout-social-buttons' );
		$clicktotweet_styles 	= apply_filters( 'tout_social_buttons_clicktotweet_styles', $styles );

		// Click to Tweet Style Field
		$wp_customize->add_setting(
			TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[clicktotweet_style]',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> 'default',
				'transport' 		=> 'postMessage',
				'type' 				=> 'option'
			)
		);
		$wp_customize->add_control(
			TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[clicktotweet_style]',
			array(
				'active_callback' 	=> '',
				'choices' 			=> $clicktotweet_styles,
				'description' 		=> esc_html__( '', 'tout-social-buttons' ),
				'label'  			=> esc_html__( 'Click to Tweet Style', 'tout-social-buttons' ),
				'priority' 			=> 10,
				'section'  			=> 'tout_social_buttons_clicktotweet',
				'settings' 			=> TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[clicktotweet_style]',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[clicktotweet_style]' )->transport = 'postMessage';

	} // register_fields()

} // class
