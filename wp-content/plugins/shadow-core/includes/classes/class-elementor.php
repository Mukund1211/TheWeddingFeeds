<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* Theme Elementor Class */
if ( ! class_exists( 'Shadow_Elements' ) ) :
	final class Shadow_Elements extends Shadow_Core {
		private static $_instance = null;
		private static $el_config;

		public static function instance() 
		{
			if ( is_null( self::$_instance ) )
				self::$_instance = new self();

			return self::$_instance;
		}

		public function init_elementor()
		{
			self::$el_config = parent::$config[ 'elementor' ];

			# Add Plugin actions
			add_action( 'elementor/elements/categories_registered', [ $this, 'init_category' ] );
			
			# Register Scripts and Styles
			add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_scripts' ] );

			# Register Shadow Elements
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_elements' ] );
			
			if ( isset( self::$el_config[ 'addons' ] ) && is_array( self::$el_config[ 'addons' ] ) ) 
			{
				add_action( 'elementor/element/before_section_end', function( $element, $section_id, $args ) 
				{
					if ( 'section' === $element->get_name() ) {
						if ( ! empty( self::$el_config[ 'addons' ][ 'section_slide' ] ) ) 
						{
						# Add Sections Slide Style
							if ( 'section_layout' === $section_id )
							{
								$element->add_control(
									'section_slider_style_divider',
									[
										'type' => \Elementor\Controls_Manager::DIVIDER,
										'style' => 'thick',
									]
								);
								$element->add_control(
									'section_slide_style',
									[
										'label' => esc_html__( 'Display as Fullscreen Slide', 'shadowcore' ),
										'type' => \Elementor\Controls_Manager::SWITCHER,
										'default' => '',
										'prefix_class' => 'shadow-section-fslide-',
										'hide_in_inner' => true,
										'condition' => [
											'height' => 'full',
										]
									]
								);
								$element->add_control(
									'section_slide_name',
									[
										'label' => esc_html__( 'Section ID for Anchor', 'shadowcore' ),
										'type' => \Elementor\Controls_Manager::TEXT,
										'default' => 'MySection',
										'description' => esc_html__( 'Use #SECTION_NAME in any link to display that section.', 'shadowcore' ),
										'prefix_class' => 'shadow-section-name-',
										'hide_in_inner' => true,
										'condition' => [
											'height' => 'full',
											'section_slide_style' => 'yes',
										]
									]
								);
								$element->add_control(
									'section_slide_name_note',
									[
										'type' => \Elementor\Controls_Manager::RAW_HTML,
										'raw' => sprintf( esc_html__( 'Note: The ID link ONLY accepts these chars: %s', 'shadowcore' ), '`A-Z, a-z, 0-9, _ , -`' ),
										'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
										'condition' => [
											'height' => 'full',
											'section_slide_style' => 'yes',
										]
									]
								);
								$element->add_control(
									'section_slide_position',
									[
										'label' => esc_html__( 'Section Hides On:', 'shadowcore' ),
										'type' => \Elementor\Controls_Manager::SELECT,
										'default' => 'top',
										'options' => [
											'top' => esc_html__( 'Top', 'shadowcore' ),
											'right' => esc_html__( 'Right', 'shadowcore' ),
											'bottom' => esc_html__( 'Bottom', 'shadowcore' ),
											'left' => esc_html__( 'Left', 'shadowcore' )
										],
										'prefix_class' => 'shadow-section-hides-',
										'hide_in_inner' => true,
										'condition' => [
											'height' => 'full',
											'section_slide_style' => 'yes',
										]
									]
								);
								$element->add_control(
									'section_slide_speed',
									[
										'label' => esc_html__( 'Animation Speed', 'shadowcore' ),
										'type' => \Elementor\Controls_Manager::NUMBER,
										'min' => 0,
										'max' => 2000,
										'step' => 100,
										'default' => 600,
										'prefix_class' => 'shadow-section-speed-',
										'condition' => [
											'height' => 'full',
											'section_slide_style' => 'yes',
										]
									]
								);
								$element->add_control(
									'section_slide_preview',
									[
										'label' => esc_html__( 'Preview in Action', 'shadowcore' ),
										'type' => \Elementor\Controls_Manager::SWITCHER,
										'default' => '',
										'prefix_class' => 'shadow-section-slide-preview-',
										'hide_in_inner' => true,
										'condition' => [
											'height' => 'full',
											'section_slide_style' => 'yes',
										]
									]
								);
							}
						}
						if ( ! empty( self::$el_config[ 'addons' ][ 'parallax_bg' ] ) ) 
						{
							# Add Parallax Background to Sections
							if ( 'section_background' === $section_id ) {
								$element->add_control(
									'section_parallax_divider',
									[
										'type' => \Elementor\Controls_Manager::DIVIDER,
										'style' => 'thick',
										'condition' => [
											'background_attachment' => [ '', 'scroll' ],
											'background_background' => [ 'classic' ],
										]
									]
								);
								$element->add_control(
									'section_parallax_background',
									[
										'type' => \Elementor\Controls_Manager::SWITCHER,
										'label' => esc_html__( 'Parallax Background', 'shadowcore'),
										'label_on' => esc_html__( 'Yes', 'shadowcore' ),
										'label_off' => esc_html__( 'No', 'shadowcore' ),
										'default' => '',
										'prefix_class' => 'shadow-bg_parallax-',
										'condition' => [
											'background_attachment' => [ '', 'scroll' ],
											'background_background' => [ 'classic' ],
										]
									]
								);
								$element->add_control(
									'section_parallax_background_speed',
									[
										'label' => esc_html__( 'Parallax Speed', 'shadowcore' ),
										'type' => \Elementor\Controls_Manager::NUMBER,
										'min' => 0,
										'max' => 100,
										'step' => 5,
										'default' => 50,
										'prefix_class' => 'shadow-bg_parallax-speed-',
										'condition' => [
											'background_attachment' => [ '', 'scroll' ],
											'background_background' => [ 'classic' ],
											'section_parallax_background' => 'yes'
										]
									]
								);                        
							}
						}
					}
					
					if ( ! empty( self::$el_config[ 'addons' ][ 'parallax_column' ] ) ) 
					{
						if ( 'column' === $element->get_name() && 'layout' === $section_id ) 
						{
							# Columns Parallax
							$element->add_control(
								'column_parallax_divider',
								[
									'type' => \Elementor\Controls_Manager::DIVIDER,
									'style' => 'thick',
								]
							);
							$element->add_control(
								'column_parallax',
								[
									'type' => \Elementor\Controls_Manager::SWITCHER,
									'label' => esc_html__( 'Enable Parallax', 'shadowcore' ),
									'label_on' => esc_html__( 'Yes', 'shadowcore' ),
									'label_off' => esc_html__( 'No', 'shadowcore' ),
									'default' => '',
									'prefix_class' => 'shadow-el_parallax-'
								]
							);
							$element->add_control(
								'column_parallax_speed',
								[
									'label' => esc_html__( 'Parallax Speed', 'shadowcore' ),
									'type' => \Elementor\Controls_Manager::NUMBER,
									'min' => 50,
									'max' => 150,
									'step' => 1,
									'default' => 50,
									'prefix_class' => 'shadow-el_parallax-speed-',
									'condition' => [
										'column_parallax' => 'yes'
									]                            
								]
							);
						}	
					}
				}, 10, 3);	
			}
		}
		
		# Register Shadow Elements Scripts
		public function register_scripts()
		{
			# Elementor Extensions and Core
			if ( isset( self::$el_config[ 'addons' ] ) && is_array( self::$el_config[ 'addons' ] ) ) 
			{
				wp_enqueue_script( 'ext-elementor-js', SHADOWCORE_ASSETS_URL . 'js/ext-elementor.js', array( 'jquery' ), false, true );
			}
            wp_enqueue_script( 'shadow-elements-js', SHADOWCORE_ASSETS_URL . 'js/shadow-elements.js', array( 'jquery' ), false, true );

			# Register Lib Scripts
			wp_register_script( 'photoswipe', SHADOWCORE_ASSETS_URL . 'js/lib/photoswipe.min.js', array( 'jquery' ) );
			wp_register_script( 'photoswipe-ui', SHADOWCORE_ASSETS_URL . 'js/lib/photoswipe-ui-default.min.js', array( 'jquery', 'photoswipe' ) );
			wp_register_script( 'masonry', SHADOWCORE_ASSETS_URL . 'js/lib/masonry.min.js', array( 'jquery', 'imagesloaded' ) );
			wp_register_script( 'owl-carousel', SHADOWCORE_ASSETS_URL . 'js/lib/owl.carousel.min.js', array( 'jquery', 'imagesloaded' ) );
			wp_register_script( 'jquery-justified-gallery', SHADOWCORE_ASSETS_URL . 'js/lib/jquery.justifiedGallery.min.js', array( 'jquery', 'imagesloaded' ) );
			
			# Register Styles
			wp_register_style( 'owl-carousel', SHADOWCORE_ASSETS_URL . 'css/lib/owl.carousel.min.css' );
			wp_register_style( 'justified-gallery', SHADOWCORE_ASSETS_URL . 'css/lib/justifiedGallery.min.css' );

			# Enqueue Styles
			wp_enqueue_style( 'ext-elementor-css', SHADOWCORE_ASSETS_URL . 'css/ext-elementor.css' );
			wp_enqueue_style( 'shadowcore-elements-css', SHADOWCORE_ASSETS_URL . 'css/elements.css' );
			wp_enqueue_style( 'shadowcore-elements-responsive-css', SHADOWCORE_ASSETS_URL . 'css/elements-responsive.css' );

		}
		
		# Load Shadow Elements
		public function register_elements() {
			if ( !empty( self::$el_config[ 'widgets' ] ) && is_array( self::$el_config[ 'widgets' ] ) ) 
			{
				foreach( self::$el_config[ 'widgets' ] as $name ) {
					require_once( SHADOWCORE_INC_PATH . 'elements/'. esc_attr( $name ) .'.php' );
				}
			}
		}
        
		# Add Shadow Elements Category
		public function init_category( $elements_manager )
		{
			$elements_manager->add_category(
				'shadow-elements',
				[
					'title' => esc_html__( 'Shadow Elements', 'shadowcore' ),
					'icon' => 'fa fa-plug',
				]
			);
		}
	}
	Shadow_Elements::instance()->init_elementor();
endif;
?>
