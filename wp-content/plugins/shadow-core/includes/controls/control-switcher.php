<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Shadow_Customize_Switcher_Control' ) && class_exists( 'WP_Customize_Control' ) ) :
	class Shadow_Customize_Switcher_Control extends WP_Customize_Control {
		
		# Set Type
		public $type = 'switcher';
		public $options = array();
		public $custom_class = '';
		
		# Enqueue Scrits and Styles
		public function enqueue() {
			wp_enqueue_style( 'shadow-customize-controls-css', SHADOWCORE_ASSETS_URL . 'css/customize-controls.css' );
			wp_enqueue_script( 'shadow-customize-controls-js', SHADOWCORE_ASSETS_URL . 'js/customize-controls.js', array('jquery'), false, true);
    	}
							  
		# Display Control Content
		public function render_content() {
				
			if ( !empty( $this->label ) ) :
				echo '<span class="customize-control-title">'. esc_html( $this->label ) .'</span>';
			endif;
			
			if ( !empty( $this->description ) ) :
				echo '<span class="description customize-control-description">' . $this->description . '</span>';
			endif;
			
			if ( $this->value() ) {
				$value_class = 'toggled_on';
			} else {
				$value_class = '';
			}
			?>
			<div class="customize-control-content" <?php echo ( $this->custom_class !== '' ? 'data-class="'. esc_attr( $this->custom_class ) .'"' : '' ) ?>>
				<div id="_customize-input-<?php echo esc_attr( $this->id ); ?>" class="cc-switcher-wrapper">
					<div class="cc-switcher <?php echo esc_attr( $value_class ); ?>">
						<span class="cc-switcher-circle"></span>
					</div>
					<input type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> <?php checked( $this->value() ); ?>/>
				</div><!-- .customize-control-switcher-wrapper -->
				<?php
				if ( !empty( $this->options['caption'] ) ) :
					echo '<div class="customize-control-switcher-caption">'. esc_html( $this->options['caption'] ) .'</div>';
				endif;
				?>
			</div><!-- .customize-control-content -->
			<?php
		}
	}
endif;