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

	// Add custom description to Colors and Background controls or sections.
	if ( property_exists( $wp_customize->get_control( 'background_color' ), 'description' ) ) {
		$wp_customize->get_control( 'background_color' )->description = __( 'May only be visible on wide screens.', 'a_rosebud_rejoicing' );
		$wp_customize->get_control( 'background_image' )->description = __( 'May only be visible on wide screens.', 'a_rosebud_rejoicing' );
	} else {
		$wp_customize->get_section( 'colors' )->description           = __( 'Background may only be visible on wide screens.', 'a_rosebud_rejoicing' );
		$wp_customize->get_section( 'background_image' )->description = __( 'Background may only be visible on wide screens.', 'a_rosebud_rejoicing' );
	}


	/* Add section: example for reference.
	$wp_customize->add_section( 'footer' , array(
	  'title' => __( 'Footer', 'a-rosebud-rejoicing' ),
	  'priority' => 90, // Before Navigation.
		'capability' => 'edit_theme_options', //Capability needed to tweak
	) );
 */

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
