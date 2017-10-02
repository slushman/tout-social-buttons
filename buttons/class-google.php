<?php

namespace ToutSocialButtons\Buttons;

/**
 * Defines the Google tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Google extends Tout_Social_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();
		$this->set_customizer();

		$this->colors 	= array( 'brand' => '#dd4b39', 'contrast' => '#000' );
		$this->icon 	= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-googleplus"><path d="M2.8 4.9c2.3-1.7 5.7-1.5 7.8.5-.6.5-1.1 1.1-1.7 1.6-1.6-1.4-4.2-1.2-5.5.4-1.6 1.8-1.1 4.9 1 6.1 2 1.2 5 .2 5.5-2.2H6.3V9.1h6c.2 1.8-.2 3.8-1.4 5.2-1.5 1.8-4.2 2.4-6.4 1.7-2.1-.6-3.9-2.5-4.3-4.7-.5-2.4.5-5 2.6-6.4zM16.3 7.3h1.8v1.8h1.8v1.8h-1.8v1.8h-1.8v-1.8h-1.8V9.1h1.8V7.3z"/></svg>';
		$this->id 		= 'google';
		$this->name 	= esc_html__( 'Google', 'tout-social-buttons' );

		$this->set_a11y_text();
		$this->set_url();

	} // __construct()

	/**
	 * Sets the url class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_url() {

		$link = urlencode( get_permalink() );

		$this->url['args']['url'] 			= $link;
		$this->url['base_url'] 				= 'https://plus.google.com/share';

	} // set_url()

} // class
