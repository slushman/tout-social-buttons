<?php

/**
 * The buttons added by this plugin.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons/Buttons
 * @author 			slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Buttons;
use ToutSocialButtons\Buttons as Buttons;

class Button_Set {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		//

	} // __construct()

	/**
	 * Registers all the WordPress hooks and filters related to this class.
	 *
	 * @hooked 		init
	 * @since 		1.0.0
	 */
	public function hooks() {

		add_filter( 'tout_social_buttons_admin_buttons', array( $this, 'add_buttons' ), 5, 1 );
		add_filter( 'tout_social_buttons_frontend_buttons', array( $this, 'add_buttons' ), 5, 1 );
		add_filter( 'tout_social_buttons_quote_buttons', array( $this, 'add_quote_buttons' ), 10, 1 );

	} // hooks()

	/**
	 * Add buttons to the button set, along with an
	 * instance of the button class.
	 *
	 * @hooked 		tout_social_buttons_admin_buttons
	 * @hooked 		tout_social_buttons_frontend_buttons
	 * @since 		1.0.0
	 */
	public function add_buttons( $buttons ) {

		$buttons['email'] 		= new Buttons\Email();
		$buttons['facebook'] 	= new Buttons\Facebook();
		$buttons['google'] 		= new Buttons\Google();
		$buttons['linkedin'] 	= new Buttons\Linkedin();
		$buttons['pinterest'] 	= new Buttons\Pinterest();
		$buttons['stumbleupon'] = new Buttons\Stumbleupon();
		$buttons['tumblr'] 		= new Buttons\tumblr();
		$buttons['twitter'] 	= new Buttons\Twitter();

		//wp_die( print_r( $buttons ) );

		return $buttons;

	} // add_buttons()

	/**
	 * Add buttons to the wuote button set, along with an
	 * instance of each button class.
	 *
	 * @hooked 		tout_social_buttons_quote_buttons
	 * @since 		1.0.0
	 */
	public function add_quote_buttons( $buttons ) {

		$buttons['email'] 		= new Buttons\Email();
		$buttons['linkedin'] 	= new Buttons\Linkedin();
		$buttons['tumblr'] 		= new Buttons\tumblr();
		$buttons['twitter'] 	= new Buttons\Twitter();

		return $buttons;

	} // add_quote_buttons()

} // class
