<?php
/**
 * Plugin Name: Hive Estates Addon Extension
 * Description: Custom Hive Estates Elementor extension which includes custom widgets.
 * Plugin URI:  https://abc.com/
 * Version:     1.0.0
 * Author:      DevTeamPro
 * Author URI:  https://devteampro.com
 * Text Domain: hiveestates-Addon
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class HiveEstates_Addon_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var HiveEstates_Addon_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return HiveEstates_Addon_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'hiveestates-addon', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		add_action('elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ] );


		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );

        // Category Init
		add_action( 'elementor/init', [ $this, 'elementor_Addon_category' ] );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'hiveestates-addon' ),
			'<strong>' . esc_html__( 'HiveEstates Addon Extension', 'hiveestates-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'HiveEstates', 'hiveestates-addon' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'hiveestates-addon' ),
			'<strong>' . esc_html__( 'HiveEstates Addon Extension', 'hiveestates-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'hiveestates-addon' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'hiveestates-addon' ),
			'<strong>' . esc_html__( 'HiveEstates Addon Extension', 'hiveestates-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'hiveestates-addon' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		require_once( __DIR__ . '/widgets/aminity-slider.php' );
		require_once( __DIR__ . '/widgets/property-list-sale.php' );
		require_once( __DIR__ . '/widgets/country-list.php' );
		require_once( __DIR__ . '/widgets/post-list.php' );
		require_once( __DIR__ . '/widgets/why-choose-us.php' );
		require_once( __DIR__ . '/widgets/team-member.php' );
		require_once( __DIR__ . '/widgets/testimonials-list.php' );
		require_once( __DIR__ . '/widgets/massonry-gallery.php' );
		require_once( __DIR__ . '/widgets/hive-gallery.php' );
		require_once( __DIR__ . '/widgets/hive-faqs.php' );
		require_once( __DIR__ . '/widgets/aminities.php' );
		require_once( __DIR__ . '/widgets/property-list.php' );
		require_once( __DIR__ . '/widgets/country-list-packery.php' );
		require_once( __DIR__ . '/widgets/hive-testimonials-slider.php' );
		require_once( __DIR__ . '/widgets/hive-facilities-list.php' );
		require_once( __DIR__ . '/widgets/country-slider.php' );

		// added by EWA - EWA own Register widgets, loading all widget names

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Aminity_Slider_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Property_List_Sale() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Country_List_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Post_List() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Why_Choose_Us_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Our_Team_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Testimonials_List_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Masonry_Gallery_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hive_Gallery_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hive_Faqs_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Aminities_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Property_List() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Country_Packery_List_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hive_Testimonials_Slider_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hive_Facilities_List_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Country_Slider_Widget() );
	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_controls() {

		/*
		* Todo: this block needs to be commented out when the custom control is ready
		*
		*
		// Include Control files
		require_once( __DIR__ . '/controls/test-control.php' );

		// Register control
		\Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );
		*/

	}

	// Custom CSS
	public function widget_styles() {
		wp_register_style( 'hiveestates-addon-style', plugins_url( 'style.css', __FILE__ ) );
		wp_enqueue_style('hiveestates-addon-style');
	}	

    // Custom JS
	public function widget_scripts() {
		wp_register_script( 'hiveestates-addon-js', plugins_url( 'main.js', __FILE__ ) );
		wp_enqueue_script('hiveestates-addon-js');
	}

    // Custom Category
    public function elementor_Addon_category () {

	   \Elementor\Plugin::$instance->elements_manager->add_category( 
	   	'hiveestates-addon-Category',
	   	[
	   		'title' => __( 'Hive Estates Addon', 'hiveestates-addon' ),
	   		'icon' => 'fa fa-plug', //default icon
			   2 ,// position
	   	],
	   );

	}
 

}

HiveEstates_Addon_Extension::instance();