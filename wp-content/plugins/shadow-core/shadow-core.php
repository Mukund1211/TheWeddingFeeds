<?php
/*
Plugin Name: Shadow Core (for Shadow Themes)
Plugin URI: http://shadow-themes.com
Description: Additional functional for Shadow Themes Only.
Version: 1.0.3
License: Themeforest
Author: Shadow Themes
Author URI: http://shadow-themes.com
*/

if ( ! defined( 'ABSPATH' ) ) exit;

# Begining Main Class
if ( ! class_exists( 'Shadow_Core' ) ) 
{
	# Define Plugin URL and PATH
	define( 'SHADOWCORE__FILE__', __FILE__ );
	define( 'SHADOWCORE_BASE', plugin_basename( SHADOWCORE__FILE__ ) );
	define( 'SHADOWCORE_PATH', plugin_dir_path( SHADOWCORE__FILE__ ) );
	define( 'SHADOWCORE_INC_PATH', SHADOWCORE_PATH . 'includes/' );
	define( 'SHADOWCORE_ASSETS_PATH', SHADOWCORE_PATH . 'assets/' );
	define( 'SHADOWCORE_URL', plugins_url( '/', SHADOWCORE__FILE__ ) );
	define( 'SHADOWCORE_ASSETS_URL', SHADOWCORE_URL . 'assets/' );

	class Shadow_Core {
		const VERSION = '1.0.2';

		# Properties
		protected static $config;

		# Methods
		private static $_instance = null;

		public static function instance() 
		{
			if ( is_null( self::$_instance ) )
				self::$_instance = new self();

			return self::$_instance;
		}

		public function init( $theme_config ) {
			# i18n
			load_plugin_textdomain( 'shadowcore' );

			# Add Theme Name to Config
			self::$config[ 'theme_name' ] = $theme_config[ 'theme_name' ];
			self::$config[ 'base_class_name' ] = $theme_config[ 'base_class_name' ];

			# Enable Elementor in config, if enabled by theme
			if ( isset( $theme_config[ 'elementor' ] ) && is_array( $theme_config[ 'elementor' ] ) ) 
			{
				self::$config[ 'elementor' ] = $theme_config[ 'elementor' ];
			} else {
				self::$config[ 'elementor' ] = false;
			}

			# Enable Custom Widgets in config, if enabled by theme
			if ( isset( $theme_config[ 'widgets' ] ) && is_array( $theme_config[ 'widgets' ] ) ) 
			{
				self::$config[ 'widgets' ] = $theme_config[ 'widgets' ];
			} else {
				self::$config[ 'widgets' ] = false;
			}

			# Enable Custom Post Types in config, if enabled by theme
			if ( isset( $theme_config[ 'cpt' ] ) && is_array( $theme_config[ 'cpt' ] ) )
			{
				self::$config[ 'cpt' ] = $theme_config[ 'cpt' ];
			} else {
				self::$config[ 'cpt' ] = false;
			}

			# Enable MegaMenu in config, if enabled by theme
			if ( isset( $theme_config[ 'mega_menu' ] ) )
			{
				self::$config[ 'mega_menu' ] = $theme_config[ 'mega_menu' ];
			} else {
				self::$config[ 'mega_menu' ] = false;
			}

			# Begin Loading
			self::loader();

			# Enqueue Scripts and Styles
			add_action( 'wp_enqueue_scripts', [ $this, 'shadow_core_enqueue'] );
			add_action( 'admin_enqueue_scripts', [ $this, 'shadow_core_enqueue_admin'] );
		}
		
		public function shadow_core_enqueue() {
			# Enqueue Styles
			wp_enqueue_style( 'shadow-customize-controls-css', SHADOWCORE_ASSETS_URL . 'css/customize-controls.css' );
			wp_enqueue_style( 'shadow-lineAwesome-css', SHADOWCORE_ASSETS_URL . 'css/line-awesome.min.css' );

			# Enqueue Scripts
			wp_enqueue_script( 'shadow-customize-controls-js', SHADOWCORE_ASSETS_URL . 'js/customize-controls.js', array('jquery'), false, true);
		}

		public function shadow_core_enqueue_admin() {
			# Enqueue Styles
			wp_enqueue_style( 'shadow-core-admin-css', SHADOWCORE_ASSETS_URL . 'css/shadow-core-admin.css' );
			wp_enqueue_style( 'shadow-customize-controls-css', SHADOWCORE_ASSETS_URL . 'css/customize-controls.css' );
			wp_enqueue_style( 'shadow-lineAwesome-css', SHADOWCORE_ASSETS_URL . 'css/line-awesome.min.css' );

			# Enqueue Scripts
			wp_enqueue_script( 'shadow-customize-controls-js', SHADOWCORE_ASSETS_URL . 'js/customize-controls.js', array('jquery'), false, true);
		}

		public static function loader() {
			# Load Files
			require_once( SHADOWCORE_INC_PATH . 'classes/class-aq-resizer.php' );

			# Load Customizer Controls
			require_once( SHADOWCORE_INC_PATH . 'controls/control-choose.php' );
			require_once( SHADOWCORE_INC_PATH . 'controls/control-dimension.php' );
			require_once( SHADOWCORE_INC_PATH . 'controls/control-divider.php' );
			require_once( SHADOWCORE_INC_PATH . 'controls/control-number.php' );
			require_once( SHADOWCORE_INC_PATH . 'controls/control-switcher.php' );
			require_once( SHADOWCORE_INC_PATH . 'controls/control-title.php' );

			# Activate Shadow Customizer
			require_once( SHADOWCORE_INC_PATH . 'classes/class-customizer.php' );

			# Activate Elementor Addons
			if ( self::$config['elementor'] && is_array( self::$config['elementor'] ) )
			{
				if ( did_action( 'elementor/loaded' ) )
					require_once( SHADOWCORE_INC_PATH . 'classes/class-elementor.php' );
			}

			# Activate Sidebar Widgets
			if ( self::$config['widgets'] && is_array( self::$config['widgets'] ) )
			{
				foreach( self::$config['widgets'] as $name ) {
					require_once( SHADOWCORE_INC_PATH . 'widgets/widget-'. $name .'.php' );
				}
			}

			# Register Custom Post Types
			if ( self::$config['cpt'] && is_array( self::$config['cpt'] ) )
			{
				foreach ( self::$config['cpt'] as $cpt_config )
				{
					register_post_type( $cpt_config['cpt_name'], $cpt_config['cpt_config'] );
					
					if ( isset( $cpt_config['cpt_tax'] ) )
						register_taxonomy( $cpt_config['cpt_tax']['tax_name'], $cpt_config['cpt_tax']['tax_post_name'], $cpt_config['cpt_tax']['tax_array'] );
				}
			}
		}
	}		
}

# Author Notify Function
if ( ! function_exists( 'shadowcore_proofing_notify' ) ) {
	add_action('wp_ajax_shadowcore_proofing_notify', 'shadowcore_proofing_notify');
	add_action('wp_ajax_nopriv_shadowcore_proofing_notify', 'shadowcore_proofing_notify');
	
	function shadowcore_proofing_notify() {
		$client_data = $_POST[ 'client_data' ];
		
		# Demo Mode
		if ( 'demo' == $client_data[ 'mailto' ] ) {
			die( esc_html( $client_data[ 'done_message' ] ) . ' ' . esc_html__( 'Demo Mode.', 'shadowcore' ) );
		}
		
		# Images Link
		$notify_message = $client_data['message'] . ' <a href="' . esc_url( $client_data['url'] ) . '" target="_blank">' . esc_html( $client_data['title'] ) . '</a>';
		if ( 'yes' == $client_data[ 'includes' ] ) {
			$notify_message .= "\n\r" . '<hr>';
			$notify_message .= "\n\r" . '<h4>' . esc_html( $client_data[ 'photos_title' ] ) . '</h4>' . "\n\r";
			if ( is_array( $client_data[ 'images' ] ) && ! empty( $client_data[ 'images' ] ) ) {
				$notify_message .= '<ul>';
				foreach ( $client_data[ 'images' ] as $image_id ) {
					$image_post = get_post( $image_id );
					$image_title = $image_post->post_title;
					$image_url = wp_get_attachment_url( $image_id );
					$notify_message .= '<li><a href="' . esc_url( $image_url ) . '" target="_blank">' . esc_html( $image_title ) . '</a></li>' . "\n\r";
				}
				$notify_message .= '</ul>';
			} else {
				$notify_message .= "\n\r" . $client_data[ 'no_photos' ] . "\n\r";
			}
		}
		
		# Email Headers
        $headers = 	"From: " . get_bloginfo( 'admin_email' ) . "\r\n" . 
					"MIME-Version: 1.0" . "\r\n" . 
					"Content-type: text/html; charset=utf-8" . "\r\n";
		
		# Send Notify Email
		if( wp_mail( $client_data[ 'mailto' ], $client_data[ 'subject' ], $notify_message, $headers ) ) {
			# Success
			echo esc_html( $client_data[ 'done_message' ] );
		} else {
			# Error
			echo esc_html( $client_data[ 'error_message' ] );
		}
		
		# Exit
		die();
	}
}

# Debug Functions
if ( ! function_exists( 'print_pre' ) )
{
	function print_pre ( $array ) 
	{
		echo '<pre>';
		print_r( $array );
		echo '</pre>';
	}
}

# Show wp_mail() Errors
/*
add_action( 'wp_mail_failed', 'onMailError', 10, 1 );
function onMailError( $wp_error ) {
    echo '<pre>';
    print_r( $wp_error );
    echo '</pre>';
}
*/