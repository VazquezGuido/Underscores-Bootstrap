<?php
defined('ABSPATH') or die("These aren't the droids you're looking for");

/**
 * Plugin Name: Bootstrap 4 for Gravity Forms
 * Plugin URI: https://github.com
 * Description: Applies Bootstrap 4 customisations & styles to Gravity Forms
 * Version: 0.1
 * Author: Zava Design
 * Author URI: https://zava.design
 */

if( ! function_exists( 'gravityforms_bootstrap4' ) ) {
  
  
	// Disable GF default CSS
	add_filter('pre_option_rg_gforms_disable_css', '__return_true');
  
  
	// Add Bootstrap classes
	add_filter("gform_field_content", "bootstrap_styles_for_gravityforms_fields", 10, 5);
	function bootstrap_styles_for_gravityforms_fields($content, $field, $value, $lead_id, $form_id){
		
		// Currently only applies to most common field types, but could be expanded.
		
		if($field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'checkbox' && $field["type"] != 'html' && $field["type"] != 'address') {
			$content = str_replace('class=\'medium', 'class=\'form-control medium', $content);
			$content = str_replace('class=\'large', 'class=\'form-control large', $content);
		}
		
		if($field["type"] == 'name' || $field["type"] == 'address') {
			$content = str_replace('<input ', '<input class=\'form-control\' ', $content);
		}
		
		if($field["type"] == 'textarea') {
			$content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
		}
		
		if($field["type"] == 'checkbox') {
			$content = str_replace('li class=\'', 'li class=\'checkbox ', $content);
			$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
		}
		
		if($field["type"] == 'radio') {
			$content = str_replace('li class=\'', 'li class=\'radio ', $content);
			$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
		}
		
		return $content;
		
	} // End bootstrap_styles_for_gravityforms_fields()
	
	
	// Add submit button code for Bootstrap
	add_filter("gform_submit_button", "form_submit_button", 10, 2);
	function form_submit_button($button, $form){
		if ($form['button']['type'] == 'text') {
			$pattern = '/(class=)(\'|")([^\'"]+)/';
			$replacement = '${1}${2}${3} btn btn-dark';
			$newbutton = preg_replace($pattern, $replacement, $button);
			if ( ! is_null($newbutton) ) {
				return $newbutton;
			}
		}
	}
	
	// Bootstrap the main validation message
	add_filter( 'gform_validation_message', 'bootstrap_main_message', 10, 2 );
	function bootstrap_main_message( $message, $form ) {
		return "<div class='validation_error alert alert-danger'>" . esc_html__( 'There was a problem with your submission.', 'gravityforms' ) . ' ' . esc_html__( 'Errors have been highlighted below.', 'gravityforms' ) . '</div>';
	}
  
	// Add custom styles
	function gravityforms_bootstrap4() {
		wp_register_style( 'gravity-bootstrap4', plugins_url('gravityforms-bootstrap4/gravity-bootstrap4.css'), array(), '1.0', 'all' );
		wp_enqueue_style( 'gravity-bootstrap4' );
	}
	add_action( 'wp_enqueue_scripts', 'gravityforms_bootstrap4' );
}
