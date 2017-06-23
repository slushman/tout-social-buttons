<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 *
 * @package 		Tout_Buttons
 * @subpackage 		Tout_Buttons/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package 		Tout_Buttons
 * @subpackage 		Tout_Buttons/public
 * @author 			Slushman <chris@slushman.com>
 */
class Tout_Buttons_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The plugin settings.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$settings 		The plugin settings.
	 */
	private $settings;

	/**
	 * Tout_Buttons_Display object.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		Tout_Buttons_Display 		$shared 		Tout_Buttons_Display object.
	 */
	private $shared;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string    $plugin_name       The name of the plugin.
	 * @param 		string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->set_settings();
		$this->set_shared();

	} // __construct()

	/**
	 * Adds the tout buttons after the post content.
	 *
	 * @since 		1.0.0
	 * @param 		mixed 		$content 		The current content.
	 * @return 		mixed 						The content plus the tout buttons.
	 */
	public function add_buttons_to_content( $content ) {

		global $wp_current_filter;

		if ( empty( $content ) ) { return $content; }
		if ( is_preview() ) { return $content; }
		if ( is_home() ) { return $content; }
		if ( is_front_page() ) { return $content; }
		if ( in_array( 'get_the_excerpt', (array) $wp_current_filter ) ) { return $content; }
		if ( ! is_main_query() ) { return $content; }
		if ( 0 === $this->settings['auto-post'] ) { return $content; }

		return $content . $this->display_buttons();

	} // add_buttons_to_content()

	/**
	 * Includes the tout buttons partial file inside an output buffer.
	 *
	 * @since 		1.0.0
	 * @return 		mixed 						The tout buttons partial file.
	 */
	public function display_buttons() {

		ob_start();

		$buttons = $this->get_buttons();

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/tout-buttons-public-display.php' );

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // display_buttons()

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tout-buttons-public.css', array(), $this->version, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tout-buttons-public.js', array( 'jquery' ), $this->version, false );

	} // enqueue_scripts()

	/**
	 * Gets the buttons, then filters out the ones that are not selected in the admin.
	 *
	 * @since 		1.0.0
	 * @return 		array 		The selected buttons.
	 */
	protected function get_buttons() {

		$buttons = $this->shared->get_button_array();


		foreach ( $buttons as $key => $button ) {

			if ( 1 !== $this->settings['button-' . $key] ) {

				unset( $buttons[$key] );

			}

		}

		return $buttons;

	} // get_buttons()

	/**
	 * Returns the classes for button.
	 *
	 * Sets a blank array. Then adds the base class.
	 * Then adds a class specific to that button.
	 * Implodes the array with a space between each element.
	 *
	 * @exits 		If $lower is empty or not a string.
	 * @since 		1.0.0
	 * @param 		string 		$lower 		The button name - all lowercase.
	 * @return 		string 					The classes.
	 */
	protected function get_button_class( $lower ) {

		if ( empty( $lower ) || ! is_string( $lower ) ) { return ''; }

		$lower 		= strtolower( $lower );
		$class 		= array();

		$class[]	= 'tout-button';
		$class[]	= 'tout-button-' . $lower;

		$class 		= implode( ' ', $class );

		return $class;

	} // get_button_class()

	/**
	 * Returns the URL for the selected button.
	 *
	 * @exits 		If $lower is empty or not a string.
	 * @since 		1.0.0
	 * @param 		string 		$lower 		The button name - all lowercase.
	 * @return 		string 					The sharing URL.
	 */
	protected function get_url( $lower ) {

		if ( empty( $lower ) || ! is_string( $lower ) ) { return ''; }

		$return 	= '';
		$lower 		= strtolower( $lower );
		$title 		= urlencode( get_the_title() );
		$excerpt 	= urlencode( get_the_excerpt() );
		$link 		= urlencode( get_permalink() );
		$image 		= urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) );
		$urls 		= array();

		// Baidu
		$urls['baidu']['args']['buttontype'] 		= 'small';
		$urls['baidu']['args']['cb'] 				= 'bdShare.ajax._callbacks.bd4bb141b';
		$urls['baidu']['args']['index'] 			= $link;
		$urls['baidu']['base_url'] 					= 'http://like.baidu.com/set';

		// Buffer
		$urls['buffer']['args']['url'] 				= $link;
		$urls['buffer']['args']['text'] 			= $title;
		$urls['buffer']['base_url'] 				= 'http://bufferapp.com/add';

		// Digg
		$urls['digg']['args']['url'] 				= $link;
		$urls['digg']['args']['title'] 				= $title;
		$urls['digg']['base_url'] 					= 'http://digg.com/submit';

		// Douban
		$urls['douban']['args']['url'] 				= $link;
		$urls['douban']['args']['title'] 			= $title;
		$urls['douban']['base_url'] 				= 'http://www.douban.com/recommend/';

		// Email
		$urls['email']['args']['subject'] 			= rawurlencode( get_the_title() );
		$urls['email']['args']['body'] 				= wp_strip_all_tags( get_the_excerpt() ) . '%0A%0A' . get_permalink();
		$urls['email']['base_url'] 					= 'mailto:';

		// Evernote
		$urls['evernote']['args']['url'] 			= $link;
		$urls['evernote']['args']['title'] 			= $title;
		$urls['evernote']['base_url'] 				= 'https://www.evernote.com/clip.action';

		// Facebook
		$urls['facebook']['args']['u'] 				= $link;
		$urls['facebook']['base_url'] 				= 'https://www.facebook.com/sharer/sharer.php';

		// Google+
		$urls['google']['args']['url'] 				= $link;
		$urls['google']['base_url'] 				= 'https://plus.google.com/share';

		// LinkedIn
		$urls['linkedin']['args']['mini'] 			= 'true';
		$urls['linkedin']['args']['url'] 			= $link;
		$urls['linkedin']['args']['source'] 		= $link;
		$urls['linkedin']['args']['summary'] 		= $excerpt;
		$urls['linkedin']['args']['title'] 			= $title;
		$urls['linkedin']['base_url'] 				= 'https://www.linkedin.com/shareArticle';

		// Pinterest
		$urls['pinterest']['args']['url'] 			= $link;
		$urls['pinterest']['args']['description'] 	= $excerpt;
		$urls['pinterest']['args']['media'] 		= $image;
		$urls['pinterest']['base_url'] 				= 'https://pinterest.com/pin/create/button/';

		// QZone
		$urls['qzone']['args']['url'] 				= $link;
		$urls['qzone']['args']['title'] 			= $title;
		$urls['qzone']['args']['summary'] 			= $excerpt;
		$urls['qzone']['base_url'] 					= 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey';

		// Reddit
		$urls['reddit']['args']['url'] 				= $link;
		$urls['reddit']['args']['title'] 			= $title;
		$urls['reddit']['base_url'] 				= 'http://www.reddit.com/submit';

		// Renren
		$urls['renren']['args']['link'] 			= $link;
		$urls['renren']['args']['title'] 			= $title;
		$urls['renren']['base_url'] 				= 'http://share.renren.com/share/buttonshare.do';

		// Stumbleupon
		$urls['stumbleupon']['args']['url'] 		= $link;
		$urls['stumbleupon']['args']['title'] 		= $title;
		$urls['stumbleupon']['base_url'] 			= 'http://www.stumbleupon.com/submit';

		// tumblr
		$urls['tumblr']['args']['canonicalUrl'] 	= $link;
		$urls['tumblr']['args']['title'] 			= $title;
		$urls['tumblr']['args']['content'] 			= $excerpt;

		if ( ! empty( $this->settings['account-tumblr'] ) ) {

			$urls['tumblr']['args']['show-via'] 	= $this->settings['account-tumblr'];

		}

		$urls['tumblr']['base_url'] 				= 'https://www.tumblr.com/widgets/share/tool';

		// Twitter
		$urls['twitter']['args']['url'] 			= $link;
		$urls['twitter']['args']['text'] 			= $title;

		if ( ! empty( $this->settings['account-twitter'] ) ) {

			$urls['tumblr']['args']['via'] 			= $this->settings['account-twitter'];

		}

		$urls['twitter']['base_url'] 				= 'https://twitter.com/intent/tweet';

		// VK
		$urls['vk']['args']['url'] 					= $link;
		$urls['vk']['args']['title'] 				= $title;
		$urls['vk']['args']['description'] 			= $excerpt;
		$urls['vk']['args']['image'] 				= $image;
		$urls['vk']['args']['noparse'] 				= true;
		$urls['vk']['base_url'] 					= 'https://vk.com/share.php';

		// Weibo
		$urls['weibo']['args']['url'] 				= $link;
		$urls['weibo']['args']['title'] 			= $title;
		$urls['weibo']['args']['appkey'] 			= '';
		$urls['weibo']['args']['pic'] 				= $image;
		$urls['weibo']['args']['ralateUid'] 		= '';
		$urls['weibo']['args']['language'] 			= 'zh_cn';
		$urls['weibo']['base_url'] 					= 'http://service.weibo.com/share/share.php';

		// Xing
		$urls['xing']['args']['url'] 				= $link;
		$urls['xing']['args']['op'] 				= 'share;';
		$urls['xing']['args']['sc_p'] 				= 'xing-share;';
		$urls['xing']['base_url'] 					= 'https://www.xing-share.com/app/user';

		$return = esc_url( add_query_arg( $urls[$lower]['args'], $urls[$lower]['base_url'] ) );

		return $return;

	} // get_url()

	public function register_shortcode() {

		add_shortcode( 'toutbuttons', array( $this, 'shortcode' ) );

	} // register_shortcode()

	/**
	 * Sets the class variable $settings with the plugin settings.
	 *
	 * @since 		1.0.0
	 */
	public function set_settings() {

		$this->settings = get_option( TOUT_BUTTONS_SETTINGS );

	} // set_settings()

	/**
	 * Sets the class variable $shared with an instance of the Tout_Buttons_Display class.
	 *
	 * @since 		1.0.0
	 */
	protected function set_shared() {

		$this->shared = new Tout_Buttons_Display();

	} // set_shared()

	/**
	 * Handles the output of the shortcode.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$atts 			The shortcode attributes.
	 * @param 		mixed 		$content 		Optional. The post content.
	 * @return 		mixed 						The shortcode output.
	 */
	public function shortcode( $atts = array(), $content = null ) {

		$defaults[''] 	= '';

		$args 			= shortcode_atts( $defaults, $atts, 'toutbuttons' );

		return $this->display_buttons();

	} // shortcode()

} // class
