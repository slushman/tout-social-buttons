<?php

namespace ToutSocialButtons\Buttons;

/**
 * Defines the Twitter tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Twitter extends Tout_Social_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();
		$this->set_customizer();

		$this->colors 				= array( 'brand' => '#1da1f2', 'contrast' => '#000' );
		$this->id 					= 'twitter';
		$this->icon 				= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="' . esc_attr( $this->get_svg_classes() ) . '"><path d="M18.94 4.46q-.75 1.12-1.83 1.9.01.15.01.47 0 1.47-.43 2.945T15.38 12.6t-2.1 2.39-2.93 1.66-3.66.62q-3.04 0-5.63-1.65.48.05.88.05 2.55 0 4.55-1.57-1.19-.02-2.125-.73T3.07 11.55q.39.07.69.07.47 0 .96-.13-1.27-.26-2.105-1.27T1.78 7.89v-.04q.8.43 1.66.46-.75-.51-1.19-1.315T1.81 5.25q0-1 .5-1.84Q3.69 5.1 5.655 6.115T9.87 7.24q-.1-.45-.1-.84 0-1.51 1.075-2.585T13.44 2.74q1.6 0 2.68 1.16 1.26-.26 2.33-.89-.43 1.32-1.62 2.02 1.07-.11 2.11-.57z"/></svg>';
		$this->name 				= esc_html__( 'Twitter', 'tout-social-buttons' );
		$this->click_to_tweet_text 	= apply_filters( 'tout_social_buttons_clicktotweet_text', esc_html__( 'Click to Tweet', 'tout-social-buttons' ) );

		$this->set_a11y_text();
		$this->set_url();
		$this->set_content();

	} // __construct()

	/**
	 * Registers all the WordPress hooks and filters related to this class.
	 *
	 * @hooked 		init
	 * @since 		1.0.0
	 */
	public function hooks() {

		add_filter( 'tout_social_buttons_frontend_buttons', array( $this, 'add_button' ), 5, 1 );
		add_filter( 'tout_social_buttons_quote_buttons', array( $this, 'add_button' ), 10, 1 );

	} // hooks()

	/**
	 * Add buttons to the button set for the plugin admin, along with an
	 * instance of the button class.
	 *
	 * @hooked 		tout_social_buttons_admin_buttons
	 * @since 		1.0.0
	 */
	public function add_button( $buttons ) {

		$buttons[] = $this->id;

		return $buttons;

	} // add_button()

	/**
	 * Returns the Click to Tweet text for this button.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The click_to_tweet_text class variable.
	 */
	public function get_click_to_tweet_text() {

		return $this->click_to_tweet_text;

	} // get_click_to_tweet_text()

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

			$title = urlencode( get_the_title() );

			$this->url['args']['text'] = $title;

		} else {

			$this->url['args']['text'] = urlencode( '"' . $content . '"' );

		}

	} // set_content()

	/**
	 * Sets the url class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_url() {

		$link = urlencode( get_permalink() );

		$this->url['args']['url'] = $link;

		if ( ! empty( $this->settings['account-twitter'] ) ) {

			$this->url['args']['via'] = $this->settings['account-twitter'];

		}

		/**
		 * The tout_social_buttons_twitter_args filter.
		 *
		 * Allows for altering the args used for the Twitter link.
		 *
		 * @var 		array
		 */
		$this->url['args'] = apply_filters( 'tout_social_buttons_twitter_args', $this->url['args'] );

		$this->url['base_url'] = 'https://twitter.com/intent/tweet';

	} // set_url()

} // class
