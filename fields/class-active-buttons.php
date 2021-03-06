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

		$this->set_default_attributes();
		$this->set_attributes( $args );
		$this->set_value( $args );
		$this->set_name_attribute();

		$this->set_default_properties();
		$this->set_default_button_properties( $args );
		$this->set_properties( $args );

		$this->output_fieldset_begin();
		$this->output_description_legend();
		$this->output_field();
		$this->output_alert();
		$this->output_fieldset_end();

	} // __construct()

	/**
	 * Returns the active buttons in order.
	 *
	 * @since 		1.0.0
	 * @return 		array 		$return 		Array of button IDs.
	 */
	protected function get_buttons() {

		if ( ! isset( $this->settings['active-buttons'] ) ) {

			$active = array();

		} else {

			$active = explode( ',', $this->settings['active-buttons'] );

		}

		/**
		 * The tout_social_buttons_admin_active_buttons filter.
		 *
		 * @param 		array 		$active 		Array of active buttons from settings.
		 */
		return apply_filters( 'tout_social_buttons_admin_active_buttons', $active );

	} // get_buttons()

	/**
	 * Includes the button field HTML file.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		$buttons 	= $this->get_buttons();
		$set 		= new Buttons\Button_Set( 'active' );

		$set->set_buttons( $buttons );
		$set->output_button_set();

		$args['attributes']['id'] 		= 'active-buttons';
		$args['attributes']['value'] 	= isset( $this->settings['active-buttons'] ) ? $this->settings['active-buttons'] : '';

		new Hidden( 'settings', $args );

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/button-status.php' );

	} // output_field()

	/**
	 * Sets the default properties for the buttons field.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 */
	protected function set_default_button_properties( $args ) {

		//

	} // set_default_button_properties()

} // class
