<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Shadow_Gallery_Grid_Widget extends Widget_Base {
	
	public function get_name() {
		return 'shadow-gallery-grid';
	}
	
	public function get_title() {
		return esc_html__( 'Gallery: Grid', 'shadowcore' );
	}
	
	public function get_icon() {
		return 'eicon-gallery-grid';
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
			'gallery',
			[
				'label' => esc_html__( 'Add Images', 'shadowcore' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
			]
		);
		$this->add_control(
			'randomize_images',
			[
				'label' => esc_html__( 'Randomize Gallery?', 'shadowcore' ),
				'description' => esc_html__( 'Shuffle images on each time gallery loads.', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'divider-gallery',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'crop_custom',
			[
				'label' => esc_html__( 'Customize Thmb Size?', 'shadowcore' ),
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
                'label' => esc_html__( 'Preview Width', 'shadowcore' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '960',
                'min' => '100',
				'step' => '1',
				'condition' => [
					'crop_custom' => 'yes'
				],
            ]
		);
		$this->add_control(
            'image_height',
            [
                'label' => esc_html__( 'Preview Height', 'shadowcore' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '640',
                'min' => '100',
				'step' => '1',
				'condition' => [
					'crop_custom' => 'yes'
				],
            ]
		);
		
		$this->add_control(
			'divider-gallery-dim',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'grid_columns',
			[
				'label' => esc_html__( 'Grid Columns', 'shadowcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					1 => esc_html__( 'One Column', 'shadowcore' ),
					2 => esc_html__( 'Two Columns', 'shadowcore' ),
					3 => esc_html__( 'Three Columns', 'shadowcore' ),
					4 => esc_html__( 'Four Columns', 'shadowcore' ),
				],
				'prefix_class' => 'shadowcore-grid-column--',
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
					'{{WRAPPER}} .shadowcore-grid' => 'margin: -{{SIZE}}{{UNIT}} 0 0 -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .shadowcore-grid-item' => 'padding: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'divider-captions',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'captions',
			[
				'label' => esc_html__( 'Image Captions', 'shadowcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'shadowcore' ),
					'under' => esc_html__( 'Under Image', 'shadowcore' ),
					'on_photo' => esc_html__( 'On Image', 'shadowcore' ),
					'on_hover' => esc_html__( 'On Hover', 'shadowcore' ),
				],
				'prefix_class' => 'shadowcore-grid-caption--',
			]
		);
		$this->add_control(
			'in_lightbox',
			[
				'label' => esc_html__( 'Lightbox Caption', 'shadowcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'shadowcore' ),
					'caption' => esc_html__( 'Show Caption', 'shadowcore' ),
					'description' => esc_html__( 'Show Description', 'shadowcore' ),
				],
			]
		);

		$this->end_controls_section();

		# TAB: STYLE
		# Section: Caption Styles
		$this->start_controls_section(
			'section_styles',
			[
				'label' => esc_html__( 'Caption Styles', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'no_captions',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Captions are disabled by element settings.', 'shadowcore' ),
				'content_classes' => 'shadowcore-elementor-message shadowcore-no-captions',
				'condition' => [
					'captions' => 'none'
				],
			]
		);
		$this->add_responsive_control(
			'caption_spacing--under',
			[
				'label' => esc_html__( 'Caption Spacing', 'shadowcore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					],
				],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-grid-caption' => 'margin: {{SIZE}}{{UNIT}} 0 0 0;',
				],
				'condition' => [
					'captions' => 'under'
				],
			]
		);
		$this->add_responsive_control(
			'caption_spacing',
			[
				'label' => esc_html__( 'Caption Spacing', 'shadowcore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => '15',
					'right' => '30',
					'bottom' => '15',
					'left' => '30',
					'isLinked' => false,
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .shadowcore-grid-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'captions' => [ 'on_photo', 'on_hover' ]
				],
			]
		);
		$this->add_control(
			'caption_fullheight',
			[
				'label' => esc_html__( 'Stretch Caption Wrapper?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'no',
				'prefix_class' => 'shadowcore-stretch-caption--',
				'condition' => [
					'captions' => [ 'on_photo', 'on_hover' ]
				],
			]
		);
		$this->add_control(
			'caption_alignment',
			[
				'label' => esc_html__( 'Caption Alignment', 'shadowcore' ),
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
				'condition' => [
					'captions!' => 'none'
				],
				'prefix_class' => 'shadowcore-caption-halign--',
			]
		);
		$this->add_control(
			'caption_valign_flex',
			[
				'label' => esc_html__( 'Caption Vertical Align', 'shadowcore' ),
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
					'captions' => [ 'on_photo', 'on_hover' ],
					'caption_fullheight' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}}.shadowcore-stretch-caption--yes .shadowcore-grid-caption' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'caption_valign_absolute',
			[
				'label' => esc_html__( 'Vertical Align', 'shadowcore' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'shadowcore' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'shadowcore' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Middle', 'shadowcore' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'bottom',
				'toggle' => false,
				'condition' => [
					'captions' => [ 'on_photo', 'on_hover' ],
					'caption_fullheight!' => 'yes'
				],
				'prefix_class' => 'shadowcore-caption-valign--',
			]
		);
		$this->add_control(
			'divider-captions-color',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'captions!' => 'none'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typo',
				'label' => esc_html__( 'Caption Typography', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-grid-caption',
				'condition' => [
					'captions!' => 'none'
				],
			]
		);
		$this->add_control(
			'caption_color',
			[
				'label' => esc_html__( 'Caption Color', 'shadowcore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shadowcore-grid-caption' => 'color: {{VALUE}};'
				],
				'condition' => [
					'captions!' => 'none'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'caption_shadow',
				'label' => esc_html__( 'Caption Text Shadow', 'shadowcore' ),
				'selector' => '{{WRAPPER}} .shadowcore-grid-caption',
				'condition' => [
					'captions!' => 'none'
				],
			]
		);
		$this->add_control(
			'divider-captions-bg',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'captions!' => 'none'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'caption_bg',
				'label' => esc_html__( 'Background', 'shadowcore' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .shadowcore-grid-caption',
				'condition' => [
					'captions' => [ 'on_photo', 'on_hover' ]
				],
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$gallery = $settings[ 'gallery' ];
		$randomize_images = $settings[ 'randomize_images' ];
		if ( 'yes' == $settings[ 'crop_custom' ] ) {
			$thmb_image_width = $settings[ 'image_width' ];
			$thmb_image_height = $settings[ 'image_height' ];	
		} else {
			$thmb_image_width = 960;
			$thmb_image_height = 640;
		}
		$in_lightbox = $settings[ 'in_lightbox' ];

		if ( empty( $gallery ) ) {
			return;
		}
		if ( 'yes' == $randomize_images ) {
			shuffle( $gallery );
		}
		?>
		<div class="shadowcore-grid">
			<?php 
			foreach ( $gallery as $item ) {
				$image_post = get_post( $item[ 'id' ] );
				$image_caption = $image_post->post_excerpt;
				$lightbox_text = '';
				if ( 'caption' == $in_lightbox ) {
					$lightbox_text = $image_caption;
				}
				if ( 'description' == $in_lightbox ) {
					$lightbox_text = $image_post->post_content;
				}
				$meta = wp_get_attachment_metadata( $item[ 'id' ] );
				$image_url = wp_get_attachment_url( $item[ 'id' ] );
				$original_image_width = $meta[ 'width' ];
				$original_image_height = $meta[ 'height' ];
				
				# in SVG holder %20 means space
			?>
			<div class="shadowcore-gallery-item shadowcore-grid-item">
				<div class="shadowcore-gallery-item__inner">
					<a 	href="<?php echo esc_url( $image_url ); ?>" 
						class="shadowcore-lightbox-link" 
						data-elementor-open-lightbox="no"
						data-gallery = "grid_<?php echo esc_attr( $this->get_id() ); ?>" 
						<?php if ( ! empty( $lightbox_text ) ) { ?>
						data-caption="<?php echo esc_attr( $lightbox_text ); ?>"
						<?php } ?>
						data-size="<?php echo esc_attr( $original_image_width ); ?>x<?php echo esc_attr( $original_image_height ); ?>">
					</a>
					<img 
						class="shadowcore-lazy" 
						src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20<?php echo absint( $thmb_image_width ); ?>%20<?php echo absint( $thmb_image_height ); ?>'%3E%3C/svg%3E"
						data-src="<?php echo esc_url( aq_resize( $image_url, absint( $thmb_image_width ), absint( $thmb_image_height ), true, true, true ) ); ?>" 
						alt="<?php echo esc_attr( get_post_meta( $item[ 'id' ], '_wp_attachment_image_alt', true ) ); ?>" 
						width="<?php echo esc_attr( $thmb_image_width ); ?>" 
						height="<?php echo esc_attr( $thmb_image_height ); ?>">
					<div class="shadowcore-grid-caption"><?php echo esc_html( $image_caption ); ?></div>
				</div>
			</div><!-- .shadowcore-gallery-item -->
			<?php } ?>
		</div><!-- .shadowcore-grid -->
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Shadow_Gallery_Grid_Widget() );