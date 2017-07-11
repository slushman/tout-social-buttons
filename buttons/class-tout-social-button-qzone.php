<?php

/**
 * Defines the QZone tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button_QZone extends Tout_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-qzone"><path d="M14.6 12.4l.5 1.5c-1.7-.2-4.2-.4-6.4-.8-.1-.3 6.1-4.6 6-4.9-5.5-.9-9.6 0-9.6 0l6.7.9s-6.3 4.2-6.4 4.6c2.8.5 7.3.5 9.8.4.6 1.9 1.4 4.6.9 4.9-1.2.6-6.3-3.3-6.3-3.3s-5 3.6-5.8 3.2c-1.2-.6.5-6.6.5-6.6S-.1 8.6.2 7.7c.3-.9 7-1.2 7-1.2S9.1 1.2 10 1s3 5.2 3 5.2 6.4.7 6.8 1.3c.4.5-5.2 4.9-5.2 4.9zM17 14s-.7 0-1.9.1c0-.1-.1-.2-.1-.2 1.3.1 2 .1 2 .1z"/></svg>';
		$this->id 	= 'qzone';
		$this->name = esc_html__( 'QZone', 'tout-social-buttons' );

		$this->set_a11y_text();
		$this->set_url();

	} // __construct()

	/**
	 * Sets the url class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_url() {

		$excerpt 	= urlencode( get_the_excerpt() );
		$link 		= urlencode( get_permalink() );
		$title 		= urlencode( get_the_title() );

		$this->url['args']['url'] 				= $link;
		$this->url['args']['title'] 			= $title;
		$this->url['args']['summary'] 			= $excerpt;
		$this->url['base_url'] 					= 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey';

	} // set_url()

} // class
