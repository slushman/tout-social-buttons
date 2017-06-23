<?php

/**
 * All the code required to produce a basic form field.
 *
 * @link 		https://www.slushman.com
 * @since 		1.0.0
 *
 * @package 	Tout_Buttons
 * @subpackage 	Tout_Buttons/includes
 */

class Tout_Buttons_Field {

	/**
	 * The field attributes.
	 *
	 * @var 		array
	 */
	var $attributes;

	/**
	 * The default field attributes.
	 *
	 * @var 		array
	 */
	var $default_attributes;

	/**
	 * The default field properties.
	 *
	 * @var 		array
	 */
	var $default_properties;

	/**
	 * The field properties.
	 *
	 * @var 		array
	 */
	var $properties;

	/**
	 * The field settings, based on the context.
	 *
	 * @var 		array
	 */
	var $settings;

	/**
	 * Class contructor.
	 * Sets the default attributes and properties class variables.
	 * Sets the $attributes and $properties class variables.
	 * Cleans the attributes and properties to remove empty values.
	 * Outputs the field HTML.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$attributes 		The field attributes.
	 * @param 		array 		$properties 		The field properties.
	 * @param 		string 		$context 			The field context. Options:
	 *                               					settings - plugin settings
	 *                               					metabox - metabox
	 *                               					widget - widget form
	 */
	public function __construct( $attributes, $properties, $context ) {

		$this->set_context( $context );
		$this->set_settings( $attributes, $properties );

		$this->set_settings( $attributes );

		$this->set_attributes( $attributes );

		$this->set_properties( $properties );

		$this->output_label();
		$this->output_field();
		$this->output_description();

	} // __construct()

	/**
	 * Removes empty values from the attributes array.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$attributes 		The full attributes array.
	 * @param 		array 		$attributes 		The clean attributes array.
	 */
	protected function clean_attributes( $attributes ) {

		if ( empty( $attributes ) ) { return; }

		foreach ( $attributes as $key => $att ) {

			if ( FALSE !== stripos( $key, 'data-' ) ) { continue; }
			if ( 'value' === $key ) { continue; }
			if ( ! array_key_exists( $key, $this->default_attributes ) ) { unset( $attributes[$key] ); }
			if ( empty( $att ) ) { unset( $attributes[$key] ); }

		}

		return $attributes;

	} // clean_attributes()

	/**
	 * Removes empty values from the properties array.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$properties 		The full properties array.
	 * @param 		array 		$properties 		The clean properties array.
	 */
	protected function clean_properties( $properties ) {

		if ( empty( $properties ) ) { return; }

		foreach ( $properties as $key => $prop ) {

			if ( ! array_key_exists( $key, $this->default_properties ) ) { unset( $properties[$key] ); }
			if ( empty( $prop ) ) { unset( $properties[$key] ); }

		}

		return $properties;

	} // clean_properties()

	/**
	 * Returns the field attributes.
	 *
	 * @since 		1.0.0
	 * @return 		array 		Array of field attributes.
	 */
	public function get_attributes() {

		return $this->attributes;

	} // get_attributes()

	/**
	 * Returns the field properties.
	 *
	 * @since 		1.0.0
	 * @return 		array 		Array of field properties.
	 */
	public function get_properties() {

		return $this->properties;

	} // get_properties()

	/**
	 * Includes the field HTML file.
	 * Defined in the child class.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		// include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/fieldtype.php' );

	} // output()

	/**
	 * Includes the field description partial file.
	 *
	 * @exits 		If the description property is empty.
	 * @since 		1.0.0
	 */
	protected function output_description() {

		if ( empty( $this->properties['description'] ) ) { return; }

	    include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/description.php' );

	} // output_description()

	/**
	 * Includes the field description legend partial file.
	 *
	 * @exits 		If the description property is empty.
	 * @since 		1.0.0
	 */
	protected function output_description_legend() {

		if ( empty( $this->properties['description'] ) ) { return; }

	    include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/description-legend.php' );

	} // output_description_legend()

	/**
	 * Includes the field description span partial file.
	 *
	 * @exits 		If the description property is empty.
	 * @since 		1.0.0
	 */
	protected function output_description_span() {

		if ( empty( $this->properties['description'] ) ) { return; }

	    include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/description-span.php' );

	} // output_description_span()

	/**
	 * Includes the fieldset begin partial file.
	 *
	 * @since 		1.0.0
	 */
	protected function output_fieldset_begin() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/fieldset_begin.php' );

	} // output_fieldset_begin()

	/**
	 * Includes the fieldset end partial file.
	 *
	 * @since 		1.0.0
	 */
	protected function output_fieldset_end() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/fieldset_end.php' );

	} // output_fieldset_end()

	/**
	 * Includes the field label beginning partial file,
	 * then the label output, the the label end partial file.
	 *
	 * @exits 		If the label property is empty.
	 * @since 		1.0.0
	 */
	protected function output_label() {

		if ( empty( $this->properties['label'] ) ) { return; }

		$this->output_label_begin();

		echo wp_kses( $this->properties['label'], array( 'code' => array() ) ) . ': ';

		$this->output_label_end();

	} // output_label()

	/**
	 * Includes the field label begin partial file.
	 *
	 * @since 		1.0.0
	 */
	protected function output_label_begin() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/label_begin.php' );

	} // output_label_begin()

	/**
	 * Includes the field label end partial file.
	 *
	 * @since 		1.0.0
	 */
	protected function output_label_end() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/label_end.php' );

	} // output_label_end()

	/**
	 * Sets the default attributes class variable.
	 *
	 * Not supporting datalist and list attributes due to poor browser support.
	 * Not supporting the form+ attributes since they are just for the submit button.
	 * Not supporting height and width attributes since those are just for the image input type.
	 *
	 * @since 		1.0.0
	 */
	protected function set_default_attributes() {

		$this->default_attributes 					= array();
		$this->default_attributes['autocomplete'] 	= '';
		$this->default_attributes['autofocus'] 		= '';
		$this->default_attributes['checked'] 		= '';
		$this->default_attributes['class'] 			= 'widefat';
		$this->default_attributes['data'] 			= array();
		$this->default_attributes['disabled'] 		= '';
		$this->default_attributes['id'] 			= '';
		$this->default_attributes['max'] 			= '';
		$this->default_attributes['maxlength'] 		= '';
		$this->default_attributes['min'] 			= '';
		$this->default_attributes['multiple'] 		= '';
		$this->default_attributes['name'] 			= '';
		$this->default_attributes['pattern'] 		= '';
		$this->default_attributes['placeholder'] 	= '';
		$this->default_attributes['readonly'] 		= '';
		$this->default_attributes['required'] 		= '';
		$this->default_attributes['size'] 			= '';
		$this->default_attributes['step'] 			= '';
		$this->default_attributes['type'] 			= 'text';
		$this->default_attributes['value'] 			= '';

	} // set_default_attributes()

	/**
	 * Sets the default properties class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_default_properties() {

		$this->default_properties 						= array();
		$this->default_properties['class-desc'] 		= '';
		$this->default_properties['class-label'] 		= '';
		$this->default_properties['class-label-span'] 	= '';
		$this->default_properties['description'] 		= '';
		$this->default_properties['error'] 				= '';
		$this->default_properties['label'] 				= '';
		$this->default_properties['role-fieldset'] 		= 'group';

	} // get_default_properties()

	/**
	 * Sets the $attributes class variable.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$attributes 		The class attributes.
	 */
	public function set_attributes( $attributes ) {

		$attributes			= wp_parse_args( $attributes, $this->default_attributes );
		$this->attributes 	= $this->clean_attributes( $attributes );

	} // set_attributes()

	/**
	 * Sets the $context class variable.
	 * Needed to determine the proper field name and value.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$context 		The field context.
	 */
	protected function set_context( $context ) {

		$this->context = $context;

	} // set_context()

	/**
	 * Sets the name attribute based on the field context.
	 *
	 * @since 		1.0.0
	 */
	protected function set_name_attribute() {

		if ( 'settings' !== $this->context && empty( $this->attributes['id'] ) && ! empty( $this->attributes['name'] ) ) { return; }

		$this->attributes['name'] = TOUT_BUTTONS_SETTINGS . '[' . $this->attributes['id'] . ']';

	} // set_name_attribute()

	/**
	 * Sets the $properties class variable.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$properties 		The class properties.
	 */
	public function set_properties( $properties ) {

		$properties 		= wp_parse_args( $properties, $this->default_properties );
		$this->properties 	= $this->clean_properties( $properties );

	} // set_properties()

	/**
	 * Sets the $settings class variable based on the context.
	 *
	 * @param 		array 		$attributes 		The field attributes.
	 * @param 		array 		$properties 		The field properties
	 */
	protected function set_settings( $attributes, $properties ) {

		if ( 'settings' === $this->context ) {

			$this->settings = get_option( TOUT_BUTTONS_SETTINGS );

		} elseif ( 'metaboxes' === $this->context ) {

			$this->settings = get_post_custom();

		}

	} // set_settings()

	/**
	 * Sets the value attributes based on the field context.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$attributes 		The field attributes.
	 */
	protected function set_value( $attributes ) {

		if ( isset( $this->attributes['type'] ) && 'checkbox' === $this->attributes['type'] ) {

			$this->attributes['value'] = 1;

		} elseif ( 'settings' === $this->context ) { // plugin

			if ( array_key_exists( $this->attributes['id'], $this->settings ) ) {

				$this->attributes['value'] = $this->settings[$this->attributes['id']];

			}

		} elseif ( 'metaboxes' === $this->context ) { // metaboxes

			$this->attributes['value'] = $this->settings[$this->attributes['id']][0];

		} /*elseif ( 'widget' === $this->context ) { // widgets settings

			//

		}*/

	} // set_value()

} // class
