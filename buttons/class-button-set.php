<?php

/**
 * The buttons added by this plugin.
 *
 * To use:
 * In constructor, call a make_button_set() method where a new instance of Button_Set is created with a context.
 * Where you want the button set output, you'll need to:
 * 		create a list of buttons to include
 * 		call set_buttons() from the Button_Set class
 * 		call output_button_set() from the Button_Set class
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons/Buttons
 * @author 			slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Buttons;

class Button_Set {

	/**
	 * Array of buttons for this set.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 		$button
	 */
	private $buttons;

	/**
	 * Array of customzier settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array
	 */
	private $customizer;

	/**
	 * Array of plugin settings to validate before saving to the database.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array
	 */
	private $settings;

	/**
	 * Constructor
	 *
	 * @since 		1.0.0
	 * @param 		string 		$context 		Where this class is used.
	 * @param 		array 		$buttons 		Optional. Array of buttons IDs for this set.
	 */
	public function __construct( $context, $buttons = array() ) {

		$this->set_settings();
		$this->set_customizer();

		$this->context = $context;

		// $this->set_buttons( $buttons );
		// $this->output_button_set();

	} // __construct()

	/**
	 * Returns the classes for each button.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$button 		The button ID.
	 * @param 		array 		$classes		The classes passed in.
	 * @return 		string 						The classes for each button.
	 */
	public function get_button_classes( $button, $classes = array() ) {

		$return 	= '';
		$classes[] 	= 'tout-social-button';
		$classes[] 	= 'tout-social-button-' . $button;

		/**
		 * The tout_social_buttons_button_classes filter.
		 *
		 * Allows for changing classes on each button.
		 *
		 * @param 		array 		$classes 		The current classes.
		 * @param 		string 		$context 		Where this is being used.
		 * @param 		string 		$button 		The button ID.
		 */
		$classes 	= apply_filters( 'tout_social_buttons_button_classes', $classes, $this->context, $button );
		$return 	= implode( ' ', $classes );

		return $return;

	} // get_button_classes()

	/**
	 * Returns the classes for the button icon wrap.
	 *
	 * @since 		1.0.0
	 * @param 		object 		$instance 		The button instance object.
	 * @param 		string 		$context 		Where this is being used.
	 * @param 		array 		$classes		The classes passed in.
	 * @return 		string 						The classes for the button icon wrap.
	 */
	public function get_button_icon_wrap_classes( $instance, $classes = array() ) {

		$return 	= '';
		$classes[] 	= 'tout-social-button-icon-wrap';

		if ( 'text' === $instance->get_type() ) {

			$classes[] = 'hidden';

		}

		/**
		 * The tout_social_buttons_button_icon_wrap_classes filter.
		 *
		 * Allows for changing classes on the button icon wrap.
		 *
		 * @param 		array 		$classes 		The current classes.
		 * @param 		string 		$context 		Where this is being used.
		 */
		$classes 	= apply_filters( 'tout_social_buttons_button_icon_wrap_classes', $classes, $this->context );
		$return 	= implode( ' ', $classes );

		return $return;

	} // get_button_icon_wrap_classes()

	/**
	 * Returns the classes for the button link.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$button 		The button.
	 * @param 		array 		$classes		The classes passed in.
	 * @return 		string 						The classes for the button link.
	 */
	public function get_button_link_classes( $button, $classes = array() ) {

		$return 	= '';
		$classes[] 	= 'tout-social-button-link';
		$classes[] 	= 'tout-social-button-link-' . $button;

		if ( 'popup' === $this->settings['button-behavior'] ) {

			$classes[] = 'tout-social-button-popup-link';

		}

		/**
		 * The tout_social_buttons_button_link_classes filter.
		 *
		 * Allows for changing classes on the button links.
		 *
		 * @param 		array 		$classes 		The current classes.
		 * @param 		string 		$context 		Where this is being used.
		 * @param 		string 		$button 		The button ID.
		 */
		$classes 	= apply_filters( 'tout_social_buttons_button_link_classes', $classes, $this->context, $button );
		$return 	= implode( ' ', $classes );

		return $return;

	} // get_button_link_classes()

	/**
	 * Returns the classes for the button set.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$classes		The classes passed in.
	 * @return 		string 						The classes for the button set.
	 */
	public function get_button_set_classes( $classes = array() ) {

		$return 	= '';
		$classes[] 	= 'tout-social-buttons';
		$classes[] 	= 'content-color-brand';
		$classes[] 	= 'bg-color-none';

		/**
		 * The tout_social_buttons_button_set_classes filter.
		 *
		 * Allows for changing classes on the button set.
		 *
		 * @param 		array 		$classes 		The current classes.
		 * @param 		string 		$context 		Where this is being used.
		 */
		$classes 	= apply_filters( 'tout_social_buttons_button_set_classes', $classes, $this->context );
		$return 	= implode( ' ', $classes );

		return $return;

	} // get_button_set_classes()

	/**
	 * Returns the ID attribute for the button set.
	 *
	 * @since 		1.0.0
	 * @return 		string 						The ID attribute for the button set.
	 */
	public function get_button_set_id() {

		/**
		 * The tout_social_buttons_button_set_id filter.
		 *
		 * Allows for changing id attribute on the button set.
		 *
		 * @param 		string 		$id 			The current id attribute.
		 * @param 		string 		$context 		Where this is being used.
		 */
		return apply_filters( 'tout_social_buttons_button_set_id', 'tout-social-buttons', $this->context );

	} // get_button_set_id()

	/**
	 * Returns the classes for the button set wrap element.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$classes 		The classes passed in.
	 * @return 		string 						The classes for the button set wrap.
	 */
	public function get_button_set_wrap_classes( $classes = array() ) {

		$return 	= '';
		$classes[] 	= 'tout-social-buttons-wrap';

		/**
		 * The tout_social_buttons_button_set_wrap_classes filter.
		 *
		 * Allows for changing classes on the button set.
		 *
		 * @param 		array 		$classes 		The current classes.
		 * @param 		string 		$context 		Where this is being used.
		 */
		$classes 	= apply_filters( 'tout_social_buttons_button_set_wrap_classes', $classes, $this->context );
		$return 	= implode( ' ', $classes );

		return $return;

	} // get_button_set_wrap_classes()

	/**
	 * Returns the classes for the button text span.
	 *
	 * @since 		1.0.0
	 * @param 		object 		$instance 		The button instance object.
	 * @param 		array 		$classes 		The classes passed in.
	 * @return 		string 						The classes for the button text span.
	 */
	public function get_button_text_classes( $instance, $classes = array() ) {

		$return 	= '';
		$classes[] 	= 'tout-social-button-text';

		if ( 'button-content-icon' === $instance->get_type() && ! is_admin() ) :

			$classes[] = 'screen-reader-text';

		endif;

		/**
		 * The tout_social_buttons_button_text_classes filter.
		 *
		 * Allows for changing classes on the button text span.
		 *
		 * @param 		array 		$classes 		The current classes.
		 * @param 		string 		$context 		Where this is being used.
		 */
		$classes 	= apply_filters( 'tout_social_buttons_button_text_classes', $classes, $this->context );
		$return 	= implode( ' ', $classes );

		return $return;

	} // get_button_text_classes()

	/**
	 * Returns the $context class variable.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The context.
	 */
	public function get_context() {

		return $this->context;

	} // get_context()

	/**
	 * Includes the button-set partial file.
	 *
	 * @since 		1.0.0
	 */
	public function output_button_set() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'buttons/partials/button-set.php' );

	} // output_button_set()

	/**
	 * Sets the $buttons class variable.
	 *
	 * @exits 		If $buttons is empty.
	 * @exits 		If $buttons is already an array of objects.
	 * @since 		1.0.0
	 * @param 		array 		$buttons 		Array of button IDs.
	 */
	public function set_buttons( $buttons ) {

		if ( empty( $buttons ) ) { return array(); }

		if ( is_array( $buttons ) ) {

			$first = key( $buttons );

			if ( is_object( $buttons[$first] ) ) {

				$this->buttons = $buttons;
				return;

			}

		}

		global $tout_social_buttons;

		$return = array();

		// Remove buttons that appear in the inactive array.
		foreach ( $tout_social_buttons as $button => $obj ) {

			if ( in_array( $button, $buttons ) ) {

				$return[$button] = $obj;

			}

		}

		$this->buttons = $return;

	} // set_button()

	/**
	 * Sets the class variable $customizer with the plugin's customizer settings.
	 *
	 * @since 		1.0.0
	 */
	public function set_customizer() {

		$this->customizer = get_option( 'tout_social_buttons' );

	} // set_customizer()

	/**
	 * Sets the class variable $settings with the plugin settings.
	 *
	 * @since 		1.0.0
	 */
	public function set_settings() {

		$this->settings = get_option( TOUT_SOCIAL_BUTTONS_SETTINGS );

	} // set_settings()

} // class
