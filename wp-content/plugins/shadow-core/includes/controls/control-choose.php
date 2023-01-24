<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Shadow_Customize_Choose_Control' ) && class_exists( 'WP_Customize_Control' ) ) :
	class Shadow_Customize_Choose_Control extends WP_Customize_Control {
		
		# Set Type
		public $type = 'choose'; 
		public $style = ''; // Text, Icon, Image, Accent Color
		public $options = array(); // Items Array
		public $config = array(); // Additional Settings
		public $custom_class = ''; // Custom Class
		
		# Enqueue Scrits and Styles
		public function enqueue() {
			wp_enqueue_style( 'shadow-customize-controls-css', SHADOWCORE_ASSETS_URL . 'css/customize-controls.css' );
			wp_enqueue_script( 'shadow-customize-controls-js', SHADOWCORE_ASSETS_URL . 'js/customize-controls.js', array('jquery'), false, true);
    	}
							  
		# Display Control Content
		public function render_content() {
			
			if ( !is_array( $this->options ) ) {
				return;
			}
			
			$additional_class = '';
			$margin = 0;
			
			if ( $this->style == 'image' ) {
				$columns = count($this->options);

				if ( is_array( $this->config ) ) {
					if ( !empty( $this->config['columns'] ) ) $columns = $this->config['columns'];
				}

				if ( is_array( $this->config ) ) {
					if ( !empty( $this->config['margin'] ) ) $margin = $this->config['margin'];
				}
				$additional_class = 'columns'.$columns;
			}

			$current_value = $this->value();

			if ( !empty( $this->label ) ) :
				echo '<span class="customize-control-title">'. esc_html( $this->label ) .'</span>';
			endif;
			
			if ( !empty( $this->description ) ) :
				echo '<span class="description customize-control-description">'. $this->description .'</span>';
			endif;
			
			?>
			<div class="customize-control-content" <?php echo ( $this->custom_class !== '' ? 'data-class="'. esc_attr( $this->custom_class ) .'"' : '' ) ?>>
				<div id="_customize-input-<?php echo esc_attr( $this->id ); ?>" class="cc-choose-wrapper cc-choose-wrapper-<?php echo esc_attr( $this->style ); ?> <?php echo esc_attr( $additional_class ); ?>" data-margin="<?php echo esc_attr( $margin ); ?>">
					<?php
						foreach ( $this->options as $key => $value ) {
							if ( $key == $current_value ) {
								$item_class = 'cc-choose-item active';
                            } else {
								$item_class = 'cc-choose-item';
							}
							if ( $this->style == 'icon' ) {
                                # Icon Type
								echo '<div class="'. esc_attr( $item_class ) .'" data-value="'. esc_attr( $key ) .'" title="'. esc_attr( $value['title'] ) .'"><i class="'. esc_attr($value['icon']) .'"></i></div>';
                                
							} else if ( $this->style == 'image' ) {
                                # Image Type
								echo '<div class="'. esc_attr( $item_class ) .'" data-value="'. esc_attr( $key ) .'" title="'. esc_attr( $value['title'] ) .'">
									<img class="cc-choose-img" src="'. esc_attr( $value['img'] ) .'" alt="'. esc_attr($value['title']) .'"/>
									<img class="cc-choose-img-active" src="'. esc_attr( $value['img_active'] ) .'" alt="'. esc_attr( $value['title'] ) .'"/>
								</div>';
                            } else if ( $this->style == 'accent_color' ) {
                                # Accent Color Type
								echo '<div class="'. esc_attr( $item_class ) .' cc-choose-color" data-value="'. esc_attr( $key ) .'" title="'. esc_attr( $value ) .'">
                                    <span><img src="'. get_template_directory_uri() .'/assets/img/null.png" alt="null"/></span>
                                </div>';          
							} else {
                                # Text Type
								echo '<div class="'. esc_attr( $item_class ) .'" data-value="'. esc_attr( $key ) .'">'. esc_attr( $value ) .'</div>';
							}
						}
					?>
					<input type="hidden" <?php $this->link(); ?> value="<?php echo $this->value(); ?>" />
				</div><!-- .cc-choose-wrapper -->
				<?php
				if ( !empty( $this->caption ) ) :
					echo '<div class="customize-control-switcher-caption">'. esc_html( $this->caption ) .'</div>';
				endif;
				?>
			</div><!-- .customize-control-content -->
			<?php
		}
	}
endif;