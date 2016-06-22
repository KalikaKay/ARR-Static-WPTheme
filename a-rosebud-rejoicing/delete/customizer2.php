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
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title Color', 'a_rosebud_rejoicing' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title &amp; Tagline', 'a_rosebud_rejoicing' );

	// Add custom description to Colors and Background controls or sections.
	if ( property_exists( $wp_customize->get_control( 'background_color' ), 'description' ) ) {
		$wp_customize->get_control( 'background_color' )->description = __( 'May only be visible on wide screens.', 'a_rosebud_rejoicing' );
		$wp_customize->get_control( 'background_image' )->description = __( 'May only be visible on wide screens.', 'a_rosebud_rejoicing' );
	} else {
		$wp_customize->get_section( 'colors' )->description           = __( 'Background may only be visible on wide screens.', 'a_rosebud_rejoicing' );
		$wp_customize->get_section( 'background_image' )->description = __( 'Background may only be visible on wide screens.', 'a_rosebud_rejoicing' );
	}
/*
	// Add a footer/copyright information section.
$wp_customize->add_section( 'footer' , array(
  'title' => __( 'Footer', 'a_rosebud_rejoicing' ),
  'priority' => 90, // Before Navigation.
) );
*/

/*Learn how to add things to the customizer. */
	/*	$wp_customize->add_section( 'footer' , array(
		  'title' => __( 'Footer', 'a_rosebud_rejoicing' ),
		  'priority' => 90, // Before Navigation.
		) );
*/
		$wp_customize->add_setting( 'footer_textcolor', array(
			'default'=> 'white',
			'type' => 'theme-mod',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		) );

		// color picker
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_textcolor', array(
			'label' => __( 'footer textcolor', 'a_rosebud_rejoicing' ),
			'section' => 'colors',
			) ) );

	/*
	$wp_customize->add_control( 'footer_textcolor', array(
	  'type' => 'date',
	  'priority' => 10, // Within the section.
	  'section' => 'colors', // Required, core or custom.
	  'label' => __( 'Date' ),
	  'description' => __( 'This is a date control with a red border.' ),
	  'input_attrs' => array(
	    'class' => 'my-custom-class-for-js',
	    'style' => 'border: 1px solid #900',
	    'placeholder' => __( 'mm/dd/yyyy' ),
	  ),
	  'active_callback' => 'is_front_page',
	) );
	*/

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


/**
 * Bind JS handlers to make Customizer preview reload changes asynchronously.
 *
 * @since A Rosebud Rejoicing 1.0
 */
function a_rosebud_rejoicing_customize_preview_js() {
	wp_enqueue_script( 'a_rosebud_rejoicing_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'a_rosebud_rejoicing_customize_preview_js' );

/**
 * Add contextual help to the Themes and Post edit screens.
 *
 * @since A Rosebud Rejoicing 1.0
 */
function a_rosebud_rejoicing_contextual_help() {
	if ( 'admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow'] ) {
		return;
	}

	get_current_screen()->add_help_tab( array(
		'id'      => 'a_rosebud_rejoicing',
		'title'   => __( 'A Rosebud Rejoicing', 'a_rosebud_rejoicing' ),
		'content' =>
			'<ul>' .
				'<li>' . sprintf( __( 'The home page features your choice of up to 6 posts prominently displayed in a grid or slider, controlled by a <a href="%1$s">tag</a>; you can change the tag and layout in <a href="%2$s">Appearance &rarr; Customize</a>. If no posts match the tag, <a href="%3$s">sticky posts</a> will be displayed instead.', 'a_rosebud_rejoicing' ), esc_url( add_query_arg( 'tag', _x( 'featured', 'featured content default tag slug', 'a_rosebud_rejoicing' ), admin_url( 'edit.php' ) ) ), admin_url( 'customize.php' ), admin_url( 'edit.php?show_sticky=1' ) ) . '</li>' .
				'<li>' . sprintf( __( 'Enhance your site design by using <a href="%s">Featured Images</a> for posts you&rsquo;d like to stand out (also known as post thumbnails). This allows you to associate an image with your post without inserting it. A Rosebud Rejoicing uses featured images for posts and pages&mdash;above the title&mdash;and in the Featured Content area on the home page.', 'a_rosebud_rejoicing' ), 'https://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail' ) . '</li>' .
				'<li>' . sprintf( __( 'For an in-depth tutorial, and more tips and tricks, visit the <a href="%s">A Rosebud Rejoicing documentation</a>.', 'a_rosebud_rejoicing' ), 'https://codex.wordpress.org/Twenty_Fourteen' ) . '</li>' .
			'</ul>',
	) );
}

add_action( 'admin_head-themes.php', 'a_rosebud_rejoicing_contextual_help' );
add_action( 'admin_head-edit.php',   'a_rosebud_rejoicing_contextual_help' );


function a_rosebud_rejoicing_custom_css_output() {
	$color = get_theme_mod( 'footer_textcolor' ); //E.g. #FF0000
  $custom_css = "
  	.mycolor{
    	background: {$color};
    }";
  wp_add_inline_style( 'custom-style', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'a_rosebud_rejoicing_custom_css_output' );

/**
 * Add styles for customized elements.
 *
 * @since A Rosebud Rejoicing 1.0
 */

/*
function a_rosebud_rejoicing_custom_css_output() {
  echo '<style type="text/css" id="custom-theme-css">' .
  get_theme_mod( 'footer_textcolor', '' ) . '</style>';
	echo get_theme_mod( 'footer_textcolor');
}
add_action( 'wp_head', 'a_rosebud_rejoicing_custom_css_output');
//add_action( 'wp_enqueue_scripts', 'a_rosebud_rejoicing_custom_css_output' );
*/
