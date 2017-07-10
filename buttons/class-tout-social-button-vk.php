<?php

/**
 * Defines the VK tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button_VK extends Tout_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

		$this->icon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-btn-icon vk"><path d="M18.3 8.2c-2 2.7-2.2 2.4-.6 3.9s1.9 2.2 2 2.3c0 0 .7 1.2-.7 1.2h-2.6c-.6.1-1.3-.4-1.3-.4-1-.7-1.9-2.4-2.6-2.2 0 0-.7.2-.7 1.8 0 .3-.2.5-.2.5s-.2.2-.5.2H9.8c-2.6.2-4.9-2.2-4.9-2.2S2.4 10.7.2 5.5C.1 5.2.2 5 .2 5s.2-.2.6-.2h2.8c.3.1.4.2.4.2s.2.1.2.3c.5 1.2 1.1 2.2 1.1 2.2C6.3 9.6 7 10 7.4 9.8c0 0 .5-.3.4-2.9 0-.9-.3-1.4-.3-1.4-.1-.2-.6-.3-.8-.3-.2 0 .1-.4.4-.6.5-.2 1.4-.3 2.5-.2.8 0 1.1.1 1.4.1 1 .2.6 1.1.6 3.3 0 .7-.1 1.7.4 2 .2.1.8 0 2.1-2.2 0 0 .6-1.1 1.1-2.3.1-.3.3-.3.3-.3s.2-.1.4-.1h3c.9-.1 1 .3 1 .3.1.4-.4 1.4-1.6 3z"/></svg>';
		$this->id 	= 'vk';
		$this->name = esc_html__( 'VK', 'tout-social-buttons' );

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
		$image 		= urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) );
		$link 		= urlencode( get_permalink() );
		$title 		= urlencode( get_the_title() );

		$this->url['args']['url'] 					= $link;
		$this->url['args']['title'] 				= $title;
		$this->url['args']['description'] 			= $excerpt;
		$this->url['args']['image'] 				= $image;
		$this->url['args']['noparse'] 				= true;
		$this->url['base_url'] 						= 'https://vk.com/share.php';

	} // set_url()

} // class
