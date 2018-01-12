<?php

/**
 * Defines all the code for an editor form field.
 *
 * @link 		https://www.slushman.com
 * @since 		1.0.0
 * @package 	ToutSocialButtons\Fields
 */

namespace ToutSocialButtons\Fields;

class Editor extends \ToutSocialButtons\Fields\Field {

	/**
	 * Class constructor.
	 *
	 * @since 		1.0.1
	 * @param 		string 		$context 			The field context. Options:
	 *                               					settings: plugin settings
	 *                               					metabox: in a metabox
	 *                               					widget: in widget form
	 * @param 		array 		$attributes 		The field attributes.
	 * @param 		array 		$properties 		The field properties.
	 */
	public function __construct( $context, $attributes, $properties ) {

		$this->set_context( $context );
		$this->set_setting_name( $args );
		$this->set_settings( $attributes, $properties );

		$this->set_default_attributes();
		$this->set_attributes( $attributes );
		$this->set_value( $attributes );
		$this->set_name_attribute();

		$this->set_default_properties();
		$this->set_default_editor_properties();
		$this->set_properties( $properties );

		$this->output_label();
		$this->output_field( $attributes, $properties );
		$this->output_description();

	} // __construct()

	/**
	 * Displays the WP Editor field.
	 *
	 * @since 		1.0.1
	 */
	public function output_field() {

		wp_editor( $this->attributes['value'], $this->attributes['id'], $this->properties['settings'] );

	} // output_field()

	/**
	 * Sets the default properties class variable.
	 *
	 * @since 		1.0.1
	 */
	protected function set_default_editor_properties() {

		$this->default_properties['settings'] = '';

	} // set_default_editor_properties()

} // class
