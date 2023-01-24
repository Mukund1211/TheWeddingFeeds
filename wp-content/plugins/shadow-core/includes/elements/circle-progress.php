<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Shadow_Circle_Progress_Widget extends Widget_Base {
	
	public function get_name() {
		return 'shadow-circle-progress';
	}
	
	public function get_title() {
		return esc_html__( 'Circle Progress Bar', 'shadowcore' );
	}
	
	public function get_icon() {
		return 'eicon-loading';
	}
	
	public function get_categories() {
		return [ 'shadow-elements' ];
	}
	
	protected function _register_controls() {		
		# TAB: CONTENT
		# Section: Content Settings
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_control(
			'progress_value',
			[
				'label' => esc_html__( 'Progress Value', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100
					]
				],
                'default' => [
                    'unit' => '%',
                    'size' => 75,
				],
			]
		);
		$this->add_control(
			'progress_label',
			[
				'label' => esc_html__( 'Label', 'shadowcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Label', 'shadowcore' )
			]
		);
		$this->add_control(
			'progress_state',
			[
				'label' => esc_html__( 'Show Progress in %', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'shadowcore-progress-state--',
			]
		);

		$this->end_controls_section();

		# TAB: STYLE
		# Section: Style
		$this->start_controls_section(
			'section_typography',
			[
				'label' => esc_html__( 'Styles', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'side_spacing',
			[
				'label' => esc_html__( 'Side Spacing', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100
					]
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-progress-item-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bar_size',
			[
				'label' => esc_html__( 'Bar Size', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10
					]
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} svg circle' => 'stroke-width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'bar_bg',
			[
				'label' => esc_html__( 'Bar Background', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-progress-circle--bg' => 'stroke: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'bar_color',
			[
				'label' => esc_html__( 'Bar Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-progress-circle--bar' => 'stroke: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'divider-style01',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'percent_typo',
				'label' => esc_html__( 'Progress Typography', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-progress-counter',
				'condition' => [
					'progress_state' => 'yes'
				]
			]
		);

		$this->add_control(
			'percent_color',
			[
				'label' => esc_html__( 'Percent Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-progress-counter' => 'color: {{VALUE}};'
				],
				'condition' => [
					'progress_state' => 'yes'
				]
			]
		);

		$this->add_control(
			'divider-style02',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'progress_state' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typo',
				'label' => esc_html__( 'Label Typography', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-progress-label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__( 'Label Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-progress-label' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'label_spacing',
			[
				'label' => esc_html__( 'Label Spacing', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					]
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-progress-label' => 'margin-top: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$value = $settings[ 'progress_value' ][ 'size' ];
		$label = $settings[ 'progress_label' ];
		?>
		<div class="shadowcore-progress-item" data-delay="3000" data-percent="<?php echo absint( $value ); ?>">
			<div class="shadowcore-progress-item-wrap">
				<svg 
					width="150" 
					height="150" 
					version="1.1" xmlns="http://www.w3.org/2000/svg">
					<circle 
						class="shadowcore-progress-circle--bg" 
						r="70" 
						cx="75" 
						cy="75" 
						fill="transparent" 
						stroke-dasharray="439.82" 
						stroke-dashoffset="0">
					</circle>
					<circle 
						class="shadowcore-progress-circle--bar" 
						transform="rotate(-90, 75, 75)"
						r="70" 
						cx="75" 
						cy="75" 
						fill="transparent" 
						stroke-dasharray="439.82" 
						stroke-dashoffset="439.82">
					</circle>
				</svg>
				<span class="shadowcore-progress-counter"><?php echo absint( $value ); ?>%</span>
			</div>
			<?php
				if ( ! empty( $label ) ) {
					echo '<span class="shadowcore-progress-label">' . esc_html( $label ) . '</span>';
				}
			?>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Shadow_Circle_Progress_Widget() );