<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Shadow_Customize_Number_Control' ) && class_exists( 'WP_Customize_Control' ) ) :
	class Shadow_Customize_Number_Control extends WP_Customize_Control {
		# Set Type
		public $options = array();
		public $custom_class = '';
		
		# Enqueue Scrits and Styles
		public function enqueue() {
			wp_enqueue_style( 'shadow-customize-controls-css', SHADOWCORE_ASSETS_URL . 'css/customize-controls.css' );
			wp_enqueue_script( 'jquery-ui-slider', array( 'jquery' ) );
			wp_enqueue_script( 'shadow-customize-controls-js', SHADOWCORE_ASSETS_URL . 'js/customize-controls.js', array( 'jquery', 'jquery-ui-slider' ), false, true) ;
    	}
        
		# Display Control Content
		public function render_content() {
			if ( !empty( $this->label ) ) :
				echo '<span class="customize-control-title">'. esc_html( $this->label ) .'</span>';
			endif;
			
			if ( !empty( $this->description ) ) :
				echo '<span class="description customize-control-description">'. $this->description .'</span>';
			endif;
            
            if ( isset( $this->options[ 'min' ] ) && !empty( $this->options[ 'min' ] ) ) {
                $min = $this->options[ 'min' ];
            } else {
                $min = '0';
            }
            
            if ( isset( $this->options[ 'max' ] ) && !empty( $this->options[ 'max' ] ) ) {
                $max = $this->options[ 'max' ];
            } else {
                $max = '100';
            }
            
            if ( isset( $this->options[ 'step' ] ) && !empty( $this->options[ 'step' ] ) ) {
                $step = $this->options[ 'step' ];
            } else {
                $step = '1';
            }
            if ( isset( $this->options[ 'style' ] ) && $this->options[ 'style' ] == 'slider' ) {
                ?>
                <div class="customize-control-content customize-control-slider" <?php echo ( $this->custom_class !== '' ? 'data-class=" '. esc_attr( $this->custom_class ) .' "' : '' ) ?> data-default="<?php echo $this->setting->default; ?>">
                    <span class="cc-number-reset" title="<?php echo esc_html__( 'Reset to default', 'shadowcore' ); ?>"><?php echo esc_html__( 'Default', 'shadowcore' ); ?></span>
                    <div class="cc-number-slider" <?php echo ( $step !== '' ? 'data-step="'. esc_attr( $step ) .'"' : '' ); ?>></div>
                    <div class="cc-number-value-wrapper">
                        <input type="number" <?php $this->link(); ?> class="cc-number-value" value="<?php echo $this->value(); ?>" <?php echo ( $min !== '' ? 'min="'. esc_attr( $min ) .'"' : '' ); ?> <?php echo ( $max !== '' ? 'max="'. esc_attr( $max ) .'"' : '' ); ?> <?php echo ( $step !== '' ? 'step="'. esc_attr( $step ) .'"' : '' ); ?>/>
                    </div>
                </div><!-- .customize-control-content -->
                <?php
            } else {
                ?>
                <div class="customize-control-content" <?php echo ( $this->custom_class !== '' ? 'data-class="'. esc_attr( $this->custom_class ) .'"' : '' ) ?>>
                    <input type="number" <?php $this->link(); ?> class="cc-number-value" value="<?php echo $this->value(); ?>" <?php echo ( $min !== '' ? 'min="'. esc_attr( $min ) .'"' : '' ); ?> <?php echo ( $max !== '' ? 'max="'. esc_attr( $max ) .'"' : '' ); ?> <?php echo ( $step !== '' ? 'step="'. esc_attr( $step ) .'"' : '' ); ?>/>
                </div><!-- .customize-control-content -->
                <?php
            }
            
		}
	}
endif;