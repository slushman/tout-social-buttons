<?php

namespace ToutSocialButtons\Buttons;

/**
 * Defines a generic tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Social_Button {

	/**
	 * The screen reader text for this button.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$a11y_text 		The text.
	 */
	protected $a11y_text;

	/**
	 * An array of colors for the button.
	 * Includes a background and icon color.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 		$colors 		Colors for the button.
	 */
	protected $colors;

	/**
	 * The SVG icon for this button.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		mixed 		$icon 		The SVG.
	 */
	protected $icon;

	/**
	 * The ID of this button.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$id 		The ID of this button.
	 */
	protected $id;

	/**
	 * An array of custom attributes for the button link.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 		$link_attributes 		Custom attributes.
	 */
	protected $link_attributes;

	/**
	 * The name of this button.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$name 		The name of this button.
	 */
	protected $name;

	/**
	 * The plugin settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$settings 		The plugin settings.
	 */
	protected $settings;

	/**
	 * The button type (text or icon).
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$type 		The button type.
	 */
	protected $type;

	/**
	 * The URL of this button.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$url 		The URL.
	 */
	protected $url;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();
		$this->set_customizer();
		$this->set_a11y_text();
		$this->set_url();

	} // __construct()

	/**
	 * Returns the A11y text for this button.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The a11y_text class variable.
	 */
	public function get_a11y_text() {

		return $this->a11y_text;

	} // get_a11y_text()

	/**
	 * Returns the either the colors array or the requested color.
	 *
	 * @since 		1.0.0
	 * @return 		array|string 		Colors array or the requested color.
	 */
	public function get_colors( $color = '' ) {

		if ( empty( $color ) ) { return $this->colors; }

		return $colors[$color];

	} // get_colors()

	/**
	 * Returns the SVG icon for this button.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The icon class variable.
	 */
	public function get_icon() {

		$type = $this->get_type();

		if ( 'text' === $type && ! is_admin() && ! is_customize_preview() ) { return; }

		return $this->icon;

	} // get_icon()

	/**
	 * Returns the id for this button.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The id class variable.
	 */
	public function get_id() {

		return $this->id;

	} // get_id()

	/**
	 * Returns a string of custom attributes for the button link.
	 *
	 * @since 		1.0.0
	 * @return 		string 		Custom link attributes.
	 */
	public function get_link_attributes() {

		if ( empty( $this->link_attributes ) ) { return; }

		$return = '';

		foreach ( $this->link_attributes as $key => $value ) :

		    if ( 'data' === $key ) :

		        foreach ( $this->link_attributes['data'] as $key => $value ) :

		            $return .= ' data-' . $key . '="' . esc_attr( $value ) . '" ';

		        endforeach;

		    else :

		        $return .= ' ' . $key . '="' . esc_attr( $value ) . '" ';

		    endif;

		endforeach;

		return $return;

	} // get_link_attributes()

	/**
	 * Returns the name for this button.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The name class variable.
	 */
	public function get_name() {

		/**
		 * The tout_social_buttons_button_name filter.
		 *
		 * Allows for change the button text.
		 *
		 * @since 		1.0.0
		 * @var 		string 		$name
		 */
		return apply_filters( 'tout_social_buttons_button_name',  $this->name );

	} // get_name()

	/**
	 * Allows additional accepted protocols for esc_url().
	 * Defined in the child class.
	 *
	 * @since 		1.0.0
	 * @return 		array 		Array of allowed protocols.
	 */
	public function get_protocols() {

		return NULL;

	} // get_protocols()

	/**
	 * Returns the name for this button.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The name class variable.
	 */
	public function get_title() {

		return esc_html__( 'Share on ' . $this->get_name(), 'tout-social-buttons' );

	} // get_title()

	/**
	 * Returns the type for this button.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The type class variable.
	 */
	public function get_type() {

		$options = get_option( 'tout_social_buttons' );

		return $options['button_type'];

	} // get_type()

	/**
	 * Returns the url for this button.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The url class variable.
	 */
	public function get_url() {

	//	return add_query_arg( $this->url['args'], $this->url['base_url'] );

		$title 		= urlencode( get_the_title() );
		$excerpt 	= urlencode( get_the_excerpt() );
		$link 		= urlencode( get_permalink() );
		$image 		= urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) );

		$url = add_query_arg( $this->url['args'], $this->url['base_url'] );

		return $url;

	} // get_url()

	/**
	 * Checks if the button is in the active buttons.
	 *
	 * @since 		1.0.0
	 * @return 		bool 	TRUE if button is selected, otherwise FALSE.
	 */
	public function is_active() {

		$active = explode( ',', $this->settings['active-buttons'] );

		return in_array( $this->id, $active );

	} // is_active()

	/**
	 * Sets the a11y_text class variable.
	 *
	 * @since 		1.0.0
	 */
	public function set_a11y_text() {

		if ( is_admin() ) {

			$this->a11y_text = esc_html__( 'Share content on ', 'tout-social-buttons' );

		} else {

			$this->a11y_text = esc_html__( 'Share on ', 'tout-social-buttons' );

		}

	} // set_a11y_text()

	/**
	 * Sets the $customizer class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_customizer() {

		$this->customizer = get_option( TOUT_SOCIAL_BUTTON_CUSTOMIZER );

	} // set_customizer()

	/**
	 * Sets the class variable $setting.
	 *
	 * Only contains whether this button is activatred or not.
	 *
	 * @since 		1.0.0
	 */
	public function set_settings() {

		$this->settings = get_option( TOUT_SOCIAL_BUTTONS_SETTINGS );

	} // set_settings()

	/**
	 * Sets the type class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_type() {

		$this->type = $this->customizer['button_type'];

	} // set_url()

	/**
	 * Sets the url class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_url() {

		$this->url = '';

	} // set_url()

} // class
