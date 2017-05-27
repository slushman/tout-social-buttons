<?php

/**
 * Define the functionality for the button set.
 *
 * These methods are used in the admin and for public-facing code
 * for the set of sharing buttons.
 *
 * @link 		https://www.slushman.com
 * @since 		1.0.0
 *
 * @package		Tout_Buttons
 * @subpackage	Tout_Buttons/includes
 * @author 		Slushman <chris@slushman.com>
 */
class Tout_Buttons_Buttons {

	/**
	 * The plugin settings array.
	 * @var 	array 		$settings 			The plugin settings.
	 */
	var $settings;

	/**
	 * The class constructor.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_settings();

	} // __construct()

	/**
	 * Returns an array of the buttons.
	 *
	 * @return 		array 			The buttons.
	 */
	public function get_button_array() {

		$return['facebook'] = esc_html__( 'Facebook', 'tout-buttons' );

		/*$buttons 	= $this->settings['button-order'];
		$list 		= explode( ',', $buttons );
		$return		= array();

		foreach ( $list as $button ) {

			$name = $this->get_name( $button );

			$return[$button] = $name;

		}*/

		return $return;

	} // get_button_array()

	/**
	 * Returns the button label based on the plugin setting.
	 *
	 * @exits 		If $lower parameter is empty.
	 * @since 		1.0.0
	 * @param 		string 				$lower 			The lowercase name of the button.
	 * @return 		string|mixed						The label text or SVG icon.
	 */
	public function get_label( $lower ) {

		if ( empty( $lower ) ) { return; }

		if ( 'icon' === $this->options['button-type'] ) {

			return $this->get_svg( $lower );

		} else {

			$name = $this->get_name( $lower );

			return '<span class="tout-btn-text">' . $name . '</span>';

		}

	} // get_label()

	protected function get_name( $lower ) {

		if ( empty( $lower ) ) { return; }

		$names['baidu'] 		= esc_html__( 'Baidu', 'tout-buttons' );
		$names['buffer'] 		= esc_html__( 'Buffer', 'tout-buttons' );
		$names['delicious'] 	= esc_html__( 'Delicious', 'tout-buttons' );
		$names['digg'] 			= esc_html__( 'Digg', 'tout-buttons' );
		$names['douban'] 		= esc_html__( 'Douban', 'tout-buttons' );
		$names['email'] 		= esc_html__( 'Email', 'tout-buttons' );
		$names['evernote'] 		= esc_html__( 'Evernote', 'tout-buttons' );
		$names['facebook'] 		= esc_html__( 'Facebook', 'tout-buttons' );
		$names['google'] 		= esc_html__( 'Google', 'tout-buttons' );
		$names['linkedin'] 		= esc_html__( 'LinkedIn', 'tout-buttons' );
		$names['pinterest'] 	= esc_html__( 'Pinterest', 'tout-buttons' );
		$names['qzone'] 		= esc_html__( 'QZone', 'tout-buttons' );
		$names['reddit'] 		= esc_html__( 'Reddit', 'tout-buttons' );
		$names['renren'] 		= esc_html__( 'Renren', 'tout-buttons' );
		$names['stumbleupon'] 	= esc_html__( 'Stumbleupon', 'tout-buttons' );
		$names['tumblr'] 		= esc_html__( 'tumblr', 'tout-buttons' );
		$names['twitter'] 		= esc_html__( 'Twitter', 'tout-buttons' );
		$names['vk'] 			= esc_html__( 'VK', 'tout-buttons' );
		$names['weibo'] 		= esc_html__( 'Weibo', 'tout-buttons' );
		$names['xing'] 			= esc_html__( 'Xing', 'tout-buttons' );

		return $names[$lower];

	} // get_name()

	/**
	 * Returns the screen reader text based on the plugin setting.
	 *
	 * @exits 		If the $button parameter is empty.
	 * @since 		1.0.0
	 * @param 		string 		$button 		The name of the button.
	 * @return 		string 						The screen text.
	 */
	public function get_screen_reader_text( $button ) {

		if ( empty( $button ) ) { return; }

		$return 		= '';

		$text['icon'] 	= esc_html__( 'Share on', 'tout-buttons' );
		$text['text'] 	= sprintf( esc_html__( 'Share on %s', 'tout-buttons' ), $button );

		if ( array_key_exists( $this->options['button-type'], $text ) ) {

			$return = $text[$this->options['button-type']];

		}

		return $return;

	} // get_screen_reader_text()

	/**
	 * Returns a button SVG or an array of button SVGs.
	 *
	 * @param 		string 		$button 		The button to return. Optional.
	 * @return 		string|array 				Either a button SVG or an array of button SVGs.
	 */
	public function get_svg( $button = '' ) {

		$buttons = array();

		$buttons['baidu'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="baidu"><path d="M17.1 11.9c-2.4.1-2.5-1.6-2.5-2.8s.3-3 2.2-3 2.4 1.9 2.4 2.5c.1.6.3 3.2-2.1 3.3zm-4.3-5.5c-1.6-.2-2-1.6-1.8-3.1.1-1.2 1.6-3 2.7-2.7s2.2 1.8 2 3c-.2 1.3-1.2 3-2.9 2.8zm0 3.6c1.5 2.1 4 4 4 4s1.9 1.4.7 4.2c-1.2 2.8-5.6 1.3-5.6 1.3s-1.6-.5-3.5-.1-3.5.3-3.5.3-2.2.1-2.8-2.7c-.6-2.7 2.2-4.2 2.4-4.5.2-.3 1.7-1.2 2.6-2.8.9-1.5 3.7-2.7 5.7.3zM7.6 6.2c-1.2 0-2.2-1.4-2.2-3.1S6.4 0 7.6 0s2.2 1.4 2.2 3.1-1 3.1-2.2 3.1zm-4.1 4.3c-2.2.5-3-2-2.8-3.2 0 0 .3-2.5 2-2.7C4.1 4.5 5.1 6 5.3 6.9c.1.6.4 3.2-1.8 3.6z"/></svg>';
		$buttons['buffer'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="buffer"><path d="M9.7.5c.3 0 .6 0 .9.1 2.8 1.3 5.6 2.6 8.5 4 .1.1.2.1.2.3 0 .2-.1.2-.3.3-2.8 1.3-5.7 2.6-8.5 4-.4.1-.8.1-1.2 0-2.8-1.3-5.7-2.6-8.5-4 0-.1-.1-.2-.1-.4 0-.1.1-.2.3-.3C3.7 3.3 6.4 2 9.1.7c.2-.1.4-.2.6-.2zM2.8 8.9c.3-.1.7 0 1 .1 1.8.9 3.7 1.7 5.5 2.6.4.2.9.2 1.3.1 1.9-.9 3.7-1.7 5.6-2.6.4-.2 1-.2 1.4 0 .5.2 1 .5 1.5.7.1.1.3.2.2.3 0 .1-.2.2-.3.3-2.8 1.3-5.6 2.6-8.5 3.9-.4.2-.9.2-1.4-.1-2.8-1.3-5.5-2.6-8.3-3.9-.1-.1-.3-.1-.3-.3 0-.1.1-.2.2-.3l1.2-.6c.4 0 .6-.2.9-.2z"/><path d="M2.9 14c.3 0 .6 0 .9.2 1.8.8 3.6 1.7 5.5 2.5.4.2.9.2 1.3.1 1.9-.9 3.9-1.8 5.8-2.7.4-.2.9-.1 1.3.1.5.2 1 .5 1.5.7.1.1.2.2.1.4-.1.1-.3.2-.5.3-2.7 1.3-5.4 2.5-8.1 3.8-.4.2-.9.2-1.3.1-2.8-1.3-5.5-2.6-8.3-3.9-.2-.1-.3-.1-.4-.3-.1-.1 0-.3.2-.3.4-.2.8-.4 1.3-.6.2-.2.4-.4.7-.4z"/></svg>';
		$buttons['delicious'] 	= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="delicious"><path d="M19.5 15.9c0 2-1.6 3.6-3.6 3.6H4.1c-2 0-3.6-1.6-3.6-3.6V4.1C.5 2.1 2.1.5 4.1.5H16c2 0 3.6 1.6 3.6 3.6v11.8zm-.8-5.9H10V1.3H4.1c-1.5 0-2.8 1.2-2.8 2.8V10H10v8.7h5.9c1.5 0 2.8-1.2 2.8-2.8V10z"/></svg>';
		$buttons['digg'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="digg"><path d="M5.2 4.1v9.5H.1V6.8h3.2V4.1h1.9zM3.3 8.4H2.1V12h1.2V8.4zM6 6h2V4H6v2zm0 7.6h2V6.8H6v6.8zm8-6.8v9.1H8.8v-1.6H12v-.8H8.8V6.8H14zm-2 1.6h-1.2V12H12V8.4zm7.9-1.6v9.1h-5.1v-1.6H18v-.8h-3.2V6.8h5.1zm-2 1.6h-1.2V12h1.2V8.4z"/></svg>';
		$buttons['douban'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="douban"><path d="M.2 19.4v-1.8h4.9l-1.5-4.8H1.9l.2-8.6h15.8v8.5h-1.7l-1.3 4.8 4.8-.2.1 2H.2v.1zm7.9-1.8h3.6l1.7-4.8h-7l1.7 4.8zm6.7-10.9H5.2l-.1 3.7h9.7V6.7zM.8.6H19v1.8H.8V.6z"/></svg>';
		$buttons['email'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="email"><path d="M19 14.5v-9q0-.62-.44-1.06T17.5 4H3.49q-.62 0-1.06.44T1.99 5.5v9q0 .62.44 1.06t1.06.44H17.5q.62 0 1.06-.44T19 14.5zm-1.31-9.11q.15.15.175.325t-.04.295-.165.22L13.6 9.95l3.9 4.06q.26.3.06.51-.09.11-.28.12t-.28-.07l-4.37-3.73-2.14 1.95-2.13-1.95-4.37 3.73q-.09.08-.28.07t-.28-.12q-.2-.21.06-.51l3.9-4.06-4.06-3.72q-.1-.1-.165-.22t-.04-.295.175-.325q.4-.4.95.07l6.24 5.04 6.25-5.04q.55-.47.95-.07z"/></svg>';
		$buttons['evernote'] 	= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="evernote"><path d="M3.4 4h1.8c.1 0 .2-.1.2-.2v-2c0-.4.1-.7.2-.9l.1-.1-3.6 3.5c.1 0 .2-.1.2-.1.3-.1.7-.2 1.1-.2zm14.3-.4c-.1-.8-.6-1.2-1-1.3-.5-.2-1.4-.3-2.5-.5-.9-.1-2-.1-2.7-.1-.1-.5-.5-1-.9-1.2C9.5.1 7.7.2 7.3.3c-.4.1-.8.3-1 .6-.1.3-.2.5-.2.9v2.1c0 .4-.3.7-.7.7H3.5c-.4 0-.7.1-.9.2-.2 0-.4.2-.5.3-.2.3-.3.8-.3 1.2 0 0 0 .3.1 1 .1.5.6 4 1.1 5.1.2.4.3.6.7.8.9.4 2.9.8 3.9.9.9.1 1.5.4 1.9-.4 0 0 .1-.2.2-.5.3-.9.4-1.8.4-2.4 0-.1.1-.1.1 0 0 .4-.1 1.9 1.1 2.3.4.2 1.4.3 2.3.4.9.1 1.5.4 1.5 2.6 0 1.3-.3 1.5-1.7 1.5-1.2 0-1.6 0-1.6-.9 0-.8.8-.7 1.3-.7.2 0 .1-.2.1-.7 0-.5.3-.7 0-.7-1.9-.1-3.1 0-3.1 2.4 0 2.2.8 2.6 3.6 2.6 2.1 0 2.9-.1 3.8-2.8.2-.5.6-2.2.9-5-.1-1.5-.4-6.8-.7-8.2zM14 9.5h-.8c.1-.5.3-1.2 1.1-1.2.9 0 1 .9 1 1.4-.3-.1-.8-.2-1.3-.2z"/></svg>';
		$buttons['facebook'] 	= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="facebook"><path d="M8.46 18h2.93v-7.3h2.45l.37-2.84h-2.82V6.04q0-.69.295-1.035T12.8 4.66h1.51V2.11Q13.36 2 12.12 2q-1.67 0-2.665.985T8.46 5.76v2.1H6v2.84h2.46V18z"/></svg>';
		$buttons['google'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="googleplus"><path d="M2.8 4.9c2.3-1.7 5.7-1.5 7.8.5-.6.5-1.1 1.1-1.7 1.6-1.6-1.4-4.2-1.2-5.5.4-1.6 1.8-1.1 4.9 1 6.1 2 1.2 5 .2 5.5-2.2H6.3V9.1h6c.2 1.8-.2 3.8-1.4 5.2-1.5 1.8-4.2 2.4-6.4 1.7-2.1-.6-3.9-2.5-4.3-4.7-.5-2.4.5-5 2.6-6.4zM16.3 7.3h1.8v1.8h1.8v1.8h-1.8v1.8h-1.8v-1.8h-1.8V9.1h1.8V7.3z"/></svg>';
		$buttons['linkedIn'] 	= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="linkedin"><path d="M2.5 5C1 5 .1 4 .1 2.8.1 1.6 1.1.6 2.5.6c1.5 0 2.4 1 2.4 2.2C4.9 4 4 5 2.5 5zm2.1 14.4H.4V6.7h4.2v12.7zm15.3 0h-4.2v-6.8c0-1.7-.6-2.9-2.1-2.9-1.2 0-1.9.8-2.2 1.5-.1.3-.1.7-.1 1v7.1H6.9c.1-11.4 0-12.6 0-12.6h4.2v1.9c.6-.9 1.6-2.1 3.8-2.1 2.8 0 4.9 1.8 4.9 5.7v7.2z"/></svg>';
		$buttons['pinterest'] 	= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="pinterest"><path d="M10.5.1c3.7 0 7.1 2.6 7.1 6.5 0 3.7-1.9 7.8-6.1 7.8-1 0-2.2-.5-2.7-1.4-.9 3.6-.8 4.1-2.8 6.8l-.2.1-.1-.1c-.1-.7-.2-1.5-.2-2.2 0-2.4 1.1-5.9 1.7-8.3-.3-.6-.4-1.3-.4-2 0-1.2.8-2.7 2.2-2.7 1 0 1.5.8 1.5 1.7 0 1.5-1 3-1 4.5 0 1 .8 1.7 1.8 1.7 2.7 0 3.6-3.9 3.6-6 0-2.8-2-4.3-4.7-4.3C7 2.1 4.6 4.3 4.6 7.5c0 1.5.9 2.3.9 2.7 0 .3-.2 1.4-.6 1.4h-.2C3 11 2.4 8.8 2.4 7.2c0-4.4 4-7.1 8.1-7.1z"/></svg>';
		$buttons['qzone'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="qzone"><path d="M14.6 12.4l.5 1.5c-1.7-.2-4.2-.4-6.4-.8-.1-.3 6.1-4.6 6-4.9-5.5-.9-9.6 0-9.6 0l6.7.9s-6.3 4.2-6.4 4.6c2.8.5 7.3.5 9.8.4.6 1.9 1.4 4.6.9 4.9-1.2.6-6.3-3.3-6.3-3.3s-5 3.6-5.8 3.2c-1.2-.6.5-6.6.5-6.6S-.1 8.6.2 7.7c.3-.9 7-1.2 7-1.2S9.1 1.2 10 1s3 5.2 3 5.2 6.4.7 6.8 1.3c.4.5-5.2 4.9-5.2 4.9zM17 14s-.7 0-1.9.1c0-.1-.1-.2-.1-.2 1.3.1 2 .1 2 .1z"/></svg>';
		$buttons['reddit'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="reddit"><path d="M19.9 9.8c0-1.3-1-2.3-2.3-2.3-.6 0-1.1.2-1.5.6-1.5-1-3.5-1.6-5.7-1.7l1.1-3.7 3.3.7c0 1 .8 1.9 1.9 1.9s1.9-.8 1.9-1.9-.8-1.9-1.9-1.9c-.8 0-1.4.5-1.7 1.1L11.5 2c-.2 0-.4.1-.4.2L9.8 6.4c-2.2 0-4.4.6-6 1.7-.4-.4-.9-.6-1.5-.6C1 7.5 0 8.5 0 9.8c0 .8.4 1.5 1.1 1.9 0 .2-.1.4-.1.6 0 1.6.9 3.1 2.7 4.3 1.7 1.1 3.9 1.7 6.2 1.7 2.4 0 4.6-.6 6.2-1.7 1.7-1.1 2.7-2.6 2.7-4.3 0-.2 0-.4-.1-.6.8-.4 1.2-1.1 1.2-1.9zm-3.1-7.5c.6 0 1.2.5 1.2 1.2 0 .6-.5 1.2-1.2 1.2-.6 0-1.2-.5-1.2-1.2 0-.6.6-1.2 1.2-1.2zM.8 9.8c0-.9.7-1.6 1.6-1.6.3 0 .6.1.9.3-1 .7-1.6 1.6-2 2.5-.3-.3-.5-.7-.5-1.2zm9.2 7.9c-4.5 0-8.2-2.4-8.2-5.3V12c0-.2.1-.5.1-.7.4-.8.9-1.6 1.8-2.3.2-.1.4-.3.6-.4 1.4-.9 3.5-1.5 5.7-1.5s4.3.6 5.7 1.5c.2.1.4.3.6.4.8.6 1.4 1.4 1.7 2.3.1.2.1.5.1.7v.4c.1 2.9-3.6 5.3-8.1 5.3zm8.7-6.7c-.3-.9-1-1.8-1.9-2.5.2-.2.6-.3.9-.3.9 0 1.6.7 1.6 1.6-.1.5-.3.9-.6 1.2z"/><path d="M12.7 14.7c-.7.6-1.5.8-2.7.8-1.2 0-2-.2-2.7-.8-.2-.1-.4-.1-.5.1-.1.2-.1.4.1.5.8.7 1.8 1 3.2 1s2.4-.3 3.2-1c.2-.1.2-.4.1-.5-.3-.2-.5-.3-.7-.1zM8.4 11.3c0-.7-.6-1.3-1.4-1.3-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3.8.1 1.4-.5 1.4-1.3zM13 10c-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3.7 0 1.3-.6 1.3-1.3.1-.7-.5-1.3-1.3-1.3z"/></svg>';
		$buttons['renren'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="renren"><path d="M.4 9.9c0-1.6.3-3 1-4.4S3.1 3 4.3 2.1 6.9.6 8.4.4v6.1c0 2.1-.5 4-1.6 5.7-1.1 1.7-2.4 3-4.1 3.8C1.2 14.3.4 12.3.4 9.9zm5 8.4c1.1-.7 2.1-1.6 2.9-2.6.8-1 1.4-2.1 1.6-3.3.3 1.2.8 2.3 1.7 3.3.8 1 1.8 1.9 2.9 2.6-1.4.8-3 1.2-4.6 1.2-1.6 0-3.1-.4-4.5-1.2zm6.2-11.7V.5c1.5.2 2.8.8 4.1 1.7s2.2 2 2.9 3.4 1 2.8 1 4.4c0 2.3-.8 4.4-2.3 6.2-1.7-.8-3.1-2.1-4.1-3.8s-1.6-3.7-1.6-5.8z"/></svg>';
		$buttons['stumbleupon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="stumbleupon"><path d="M11.1 6.9c0-.6-.5-1.1-1.1-1.1s-1.1.5-1.1 1.1v6.3c0 2.4-2 4.4-4.4 4.4-2.4 0-4.4-2-4.4-4.4v-2.7h3.4v2.7c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1V6.7c0-2.4 2-4.3 4.4-4.3 2.4 0 4.4 1.9 4.4 4.3v1.4l-2 .6-1.4-.6V6.9zm8.8 3.5v2.7c0 2.4-2 4.4-4.4 4.4-2.4 0-4.4-2-4.4-4.4v-2.8l1.4.6 2-.6v2.8c0 .6.5 1 1.1 1 .6 0 1.1-.5 1.1-1v-2.8h3.2z"/></svg>';
		$buttons['tumblr'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tumblr"><path d="M15.7 18.7c-.4.5-2 1.1-3.4 1.2-4.3.1-5.9-3.1-5.9-5.3V8.1h-2V5.6c3-1.1 3.7-3.8 3.9-5.3 0-.1.1-.1.1-.1h2.9v5h4v3h-4v6.1c0 .8.3 2 1.9 1.9.5 0 1.2-.2 1.6-.3l.9 2.8z"/></svg>';
		$buttons['twitter'] 	= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="twitter"><path d="M18.94 4.46q-.75 1.12-1.83 1.9.01.15.01.47 0 1.47-.43 2.945T15.38 12.6t-2.1 2.39-2.93 1.66-3.66.62q-3.04 0-5.63-1.65.48.05.88.05 2.55 0 4.55-1.57-1.19-.02-2.125-.73T3.07 11.55q.39.07.69.07.47 0 .96-.13-1.27-.26-2.105-1.27T1.78 7.89v-.04q.8.43 1.66.46-.75-.51-1.19-1.315T1.81 5.25q0-1 .5-1.84Q3.69 5.1 5.655 6.115T9.87 7.24q-.1-.45-.1-.84 0-1.51 1.075-2.585T13.44 2.74q1.6 0 2.68 1.16 1.26-.26 2.33-.89-.43 1.32-1.62 2.02 1.07-.11 2.11-.57z"/></svg>';
		$buttons['vk'] 			= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="vk"><path d="M18.3 8.2c-2 2.7-2.2 2.4-.6 3.9s1.9 2.2 2 2.3c0 0 .7 1.2-.7 1.2h-2.6c-.6.1-1.3-.4-1.3-.4-1-.7-1.9-2.4-2.6-2.2 0 0-.7.2-.7 1.8 0 .3-.2.5-.2.5s-.2.2-.5.2H9.8c-2.6.2-4.9-2.2-4.9-2.2S2.4 10.7.2 5.5C.1 5.2.2 5 .2 5s.2-.2.6-.2h2.8c.3.1.4.2.4.2s.2.1.2.3c.5 1.2 1.1 2.2 1.1 2.2C6.3 9.6 7 10 7.4 9.8c0 0 .5-.3.4-2.9 0-.9-.3-1.4-.3-1.4-.1-.2-.6-.3-.8-.3-.2 0 .1-.4.4-.6.5-.2 1.4-.3 2.5-.2.8 0 1.1.1 1.4.1 1 .2.6 1.1.6 3.3 0 .7-.1 1.7.4 2 .2.1.8 0 2.1-2.2 0 0 .6-1.1 1.1-2.3.1-.3.3-.3.3-.3s.2-.1.4-.1h3c.9-.1 1 .3 1 .3.1.4-.4 1.4-1.6 3z"/></svg>';
		$buttons['weibo'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="weibo"><path d="M19.6 8.8c-.1.4-.6.6-1 .5-.4-.1-.6-.6-.5-1 .4-1.2.1-2.6-.8-3.6S15 3.3 13.8 3.6c-.3.1-.7-.2-.8-.6-.1-.4.2-.8.6-.9 1.8-.4 3.7.2 5 1.6 1.2 1.5 1.6 3.4 1 5.1zM14.4 6c-.4.1-.7-.1-.8-.5-.1-.4.1-.7.5-.8.9-.2 1.8.1 2.4.8.6.7.8 1.7.5 2.5-.1.3-.5.5-.8.4-.3-.1-.5-.5-.4-.8.1-.4 0-.9-.3-1.2-.2-.4-.7-.5-1.1-.4zm.3 1.2c.3.5.3 1.2 0 2-.1.4 0 .4.3.5 1.1.4 2.4 1.2 2.4 2.7 0 2.5-3.6 5.6-9 5.6-4.1 0-8.3-2-8.3-5.3C.1 11 1.2 9 3 7.1c2.5-2.5 5.4-3.6 6.5-2.5.5.5.6 1.4.3 2.4-.2.5.5.2.5.2 2-.8 3.7-.9 4.4 0zm-.7 5.2c-.2-2.2-3-3.6-6.3-3.3-3.3.3-5.8 2.3-5.5 4.5.2 2.2 3 3.6 6.3 3.3 3.2-.4 5.7-2.4 5.5-4.5zm-7.7 3.5c-1.6-.5-2.2-2.1-1.6-3.5.7-1.4 2.4-2.2 4-1.7 1.6.4 2.4 1.9 1.8 3.4-.6 1.5-2.6 2.3-4.2 1.8zm.9-2.9c-.5-.2-1.2 0-1.5.5-.3.5-.2 1.1.3 1.3.5.2 1.2 0 1.5-.5.4-.5.2-1.1-.3-1.3zm1.2-.5c-.2-.1-.4 0-.6.2-.1.2 0 .4.1.5.2.1.5 0 .6-.2.2-.2.1-.5-.1-.5z"/></svg>';
		$buttons['xing'] 		= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="xing"><path d="M5.6 13.4c-.1.3-.3.6-.8.6H2c-.2 0-.3-.1-.4-.2-.1-.1-.1-.3 0-.4l3-5.4-1.9-3.4c-.1-.2-.1-.3 0-.4.1-.2.2-.2.4-.2H6c.4 0 .6.3.8.5l2 3.4s-.2.3-3.2 5.5zM18.4.7l-6.3 11.2 4 7.4c.1.2.1.3 0 .4-.1.1-.2.2-.4.2h-2.9c-.4 0-.7-.3-.8-.5l-4-7.5s.2-.4 6.4-11.3c.2-.3.3-.5.8-.5H18c.2 0 .3.1.4.2.1.1.1.2 0 .4z"/></svg>';

		/**
		 * The tout_buttons_buttons_list filter.
		 */
		$buttons = apply_filters( 'tout_buttons_buttons_list', $buttons );

		if ( empty( $button ) ) {

			return $buttons;

		}

		return $buttons[$button];

	} // get_svg()

	/**
	 * Sets the class variable $settings with the plugin settings.
	 *
	 * @since 		1.0.0
	 */
	public function set_settings() {

		$this->settings = get_option( TOUT_BUTTONS_SETTINGS );

	} // set_settings()

} // class
