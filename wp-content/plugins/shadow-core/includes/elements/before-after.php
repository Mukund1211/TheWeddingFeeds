<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Shadow_Before_After_Widget extends Widget_Base {
	
	public function get_name() {
		return 'shadow-before-after';
	}
	
	public function get_title() {
		return esc_html__( 'Before and After', 'shadowcore' );
	}
	
	public function get_icon() {
		return 'eicon-image-before-after';
	}
	
	public function get_categories() {
		return [ 'shadow-elements' ];
	}
	
	protected function _register_controls() {		
		# TAB: CONTENT
		# Section: Settings
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Select Images', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'image_before',
			[
				'label' => esc_html__( 'Before Image', 'shadowcore' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'image_after',
			[
				'label' => esc_html__( 'After Image', 'shadowcore' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'divider-images',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'crop-images',
			[
				'label' => esc_html__( 'Crop Images?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);		
		$this->add_control(
			'image_width',
			[
				'label' => esc_html__( 'Image Width', 'shadowcore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'default' => 1920,
				'condition' => [
					'crop-images' => 'yes'
				]
			]
		);
		$this->add_control(
			'image_height',
			[
				'label' => esc_html__( 'Image Height', 'shadowcore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'default' => 1280,
				'condition' => [
					'crop-images' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		# TAB: STYLE
		# Section: Typography
		$this->start_controls_section(
			'section_typography',
			[
				'label' => esc_html__( 'Styles', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'divider_icon',
			[
				'label' => esc_html__( 'Show Divider Icon?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'shadowcore-divider-icon--',
			]
		);

		$this->add_control(
			'divider_bg',
			[
				'label' => esc_html__( 'Divider Background', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-before-after-divider' => 'background: {{VALUE}};',
					'{{WRAPPER}} .shadowcore-before-after-divider:before' => 'background: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'divider_color',
			[
				'label' => esc_html__( 'Divider Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-before-after-divider svg path' => 'fill: {{VALUE}};'
				],
				'condition' => [
					'divider_icon' => 'yes'
				]
			]
		);
		
		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$image_before = $settings[ 'image_before' ];
		$image_after = $settings[ 'image_after' ];
		$image_width = $settings[ 'image_width' ];
		$image_height = $settings[ 'image_height' ];
		if ( ! empty( $image_before[ 'id' ] ) ) {
			if ( 'yes' == $settings[ 'crop-images' ] ) {
				$image_before_url = aq_resize( esc_url( wp_get_attachment_url( $image_before[ 'id' ] ) ), absint( $image_width ), absint( $image_height ), true, true, true );
			} else {
				$meta = wp_get_attachment_metadata( $image_before[ 'id' ] );
				$image_width = $meta[ 'width' ];
				$image_height = $meta[ 'height' ];
				$image_before_url = wp_get_attachment_url( $image_before[ 'id' ] );
			}
		} else {
			$image_width = 1200;
			$image_height = 800;
			$image_before_url = Utils::get_placeholder_image_src();
		}
		if ( ! empty( $image_after[ 'id' ] ) ) {
			if ( 'yes' == $settings[ 'crop-images' ] ) {
				$image_after_url = aq_resize( esc_url( wp_get_attachment_url( $image_after[ 'id' ] ) ), absint( $image_width ), absint( $image_height ), true, true, true );
			} else {
				$image_after_url = wp_get_attachment_url( $image_after[ 'id' ] );
			}
		} else {
			$image_after_url = Utils::get_placeholder_image_src();
		}
		?>
		<div class="shadowcore-before-after" data-img-before="<?php echo esc_url( $image_before_url ); ?>" data-img-after="<?php echo esc_url( $image_after_url ); ?>">
			<img src="<?php echo esc_url( $image_before_url ); ?>" alt="<?php echo esc_attr( get_post_meta( $image_before[ 'id' ], '_wp_attachment_image_alt', true ) ); ?>" width="<?php echo esc_attr( $image_width ); ?>" height="<?php echo esc_attr( $image_height ); ?>">
        </div><!-- .shadowcore-before-after -->
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Shadow_Before_After_Widget() );