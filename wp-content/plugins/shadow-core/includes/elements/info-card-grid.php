<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Shadow_Info_Card_Grid_Widget extends Widget_Base {
	
	public function get_name() {
		return 'shadow-info-card-grid';
	}
	
	public function get_title() {
		return esc_html__( 'Info Card Grid', 'shadowcore' );
	}
	
	public function get_icon() {
		return 'eicon-posts-grid';
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
				'label' => esc_html__( 'Item Content', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'caption_above',
			[
				'label' => esc_html__( 'Caption Above Heading?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'shadowcore-caption-above--',
			]
		);
		$this->add_control(
			'link_style',
			[
				'label' => esc_html__( 'Link Style', 'shadowcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
					'none' => esc_html__( 'None', 'shadowcore' ),		
					'text' => esc_html__( 'Text', 'shadowcore' ),
					'button' => esc_html__( 'Button', 'shadowcore' )
				]
			]
		);
		$this->add_control(
			'divider-repeater',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'shadowcore' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => get_template_directory_uri() . '/assets/img/holders/image-holder.png',
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
			'heading',
			[
				'label' => esc_html__( 'Heading', 'shadowcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Info Card', 'shadowcore' )
			]
		);
		$repeater->add_control(
			'caption',
			[
				'label' => esc_html__( 'Heading Caption', 'shadowcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'This is Info Card', 'shadowcore' )
			]
		);
		
		$repeater->add_control(
			'divider-content02',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'shadowcore' ),
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
		$repeater->add_control(
            'link_text',
            [
                'label' => esc_html__( 'Link Text', 'shadowcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Link', 'shadowcore' ),
            ]
		);
		$repeater->add_control(
            'link_url',
            [
                'label' => esc_html__( 'Link URL', 'shadowcore' ),
                'type' => Controls_Manager::URL,
				'default' => [
					'url' => '',
					'is_external' => 'true',
				],
				'placeholder' => esc_html__( 'https://your-link.com/', 'shadowcore' ),
            ]
		);

		$this->add_control(
			'card_item',
			[
				'label' => esc_html__( 'Info Cards', 'shadowcore' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ heading }}}',
				'default' => [
					[
						'image' => ['url' => get_template_directory_uri() . '/assets/img/holders/image-holder.png'],
						'heading' => esc_html__( 'Info Card', 'shadowcore' ),
						'caption' => esc_html__( 'This is Info Card', 'shadowcore' ),
						'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
						'link_text' => esc_html__( 'Your Link', 'shadowcore' ),
						'link_url' => ['url' => '', 'is_external' => 'true']
					],
					[
						'image' => ['url' => get_template_directory_uri() . '/assets/img/holders/image-holder.png'],
						'heading' => esc_html__( 'Info Card', 'shadowcore' ),
						'caption' => esc_html__( 'This is Info Card', 'shadowcore' ),
						'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
						'link_text' => esc_html__( 'Your Link', 'shadowcore' ),
						'link_url' => ['url' => '', 'is_external' => 'true']
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

		$this->add_responsive_control(
			'grid_columns',
			[
				'label' => esc_html__( 'Grid Columns', 'shadowcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '50%',
				'options' => [
					'100%' 	 => esc_html__( 'One Column', 'shadowcore' ),
					'50%' 	 => esc_html__( 'Two Columns', 'shadowcore' ),
					'33.33%' => esc_html__( 'Three Columns', 'shadowcore' ),
					'25%' 	 => esc_html__( 'Four Columns', 'shadowcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-service-card' => 'width: {{VALUE}};',
				]
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
                    'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-service-card-grid' => 'margin: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shadowcore-service-card' => 'padding: {{SIZE}}{{UNIT}};',
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
				'label' => esc_html__( 'Image and Title Layout', 'shadowcore' ),
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
				'prefix_class' => 'shadowcore-infocard-layout--',
			]
		);
		$this->add_control(
			'head_v_layout',
			[
				'label' => esc_html__( 'Vertical Align', 'shadowcore' ),
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
				'default' => 'center',
				'toggle' => false,
				'condition' => [
					'head_layout' => 'horizontal'
				],
				'selectors' => [
					'{{WRAPPER}}.shadowcore-infocard-layout--horizontal .shadowcore-service-card__head' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_alignment',
			[
				'label' => esc_html__( 'Heading Alignment', 'shadowcore' ),
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
					'{{WRAPPER}} .shadowcore-service-card__label' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .shadowcore-service-card__label span' => 'text-align: {{VALUE}};',
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
				'label' => esc_html__( 'Swap Content and Heading?', 'shadowcore' ),
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
				'default' => 'left',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-service-card__content' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'divider-layout03',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'link_style!' => 'none'
				]
			]
		);
		$this->add_control(
			'link_alignment',
			[
				'label' => esc_html__( 'Link Alignment', 'shadowcore' ),
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
					'{{WRAPPER}} .shadowcore-service-card__link' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'link_style!' => 'none'
				]
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
						'max' => 960
					],
					'%' => [
						'min' => 0,
						'max' => 100
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 155,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-service-card__image' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.shadowcore-infocard-layout--horizontal .shadowcore-service-card__label' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
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
					'{{WRAPPER}} .shadowcore-service-card__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => esc_html__( 'Button Shadow', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-service-card__image img'
			]
		);

		$this->end_controls_section();

		# Section: Heading Style
		$this->start_controls_section(
			'section_style_heading',
			[
				'label' => esc_html__( 'Heading Styles', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'heading_spacing',
			[
				'label' => esc_html__( 'Heading Padding', 'shadowcore' ),
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
					'{{WRAPPER}} .shadowcore-service-card__label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__( 'Heading Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-service-card__label' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typo',
				'label' => esc_html__( 'Heading Typography', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-service-card__label'
			]
		);
		$this->add_control(
			'divider-style-heading01',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_responsive_control(
			'caption_spacing',
			[
				'label' => esc_html__( 'Caption Spacing', 'shadowcore' ),
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
					'{{WRAPPER}} .shadowcore-service-card__label > span:first-child' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shadowcore-service-card__label > span:last-child' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'caption_color',
			[
				'label' => esc_html__( 'Caption Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-service-card__label > span' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typo',
				'label' => esc_html__( 'Caption Typography', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-service-card__label > span'
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
					'top' => '-40',
					'right' => '0',
					'bottom' => '0',
					'left' => '30',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-service-card__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
					'top' => '66',
					'right' => '29',
					'bottom' => '28',
					'left' => '29',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-service-card__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
					'{{WRAPPER}} .shadowcore-service-card__content' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Text Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-service-card__content' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .shadowcore-service-card__content'
			]
		);

		$this->end_controls_section();

		# Section: Link Style
		$this->start_controls_section(
			'section_style_link',
			[
				'label' => esc_html__( 'Link Styles', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_typo',
				'label' => esc_html__( 'Typography', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-service-card__link > a'
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'link_shadow',
				'label' => esc_html__( 'Text Shadow', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-service-card__link > a',
			]
		);
		$this->add_control(
			'divider-style-link01',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		# State Tabs
		$this->start_controls_tabs( 'more_button_settings_tabs' );
		
			# Tab: Normal
			$this->start_controls_tab(
				'tab_link_normal',
				[
					'label' => esc_html__( 'Normal', 'shadowcore' )
				]
			);

				$this->add_control(
					'link_normal_color',
					[
						'label' => esc_html__( 'Link Color', 'shadowcore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .shadowcore-service-card__link > a' => 'color: {{VALUE}};'
						]
					]
				);
				$this->add_control(
					'link_normal_bg',
					[
						'label' => esc_html__( 'Link Background', 'shadowcore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .shadowcore-service-card__link > a' => 'background-color: {{VALUE}};'
						],
						'condition' => [
							'link_style' => 'button'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'link_border',
						'selector' => '{{WRAPPER}} .shadowcore-service-card__link > a',
						'condition' => [
							'link_style' => 'button'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'link_box_shadow',
						'label' => esc_html__( 'Button Shadow', 'shadowcore' ),
						'selector' => '{{WRAPPER}} .shadowcore-service-card__link > a',
						'condition' => [
							'link_style' => 'button'
						]
					]
				);

			$this->end_controls_tab();
			
			# Tab: Hover
			$this->start_controls_tab(
				'tab_link_hover',
				[
					'label' => esc_html__( 'Hover', 'shadowcore' )
				]
			);

				$this->add_control(
					'link_hover_color',
					[
						'label' => esc_html__( 'Link Hover Color', 'shadowcore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .shadowcore-service-card__link > a:hover' => 'color: {{VALUE}};'
						]
					]
				);
				$this->add_control(
					'link_hover_bg',
					[
						'label' => esc_html__( 'Link Hover Background', 'shadowcore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .shadowcore-service-card__link > a:hover' => 'background-color: {{VALUE}};'
						],
						'condition' => [
							'link_style' => 'button'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'link_border_hover',
						'selector' => '{{WRAPPER}} .shadowcore-service-card__link > a:hover',
						'condition' => [
							'link_style' => 'button'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'link_box_shadow_hover',
						'label' => esc_html__( 'Button Hover Shadow', 'shadowcore' ),
						'selector' => '{{WRAPPER}} .shadowcore-service-card__link > a:hover',
						'condition' => [
							'link_style' => 'button'
						]
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->add_control(
			'divider-style-link02',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'link_style' => 'button'
				]
			]
		);
		$this->add_responsive_control(
			'link_padding',
			[
				'label' => esc_html__( 'Button Padding', 'shadowcore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-service-card__link > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'default' => [
					'top' => '15',
					'right' => '40',
					'bottom' => '15',
					'left' => '40',
					'isLinked' => false,
					'unit' => 'px'
				],
				'condition' => [
					'link_style' => 'button'
				]
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings();
		$image_size = 960;
		$image_shape = $settings[ 'image_shape' ];
		$link_style = $settings[ 'link_style' ];
		?>
		<div class="shadowcore-service-card-grid">
		<?php
		foreach (  $settings[ 'card_item' ] as $item ) {
			$image = $item[ 'image' ];
			$heading = $item[ 'heading' ];
			$caption = $item[ 'caption' ];
			$description = $item[ 'description' ];
			$link_text = $item[ 'link_text' ];
			$link_url = $item[ 'link_url' ];
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
			<div class="shadowcore-service-card">
				<div class="shadowcore-service-card__head">
					<div class="shadowcore-service-card__image">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_post_meta( $image[ 'id' ], '_wp_attachment_image_alt', true ) ); ?>">
					</div>
					<div class="shadowcore-service-card__label">
						<span><?php echo esc_html( $caption ); ?></span>
						<?php echo esc_html( $heading ); ?>
						<span><?php echo esc_html( $caption ); ?></span>
					</div>
				</div><!-- .shadowcore-service-card__head -->
				<div class="shadowcore-service-card__content">
					<?php echo esc_html( $description ); ?>
					<?php
					if ( 'none' !== $link_style ) {
						echo '
						<div class="shadowcore-service-card__link">
							<a href="' . esc_url( $link_url[ 'url' ] ) . '" ' . ( $link_url[ 'is_external' ] ? 'target="_blank"' : 'target="_self"' ) . ' ' . ( $link_url[ 'nofollow' ] ? 'rel="nofollow"' : '' ) . ' class="shadowcore-service-card__link--' . esc_attr( $link_style ) . '">' . esc_html( $link_text ) . '</a>
						</div>';
					}
					?>
				</div><!-- .shadowcore-service-card__content -->
			</div><!-- .shadowcore-service-card -->
			<?php		
		}
		?>
		</div><!-- .shadowcore-service-card-grid -->
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Shadow_Info_Card_Grid_Widget() );