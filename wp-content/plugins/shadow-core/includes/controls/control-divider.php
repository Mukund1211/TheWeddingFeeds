<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Shadow_Customize_Divider_Control' ) && class_exists( 'WP_Customize_Control' ) ) :
	class Shadow_Customize_Divider_Control extends WP_Customize_Control {
		
		# Set Type
		public $type = 'divider';
		public $options = array();
		public $custom_class = '';
		
		# Enqueue Scrits and Styles
		public function enqueue() {
			wp_enqueue_style( 'shadow-customize-controls-css', SHADOWCORE_ASSETS_URL . 'css/customize-controls.css' );
			wp_enqueue_script( 'shadow-customize-controls-js', SHADOWCORE_ASSETS_URL . 'js/customize-controls.js', array( 'jquery' ), false, true );
    	}
							  
		# Display Control Content
		public function render_content() {
			$additional = '';
			
			if ( ! empty( $this->options['margin-top'] ) ) {
				$additional .= ' data-top=" '. absint( $this->options['margin-top'] ) .' "';
			}
			
			if ( ! empty( $this->options['margin-bottom'] ) ) {
				$additional .= ' data-bottom="'. absint( $this->options['margin-bottom'] ) .'"';
			}
			
			if ( ! empty( $this->description ) ) {
				echo '<span class="divider-description customize-control-description">'. $this->description .'</span>';
			}
			
			echo '<div class="cc_control_divider" '. $additional .' '. ( $this->custom_class !== '' ? 'data-class="'. esc_attr( $this->custom_class ) .'"' : '' ) .'></div>';
		}
	}
endif;