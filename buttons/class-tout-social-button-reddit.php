<?php

/**
 * Defines the Reddit tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button_Reddit extends Tout_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-reddit"><path d="M19.9 9.8c0-1.3-1-2.3-2.3-2.3-.6 0-1.1.2-1.5.6-1.5-1-3.5-1.6-5.7-1.7l1.1-3.7 3.3.7c0 1 .8 1.9 1.9 1.9s1.9-.8 1.9-1.9-.8-1.9-1.9-1.9c-.8 0-1.4.5-1.7 1.1L11.5 2c-.2 0-.4.1-.4.2L9.8 6.4c-2.2 0-4.4.6-6 1.7-.4-.4-.9-.6-1.5-.6C1 7.5 0 8.5 0 9.8c0 .8.4 1.5 1.1 1.9 0 .2-.1.4-.1.6 0 1.6.9 3.1 2.7 4.3 1.7 1.1 3.9 1.7 6.2 1.7 2.4 0 4.6-.6 6.2-1.7 1.7-1.1 2.7-2.6 2.7-4.3 0-.2 0-.4-.1-.6.8-.4 1.2-1.1 1.2-1.9zm-3.1-7.5c.6 0 1.2.5 1.2 1.2 0 .6-.5 1.2-1.2 1.2-.6 0-1.2-.5-1.2-1.2 0-.6.6-1.2 1.2-1.2zM.8 9.8c0-.9.7-1.6 1.6-1.6.3 0 .6.1.9.3-1 .7-1.6 1.6-2 2.5-.3-.3-.5-.7-.5-1.2zm9.2 7.9c-4.5 0-8.2-2.4-8.2-5.3V12c0-.2.1-.5.1-.7.4-.8.9-1.6 1.8-2.3.2-.1.4-.3.6-.4 1.4-.9 3.5-1.5 5.7-1.5s4.3.6 5.7 1.5c.2.1.4.3.6.4.8.6 1.4 1.4 1.7 2.3.1.2.1.5.1.7v.4c.1 2.9-3.6 5.3-8.1 5.3zm8.7-6.7c-.3-.9-1-1.8-1.9-2.5.2-.2.6-.3.9-.3.9 0 1.6.7 1.6 1.6-.1.5-.3.9-.6 1.2z"/><path d="M12.7 14.7c-.7.6-1.5.8-2.7.8-1.2 0-2-.2-2.7-.8-.2-.1-.4-.1-.5.1-.1.2-.1.4.1.5.8.7 1.8 1 3.2 1s2.4-.3 3.2-1c.2-.1.2-.4.1-.5-.3-.2-.5-.3-.7-.1zM8.4 11.3c0-.7-.6-1.3-1.4-1.3-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3.8.1 1.4-.5 1.4-1.3zM13 10c-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3.7 0 1.3-.6 1.3-1.3.1-.7-.5-1.3-1.3-1.3z"/></svg>';
		$this->id 	= 'reddit';
		$this->name = esc_html__( 'Reddit', 'tout-social-buttons' );

		$this->set_a11y_text();
		$this->set_url();

	} // __construct()

	/**
	 * Sets the url class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_url() {

		$link 		= urlencode( get_permalink() );
		$title 		= urlencode( get_the_title() );

		$this->url['args']['url'] 			= $link;
		$this->url['args']['title'] 		= $title;
		$this->url['base_url'] 				= 'http://www.reddit.com/submit';

	} // set_url()

} // class
