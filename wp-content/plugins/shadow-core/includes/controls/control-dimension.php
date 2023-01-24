<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Shadow_Customize_Dimension_Control' ) && class_exists( 'WP_Customize_Control' ) ) :
	class Shadow_Customize_Dimension_Control extends WP_Customize_Control {
		
		# Set Type
		public $disable = array();
		public $custom_class = ''; // Custom Class
		public $locked = ''; // Custom Class
		
		# Enqueue Scrits and Styles
		public function enqueue() {
			wp_enqueue_style( 'shadow-customize-controls-css', SHADOWCORE_ASSETS_URL . 'css/customize-controls.css' );
			wp_enqueue_script( 'shadow-customize-controls-js', SHADOWCORE_ASSETS_URL . 'js/customize-controls.js', array( 'jquery' ), false, true );
    	}
        
		# Display Control Content
		public function render_content() {
			
            $control_id = dechex( mt_rand( 0, 9999 ) );
            
            $disabled['top'] = 'no';
            $disabled['right'] = 'no';
            $disabled['bottom'] = 'no';
            $disabled['left'] = 'no';
            
            $current_value = explode( '/', $this->value() );
				
			if ( ! empty( $this->label ) ) :
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
			endif;
			
			if ( ! empty( $this->description ) ) :
				echo '<span class="description customize-control-description">' . $this->description . '</span>';
			endif;
            
            foreach ( $this->disable as $key => $value ) {
                $disabled[$key] = $value;
            }
            
			?>
			<div class="customize-control-content <?php echo ( $this->locked == 'no' ? '' : 'cc-dimension-locked' ) ?> cc-dimension-wrapper" id="<?php echo esc_attr( $control_id ); ?>" <?php echo ( $this->custom_class !== '' ? 'data-class="' . esc_attr( $this->custom_class ) . '"' : '' ) ?>>
				<ul class="cc-dimension-list">
                    <li>
                        <input type="number" id="cc-dimension-<?php echo esc_attr( $control_id ); ?>-top" class="cc-dimension-top cc-dimension-input" <?php echo ( $disabled['top'] == 'yes' ? 'disabled' : '' ); ?> value="<?php echo ( $current_value[0] !== 'd' ? esc_attr( $current_value[0] ) : '' ); ?>"/>
                        <label for="cc-dimension-<?php echo esc_attr( $control_id ); ?>-top" class="cc-dimension-label"><?php echo esc_html__('Top', 'shadowcore'); ?></label>
                    </li>
                    <li>
                        <input type="number" id="cc-dimension-<?php echo esc_attr( $control_id ); ?>-right" class="cc-dimension-right cc-dimension-input" <?php echo ( $disabled['right'] == 'yes' ? 'disabled' : '' ); ?> value="<?php echo ( $current_value[1] !== 'd' ? esc_attr( $current_value[1] ) : '' ); ?>"/>
                        <label for="cc-dimension-<?php echo esc_attr( $control_id ); ?>-right" class="cc-dimension-label"><?php echo esc_html__('Right', 'shadowcore'); ?></label>
                    </li>
                    <li>
                        <input type="number" id="cc-dimension-<?php echo esc_attr( $control_id ); ?>-bottom" class="cc-dimension-bottom cc-dimension-input" <?php echo ( $disabled['bottom'] == 'yes' ? 'disabled' : '' ); ?> value="<?php echo ( $current_value[2] !== 'd' ? esc_attr( $current_value[2] ) : '' ); ?>"/>
                        <label for="cc-dimension-<?php echo esc_attr( $control_id ); ?>-bottom" class="cc-dimension-label"><?php echo esc_html__('Bottom', 'shadowcore'); ?></label>
                    </li>
                    <li>
                        <input type="number" id="cc-dimension-<?php echo esc_attr( $control_id ); ?>-left" class="cc-dimension-left cc-dimension-input" <?php echo ( $disabled['left'] == 'yes' ? 'disabled' : '' ); ?> value="<?php echo ( $current_value[3] !== 'd' ? esc_attr( $current_value[3] ) : '' ); ?>"/>
                        <label for="cc-dimension-<?php echo esc_attr( $control_id ); ?>-left" class="cc-dimension-label"><?php echo esc_html__('Left', 'shadowcore'); ?></label>
                    </li>
                    <li>
                        <span class="cc-dimension-lock">
                            <i class="la la-chain"></i>
                            <i class="la la-chain-broken"></i>
                        </span>
                    </li>
				</ul><!-- .cc-dimension-list -->
                <input type="hidden" <?php $this->link(); ?> class="cc-dimension-value" value="<?php echo $this->value(); ?>" />
			</div><!-- .customize-control-content -->
			<?php
		}
	}
endif;