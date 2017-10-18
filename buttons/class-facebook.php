<?php

namespace ToutSocialButtons\Buttons;

/**
 * Defines the Facebook tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Facebook extends Tout_Social_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();
		$this->set_customizer();

		$this->colors 	= array( 'brand' => '#3b5998', 'contrast' => '#fff' );
		$this->id 		= 'facebook';
		$this->icon 	= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="' . esc_attr( $this->get_svg_classes() ) . '"><path d="M8.46 18h2.93v-7.3h2.45l.37-2.84h-2.82V6.04q0-.69.295-1.035T12.8 4.66h1.51V2.11Q13.36 2 12.12 2q-1.67 0-2.665.985T8.46 5.76v2.1H6v2.84h2.46V18z"/></svg>';
		$this->name 	= esc_html__( 'Facebook', 'tout-social-buttons' );

		$this->set_a11y_text();
		$this->set_url();

	} // __construct()

	/**
	 * Registers all the WordPress hooks and filters related to this class.
	 *
	 * @hooked 		init
	 * @since 		1.0.0
	 */
	public function hooks() {

		add_filter( 'tout_social_buttons_frontend_buttons', array( $this, 'add_button' ), 5, 1 );

	} // hooks()

	/**
	 * Add buttons to the button set for the plugin admin, along with an
	 * instance of the button class.
	 *
	 * @hooked 		tout_social_buttons_admin_buttons
	 * @since 		1.0.0
	 */
	public function add_button( $buttons ) {

		$buttons[] = $this->id;

		return $buttons;

	} // add_button()

	/**
	 * Sets the url class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_url() {

		$link = urlencode( get_permalink() );

		$this->url['args']['u'] = $link;
		$this->url['base_url'] 	= 'https://www.facebook.com/sharer/sharer.php';

	} // set_url()

} // class
