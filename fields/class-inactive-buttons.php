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
		$this->set_buttons( $args );

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
	 * Includes the button field HTML file.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/inactive-buttons.php' );

	} // output_field()

	/**
	 * Sets the $buttons class variable.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$args 		The field arguments.
	 */
	protected function set_buttons( $args ) {

		/**
		 * The tout_social_buttons_admin_buttons filter.
		 *
		 * @param 		array 		$buttons 		Array of buttons objects.
		 */
		$buttons = apply_filters( 'tout_social_buttons_admin_buttons', array() );

		if ( ! isset( $this->settings['active-buttons'] ) || empty( $this->settings['active-buttons'] ) ) { $this->buttons = $buttons; return; }

		$active = explode( ',', $this->settings['active-buttons'] );

		foreach ( $buttons as $button => $obj ) {

			if ( in_array( $button, $active ) ) {

				unset( $buttons[$button] );

			}

		}

		/**
		 * The tout_social_buttons_admin_inactive_buttons filter.
		 *
		 * @param 		array 		$buttons 		Array of buttons derived from the button-order setting.
		 */
		$this->buttons = apply_filters( 'tout_social_buttons_admin_inactive_buttons', $buttons );

	} // set_buttons()

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
