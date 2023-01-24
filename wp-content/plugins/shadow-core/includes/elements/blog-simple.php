<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
namespace Elementor;

use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Shadow_Blog_Simple_Widget extends Widget_Base {
	
	public function get_name() {
		return 'shadow-blog-simple';
	}
	
	public function get_title() {
		return esc_html__( 'Simple Blog', 'shadowcore' );
	}
	
	public function get_icon() {
		return 'eicon-post-list';
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
				'label' => esc_html__( 'Query Settings', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);
		
		$this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__( 'Posts per Page', 'shadowcore' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '5',
                'min' => '1',
                'step' => '1'
            ]
		);
		$this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Sort Posts By', 'shadowcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'title' => esc_html__( 'Title', 'shadowcore' ),
					'date' => esc_html__( 'Date', 'shadowcore' ),
					'name' => esc_html__( 'Name (slug)', 'shadowcore' ),
					'rand' => esc_html__( 'Random', 'shadowcore' ),
				]
			]
		);
		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Posts Order', 'shadowcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => esc_html__( 'Descending', 'shadowcore' ),
					'ASC' => esc_html__( 'Ascending', 'shadowcore' ),
				]
			]
		);
		$this->add_control(
			'divider-query01',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'show_categories',
			[
				'label' => esc_html__( 'Categories to Show', 'shadowcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all' => esc_html__( 'All', 'shadowcore' ),
					'choose' => esc_html__( 'Select Categories', 'shadowcore' ),
				]
			]
		);

		$categs = get_categories( array( 'type' => 'post' ) );
		$categories_list = array();
		if ( count( $categs ) > 0 ) {
			foreach ( $categs as $this_cat ) {
				$categories_list[ $this_cat->slug ] = $this_cat->name;
			}
			
			$this->add_control(
				'selected_categories',
				[
					'label' => esc_html__( 'Select Categories', 'shadowcore' ),
					'type' => Controls_Manager::SELECT2,
					'options' => $categories_list,
					'multiple' => true,
					'condition' => [
						'show_categories' => 'choose'
					]
				]
			);
		} else {
			$this->add_control(
				'no_categories',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => esc_html__( 'You have no categories available', 'shadowcore' ),
					'content_classes' => 'shadowcore-elementor-message shadowcore-no-categories',
					'condition' => [
						'show_categories' => 'choose'
					]
				]
			);
		}
		$this->add_control(
			'divider-query02',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'ignore_sticky',
			[
				'label' => esc_html__( 'Ignore Sticky Posts?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();

		# TAB: SETTINGS
		# Section: Style
		$this->start_controls_section(
			'section_typography',
			[
				'label' => esc_html__( 'Post Settings', 'shadowcore' ),
				'tab' => Controls_Manager::TAB_SETTINGS
			]
		);

		$this->add_control(
			'meta_post_author',
			[
				'label' => esc_html__( 'Show Post Author?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'meta_post_date',
			[
				'label' => esc_html__( 'Show Post Date?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'meta_post_comments',
			[
				'label' => esc_html__( 'Show Comments Count?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'meta_post_category',
			[
				'label' => esc_html__( 'Show Post Category?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'meta_post_tags',
			[
				'label' => esc_html__( 'Show Post Tags?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'post_excerpt',
			[
				'label' => esc_html__( 'Show Post Excerpt?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'post_pagination',
			[
				'label' => esc_html__( 'Show Pagination?', 'shadowcore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'shadowcore' ),
				'label_off' => esc_html__( 'No', 'shadowcore' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$post_settings = array(
			'meta_post_author' 	 => $settings[ 'meta_post_author' ],
			'meta_post_date' 	 => $settings[ 'meta_post_date' ],
			'meta_post_comments' => $settings[ 'meta_post_comments' ],
			'meta_post_category' => $settings[ 'meta_post_category' ],
			'meta_post_tags' 	 => $settings[ 'meta_post_tags' ],
			'post_excerpt' 		 => $settings[ 'post_excerpt' ]
		);

		$selected_categories = $settings[ 'selected_categories' ];

		# Paged
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} else if ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		# Query Args
		$this_args = array(
			'post_type' 	 => 'post',
			'post_status' 	 => 'publish',
			'posts_per_page' => absint( $settings[ 'posts_per_page' ] ),
			'orderby' 		 => esc_attr( $settings[ 'orderby' ] ),
			'order' 		 => esc_attr( $settings[ 'order' ] ),
			'paged' 		 => absint( $paged ),
		);
		
		# Ignore Sticky
		if ( 'yes' == $settings[ 'ignore_sticky' ] ) {
			$this_args[ 'ignore_sticky_posts' ] = 1;
		} else {
			$this_args[ 'ignore_sticky_posts' ] = 0;
		}

		# Selected Categories
		if ( 'choose' == $settings[ 'show_categories' ] && ! empty( $selected_categories ) ) {
			$categories = '';
			foreach ( $selected_categories as $slug ) {
				$cat = get_category_by_slug( $slug );
				$categories .= $cat->term_id . ',';
			}
			$this_args[ 'cat' ] = substr( $categories, 0, -1 );
		}

		# HTML Render
		?>
		<div class="shadowcore-blog-listing">
			<?php 
			$query = new WP_Query( $this_args );
			if ( $query->have_posts() ) {
				# Send Post Display Options to Query
				set_query_var( 'shadowcore_simple_blog', $post_settings );

				# While Have Posts
				while ( $query->have_posts() ) {
					$query->the_post();

					# Post Template
					get_template_part( 'template-parts/elements/post-listing' );
				}
			} else {
				echo '<p>' . esc_html__( 'You do not have any posts. Create your first post to show here.', 'shadowcore' ) . '</p>';
			}

			# Pagination Template
			if ( 'yes' == $settings[ 'post_pagination' ] ) {
				$global_query = $GLOBALS['wp_query'];
				$GLOBALS['wp_query'] = $query;
				get_template_part( 'template-parts/elements/post-listing-pagination' );
				$GLOBALS['wp_query'] = $global_query;
			}
			?>
		</div><!-- .shadowcore-blog-listing -->
		<?php

		# Reset Query
		wp_reset_query();
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Shadow_Blog_Simple_Widget() );