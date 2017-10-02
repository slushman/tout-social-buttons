<?php

namespace ToutSocialButtons\Buttons;

/**
 * Defines the tumblr tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Buttons
 * @author 			Slushman <chris@slushman.com>
 */
class tumblr extends Tout_Social_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();
		$this->set_customizer();

		$this->colors 	= array( 'brand' => '#35465c', 'contrast' => '#fff' );
		$this->icon 	= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tout-social-button-icon tout-social-button-icon-tumblr"><path d="M15.7 18.7c-.4.5-2 1.1-3.4 1.2-4.3.1-5.9-3.1-5.9-5.3V8.1h-2V5.6c3-1.1 3.7-3.8 3.9-5.3 0-.1.1-.1.1-.1h2.9v5h4v3h-4v6.1c0 .8.3 2 1.9 1.9.5 0 1.2-.2 1.6-.3l.9 2.8z"/></svg>';
		$this->id 		= 'tumblr';
		$this->name 	= esc_html__( 'tumblr', 'tout-social-buttons' );

		$this->set_a11y_text();
		$this->set_url();

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

			$excerpt = urlencode( get_the_excerpt() );

			$this->url['args']['content'] = $excerpt;

		} else {

			$this->url['args']['content'] = urlencode( '"' . $content . '"' );

		}

	} // set_content()

	/**
	 * Sets the url class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_url() {

		$link 		= urlencode( get_permalink() );
		$title 		= urlencode( get_the_title() );

		$this->url['args']['canonicalUrl'] 		= $link;
		$this->url['args']['title'] 			= $title;

		if ( ! empty( $this->settings['account-tumblr'] ) ) {

			$this->url['args']['show-via'] 	= $this->settings['account-tumblr'];

		}

		$this->url['base_url'] = 'https://www.tumblr.com/widgets/share/tool';

	} // set_url()

} // class
