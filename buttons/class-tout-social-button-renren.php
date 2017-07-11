<?php

/**
 * Defines the Renren tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button_Renren extends Tout_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-renren"><path d="M.4 9.9c0-1.6.3-3 1-4.4S3.1 3 4.3 2.1 6.9.6 8.4.4v6.1c0 2.1-.5 4-1.6 5.7-1.1 1.7-2.4 3-4.1 3.8C1.2 14.3.4 12.3.4 9.9zm5 8.4c1.1-.7 2.1-1.6 2.9-2.6.8-1 1.4-2.1 1.6-3.3.3 1.2.8 2.3 1.7 3.3.8 1 1.8 1.9 2.9 2.6-1.4.8-3 1.2-4.6 1.2-1.6 0-3.1-.4-4.5-1.2zm6.2-11.7V.5c1.5.2 2.8.8 4.1 1.7s2.2 2 2.9 3.4 1 2.8 1 4.4c0 2.3-.8 4.4-2.3 6.2-1.7-.8-3.1-2.1-4.1-3.8s-1.6-3.7-1.6-5.8z"/></svg>';
		$this->id 	= 'renren';
		$this->name = esc_html__( 'Renren', 'tout-social-buttons' );

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

		$this->url['args']['link'] 			= $link;
		$this->url['args']['title'] 		= $title;
		$this->url['base_url'] 				= 'http://share.renren.com/share/buttonshare.do';

	} // set_url()

} // class
