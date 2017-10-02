<?php

namespace ToutSocialButtons\Buttons;

/**
 * Defines the LinkedIn tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Buttons
 * @author 			Slushman <chris@slushman.com>
 */
class LinkedIn extends Tout_Social_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();
		$this->set_customizer();

		$this->colors 	= array( 'brand' => '#0077b5', 'contrast' => '#fff' );
		$this->icon 	= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-linkedin"><path d="M2.5 5C1 5 .1 4 .1 2.8.1 1.6 1.1.6 2.5.6c1.5 0 2.4 1 2.4 2.2C4.9 4 4 5 2.5 5zm2.1 14.4H.4V6.7h4.2v12.7zm15.3 0h-4.2v-6.8c0-1.7-.6-2.9-2.1-2.9-1.2 0-1.9.8-2.2 1.5-.1.3-.1.7-.1 1v7.1H6.9c.1-11.4 0-12.6 0-12.6h4.2v1.9c.6-.9 1.6-2.1 3.8-2.1 2.8 0 4.9 1.8 4.9 5.7v7.2z"/></svg>';
		$this->id 		= 'linkedin';
		$this->name 	= esc_html__( 'LinkedIn', 'tout-social-buttons' );

		$this->set_a11y_text();
		$this->set_url();
		$this->set_content();

	} // __construct()

	/**
	 * Sets the content for button URL.
	 *
	 * If no content is passed in, defaults to the post title.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$content 		Optional. The content.
	 */
	public function set_content( $content = '' ) {

		if ( empty( $content ) ) {

			$excerpt 	= urlencode( get_the_excerpt() );
			$title 		= urlencode( get_the_title() );

			$this->url['args']['summary'] 		= $excerpt;
			$this->url['args']['title'] 		= $title;

		} else {

			$this->url['args']['summary'] = urlencode( '"' . $content . '"' );

		}

	} // set_content()

	/**
	 * Sets the url class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_url() {

		$link 		= urlencode( get_permalink() );

		$this->url['args']['mini'] 			= 'true';
		$this->url['args']['url'] 			= $link;
		$this->url['args']['source'] 		= $link;
		$this->url['base_url'] 				= 'https://www.linkedin.com/shareArticle';

	} // set_url()

} // class
