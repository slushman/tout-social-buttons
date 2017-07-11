<?php

/**
 * Defines the Xing tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button_Xing extends Tout_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-xing"><path d="M5.6 13.4c-.1.3-.3.6-.8.6H2c-.2 0-.3-.1-.4-.2-.1-.1-.1-.3 0-.4l3-5.4-1.9-3.4c-.1-.2-.1-.3 0-.4.1-.2.2-.2.4-.2H6c.4 0 .6.3.8.5l2 3.4s-.2.3-3.2 5.5zM18.4.7l-6.3 11.2 4 7.4c.1.2.1.3 0 .4-.1.1-.2.2-.4.2h-2.9c-.4 0-.7-.3-.8-.5l-4-7.5s.2-.4 6.4-11.3c.2-.3.3-.5.8-.5H18c.2 0 .3.1.4.2.1.1.1.2 0 .4z"/></svg>';
		$this->id 	= 'xing';
		$this->name = esc_html__( 'Xing', 'tout-social-buttons' );

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

		$this->url['args']['url'] 				= $link;
		$this->url['args']['op'] 				= 'share;';
		$this->url['args']['sc_p'] 				= 'xing-share;';
		$this->url['base_url'] 					= 'https://www.xing-share.com/app/user';

	} // set_url()

} // class
