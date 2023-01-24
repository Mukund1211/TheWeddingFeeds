<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Shadow_Customize_Title_Control' ) && class_exists( 'WP_Customize_Control' ) ) :
	class Shadow_Customize_Title_Control extends WP_Customize_Control {
		
		# Set Type
		public $type = 'custom_title';
		public $options = array();
		public $custom_class = '';
		
		# Enqueue Scrits and Styles
		public function enqueue() {
			wp_enqueue_style( 'shadow-customize-controls-css', SHADOWCORE_ASSETS_URL . 'css/customize-controls.css' );
			wp_enqueue_script( 'shadow-customize-controls-js', SHADOWCORE_ASSETS_URL . 'js/customize-controls.js', array('jquery'), false, true);
    	}
							  
		# Display Control Content
		public function render_content() {
			$additional = '';
			
			if ( is_array( $this->options ) ) {
				if ( !empty( $this->options[ 'font-size' ] ) ) {
					$additional .= ' data-font-size = "'. absint( $this->options[ 'font-size' ] ) .'"';
				}

				if ( !empty( $this->options[ 'line-height' ] ) ) {
					$additional .= ' data-line-height = "'. absint( $this->options[ 'line-height' ] ) .'"';
				}

				if ( !empty( $this->options[ 'margin-bottom' ] ) ) {
					$additional .= ' data-bottom = "'. absint( $this->options[ 'margin-bottom' ] ) .'"';
				}

				if ( !empty( $this->options[ 'color' ] ) ) {
					$additional .= ' data-color = "'. esc_attr( $this->options[ 'color' ] ) .'"';
				}	
				
				if ( !empty( $this->options[ 'font-family' ] ) ) {
					$additional .= ' data-font-family = "'. esc_attr( $this->options[ 'font-family' ] ) .'"';
				}	
			}						
			echo '<div class="cc_control_title customize-control-title" '. $additional .' '. ( $this->custom_class !== '' ? 'data-class="'. esc_attr( $this->custom_class ) .'"' : '' ) .'>'. $this->label .'</div>';
			if ( ! empty( $this->description ) ) {
				echo '<span class="customize-control-description"> '. $this->description .' </span>';
			}
		}
	}
endif;