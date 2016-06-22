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

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'a_rosebud_rejoicing_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'a_rosebud_rejoicing_customize_partial_blogdescription',
		) );
	}

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Lip Color', 'a_rosebud_rejoicing' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title &amp; Tagline', 'a_rosebud_rejoicing' );

	// Hide core sections/controls when they aren't used on the current page.
	//$wp_customize->get_section( 'header_image' )->active_callback = 'is_front_page';

	// Add custom description to Colors and Background controls or sections.
	if ( property_exists( $wp_customize->get_control( 'background_color' ), 'description' ) ) {
		$wp_customize->get_control( 'background_color' )->description = __( 'May only be visible on wide screens.', 'a_rosebud_rejoicing' );
		$wp_customize->get_control( 'background_image' )->description = __( 'May only be visible on wide screens.', 'a_rosebud_rejoicing' );

	} else {
		$wp_customize->get_section( 'colors' )->description           = __( 'Background may only be visible on wide screens.', 'a_rosebud_rejoicing' );
		$wp_customize->get_section( 'background_image' )->description = __( 'Background may only be visible on wide screens.', 'a_rosebud_rejoicing' );
		$wp_customize->get_section( 'header_image' )->description = __( 'Think Tank.', 'a_rosebud_rejoicing' );
	}


	/* Add section: example for reference.
	$wp_customize->add_section( 'footer' , array(
	  'title' => __( 'Footer', 'a-rosebud-rejoicing' ),
	  'priority' => 90, // Before Navigation.
		'capability' => 'edit_theme_options', //Capability needed to tweak
	) );
 */

 //Header Image Direction
 $wp_customize->add_setting( 'HI_Direction', array(
 	'default'=> home_url( '/' ),
 	'type' => 'theme_mod',
 	'sanitize_callback' => 'esc_url',
 	'transport' => 'postMessage',
 ) );

 //Header Image Direction
 $wp_customize->add_control( 'HI_Direction', array(
 	'label' 		=> __( 'Image URL', 'a-rosebud-rejoicing' ),
	'description' => __( 'Enter the website URL', 'a-rosebud-rejoicing' ),
	'type'     	=> 'textarea',
 	'section'	 	=> 'header_image',
 	'priority' 	=> 74,
  ) );


//Header Image Hover Text
 $wp_customize->add_setting( 'HI_hover_text', array(
	 'type' => 'theme_mod',
	 'sanitize_callback' => 'esc_textarea',
	 'transport' => 'postMessage',
 ) );

 //Header Image Hover Text
 $wp_customize->add_control( 'HI_hover_text', array(
	 'label'    => __( 'Hover Text', 'a-rosebud-rejoicing' ),
	 'description' => __( 'Select the text to appear on hover.', 'a-rosebud-rejoicing' ),
	 'type'     => 'textarea',
	 'section'  => 'header_image',
	 'priority' => 75,
  ) );

  //Header Image Hover Image
	$wp_customize->add_setting( 'HI_hover_image', array(
 	 'type' => 'theme_mod',
 	 'sanitize_callback' => 'absint',
 	 'transport' => 'postMessage',
  ) );

 	 /* Header Image Hover Image, sans the cropping
  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'HI_hover_image', array(
 	 'label' => __( 'Hover Image', 'a-rosebud-rejoicing' ),
	 'description' => __( 'Select the image to appear on hover.', 'a-rosebud-rejoicing' ),
 	 'section' => 'header_image',
	 'mime_type' => 'image',
 	 'priority' => 76,
   ) ) );
	 */
	 $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'HI_hover_image', array(
    'section'     => 'header_image',
		'description' => __( 'Select the image to appear on hover.', 'a-rosebud-rejoicing' ),
    'label'       => __(  'Hover Image', 'a-rosebud-rejoicing' ),
    'flex_width'  => true, // Allow any width, making the specified value recommended. False by default.
    'flex_height' => true, // Require the resulting image to be exactly as tall as the height attribute (default).
    'width'       => 170,
    'height'      => 150,
    ) ) );

	// header background color picker
	$wp_customize->add_setting( 'header_background_color', array(
		'default'=> '#e1efe9',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	) );

	// header background color picker
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label' => __( 'Hair Color', 'a-rosebud-rejoicing' ),
		'section' => 'colors',
		'priority' => 1,
		) ) );

		//Shadow checkbox
		$wp_customize->add_setting( 'header_shadow3', array(
			'default'=> 1,
			'type' => 'theme_mod',
			'transport' => 'postMessage',
			//'sanitize_callback' => 'function($val) { return $val }',
			'sanitize_callback' => 'esc_url_raw',
			//'sanitize_callback' => 'sanitize_checkbox',
			) );

		$wp_customize->add_control( 'header_shadow3', array(
  		'label' => __( 'Shadow', 'a-rosebud-rejoicing' ),
  		'type' => 'checkbox',
  		'section' => 'title_tagline',
		) );

}
add_action( 'customize_register', 'a_rosebud_rejoicing_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since A Rosebud Rejoicing 1.7
 * @see a_rosebud_rejoicing_customize_register()
 *
 * @return void
 */
function a_rosebud_rejoicing_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since A Rosebud Rejoicing 1.7
 * @see a_rosebud_rejoicing_customize_register()
 *
 * @return void
 */
function a_rosebud_rejoicing_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


//trying to figure this one out. Meanwhile esc_url_raw works... we'll use that until...
add_filter('sanitize_checkbox', 'sanitize_my_checkbox');

function sanitize_my_checkbox( $val ) {

		if ( 1 == $val )
		{
        return 1;
 		} else {
				return '';
		}
}

function a_rosebud_rejoicing_custom_css_output() {
	$default_color = '#e1efe9';
	$textShadow = '2px 2px 4px #000000';
	$color = get_theme_mod( 'header_background_color', $default_color );
	$shadowing =  get_theme_mod( 'header_shadow3');
	//echo "<script type='text/javascript'>alert('$shadowing');</script>";

	//turn text shadow off if deselected.
	if ($shadowing == "http://1" ){
		$textShadow = $textShadow;
	} else {
		$textShadow = '0 0 0';
	}

	// Don't do anything if the current color is the default.
	if ( $color === $default_color ) {
		return;
	}

  $custom_css = "
  	.site-header {
    	background-color: {$color};
			text-shadow: {$textShadow};
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
