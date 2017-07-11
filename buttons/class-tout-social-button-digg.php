<?php

/**
 * Defines the Digg tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button_Digg extends Tout_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-digg"><path d="M5.2 4.1v9.5H.1V6.8h3.2V4.1h1.9zM3.3 8.4H2.1V12h1.2V8.4zM6 6h2V4H6v2zm0 7.6h2V6.8H6v6.8zm8-6.8v9.1H8.8v-1.6H12v-.8H8.8V6.8H14zm-2 1.6h-1.2V12H12V8.4zm7.9-1.6v9.1h-5.1v-1.6H18v-.8h-3.2V6.8h5.1zm-2 1.6h-1.2V12h1.2V8.4z"/></svg>';
		$this->id 	= 'digg';
		$this->name = esc_html__( 'Digg', 'tout-social-buttons' );

		$this->set_a11y_text();
		$this->set_url();

	} // __construct()

	/**
	 * Sets the url class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_url() {

		$link 	= urlencode( get_permalink() );
		$title 	= urlencode( get_the_title() );

		$this->url['args']['url'] 				= $link;
		$this->url['args']['title'] 			= $title;
		$this->url['base_url'] 					= 'http://digg.com/submit';

	} // set_url()

} // class
