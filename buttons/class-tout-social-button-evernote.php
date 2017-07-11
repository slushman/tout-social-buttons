<?php

/**
 * Defines the Evernote tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button_Evernote extends Tout_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-evernote"><path d="M3.4 4h1.8c.1 0 .2-.1.2-.2v-2c0-.4.1-.7.2-.9l.1-.1-3.6 3.5c.1 0 .2-.1.2-.1.3-.1.7-.2 1.1-.2zm14.3-.4c-.1-.8-.6-1.2-1-1.3-.5-.2-1.4-.3-2.5-.5-.9-.1-2-.1-2.7-.1-.1-.5-.5-1-.9-1.2C9.5.1 7.7.2 7.3.3c-.4.1-.8.3-1 .6-.1.3-.2.5-.2.9v2.1c0 .4-.3.7-.7.7H3.5c-.4 0-.7.1-.9.2-.2 0-.4.2-.5.3-.2.3-.3.8-.3 1.2 0 0 0 .3.1 1 .1.5.6 4 1.1 5.1.2.4.3.6.7.8.9.4 2.9.8 3.9.9.9.1 1.5.4 1.9-.4 0 0 .1-.2.2-.5.3-.9.4-1.8.4-2.4 0-.1.1-.1.1 0 0 .4-.1 1.9 1.1 2.3.4.2 1.4.3 2.3.4.9.1 1.5.4 1.5 2.6 0 1.3-.3 1.5-1.7 1.5-1.2 0-1.6 0-1.6-.9 0-.8.8-.7 1.3-.7.2 0 .1-.2.1-.7 0-.5.3-.7 0-.7-1.9-.1-3.1 0-3.1 2.4 0 2.2.8 2.6 3.6 2.6 2.1 0 2.9-.1 3.8-2.8.2-.5.6-2.2.9-5-.1-1.5-.4-6.8-.7-8.2zM14 9.5h-.8c.1-.5.3-1.2 1.1-1.2.9 0 1 .9 1 1.4-.3-.1-.8-.2-1.3-.2z"/></svg>';
		$this->id 	= 'evernote';
		$this->name = esc_html__( 'Evernote', 'tout-social-buttons' );

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

		$this->url['args']['url'] 			= $link;
		$this->url['args']['title'] 		= $title;
		$this->url['base_url'] 				= 'https://www.evernote.com/clip.action';

	} // set_url()

} // class
