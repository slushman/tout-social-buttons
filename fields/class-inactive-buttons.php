<?php

namespace ToutSocialButtons\Fields;
use \ToutSocialButtons\Includes as Inc;
use \ToutSocialButtons\Buttons as Buttons;

/**
 * Defines all the code for the inactive buttons.
 *
 * @link 		https://www.slushman.com
 * @since 		1.0.0
 * @package 	ToutSocialButtons\Fields
 */
class Inactive_Buttons extends Field {

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
	 * Returns the inactive buttons.
	 *
	 * Grabs the $tout_social_buttons global,
	 * removes the active buttons, then returns
	 * the remainder.
	 *
	 * @since 		1.0.0
	 * @return 		array 		$return 		Array of button IDs.
	 */
	protected function get_buttons() {

		global $tout_social_buttons;

		if ( ! isset( $this->settings['active-buttons'] ) ) {

			$inactive = $tout_social_buttons;

		} else {

			$active = explode( ',', $this->settings['active-buttons'] );

			foreach ( $tout_social_buttons as $button => $obj ) {

				if ( ! in_array( $button, $active ) ) {

					$inactive[$button] = $obj;

				}

			}

		}

		/**
		 * The tout_social_buttons_admin_inactive_buttons filter.
		 *
		 * @param 		array 		$inactive 		Array of inactive buttons.
		 */
		return apply_filters( 'tout_social_buttons_admin_inactive_buttons', $inactive );

	} // get_buttons()

	/**
	 * Includes the button field HTML file.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		$buttons 	= $this->get_buttons();
		$set 		= new Buttons\Button_Set( 'inactive' );

		$set->set_buttons( $buttons );
		$set->output_button_set();

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
