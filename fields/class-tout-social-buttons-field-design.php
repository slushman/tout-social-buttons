<?php

/**
 * Defines all the code for the design form field.
 */

class Tout_Social_Buttons_Field_Design extends Tout_Social_Buttons_Field {

	/**
	 * Class constructor.
	 *
	 * @since 		1.0.0
	 * @param 		string 		$context 			The field context. Options:
	 *                               					settings: plugin settings
	 *                               					metabox: in a metabox
	 *                               					widget: in widget form
	 * @param 		array 		$attributes 		The field attributes.
	 * @param 		array 		$properties 		The field properties.
	 */
	public function __construct( $context, $attributes, $properties ) {

		$this->set_context( $context );
		$this->set_settings( $attributes, $properties );

		$this->set_default_attributes();
		$this->set_attributes( $attributes );
		$this->set_value( $attributes );
		$this->set_name_attribute();

		$this->set_default_properties();
		$this->set_properties( $properties );

		$this->output_label();
		$this->output_field();
		$this->output_description();
		$this->output_alert();

	} // __construct()

	/**
	 * Includes the field markup file.
	 *
	 * Uses the newest post as the preview page.
	 *
	 * @since 		1.0.0
	 */
	public function output_field() {

		$post_opts['numberposts'] 	= 1;
		$post_opts['post_status'] 	= 'publish';
		$posts 						= wp_get_recent_posts( $post_opts );

		if ( 0 === count( $posts ) ) { return; }

		$url 		= admin_url( 'customize.php' );
		$post_url 	= get_permalink( $posts[0]['ID'] );

		$query['autofocus[section]'] 				= 'tout_social_buttons';
		$query['url'] 								= $post_url;
		$query['return'] 							= urlencode( add_query_arg( array( 'page' => 'tout-social-buttons-settings', 'tab' => 'settings' ), admin_url( 'admin.php' ) ) );
		$query['tout-social-buttons-customizer'] 	= TRUE;

		$link = add_query_arg( $query, $url );

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/partials/design.php' );

	} // output_field()

} // class
