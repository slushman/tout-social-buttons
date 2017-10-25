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

		$this->colors 			= array( 'brand' => '#bd081c', 'contrast' => '#fff' );
		$this->id 				= 'pinterest';
		$this->icon 			= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="' . esc_attr( $this->get_svg_classes() ) . '"><path d="M10.5.1c3.7 0 7.1 2.6 7.1 6.5 0 3.7-1.9 7.8-6.1 7.8-1 0-2.2-.5-2.7-1.4-.9 3.6-.8 4.1-2.8 6.8l-.2.1-.1-.1c-.1-.7-.2-1.5-.2-2.2 0-2.4 1.1-5.9 1.7-8.3-.3-.6-.4-1.3-.4-2 0-1.2.8-2.7 2.2-2.7 1 0 1.5.8 1.5 1.7 0 1.5-1 3-1 4.5 0 1 .8 1.7 1.8 1.7 2.7 0 3.6-3.9 3.6-6 0-2.8-2-4.3-4.7-4.3C7 2.1 4.6 4.3 4.6 7.5c0 1.5.9 2.3.9 2.7 0 .3-.2 1.4-.6 1.4h-.2C3 11 2.4 8.8 2.4 7.2c0-4.4 4-7.1 8.1-7.1z"/></svg>';
		$this->name 			= esc_html__( 'Pinterest', 'tout-social-buttons' );
		$this->pinit 			= '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="20" viewBox="0 0 44.1 20" class="' . esc_attr( $this->get_pinit_classes() ) . '"><path d="M8.21.38C3 .38.31 4.15.31 7.29c0 1.9.72 3.59 2.26 4.22a.38.38 0 0 0 .55-.28l.23-.89a.54.54 0 0 0-.16-.62 3.19 3.19 0 0 1-.73-2.17A5.23 5.23 0 0 1 7.9 2.27c3 0 4.6 1.81 4.6 4.23 0 3.18-1.41 5.87-3.5 5.87a1.71 1.71 0 0 1-1.74-2.13 23.7 23.7 0 0 0 1-3.92 1.48 1.48 0 0 0-1.52-1.65c-1.18 0-2.13 1.22-2.13 2.86A4.25 4.25 0 0 0 5 9.28l-1.42 6a12.4 12.4 0 0 0 0 4.2.15.15 0 0 0 .26.06 11.79 11.79 0 0 0 2-3.61c.14-.49.78-3 .78-3a3.17 3.17 0 0 0 2.7 1.38c3.55 0 6-3.24 6-7.57-.12-3.3-2.9-6.36-7.11-6.36z" /><g><path d="M29.57 15.06a2.7 2.7 0 0 1-1.18.48c-.58 0-.82-.29-.82-.92 0-1 1-3.46 1-4.58a2.16 2.16 0 0 0-2.45-2.37 3.61 3.61 0 0 0-2.57 1.26s.14-.48.19-.67a.29.29 0 0 0-.31-.39h-1.64a.44.44 0 0 0-.49.38l-1.16 4.55c-.38 1.5-1.31 2.75-2.3 2.75-.51 0-.74-.32-.74-.86a20.78 20.78 0 0 1 .66-3.06c.44-1.75.83-3.19.87-3.35a.3.3 0 0 0-.32-.4H16.7a.43.43 0 0 0-.46.37l-.94 3.65a21.4 21.4 0 0 0-.74 3.48 1.83 1.83 0 0 0 2 2.09 3.71 3.71 0 0 0 2.72-1.31l-.17.67c-.06.23 0 .43.28.43h1.66a.4.4 0 0 0 .46-.37c.06-.24 1.3-5.11 1.3-5.11.33-1.31 1.14-2.17 2.28-2.17a.91.91 0 0 1 1 1.05c-.06.76-1 3.51-1 4.72a1.87 1.87 0 0 0 2.06 2.09 3.3 3.3 0 0 0 2.22-.84zM17.76 7.16a1.86 1.86 0 0 0 1.75-1.53 1.22 1.22 0 0 0-1.21-1.51 1.87 1.87 0 0 0-1.76 1.51 1.22 1.22 0 0 0 1.22 1.53z"/></g><g id="Layer_5" data-name="Layer 5"><path d="M42.94 13.93a2.69 2.69 0 0 1-2 1.49.75.75 0 0 1-.79-.86 22.11 22.11 0 0 1 .69-3l.51-2H43a.41.41 0 0 0 .46-.34c.08-.34.23-.93.27-1.09a.28.28 0 0 0-.3-.37H41.8l.79-3.14a.36.36 0 0 0-.46-.43l-1.53.3a.62.62 0 0 0-.51.53l-.68 2.74h-1.34a.41.41 0 0 0-.46.34c-.08.34-.23.93-.27 1.09a.28.28 0 0 0 .3.37H39s-.47 1.8-.85 3.39a8.28 8.28 0 0 1-.57 1.64 2.26 2.26 0 0 1-1.66 1c-.51 0-.74-.32-.74-.86a20.79 20.79 0 0 1 .66-3.06c.44-1.75.83-3.19.87-3.35a.3.3 0 0 0-.32-.4h-1.65a.43.43 0 0 0-.46.37s-.46 1.73-.94 3.65a21.4 21.4 0 0 0-.74 3.48 1.83 1.83 0 0 0 2 2.09 3.22 3.22 0 0 0 1-.17 3.51 3.51 0 0 0 2.12-1.24 1.81 1.81 0 0 0 2 1.29 3.89 3.89 0 0 0 3-1.35z"/><path d="M35.8 7.16a1.86 1.86 0 0 0 1.75-1.53 1.22 1.22 0 0 0-1.22-1.51 1.87 1.87 0 0 0-1.76 1.51 1.22 1.22 0 0 0 1.23 1.53z" id="i"/></g></svg>';
		$this->pin 				= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="' . esc_attr( $this->get_pin_classes() ) . '"><path d="M5 3.61V1.04l8.99-.01-.01 2.58a2.737 2.737 0 0 0-2.16 2.67v.5c.01 1.31.93 2.4 2.17 2.66l-.01 2.58h-3.41l-.01 2.57c0 .6-.47 4.41-1.06 4.41-.6 0-1.08-3.81-1.08-4.41v-2.56L5 12.02l.01-2.58a2.707 2.707 0 0 0 2.15-2.66v-.5c0-1.31-.92-2.41-2.16-2.67z"/></svg>';
		$this->outlined 		= '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="-1 -1 31 31" class="' . esc_attr( $this->get_outlined_classes() ) . '"><path d="M29.45 14.662c0 8.06-6.582 14.594-14.7 14.594-8.118 0-14.7-6.534-14.7-14.594C.05 6.602 6.633.067 14.75.067c8.118 0 14.7 6.534 14.7 14.595" fill="#fff" stroke="#fff"/><path d="M14.733 1.686c-7.217 0-13.068 5.81-13.068 12.976 0 5.497 3.444 10.192 8.305 12.082-.114-1.026-.217-2.6.046-3.722.237-1.012 1.532-6.45 1.532-6.45s-.39-.777-.39-1.926c0-1.804 1.053-3.15 2.364-3.15 1.115 0 1.653.83 1.653 1.827 0 1.113-.713 2.777-1.082 4.32-.308 1.292.652 2.345 1.935 2.345 2.323 0 4.108-2.432 4.108-5.942 0-3.107-2.248-5.28-5.458-5.28-3.72 0-5.9 2.77-5.9 5.632 0 1.115.432 2.31.97 2.96.108.13.124.242.092.373-.1.41-.32 1.293-.363 1.473-.057.237-.19.288-.437.173-1.632-.754-2.653-3.124-2.653-5.027 0-4.094 2.996-7.853 8.635-7.853 4.533 0 8.056 3.208 8.056 7.494 0 4.473-2.84 8.072-6.78 8.072-1.325 0-2.57-.683-2.996-1.49 0 0-.655 2.478-.814 3.085-.295 1.127-1.092 2.54-1.625 3.4 1.223.377 2.523.58 3.87.58 7.217 0 13.068-5.81 13.068-12.975 0-7.167-5.85-12.976-13.067-12.976" fill="#bd081c"/></svg>';

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
	 * Returns the $button_text class variable.
	 *
	 * @since 		1.0.0
	 * @return 		string 		The button text.
	 */
	public function get_button_text() {

		return $this->button_text;

	} // get_button_text()

	/**
	 * Returns the $outlined class variable.
	 *
	 * @since 		1.0.0
	 * @return 		mixed 		The outlined SVG.
	 */
	public function get_outlined() {

		return $this->outlined;

	} // get_outlined()

	/**
	 * Returns the Outlined SVG classes.
	 *
	 * @since 		1.0.0
	 * @return 		string 		$classes 		The classes for the Outlined SVG.
	 */
	protected function get_outlined_classes() {

		$return 	= '';
		$classes[] 	= 'tout-social-button-outlined';

		/**
		 * The tout_social_buttons_outlined_svg_classes filter.
		 *
		 * Allows for changing classes for the Outlined SVG.
		 *
		 * @param 		array 		$classes 		The current classes.
		 * @param 		string 		$id 			The button ID.
		 */
		$classes 	= apply_filters( 'tout_social_buttons_outlined_svg_classes', $classes, $this->id );
		$return 	= implode( ' ', $classes );

		return $return;

	} // get_outlined_classes()

	/**
	 * Returns the Pin SVG classes.
	 *
	 * @since 		1.0.0
	 * @return 		string 		$classes 		The classes for the Pin SVG.
	 */
	protected function get_pin_classes() {

		$return 	= '';
		$classes[] 	= 'tout-social-button-pin';

		/**
		 * The tout_social_buttons_pin_svg_classes filter.
		 *
		 * Allows for changing classes for the Pin SVG.
		 *
		 * @param 		array 		$classes 		The current classes.
		 * @param 		string 		$id 			The button ID.
		 */
		$classes 	= apply_filters( 'tout_social_buttons_pin_svg_classes', $classes, $this->id );
		$return 	= implode( ' ', $classes );

		return $return;

	} // get_pin_classes()

	/**
	 * Returns the $pin class variable.
	 *
	 * @since 		1.0.0
	 * @return 		mixed 		The pin SVG.
	 */
	public function get_pin() {

		return $this->pin;

	} // get_pin()

	/**
	 * Returns the $pinit class variable.
	 *
	 * @since 		1.0.0
	 * @return 		mixed 		The pinit SVG.
	 */
	public function get_pinit() {

		return $this->pinit;

	} // get_pinit()

	/**
	 * Returns the Pin It SVG classes.
	 *
	 * @since 		1.0.0
	 * @return 		string 		$classes 		The classes for the Pin It SVG.
	 */
	protected function get_pinit_classes() {

		$return 	= '';
		$classes[] 	= 'tout-social-button-pinit';

		/**
		 * The tout_social_buttons_pinit_svg_classes filter.
		 *
		 * Allows for changing classes for the Pin It SVG.
		 *
		 * @param 		array 		$classes 		The current classes.
		 * @param 		string 		$id 			The button ID.
		 */
		$classes 	= apply_filters( 'tout_social_buttons_pinit_svg_classes', $classes, $this->id );
		$return 	= implode( ' ', $classes );

		return $return;

	} // get_pinit_classes()

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
