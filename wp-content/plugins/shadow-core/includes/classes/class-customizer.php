<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

# Customizer Theme Class
if ( ! class_exists( 'Shadow_Customizer' ) ) :
	class Shadow_Customizer {
		# Methods		
		public static function add_field( $wp_customize, $id, $item, $section ) {
			if ( empty( $item[ 'type' ] ) ) {
				$item[ 'type' ] = '';
			}
			if ( 'divider' == $item[ 'type' ] || 'custom_title' == $item[ 'type' ] ) {
				$default = '';
			} else {
				if ( !array_key_exists( 'default', $item ) ) {
					wp_die( 'Shadow Customizer Error: ' . esc_html__( "Default value for \"$id\" not specified", 'shadowcore' ) );
				} else {
					$default = $item[ 'default' ];
				}
			}

			$item_args = array(
				'type' => $item[ 'type' ],
				'section' => $section,
				'settings' => $id
			);

			if ( ! empty( $item[ 'label' ] ) )
				$item_args[ 'label' ] = $item[ 'label' ];
			if ( ! empty( $item[ 'description' ] ) )
				$item_args[ 'description' ] = $item[ 'description' ];
			if ( ! empty( $item[ 'active_callback' ] ) )
				$item_args[ 'active_callback' ] = $item[ 'active_callback'] ;
			if ( ! empty( $item[ 'choices' ] ) )
				$item_args[ 'choices' ] = $item[ 'choices' ];
			if ( ! empty( $item[ 'input_attrs' ] ) )
				$item_args[ 'input_attrs' ] = $item[ 'input_attrs' ];

			if ( !empty( $item[ 'condition' ] ) ) {
				$data_id = '';
				$data_value = '';
				$descr = !empty( $item[ 'description' ] ) ? $item[ 'description' ] : '';
				
				foreach ( $item[ 'condition' ] as $key => $value ) {
					if ( $data_id == '' ) {
						$data_id = $key;
					} else {
						$data_id .= '|' . $key;
					}
					if ( $data_value == '' ) {
						$data_value = $value;
					} else {
						$data_value .= '|' . $value;
					}
				}

				$descr .= '<input type="hidden" class="customize_condition" data-id="' . esc_attr( $data_id ) . '" data-value="' . esc_attr( $data_value ) . '"/>';
                $item_args[ 'description' ] = $descr;
			}
            
			if ( ! empty( $item[ 'caption' ] ) ) {
				$item_args[ 'caption' ] = $item[ 'caption' ];
			}
			if ( ! empty( $item[ 'label_on' ] ) ) {
				$item_args[ 'label_on' ] = $item[ 'label_on' ];
			}
			if ( ! empty( $item[ 'label_off' ] ) ) {
				$item_args[ 'label_off' ] = $item[ 'label_off' ];
			}
			if ( ! empty( $item[ 'style' ] ) ) {
				$item_args[ 'style' ] = $item[ 'style' ];
			}
			if ( ! empty( $item[ 'options' ] ) ) {
				$item_args[ 'options' ] = $item[ 'options' ];
			}
			if ( ! empty( $item[ 'config' ] ) ) {
				$item_args[ 'config' ] = $item[ 'config' ];
			}
			if ( ! empty( $item[ 'custom_class' ] ) ) {
				$item_args[ 'custom_class' ] = $item[ 'custom_class' ];
			}
			if ( ! empty( $item[ 'disable' ] ) ) {
				$item_args[ 'disable' ] = $item[ 'disable' ];
			}
			if ( ! empty( $item[ 'locked' ] ) ) {
				$item_args[ 'locked' ] = $item[ 'locked' ];
			}
			
			# Control Types
			if ($item[ 'type' ] == 'select' || $item[ 'type' ] == 'radio' ) {
				$item_args[ 'type' ] = $item[ 'type' ];
				$item_args[ 'choices' ] = $item[ 'choices' ];
			}
			if ($item[ 'type' ] == 'checkbox' || $item[ 'type' ] == 'textarea' ) {
				$item_args[ 'type' ] = $item[ 'type' ];
			}

			# Add Control 
			if ( $item[ 'type' ] == 'color' ) {
				$wp_customize->add_control( new WP_Customize_Color_Control (
					$wp_customize,
					$id,
					$item_args
				) );
			} else if ( $item[ 'type' ] == 'custom_title' ) {
				$wp_customize->add_control( new Shadow_Customize_Title_Control (
					$wp_customize,
					$id,
					$item_args
				) );
			} else if ( $item[ 'type' ] == 'choose' ) {
				$wp_customize->add_control( new Shadow_Customize_Choose_Control (
					$wp_customize,
					$id,
					$item_args
				) );
			} else if ( $item[ 'type' ] == 'switcher' ) {
				$wp_customize->add_control( new Shadow_Customize_Switcher_Control (
					$wp_customize,
					$id,
					$item_args
				) );
			} else if ($item[ 'type' ] == 'divider' ) {
				$wp_customize->add_control( new Shadow_Customize_Divider_Control (
					$wp_customize,
					$id,
					$item_args
				) );
			} else if ( $item[ 'type' ] == 'upload' ) {
				$wp_customize->add_control( new WP_Customize_Upload_Control (
					$wp_customize,
					$id,
					$item_args
				) );				
			} else if ( $item[ 'type' ] == 'image' ) {
				$wp_customize->add_control( new WP_Customize_Image_Control (
					$wp_customize,
					$id,
					$item_args
				) );
			} else if ( $item[ 'type' ] == 'dimension' ) {
				$wp_customize->add_control( new Shadow_Customize_Dimension_Control (
					$wp_customize,
					$id,
					$item_args
				) );
			} else if ( $item[ 'type' ] == 'number' ) {
				$wp_customize->add_control( new Shadow_Customize_Number_Control (
					$wp_customize,
					$id,
					$item_args
				) );
			} else {
				$wp_customize->add_control( new WP_Customize_Control (
					$wp_customize,
					$id,
					$item_args
				) );
			}
			return $wp_customize;
		}
	}
endif;