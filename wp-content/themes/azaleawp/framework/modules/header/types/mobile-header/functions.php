<?php

if ( ! function_exists( 'azalea_eltdf_include_mobile_header_menu' ) ) {
	function azalea_eltdf_include_mobile_header_menu( $menus ) {
		$menus['mobile-navigation'] = esc_html__( 'Mobile Navigation', 'azaleawp' );
		
		return $menus;
	}
	
	add_filter( 'azalea_eltdf_register_headers_menu', 'azalea_eltdf_include_mobile_header_menu' );
}

if ( ! function_exists( 'azalea_eltdf_register_mobile_header_areas' ) ) {
	/**
	 * Registers widget areas for mobile header
	 */
	function azalea_eltdf_register_mobile_header_areas() {
		if ( azalea_eltdf_is_responsive_on() ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Mobile Header Widget Area', 'azaleawp' ),
				'id'            => 'eltdf-right-from-mobile-logo',
				'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-right-from-mobile-logo">',
				'after_widget'  => '</div>',
				'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the mobile logo on mobile header', 'azaleawp' )
			) );
		}
	}
	
	add_action( 'widgets_init', 'azalea_eltdf_register_mobile_header_areas' );
}

if ( ! function_exists( 'azalea_eltdf_mobile_header_class' ) ) {
	function azalea_eltdf_mobile_header_class( $classes ) {
		$classes[] = 'eltdf-default-mobile-header';
		
		$classes[] = 'eltdf-sticky-up-mobile-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'azalea_eltdf_mobile_header_class' );
}

if ( ! function_exists( 'azalea_eltdf_get_mobile_header' ) ) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function azalea_eltdf_get_mobile_header() {
		if ( azalea_eltdf_is_responsive_on() ) {
			$mobile_menu_title = azalea_eltdf_options()->getOptionValue( 'mobile_menu_title' );
			$has_navigation    = has_nav_menu( 'main-navigation' ) || has_nav_menu( 'mobile-navigation' ) ? true : false;
			
			$parameters = array(
				'show_navigation_opener' => $has_navigation,
				'mobile_menu_title'      => $mobile_menu_title
			);
			
			azalea_eltdf_get_module_template_part( 'templates/mobile-header', 'header/types/mobile-header', '', $parameters );
		}
	}
	
	add_action( 'azalea_eltdf_after_page_header', 'azalea_eltdf_get_mobile_header' );
}

if ( ! function_exists( 'azalea_eltdf_get_mobile_logo' ) ) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 */
	function azalea_eltdf_get_mobile_logo() {
		$show_logo_image = azalea_eltdf_options()->getOptionValue( 'hide_logo' ) === 'yes' ? false : true;
		
		if ( $show_logo_image ) {
			$mobile_logo_image = azalea_eltdf_get_meta_field_intersect('logo_image_mobile', azalea_eltdf_get_page_id());
			
			//check if mobile logo has been set and use that, else use normal logo
			$logo_image = ! empty( $mobile_logo_image ) ? $mobile_logo_image : azalea_eltdf_get_meta_field_intersect( 'logo_image', azalea_eltdf_get_page_id() );
			
			//get logo image dimensions and set style attribute for image link.
			$logo_dimensions = azalea_eltdf_get_image_dimensions( $logo_image );
			
			$logo_height = '';
			$logo_styles = '';
			if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
				$logo_height = $logo_dimensions['height'];
				$logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px'; //divided with 2 because of retina screens
			}
			
			//set parameters for logo
			$parameters = array(
				'logo_image'      => $logo_image,
				'logo_dimensions' => $logo_dimensions,
				'logo_height'     => $logo_height,
				'logo_styles'     => $logo_styles
			);
			
			azalea_eltdf_get_module_template_part( 'templates/mobile-logo', 'header/types/mobile-header', '', $parameters );
		}
	}
}

if ( ! function_exists( 'azalea_eltdf_get_mobile_nav' ) ) {
	/**
	 * Loads mobile navigation HTML
	 */
	function azalea_eltdf_get_mobile_nav() {
		azalea_eltdf_get_module_template_part( 'templates/mobile-navigation', 'header/types/mobile-header' );
	}
}