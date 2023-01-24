<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Shadow_Testimonials_Grid_Widget extends Widget_Base {
	
	public function get_name() {
		return 'shadow-testimonials-grid';
	}
	
	public function get_title() {
		return esc_html__( 'Testimonials Grid', 'shadowcore' );
	}
	
	public function get_icon() {
		return 'eicon-comments';
	}
	
	public function get_categories() {
		return [ 'shadow-elements' ];
	}

	public function get_script_depends() {
		return [ 'masonry' ];
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
				'default' => esc_html__( 'John Doe', 'shadowcore' )
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
		$repeater->add_control(
			'rating',
			[
				'label' => esc_html__( 'Rating', 'shadowcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'shadowcore' ),
					1 => esc_html__( '1 Star', 'shadowcore' ),
					2 => esc_html__( '2 Stars', 'shadowcore' ),
					3 => esc_html__( '3 Stars', 'shadowcore' ),
					4 => esc_html__( '4 Stars', 'shadowcore' ),
					5 => esc_html__( '5 Stars', 'shadowcore' ),
				]
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
						'rating' => 4
					],
					[
						'author_image' => [ 'url' => get_template_directory_uri() . '/assets/img/holders/avatar-holder.png' ],
						'author_name' => esc_html__( 'John Doe', 'shadowcore' ),
						'occupation' => esc_html__( 'Occupation', 'shadowcore' ),
						'testimonial_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
						'rating' => 4
					],
					[
						'author_image' => [ 'url' => get_template_directory_uri() . '/assets/img/holders/avatar-holder.png' ],
						'author_name' => esc_html__( 'John Doe', 'shadowcore' ),
						'occupation' => esc_html__( 'Occupation', 'shadowcore' ),
						'testimonial_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
						'rating' => 4
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
			'grid_columns',
			[
				'label' => esc_html__( 'Grid Columns', 'shadowcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '33.33%',
				'options' => [
					'100%' 	 => esc_html__( 'One Column', 'shadowcore' ),
					'50%' 	 => esc_html__( 'Two Columns', 'shadowcore' ),
					'33.33%' => esc_html__( 'Three Columns', 'shadowcore' ),
					'25%' 	 => esc_html__( 'Four Columns', 'shadowcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item' => 'width: {{VALUE}};',
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
                    'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-grid ' => 'margin: -{{SIZE}}{{UNIT}} 0 0 -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shadowcore-testimonials-item' => 'padding: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}};',
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
				'default' => 'left',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__content' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'divider-layout03',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'rating_alignment',
			[
				'label' => esc_html__( 'Rating Alignment', 'shadowcore' ),
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
					'{{WRAPPER}} .shadowcore-testimonials-item__stars' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'rating_position',
			[
				'label' => esc_html__( 'Rating Position', 'shadowcore' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'column' => [
						'title' => esc_html__( 'Top', 'shadowcore' ),
						'icon' => 'eicon-v-align-top',
					],
					'column-reverse' => [
						'title' => esc_html__( 'Bottom', 'shadowcore' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'shadowcore-rating--',
				'default' => 'column',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__content' => 'flex-direction: {{VALUE}};',
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
						'max' => 512
					],
					'%' => [
						'min' => 0,
						'max' => 100
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
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
				'label' => esc_html__( 'Button Shadow', 'shadowcore' ),
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
			'heading_spacing',
			[
				'label' => esc_html__( 'Author Name Padding', 'shadowcore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '12',
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
					'top' => '-30',
					'right' => '0',
					'bottom' => '0',
					'left' => '20',
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
					'top' => '10',
					'right' => '20',
					'bottom' => '18',
					'left' => '20',
					'isLinked' => false,
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

		# Section: Rating Style
		$this->start_controls_section(
			'section_style_rating',
			[
				'label' => esc_html__( 'Rating Styles', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'rating_spacing',
			[
				'label' => esc_html__( 'Rating Spacing', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}}.shadowcore-rating--column .shadowcore-testimonials-item__stars' => 'margin: 0 0 {{SIZE}}{{UNIT}} 0;',
					'{{WRAPPER}}.shadowcore-rating--column-reverse .shadowcore-testimonials-item__stars' => 'margin: {{SIZE}}{{UNIT}} 0 0 0;',
				],
			]
		);
		$this->add_control(
			'rating_color',
			[
				'label' => esc_html__( 'Rating Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-testimonials-item__stars svg path' => 'fill: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings();
		$image_size = 512;
		$image_shape = $settings[ 'image_shape' ];
		?>
		<div class="shadowcore-testimonials-grid shadowcore-is-masonry">
		<?php
		foreach (  $settings[ 'testimonials' ] as $item ) {
			$image = $item[ 'author_image' ];
			$author_name = $item[ 'author_name' ];
			$occupation = $item[ 'occupation' ];
			$description = $item[ 'testimonial_text' ];
			$rating = $item[ 'rating' ];
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
			<div class="shadowcore-testimonials-item">
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
				<div class="shadowcore-testimonials-item__content">
					<?php if ( 'none' !== $rating ) { ?>
					<div class="shadowcore-testimonials-item__stars">
						<?php
							for ( $i = 1; $i <= absint( $rating ); $i++ ) {
							echo '
							<svg xmlns="http://www.w3.org/2000/svg" width="14.313" height="13.625" viewBox="0 0 14.313 13.625">
								<path d="M-.844-7.719-4.625-4.312l1.063,5L-8-1.844-12.437.688l1.063-5-3.781-3.406,5.063-.531L-8-12.937-5.906-8.25Z" transform="translate(15.156 12.938)" fill="#404040"/>
							</svg>

							';
							}
							if ( $rating < 5 ) {
								for ( $i = 1; $i <= (5 - absint( $rating ) ); $i++ ) {
									echo '
									<svg xmlns="http://www.w3.org/2000/svg" width="14.375" height="13.625" viewBox="0 0 14.375 13.625">
										<path d="M-8-12.937l.438,1.031L-5.937-8.25l4,.406,1.125.125-.875.75L-4.625-4.312l.813,3.938.25,1.063-1-.562L-8-1.875l-3.437,2-1,.563.25-1.062.813-3.937-2.937-2.656-.875-.75,1.125-.125,4-.406,1.625-3.656ZM-8-10.5-9.281-7.594l-.125.281h-.281l-3.125.344L-10.5-4.875l.25.219-.062.281L-11-1.312l2.75-1.562L-8-3l.25.125L-5-1.312l-.687-3.062-.062-.281.25-.219,2.313-2.094-3.125-.344h-.281l-.125-.281Z" transform="translate(15.188 12.938)" fill="#404040"/>
									</svg>
									';
								}
							}
						?>
					</div>
					<?php } ?>
					<div class="shadowcore-testimonials-item__content-inner">
						<?php echo esc_html( $description ); ?>
					</div><!-- .shadowcore-testimonials-item__content-inner -->
				</div><!-- .shadowcore-testimonials-item__content -->
			</div><!-- .shadowcore-testimonials-item -->
			<?php		
		}
		?>
		</div><!-- .shadowcore-testimonials-grid -->
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Shadow_Testimonials_Grid_Widget() );