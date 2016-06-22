<?php
/**
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package A_Rosebud_Rejoicing
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses a_rosebud_rejoicing_header_style()
 */
function a_rosebud_rejoicing_custom_header_setup() {
	/*
	add_theme_support( 'custom-header', apply_filters( 'a_rosebud_rejoicing_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'a_rosebud_rejoicing_header_style',
	) ) );
} */

	add_theme_support( 'custom-header', apply_filters( 'a_rosebud_rejoicing_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 170,
		'height'                 => 150,
		'flex-height'            => true,
		'flex-width'    				 => true,
		'wp-head-callback'       => 'a_rosebud_rejoicing_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'a_rosebud_rejoicing_custom_header_setup' );

if ( ! function_exists( 'a_rosebud_rejoicing_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see a_rosebud_rejoicing_custom_header_setup().
 */
function a_rosebud_rejoicing_header_style() {
	$header_text_color = get_header_textcolor();
	$textingit = get_theme_mod('HI_hover_text');
	$header_hover_image =  wp_get_attachment_url( get_theme_mod('HI_hover_image') );
	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
	 */
	if ( HEADER_TEXTCOLOR === $header_text_color ) {
		return;
	}


	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}

	<?php endif; ?>

	<?php
		// Has the image been set?
		if ( ! get_header_image() ) :
	?>
		.site-logo {
			display: none;
		}

	<?php
		// If the user has set a custom image use that.
		//background-image: url('http://devblogarosebudrejoicing-kalikakay.rhcloud.com/wp-content/uploads/2016/05/cropped-BlackandWhite-e1464223943180.jpg');
		else :
	?>

		.site-logo {
			background-image: url('<?php header_image(); ?> ');
		}


		.site-logo:hover {
			background-image: url('<?php echo $header_hover_image; ?> ');
			cursor: not-allowed;
		}

		.site-logo:hover ~ .site-logo-description:after {

			content:'<?php echo $textingit; ?>';
			border-style: double;
			position:absolute;
			background-color: #999999;
			margin: 7.5em 0 0 0;
			color: #e2e2e2;
			text-indent: 0;
			padding: 0 0.5em 0 0.5em;
		}

	<?php
		endif;
	?>
	</style>

<?php
}
endif;
