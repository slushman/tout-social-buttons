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

		// Buttons Section
		$wp_customize->add_section( 'tout_social_buttons_general',
			array(
				'active_callback' 	=> '',
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'tout-social-buttons' ),
				'panel' 			=> TOUT_SOCIAL_BUTTON_CUSTOMIZER,
				'priority'  		=> 9,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Buttons', 'tout-social-buttons' ),
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

		$types['button-content-icon'] 	= esc_html__( 'Icon', 'tout-social-buttons' );
		$types['button-content-text'] 	= esc_html__( 'Text', 'tout-social-buttons' );

		/**
		 * The tout_social_buttons_content filter.
		 *
		 * Allows for changing the content of the buttons.
		 *
		 * @param 		array 		$types 		The button content array.
		 */
		$button_contents 	= apply_filters( 'tout_social_buttons_content', $types );

		// Button Content Field
		$wp_customize->add_setting(
			TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[button_content]',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> 'button-content-icon',
				'transport' 		=> 'postMessage',
				'type' 				=> 'option'
			)
		);
		$wp_customize->add_control(
			TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[button_content]',
			array(
				'active_callback' 	=> '',
				'choices' 			=> $button_contents,
				'description' 		=> esc_html__( '', 'tout-social-buttons' ),
				'label'  			=> esc_html__( 'Button Content', 'tout-social-buttons' ),
				'priority' 			=> 10,
				'section'  			=> 'tout_social_buttons_general',
				'settings' 			=> TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[button_content]',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( TOUT_SOCIAL_BUTTON_CUSTOMIZER . '[button_content]' )->transport = 'postMessage';





		$styles['none'] 		= esc_html__( 'None', 'tout-social-buttons' );
		$styles['default'] 		= esc_html__( 'Default', 'tout-social-buttons' );
		$styles['border'] 		= esc_html__( 'Border', 'tout-social-buttons' );
		$styles['solid'] 		= esc_html__( 'Solid Color', 'tout-social-buttons' );
		$styles['shadow'] 		= esc_html__( 'Shadow', 'tout-social-buttons' );

		/**
		 * The tout_social_buttons_clicktotweet_styles filter.
		 *
		 * Allows for adding more Click to Tweet style presets.
		 *
		 * @param 		array 		$styles 		The current style presets.
		 */
		$clicktotweet_styles = apply_filters( 'tout_social_buttons_clicktotweet_styles', $styles );

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
