/**
 * The a thing I'm testings, based on the template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package A_Rosebud_Rejoicing
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<?php
$mods = get_theme_mods();

var_dump( $mods );
// output example:
//    array(2) { ["header_textcolor"]=> string(3) "333" ["header_image"]=> string(20) "random-default-image" }

var_dump( $mods['header_textcolor'] );
// output example:
//    string(3) "333"

?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
