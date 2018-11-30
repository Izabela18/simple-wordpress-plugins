<?php
/**
Plugin Name: CMS 2 Labb 2 Shortcode
Description: Custom-made shortcode button
Author: Izabela Walczak-Niznik
Version: 1.0.0
*/

function myprefix_button_shortcode( $atts) {

	// Extract shortcode attributes
	extract( shortcode_atts( array(
		'url'    => '',
    'text' => 'knapp',
		'background'  => 'grey',
		'style' => '',
		'width' => ''
	), $atts ));

  wp_enqueue_style( 'knapp-style' );


    return '<a href="'.$url.'"><button style="background-color:'.$background.'; border-radius:'.$style.'; width:'.$width.';" class="knapp">'.$text.'</button></a>';

}

add_shortcode( 'sh-button', 'myprefix_button_shortcode' );
add_action( 'wp_enqueue_scripts', 'knapp_assets' );
function knapp_assets() {
	wp_register_style( 'knapp-style', plugin_dir_url( __FILE__ ) . 'css/knapp-style.css' );
}
