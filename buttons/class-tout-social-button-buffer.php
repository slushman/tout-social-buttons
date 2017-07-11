<?php

/**
 * Defines the Buffer tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button_Buffer extends Tout_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-buffer"><path d="M9.7.5c.3 0 .6 0 .9.1 2.8 1.3 5.6 2.6 8.5 4 .1.1.2.1.2.3 0 .2-.1.2-.3.3-2.8 1.3-5.7 2.6-8.5 4-.4.1-.8.1-1.2 0-2.8-1.3-5.7-2.6-8.5-4 0-.1-.1-.2-.1-.4 0-.1.1-.2.3-.3C3.7 3.3 6.4 2 9.1.7c.2-.1.4-.2.6-.2zM2.8 8.9c.3-.1.7 0 1 .1 1.8.9 3.7 1.7 5.5 2.6.4.2.9.2 1.3.1 1.9-.9 3.7-1.7 5.6-2.6.4-.2 1-.2 1.4 0 .5.2 1 .5 1.5.7.1.1.3.2.2.3 0 .1-.2.2-.3.3-2.8 1.3-5.6 2.6-8.5 3.9-.4.2-.9.2-1.4-.1-2.8-1.3-5.5-2.6-8.3-3.9-.1-.1-.3-.1-.3-.3 0-.1.1-.2.2-.3l1.2-.6c.4 0 .6-.2.9-.2z"/><path d="M2.9 14c.3 0 .6 0 .9.2 1.8.8 3.6 1.7 5.5 2.5.4.2.9.2 1.3.1 1.9-.9 3.9-1.8 5.8-2.7.4-.2.9-.1 1.3.1.5.2 1 .5 1.5.7.1.1.2.2.1.4-.1.1-.3.2-.5.3-2.7 1.3-5.4 2.5-8.1 3.8-.4.2-.9.2-1.3.1-2.8-1.3-5.5-2.6-8.3-3.9-.2-.1-.3-.1-.4-.3-.1-.1 0-.3.2-.3.4-.2.8-.4 1.3-.6.2-.2.4-.4.7-.4z"/></svg>';
		$this->id 	= 'buffer';
		$this->name = esc_html__( 'Buffer', 'tout-social-buttons' );

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
		$this->url['args']['text'] 				= $title;
		$this->url['base_url'] 					= 'http://bufferapp.com/add';

	} // set_url()

} // class
