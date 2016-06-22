<?php
/**
* A Rosebud Rejoicing Theme Customizer.
*
* @package A_Rosebud_Rejoicing
*
*@link https://developer.wordpress.org/themes/advanced-topics/customizer-api/
*
*@link https://codex.wordpress.org/Theme_Customization_API
*
*/

/**
 * Implement Customizer additions and adjustments.
 *
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function a_rosebud_rejoicing_customize_register( $wp_customize ) {
	// Add a footer information section.
	$wp_customize->add_section( 'footer' , array(
	  'title' => __( 'Footer', 'a-rosebud-rejoicing' ),
	  'priority' => 90, // Before Navigation.
		'capability' => 'edit_theme_options', //Capability needed to tweak
	) );

	$wp_customize->add_setting( 'footer_textcolor', array(
		'default'=> '#eeee22',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	) );

		// color picker
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_textcolor', array(
		'label' => __( 'footer textcolor', 'a-rosebud-rejoicing' ),
		'section' => 'footer',
		) ) );



}
add_action( 'customize_register', 'a_rosebud_rejoicing_customize_register' );

function a_rosebud_rejoicing_custom_css_output() {
	$default_color = '#eeee22';
	$color = get_theme_mod( 'footer_textcolor', $default_color );

	// Don't do anything if the current color is the default.
	if ( $color === $default_color ) {
		return;
	}

  $custom_css = "
  	.site-footer {
    	color: {$color};
    }";

  wp_add_inline_style( 'a-rosebud-rejoicing-style', $custom_css );

}
//add_action( 'wp_head', 'a_rosebud_rejoicing_custom_css_output' );
add_action( 'wp_enqueue_scripts', 'a_rosebud_rejoicing_custom_css_output' );


/**
 * Bind JS handlers to make Customizer preview reload changes asynchronously.
 *
 * @since A Rosebud Rejoicing 1.0
 */
function a_rosebud_rejoicing_customize_preview_js() {
	wp_enqueue_script( 'a_rosebud_rejoicing_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'a_rosebud_rejoicing_customize_preview_js' );
