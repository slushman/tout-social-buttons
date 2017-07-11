<?php

/**
 * Defines the Baidu tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button_Baidu extends Tout_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-baidu"><path d="M17.1 11.9c-2.4.1-2.5-1.6-2.5-2.8s.3-3 2.2-3 2.4 1.9 2.4 2.5c.1.6.3 3.2-2.1 3.3zm-4.3-5.5c-1.6-.2-2-1.6-1.8-3.1.1-1.2 1.6-3 2.7-2.7s2.2 1.8 2 3c-.2 1.3-1.2 3-2.9 2.8zm0 3.6c1.5 2.1 4 4 4 4s1.9 1.4.7 4.2c-1.2 2.8-5.6 1.3-5.6 1.3s-1.6-.5-3.5-.1-3.5.3-3.5.3-2.2.1-2.8-2.7c-.6-2.7 2.2-4.2 2.4-4.5.2-.3 1.7-1.2 2.6-2.8.9-1.5 3.7-2.7 5.7.3zM7.6 6.2c-1.2 0-2.2-1.4-2.2-3.1S6.4 0 7.6 0s2.2 1.4 2.2 3.1-1 3.1-2.2 3.1zm-4.1 4.3c-2.2.5-3-2-2.8-3.2 0 0 .3-2.5 2-2.7C4.1 4.5 5.1 6 5.3 6.9c.1.6.4 3.2-1.8 3.6z"/></svg>';
		$this->id 	= 'baidu';
		$this->name = esc_html__( 'Baidu', 'tout-social-buttons' );

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

		$this->url['args']['buttontype'] 		= 'small';
		$this->url['args']['cb'] 				= 'bdShare.ajax._callbacks.bd4bb141b';
		$this->url['args']['index'] 			= $link;
		$this->url['base_url'] 					= 'http://like.baidu.com/set';

	} // set_url()

} // class
