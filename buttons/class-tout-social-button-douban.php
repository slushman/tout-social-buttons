<?php

/**
 * Defines the Douban tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button_Douban extends Tout_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-douban"><path d="M.2 19.4v-1.8h4.9l-1.5-4.8H1.9l.2-8.6h15.8v8.5h-1.7l-1.3 4.8 4.8-.2.1 2H.2v.1zm7.9-1.8h3.6l1.7-4.8h-7l1.7 4.8zm6.7-10.9H5.2l-.1 3.7h9.7V6.7zM.8.6H19v1.8H.8V.6z"/></svg>';
		$this->id 	= 'douban';
		$this->name = esc_html__( 'Douban', 'tout-social-buttons' );

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
		$this->url['base_url'] 				= 'http://www.douban.com/recommend/';

	} // set_url()

} // class
