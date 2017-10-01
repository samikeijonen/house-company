<?php
/**
 * This is child themes functions.php file. All modifications should be made in this file.
 *
 * All style changes should be in child themes style.css file.
 *
 * @package    House Company
 * @version    1.0.0
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright  Copyright (c) 2015, Sami Keijonen
 * @link       https://foxland.fi
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Setup function. All child themes should run their setup within this function. The idea is to add/remove
 * filters and actions after the parent theme has been set up. This function provides you that opportunity.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function house_company_theme_setup() {
	// Load child theme text domain.
	load_child_theme_textdomain( 'house-company', get_stylesheet_directory() . '/languages' );

	// Add new image size.
	add_image_size( 'house-company-smaller', 255, 255, true );

	// Add child theme fonts to editor styles.
	add_editor_style( house_company_fonts_url() );
}
add_action( 'after_setup_theme', 'house_company_theme_setup', 11 );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 **/
function house_company_scripts() {
	// Dequeue parent fonts.
	wp_dequeue_style( 'munsa-fonts' );

	// Enqueue child theme fonts.
	wp_enqueue_style( 'house-company-fonts', house_company_fonts_url(), array(), null );

	if ( is_page_template( 'pages/front-page.php' ) ) {
		// Enqueue Slick Slider JS.
		wp_enqueue_script( 'housecompany-slick-slider', get_stylesheet_directory_uri() . '/js/slick.min.js', array( 'jquery' ), '20170915', true );
		wp_enqueue_script( 'housecompany-slick-slider-settings', get_stylesheet_directory_uri() . '/js/slider-settings.js', array( 'housecompany-slick-slider' ), '20170915', true );

	}

	// Enqueue JS.
	wp_enqueue_script( 'housecompany-settings', get_stylesheet_directory_uri() . '/js/settings.js', array( 'jquery' ), '20170915', true );
}
add_action( 'wp_enqueue_scripts', 'house_company_scripts', 11 );

/**
 * Returns just a link to the porfolio item URL if it has been set.
 *
 * @since  1.0.0
 */
function house_company_portfolio_link() {
	$house_company_portfolio_url = get_post_meta( get_the_ID(), 'url', true );

	return esc_url( $house_company_portfolio_url );
}

/**
 * Returns a link to the porfolio item URL if it has been set.
 *
 * @since  1.0.0
 */
function house_company_portfolio_item_link() {
	$house_company_portfolio_url = get_post_meta( get_the_ID(), 'url', true );
	if ( ! empty( $house_company_portfolio_url ) ) {

		/* Translators: The %s is the post title shown to screen readers. */
		$text = sprintf( __( 'Visit site %s', 'house-company' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' );
		$link = sprintf( '<span class="house-company-project-url"><a href="%s" class="munsa-button house-company-portfolio-item-link">%s</a></span>', esc_url( $house_company_portfolio_url  ), $text );
		return $link;

	}
}

/**
 * Return the Google font stylesheet URL
 *
 * @since  1.0.0
 * @return string
 */
function house_company_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'munsa' ) ) {
		$fonts[] = 'Lato:400,700,400italic,700italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'munsa' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

function house_company_logo() {
	// Get logo url.
	$logo = get_stylesheet_directory_uri() . '/images/house_company_logo_front.png';

	?>
	<div id="logo-wrapper" class="logo-wrapper">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="house-company-logo" src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
	</div>
	<?php
}
add_action( 'munsa_open_branding', 'house_company_logo' );

/**
 * Logos after Contact info.
 */
function house_company_after_contact_info() {
	// Image one. ?>
	<img class="work-image work-image-fi" src="<?php echo get_stylesheet_directory_uri(); ?>/images/suomalaisen-tyon-liitto-web.png" alt="Suomalaisen työn liitto">

	<?php
	// Image Two. ?>
	<img class="work-image work-image-flag" src="<?php echo get_stylesheet_directory_uri(); ?>/images/avainlippu-web.png" alt="Avainlippu">
	<?php

	// Image Three. ?>
	<img class="work-image work-image-skvl" src="<?php echo get_stylesheet_directory_uri(); ?>/images/skvl.jpg" alt="SKVL">
	<?php
}
add_action( 'munsa_after_contact_info', 'house_company_after_contact_info' );

/**
 * Slider in the front page.
 */
function house_company_slider() {
	$k = 0;
	$slider_imgs = array();
	while ( 4 > $k ) {
		if ( get_theme_mod( 'slider_img_' . $k ) ) {
			$slider_imgs[] = get_theme_mod( 'slider_img_' . $k );
		}
		$k++;
	}

	if ( $slider_imgs ) {
		echo '<div class="slider-images-wrapper">';
			foreach ( $slider_imgs as $slider_img ) {
				$bg_slider = ' style="background-image: url(' . esc_url( $slider_img ) . ');"';
				echo '<div class="slider-image"' . $bg_slider . '></div>';
			}
		echo '</div>';
	}
}
add_action( 'munsa_close_featured_content', 'house_company_slider' );

/**
 * Add Insta feed.
 */
function house_company_insta() {
	if ( is_page_template( 'pages/front-page.php' ) ) {
		get_template_part( 'template-parts/content', 'insta-feed' );
	}
}
add_action( 'munsa_before_footer_widgets', 'house_company_insta' );

/**
 * Instagram hashtag feed.
 */
add_filter( 'dude-insta-feed/access_token/user=2303846579', function() {
	return esc_attr( get_theme_mod( 'insta_access_token' ) );
} );

/**
 * Instagram feed items.
 */
add_filter( 'dude-insta-feed/user_images_parameters', function( $parameters ) {
	$parameters['count'] = '8';
	return $parameters;
} );

/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';
