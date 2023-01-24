<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Shadow_Testimonials_Carousel_Widget extends Widget_Base {
	
	public function get_name() {
		return 'shadow-testimonials-carousel';
	}
	
	public function get_title() {
		return esc_html__( 'Testimonials Carousel', 'shadowcore' );
	}
	
	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}
	
	public function get_categories() {
		return [ 'shadow-elements' ];
	}

	public function get_script_depends() {
		return [ 'owl-carousel' ];
	}
		
	public function get_style_depends() {
		return [ 'owl-carousel' ];
	}
	
	protected function _register_controls() {		
		# TAB: CONTENT
		# Section: Content Settings
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Item Content', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'author_image',
			[
				'label' => esc_html__( 'Author Image', 'shadowcore' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => get_template_directory_uri() . '/assets/img/holders/avatar-holder.png',
				],
			]
		);
		$repeater->add_control(
			'divider-content01',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_control(
			'author_name',
			[
				'label' => esc_html__( 'Author Name', 'shadowcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Author', 'shadowcore' )
			]
		);
		$repeater->add_control(
			'occupation',
			[
				'label' => esc_html__( 'Occupation', 'shadowcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Occupation', 'shadowcore' )
			]
		);
		
		$repeater->add_control(
			'divider-content02',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_control(
            'testimonial_text',
            [
                'label' => esc_html__( 'Testimonial', 'shadowcore' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
            ]
		);
		$repeater->add_control(
			'divider-content03',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'testimonials',
			[
				'label' => esc_html__( 'Testimonials', 'shadowcore' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ author_name }}}',
				'default' => [
					[
						'author_image' => [ 'url' => get_template_directory_uri() . '/assets/img/holders/avatar-holder.png' ],
						'author_name' => esc_html__( 'John Doe', 'shadowcore' ),
						'occupation' => esc_html__( 'Occupation', 'shadowcore' ),
						'testimonial_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
					],
					[
						'author_image' => [ 'url' => get_template_directory_uri() . '/assets/img/holders/avatar-holder.png' ],
						'author_name' => esc_html__( 'John Doe', 'shadowcore' ),
						'occupation' => esc_html__( 'Occupation', 'shadowcore' ),
						'testimonial_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
					],
				]
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Layout and Align', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'occupation_above',
			[
				'label' => esc_html__( 'Occupation Above Heading?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'shadowcore-op-above--',
			]
		);
		$this->add_control(
			'divider-repeater',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_responsive_control(
			'item_spacing',
			[
				'label' => esc_html__( 'Items Spacing', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
				],
			]
		);
		$this->add_control(
			'divider-layout00',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'head_layout',
			[
				'label' => esc_html__( 'Author Layout', 'shadowcore' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'horizontal' => [
						'title' => esc_html__( 'Horizontal', 'shadowcore' ),
						'icon' => 'eicon-h-align-stretch',
					],
					'vertical' => [
						'title' => esc_html__( 'Vertical', 'shadowcore' ),
						'icon' => 'eicon-v-align-stretch',
					],
				],
				'default' => 'horizontal',
				'toggle' => false,
				'prefix_class' => 'shadowcore-testimonials-layout--',
			]
		);
		$this->add_control(
			'head_v_layout',
			[
				'label' => esc_html__( 'Author Vertical Align', 'shadowcore' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Top', 'shadowcore' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Middle', 'shadowcore' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__( 'Bottom', 'shadowcore' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'flex-start',
				'toggle' => false,
				'condition' => [
					'head_layout' => 'horizontal'
				],
				'selectors' => [
					'{{WRAPPER}}.shadowcore-testimonials-layout--horizontal .shadowcore-testimonials-item__author' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_alignment',
			[
				'label' => esc_html__( 'Author Name Alignment', 'shadowcore' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'shadowcore' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'shadowcore' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'shadowcore' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'right',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__author--name' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .shadowcore-testimonials-item__author--name span' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'divider-layout01',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'image_title_swap',
			[
				'label' => esc_html__( 'Swap Image and Title?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'no',
				'prefix_class' => 'shadowcore-swap-head--',
			]
		);
		$this->add_control(
			'card_swap',
			[
				'label' => esc_html__( 'Swap Content and Author?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'no',
				'prefix_class' => 'shadowcore-swap-cotent--',
			]
		);
		$this->add_control(
			'divider-layout02',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'content_alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'shadowcore' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'shadowcore' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'shadowcore' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'shadowcore' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		# TAB: STYLE
		# Section: Image Style
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image Styles', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'image_shape',
			[
				'label' => esc_html__( 'Image Shape', 'shadowcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'square',
				'options' => [
					'original' => esc_html__( 'Original', 'shadowcore' ),
					'square' => esc_html__( 'Square', 'shadowcore' ),
				]
			]
		);
		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__( 'Image Size', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300
					],
					'%' => [
						'min' => 0,
						'max' => 100
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__author--image' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.shadowcore-infocard-layout--horizontal .shadowcore-testimonials-item__author--name' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Image Border Radius', 'shadowcore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'isLinked' => true,
					'unit' => '%'
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__author--image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => esc_html__( 'Image Shadow', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-testimonials-item__author--image img'
			]
		);

		$this->end_controls_section();

		# Section: Heading Style
		$this->start_controls_section(
			'section_style_heading',
			[
				'label' => esc_html__( 'Author Styles', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'heading_margin',
			[
				'label' => esc_html__( 'Author Name Margin', 'shadowcore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '-25',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__author--name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'heading_spacing',
			[
				'label' => esc_html__( 'Author Name Padding', 'shadowcore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__author--name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__( 'Author Name Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__author--name' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'heading_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-testimonials-item__author--name',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typo',
				'label' => esc_html__( 'Author Name Typography', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-testimonials-item__author--name'
			]
		);
		$this->add_control(
			'divider-style-heading01',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_responsive_control(
			'oc_spacing',
			[
				'label' => esc_html__( 'Occupation Spacing', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					],
					'%' => [
						'min' => 0,
						'max' => 100
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__author--name > span:first-child' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shadowcore-testimonials-item__author--name > span:last-child' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'caption_color',
			[
				'label' => esc_html__( 'Occupation Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__author--name > span' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typo',
				'label' => esc_html__( 'Occupation Typography', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-testimonials-item__author--name > span'
			]
		);

		$this->end_controls_section();
		
		# Section: Content Style
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content Styles', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Content Margin', 'shadowcore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '50',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Content Padding', 'shadowcore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'divider-style-content01',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'content_bg',
			[
				'label' => esc_html__( 'Background Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__content' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Text Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__content' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'divider-style-content02',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typo',
				'label' => esc_html__( 'Content Typography', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-testimonials-item__content'
			]
		);

		$this->end_controls_section();

		# Section: Navigation Style
		$this->start_controls_section(
			'section_style_nav',
			[
				'label' => esc_html__( 'Navigation Styles', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'nav_border_radius',
			[
				'label' => esc_html__( 'Navigation Border Radius', 'shadowcore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'isLinked' => true,
					'unit' => '%'
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-carousel .owl-dots button.owl-dot span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'divider-style-nav01',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_responsive_control(
			'nav_top_spacing',
			[
				'label' => esc_html__( 'Navigation Top Spacing', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-carousel .shadowcore-owl-container .owl-dots' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'nav_spacing',
			[
				'label' => esc_html__( 'Navigation Item Spacing', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-carousel .owl-dots button.owl-dot' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shadowcore-testimonials-carousel .owl-dots button.owl-dot:first-child' => 'margin-left: 0;',
				],
			]
		);
		$this->add_responsive_control(
			'nav_size',
			[
				'label' => esc_html__( 'Navigation Item Size', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-carousel .owl-dots button.owl-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shadowcore-testimonials-carousel .owl-dots button.owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'divider-style-nav02',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		# State Tabs
		$this->start_controls_tabs( 'nav_style_tabs' );
		
			# Tab: Normal
			$this->start_controls_tab(
				'nav_normal',
				[
					'label' => esc_html__( 'Normal', 'shadowcore' )
				]
			);
				$this->add_control(
					'item_color',
					[
						'label' => esc_html__( 'Item Color', 'shadowcore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .shadowcore-testimonials-carousel .owl-dots button.owl-dot span' => 'background: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'item_border',
						'selector' => '{{WRAPPER}} .shadowcore-testimonials-carousel .owl-dots button.owl-dot span',
					]
				);
			$this->end_controls_tab();
		
			# Tab: Hover
			$this->start_controls_tab(
				'nav_hover',
				[
					'label' => esc_html__( 'Hover', 'shadowcore' )
				]
			);
				$this->add_control(
					'item_color_hover',
					[
						'label' => esc_html__( 'Item Color', 'shadowcore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .shadowcore-testimonials-carousel .owl-dots button.owl-dot:hover span' => 'background: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'item_border_hover',
						'selector' => '{{WRAPPER}} .shadowcore-testimonials-carousel .owl-dots button.owl-dot:hover span',
					]
				);
			$this->end_controls_tab();

			# Tab: Active
			$this->start_controls_tab(
				'nav_active',
				[
					'label' => esc_html__( 'Active', 'shadowcore' )
				]
			);
				$this->add_control(
					'item_color_active',
					[
						'label' => esc_html__( 'Item Color', 'shadowcore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .shadowcore-testimonials-carousel .owl-dots button.owl-dot.active span' => 'background: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'item_border_active',
						'selector' => '{{WRAPPER}} .shadowcore-testimonials-carousel .owl-dots button.owl-dot.active span',
					]
				);
			$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings();
		$image_size = 300;
		$image_shape = $settings[ 'image_shape' ];
		?>
		<div class="shadowcore-testimonials-carousel">
			<div class="shadowcore-owl-container owl-carousel owl-theme" id="<?php echo esc_attr( $this->get_id() ); ?>" data-gutter="<?php echo esc_attr( $settings[ 'item_spacing' ][ 'size' ] ); ?>" data-speed="1000">
			<?php
			foreach (  $settings[ 'testimonials' ] as $item ) {
				$image = $item[ 'author_image' ];
				$author_name = $item[ 'author_name' ];
				$occupation = $item[ 'occupation' ];
				$description = $item[ 'testimonial_text' ];
				if ( ! empty ( $image[ 'id' ])) {
					if ( $image_shape == 'original' ) {
						$image_url = aq_resize( esc_url( wp_get_attachment_url( $image[ 'id' ] ) ), absint( $image_size ), '', true, true, true );
					} else {
						$image_url = aq_resize( esc_url( wp_get_attachment_url( $image[ 'id' ] ) ), absint( $image_size ), absint( $image_size ), true, true, true );
					}
				} else {
					$image_url = $image[ 'url' ];
				}
				?>
				<div class="shadowcore-testimonials-item align-center swiper-slide">
					<div class="shadowcore-testimonials-item__content">
						<p><?php echo esc_html( $description ); ?></p>
					</div><!-- .shadowcore-testimonials-item__content -->
					<div class="shadowcore-testimonials-item__author">
						<div class="shadowcore-testimonials-item__author--image">
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_html( $author_name ); ?>">
						</div>
						<div class="shadowcore-testimonials-item__author--name">
							<span><?php echo esc_html( $occupation ); ?></span>
							<?php echo esc_html( $author_name ); ?>
							<span><?php echo esc_html( $occupation ); ?></span>
						</div>
					</div><!-- .shadowcore-testimonials-item__author -->
				</div><!-- .shadowcore-testimonials-item -->
				<?php		
			}
			?>
			</div><!-- .shadowcore-testimonials-carousel -->
		</div><!-- .shadowcore-tns-container -->
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Shadow_Testimonials_Carousel_Widget() );