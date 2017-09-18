<?php
/**
 * House Company Theme Customizer.
 *
 * @package House Company
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function house_company_customize_register( $wp_customize ) {
	// Add the house-company section.
	$wp_customize->add_section(
		'house-company',
		array(
			'title'       => esc_html__( 'Partner page', 'house-company' ),
			'description' => esc_html__( 'Select page which you want to get partners content and child pages content.', 'house-company' ),
			'priority'    => 5,
			'panel'       => 'theme',
		)
	);

	// Add the slider-images section.
	$wp_customize->add_section(
		'slider-images',
		array(
			'title'       => esc_html__( 'Slider images', 'house-company' ),
			'description' => esc_html__( 'Recommended image max. width is 2000px', 'house-company' ),
			'priority'    => 4,
			'panel'       => 'theme',
		)
	);

	// Add the slider-images section.
	$wp_customize->add_section(
		'insta',
		array(
			'title'    => esc_html__( 'Instagram', 'house-company' ),
			'priority' => 6,
			'panel'    => 'theme',
		)
	);

	/**
	 * Partner Page settings.
	 *
	 */

	// Add the 'partner_page' setting.
	$wp_customize->add_setting(
		'partner_page',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint'
		)
	);

	// Add the 'partner_page' control.
	$wp_customize->add_control(
		'partner_page',
			array(
				'label'    => esc_html__( 'Select partner page', 'house-company' ),
				'section'  => 'house-company',
				'type'     => 'dropdown-pages',
				'priority' => 10
			)
		);

	// Loop 4 images settings and slider for slider images.
	$k = 0;
	while ( 4 > $k ) {
		// Add the 'slider_img_{id}' setting.
		$wp_customize->add_setting(
			'slider_img_' . $k,
			array(
				'default'           => 0,
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		// Add the 'slider_img_{id}' control.
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize,
			'slider_img_' . $k,
				array(
					'label'    => sprintf( esc_html__( 'Select slider image %s', 'house-company' ), $k+1 ),
					'section'  => 'slider-images',
					'priority' => 10 + $k,
				)
			)
		);
		$k++;
	}

	// Add the insta title setting.
	$wp_customize->add_setting(
		'insta_title',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	// Add the insta title control.
	$wp_customize->add_control(
		'insta_title',
		array(
			'label'    => esc_html__( 'Instagram title', 'house-company' ),
			'section'  => 'insta',
			'priority' => 9,
			'type'     => 'text'
		)
	);

	// Add the insta access token setting.
	$wp_customize->add_setting(
		'insta_access_token',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	// Add the insta access token control.
	$wp_customize->add_control(
		'insta_access_token',
		array(
			'label'    => esc_html__( 'Instagram access token', 'house-company' ),
			'section'  => 'insta',
			'priority' => 10,
			'type'     => 'text'
		)
	);
}
add_action( 'customize_register', 'house_company_customize_register' );
