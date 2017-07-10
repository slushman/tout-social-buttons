<?php

/**
 * Defines the Weibo tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Social_Buttons
 * @subpackage 		Tout_Social_Buttons/buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Button_Weibo extends Tout_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

		$this->icon ='<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-btn-icon weibo"><path d="M19.6 8.8c-.1.4-.6.6-1 .5-.4-.1-.6-.6-.5-1 .4-1.2.1-2.6-.8-3.6S15 3.3 13.8 3.6c-.3.1-.7-.2-.8-.6-.1-.4.2-.8.6-.9 1.8-.4 3.7.2 5 1.6 1.2 1.5 1.6 3.4 1 5.1zM14.4 6c-.4.1-.7-.1-.8-.5-.1-.4.1-.7.5-.8.9-.2 1.8.1 2.4.8.6.7.8 1.7.5 2.5-.1.3-.5.5-.8.4-.3-.1-.5-.5-.4-.8.1-.4 0-.9-.3-1.2-.2-.4-.7-.5-1.1-.4zm.3 1.2c.3.5.3 1.2 0 2-.1.4 0 .4.3.5 1.1.4 2.4 1.2 2.4 2.7 0 2.5-3.6 5.6-9 5.6-4.1 0-8.3-2-8.3-5.3C.1 11 1.2 9 3 7.1c2.5-2.5 5.4-3.6 6.5-2.5.5.5.6 1.4.3 2.4-.2.5.5.2.5.2 2-.8 3.7-.9 4.4 0zm-.7 5.2c-.2-2.2-3-3.6-6.3-3.3-3.3.3-5.8 2.3-5.5 4.5.2 2.2 3 3.6 6.3 3.3 3.2-.4 5.7-2.4 5.5-4.5zm-7.7 3.5c-1.6-.5-2.2-2.1-1.6-3.5.7-1.4 2.4-2.2 4-1.7 1.6.4 2.4 1.9 1.8 3.4-.6 1.5-2.6 2.3-4.2 1.8zm.9-2.9c-.5-.2-1.2 0-1.5.5-.3.5-.2 1.1.3 1.3.5.2 1.2 0 1.5-.5.4-.5.2-1.1-.3-1.3zm1.2-.5c-.2-.1-.4 0-.6.2-.1.2 0 .4.1.5.2.1.5 0 .6-.2.2-.2.1-.5-.1-.5z"/></svg>';
		$this->id 	= 'weibo';
		$this->name = esc_html__( 'Weibo', 'tout-social-buttons' );

		$this->set_a11y_text();
		$this->set_url();

	} // __construct()

	/**
	 * Sets the url class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_url() {

		$image 		= urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) );
		$link 		= urlencode( get_permalink() );
		$title 		= urlencode( get_the_title() );

		$this->url['args']['url'] 				= $link;
		$this->url['args']['title'] 			= $title;
		$this->url['args']['appkey'] 			= '';
		$this->url['args']['pic'] 				= $image;
		$this->url['args']['ralateUid'] 		= '';
		$this->url['args']['language'] 			= 'zh_cn';
		$this->url['base_url'] 					= 'http://service.weibo.com/share/share.php';

	} // set_url()

} // class
