<?php

/**
 * Defines a generic tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button {

	/**
	 * The screen reader text for this button.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 		$a11y_text 		The text.
	 */
	protected $a11y_text;

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
	 * Returns the SVG icon for this button.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The icon class variable.
	 */
	public function get_icon() {

		$type = $this->get_type();

		if ( 'icon' !== $type ) { return; }

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
	 * Returns the selected output type for this button.
	 *
	 * @since 		1.0.0
	 * @return 		mixed 		Either the button text in a span or the icon.
	 */
	public function get_label() {

		$return = '';
		$type 	= $this->get_type();

		if ( 'icon' === $type ) :

			$return .= $this->get_icon();

		endif;

		$return .= '<span class="tout-btn-text';

		if ( 'icon' === $type ) :

			$return .= ' screen-reader-text';

		endif;

		$return .='">';
		$return .= $this->get_name();
		$return .= '</span>';

		return $return;

	} // get_label()

	/**
	 * Returns the name for this button.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The name class variable.
	 */
	public function get_name() {

		return $this->name;

	} // get_name()

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

		return get_option( 'tout_social_buttons_button_type' );

	} // get_type()

	/**
	 * Returns the url for this button.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The url class variable.
	 */
	public function get_url() {

		$title 		= urlencode( get_the_title() );
		$excerpt 	= urlencode( get_the_excerpt() );
		$link 		= urlencode( get_permalink() );
		$image 		= urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) );

		return esc_url( add_query_arg( $this->url['args'], $this->url['base_url'] ) );

	} // get_url()

	/**
	 * Checks if the button is selected in the admin.
	 *
	 * @since 		1.0.0
	 * @return 		bool 	TRUE if button is selected, otherwise FALSE.
	 */
	public function is_active() {

		if ( 1 === $this->settings['button-' . $this->get_id()] ) {

			return TRUE;

		} else {

			return FALSE;

		}

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
	 * Sets the class variable $settings with the plugin settings.
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

		$this->type = get_option( 'tout_social_buttons_button_type' );

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
