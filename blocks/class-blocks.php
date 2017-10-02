<?php

/**
 * The Gutenberg-specific functionality of the plugin.
 *
 * Adds Gutenberg blocks for displaying the Tout.Social buttons.
 *
 * @link 			https://www.slushman.com
 * @since 			1.0.0
 * @package 		ToutSocialButtons\Blocks
 * @author 			Slushman <chris@slushman.com>
 */

namespace ToutSocialButtons\Blocks;

class Blocks {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {



	} // __construct()

	/**
	 * Registers all the WordPress hooks and filters related to this class.
	 *
	 * @hooked 		init
	 * @since 		1.0.0
	 */
	public function hooks() {

		add_action( 'enqueue_block_editor_assets', 	array( $this, 'enqueue_block_editor_assets' ) );
		add_action( 'enqueue_block_assets', 		array( $this, 'enqueue_block_assets' ) );
		register_block_type( 'tout-social-buttons/tout-social-buttons', array(
			//'render_callback' => '\ToutSocialButtons\Frontend\display_buttons'
			'render_callback' => 'tout_social_buttons_test'
		) );

	} // hooks()

	/**
	 * Enqueue the block's assets for the editor.
	 *
	 * 'wp-blocks': 	includes block type registration and related functions.
	 * 'wp-element': 	includes the WordPress Element abstraction for describing the structure of your blocks.
	 * 'wp-i18n': 		to internationalize the block's text.
	 *
	 * @hooked 		enqueue_block_editor_assets
	 * @since 		1.0.0
	 */
	public function enqueue_block_editor_assets() {

		wp_enqueue_script( TOUT_SOCIAL_BUTTONS_SLUG, plugin_dir_url( __FILE__ ) . 'js/editor.min.js', array( 'wp-blocks', 'wp-i18n', 'wp-element' ), TOUT_SOCIAL_BUTTONS_VERSION );
		wp_enqueue_style( TOUT_SOCIAL_BUTTONS_SLUG, plugin_dir_url( __FILE__ ) . 'css/editor.css', array( 'wp-edit-blocks' ), TOUT_SOCIAL_BUTTONS_VERSION );

	} // enqueue_block_editor_assets()

	/**
	 * Register the JavaScript for the frontend of the site.
	 *
	 * @hooked 		enqueue_block_assets
	 * @since 		1.0.0
	 */
	public function enqueue_block_assets() {

		//wp_enqueue_script( TOUT_SOCIAL_BUTTONS_SLUG, plugin_dir_url( __FILE__ ) . 'js/block.min.js', array( 'wp-blocks', 'wp-i18n', 'wp-element' ), TOUT_SOCIAL_BUTTONS_VERSION );
		wp_enqueue_style( TOUT_SOCIAL_BUTTONS_SLUG, plugin_dir_url( __FILE__ ) . 'css/block.css', array( 'wp-blocks' ), TOUT_SOCIAL_BUTTONS_VERSION );

	} // enqueue_block_assets()

} // class

function tout_social_buttons_test() {

	return '<p>Yer mom</p>';

}
