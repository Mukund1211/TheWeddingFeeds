<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Shadow_Countdown_Widget extends Widget_Base {
	
	public function get_name() {
		return 'shadow-countdown';
	}
	
	public function get_title() {
		return esc_html__( 'Count Down', 'shadowcore' );
	}
	
	public function get_icon() {
		return 'eicon-countdown';
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
				'label' => esc_html__( 'Settings', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_control(
			'date',
			[
				'label' => esc_html__( 'Due Date', 'shadowcore' ),
				'type' => Controls_Manager::DATE_TIME,
				'picker_options' => array(
					'enableTime' => false
				),
				'default' => date('Y-m-d', strtotime('+1 year'))
			]
		);
		$this->add_control(
			'divider-date',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'label-state',
			[
				'label' => esc_html__( 'Show Labels', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'shadowcore-labels-state--',
			]
		);
		$this->add_control(
			'label_day',
			[
				'label' => esc_html__( 'Days Label', 'shadowcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Days', 'shadowcore' ),
				'condition' => [
					'label-state' => 'yes'
				]
			]
		);
		$this->add_control(
			'label_hour',
			[
				'label' => esc_html__( 'Hours Label', 'shadowcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Hours', 'shadowcore' ),
				'condition' => [
					'label-state' => 'yes'
				]
			]
		);
		$this->add_control(
			'label_min',
			[
				'label' => esc_html__( 'Minutes Label', 'shadowcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Minutes', 'shadowcore' ),
				'condition' => [
					'label-state' => 'yes'
				]
			]
		);
		$this->add_control(
			'label_sec',
			[
				'label' => esc_html__( 'Seconds Label', 'shadowcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Seconds', 'shadowcore' ),
				'condition' => [
					'label-state' => 'yes'
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typo',
				'label' => esc_html__( 'Number Typography', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-coming-soon__count',
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Number Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-coming-soon__count' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typo',
				'label' => esc_html__( 'Label Typography', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-coming-soon__label',
				'condition' => [
					'label-state' => 'yes'
				]
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__( 'Label Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-coming-soon__label' => 'color: {{VALUE}};'
				],
				'condition' => [
					'label-state' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'label_spacing',
			[
				'label' => esc_html__( 'Label Spacing', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 100
					]
				],
                'default' => [
                    'unit' => 'px',
                    'size' => -4,
                ],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-coming-soon__label' => 'margin-top: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'label-state' => 'yes'
				]
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$date = strtotime( $this->get_settings( 'date' ) );
		$labels_state = $settings[ 'label-state' ];
		$label_d = $settings[ 'label_day' ];
		$label_h = $settings[ 'label_hour' ];
		$label_m = $settings[ 'label_min' ];
		$label_s = $settings[ 'label_sec' ];
		?>
		<div class="shadowcore-coming-soon">
			<div class="shadowcore-coming-soon--days">
				<div class="shadowcore-coming-soon__count">0</div>
				<span class="shadowcore-coming-soon__label"><?php echo esc_html( $label_d ); ?></span>
			</div>
			<div class="shadowcore-coming-soon--hours">
				<div class="shadowcore-coming-soon__count">0</div>
				<span class="shadowcore-coming-soon__label"><?php echo esc_html( $label_h ); ?></span>
			</div>
			<div class="shadowcore-coming-soon--minutes">
				<div class="shadowcore-coming-soon__count">0</div>
				<span class="shadowcore-coming-soon__label"><?php echo esc_html( $label_m ); ?></span>
			</div>
			<div class="shadowcore-coming-soon--seconds">
				<div class="shadowcore-coming-soon__count">0</div>
				<span class="shadowcore-coming-soon__label"><?php echo esc_html( $label_s ); ?></span>
			</div>
			<time><?php echo $settings[ 'date' ]; ?></time>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Shadow_Countdown_Widget() );