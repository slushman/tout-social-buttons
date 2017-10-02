<?php

namespace ToutSocialButtons\Fields;
use \ToutSocialButtons\Includes as Inc;
use \ToutSocialButtons\Buttons as Buttons;

/**
 * Defines all the code for the active buttons.
 *
 * @link 		https://www.slushman.com
 * @since 		1.0.0
 * @package 	ToutSocialButtons\Fields
 */
class Active_Buttons extends Field {

	/**
	 * The set of buttons.
	 *
	 * @var 	array 		Array of social buttons.
	 */
	var $buttons = array();

	/**
	 * The button order.
	 *
	 * @var 	string 		The button order.
	 */
	var $button_order;

	/**
	 * Class constructor.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$context 		The field context. Options:
	 *                               				settings: plugin settings
	 *                               				metabox: in a metabox
	 *                               				widget: in widget form
	 * @param 		array 		$args 			The field arguments.
	 */
	public function __construct( $context, $args ) {

		$this->set_context( $context );
		$this->set_setting_name( $args );

		$this->set_settings( $args );
		$this->set_buttons( $args );

		$this->set_default_attributes();
		$this->set_attributes( $args );
		$this->set_value( $args );
		$this->set_name_attribute();

		$this->set_default_properties();
		$this->set_default_button_properties( $args );
		$this->set_properties( $args );

		$this->set_button_order( $args );

		$this->output_fieldset_begin();
		$this->output_description_legend();
		$this->output_field();
		$this->output_alert();
		$this->output_fieldset_end();

	} // __construct()

	/**
	 * Includes the button field HTML file.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/active-buttons.php' );

	} // output_field()

	/**
	 * Sets the $buttons class variable.
	 *
	 * Adds all the buttons and their objects to an array.
	 * Filters out the buttons saved in the inactive-buttons setting.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 */
	protected function set_buttons( $args ) {

		/**
		 * The tout_social_buttons_admin_buttons filter.
		 *
		 * @param 		array 		$buttons 		Array of button objects.
		 */
		$buttons = apply_filters( 'tout_social_buttons_admin_buttons', array() );

		// If there are no inactive buttons or that settings isn't set, set the active buttons to a blank array.
		if ( ! isset( $this->settings['inactive-buttons'] ) || empty( $this->settings['inactive-buttons'] ) ) { $this->buttons = array(); return; }

		$inactive 	= explode( ',', $this->settings['inactive-buttons'] );
		$active 	= explode( ',', $this->settings['active-buttons'] );
		$ordered 	= array();

		// Remove buttons that appear in the inactive array.
		foreach ( $buttons as $button => $obj ) {

			if ( in_array( $button, $inactive ) ) {

				unset( $buttons[$button] );

			}

		}

		// Put the active buttons in order.
		foreach ( $active as $button ) {

			$ordered[$button] = $buttons[$button];

		}

		/**
		 * The tout_social_buttons_admin_active_buttons filter.
		 *
		 * @param 		array 		$ordered 		Array of button objects.
		 * @param 		array 		$active 		Active buttons from settings.
		 * @param 		array 		$inactive 		Inactive buttons from settings.
		 */
		$this->buttons = apply_filters( 'tout_social_buttons_admin_active_buttons', $ordered, $active, $inactive );

	} // set_buttons()

	/**
	 * Sets the value for the button-order field.
	 *
	 * @since 		1.0.0
	 */
	protected function set_button_order() {

		//wp_die( print_r( $this->properties ) );

		if ( array_key_exists( 'button-order', $this->settings ) && ! empty( $this->settings['button-order'] ) ) {

			$this->button_order = $this->settings['button-order'];

		} else {

			//$this->button_order = $this->properties['default-order'];

		}

		//wp_die( print_r( $this->button_order ) );

	} // set_button_order()

	/**
	 * Sets the default properties for the buttons field.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 */
	protected function set_default_button_properties( $args ) {

		//$this->default_properties['default-order'] = $args['properties']['default-order'];

	} // set_default_button_properties()

} // class
