<?php

namespace ToutSocialButtons\Buttons;

/**
 * Defines the Pinterest tout button.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Buttons
 * @author 			Slushman <chris@slushman.com>
 */
class Pinterest extends Tout_Social_Button {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();
		$this->set_customizer();

		$this->colors 	= array( 'brand' => '#bd081c', 'contrast' => '#fff' );
		$this->id 		= 'pinterest';
		$this->icon 	= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="' . esc_attr( $this->get_svg_classes() ) . '"><path d="M10.5.1c3.7 0 7.1 2.6 7.1 6.5 0 3.7-1.9 7.8-6.1 7.8-1 0-2.2-.5-2.7-1.4-.9 3.6-.8 4.1-2.8 6.8l-.2.1-.1-.1c-.1-.7-.2-1.5-.2-2.2 0-2.4 1.1-5.9 1.7-8.3-.3-.6-.4-1.3-.4-2 0-1.2.8-2.7 2.2-2.7 1 0 1.5.8 1.5 1.7 0 1.5-1 3-1 4.5 0 1 .8 1.7 1.8 1.7 2.7 0 3.6-3.9 3.6-6 0-2.8-2-4.3-4.7-4.3C7 2.1 4.6 4.3 4.6 7.5c0 1.5.9 2.3.9 2.7 0 .3-.2 1.4-.6 1.4h-.2C3 11 2.4 8.8 2.4 7.2c0-4.4 4-7.1 8.1-7.1z"/></svg>';
		$this->name 	= esc_html__( 'Pinterest', 'tout-social-buttons' );

		$this->set_a11y_text();
		$this->set_url();

	} // __construct()

	/**
	 * Registers all the WordPress hooks and filters related to this class.
	 *
	 * @hooked 		init
	 * @since 		1.0.0
	 */
	public function hooks() {

		add_filter( 'tout_social_buttons_frontend_buttons', array( $this, 'add_button' ), 5, 1 );

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
	 * Sets the url class variable.
	 *
	 * @since 		1.0.0
	 */
	protected function set_url() {

		$excerpt 	= urlencode( get_the_excerpt() );
		$image 		= urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) );
		$link 		= urlencode( get_permalink() );

		$this->url['args']['url'] 			= $link;
		$this->url['args']['description'] 	= $excerpt;
		$this->url['args']['media'] 		= $image;
		$this->url['base_url'] 				= 'https://pinterest.com/pin/create/button/';

	} // set_url()

} // class
