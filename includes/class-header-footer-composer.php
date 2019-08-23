<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://metricthemes.com
 * @since      1.0.0
 *
 * @package    Header_Footer_Composer
 * @subpackage Header_Footer_Composer/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Header_Footer_Composer
 * @subpackage Header_Footer_Composer/includes
 * @author     MetricThemes <support@metricthemes.com>
 */
class Header_Footer_Composer {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Header_Footer_Composer_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'HEADER_FOOTER_COMPOSER_VERSION' ) ) {
			$this->version = HEADER_FOOTER_COMPOSER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'header-footer-composer';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		
		add_action( 'admin_notices', array( $this, 'hfcmt_theme_support') );			

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Header_Footer_Composer_Loader. Orchestrates the hooks of the plugin.
	 * - Header_Footer_Composer_i18n. Defines internationalization functionality.
	 * - Header_Footer_Composer_Admin. Defines all hooks for the admin area.
	 * - Header_Footer_Composer_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-header-footer-composer-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-header-footer-composer-i18n.php';		

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-header-footer-composer-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-header-footer-composer-public.php';
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-header-footer-composer-post-type.php';					

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-header-footer-composer-metabox.php';								

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-header-footer-composer-render.php';									
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-header-footer-composer-widgets.php';											
		
		
		$this->loader = new Header_Footer_Composer_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Header_Footer_Composer_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Header_Footer_Composer_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Header_Footer_Composer_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'hfc_register_admin_menu' );				
			
		$plugin_post_type = new Header_Footer_Composer_Post_Type( $this->get_plugin_name(), $this->get_version() );				
		$this->loader->add_action( 'init', $plugin_post_type, 'hf_composer_register_post_type' );		
		
		$plugin_meta_box = new Header_Footer_Composer_Meta_Box( $this->get_plugin_name(), $this->get_version() );				
		$this->loader->add_action( 'add_meta_boxes', $plugin_meta_box, 'hf_composer_add_meta_box' );
		$this->loader->add_action( 'save_post', $plugin_meta_box, 'hf_composer_meta_save' );
		
		$plugin_render = new Header_Footer_Composer_Render( $this->get_plugin_name(), $this->get_version() );				
		$this->loader->add_action( 'template_redirect', $plugin_render, 'hf_composer_layout_frontend');
		$this->loader->add_filter( 'single_template', $plugin_render, 'load_canvas_template');		
		$this->loader->add_action( 'template_redirect', $plugin_render, 'remove_header', 10 );		
		$this->loader->add_action('munk_header', $plugin_render, 'new_header', 10);		
		$this->loader->add_action( 'template_redirect', $plugin_render, 'remove_footer', 10 );		
		$this->loader->add_action('munk_footer', $plugin_render, 'new_footer', 10);						

		$plugin_widgets = new Header_Footer_Composer_Widgets( $this->get_plugin_name(), $this->get_version() );

	}
	
	public function hfcmt_theme_support() {	
		if (! current_theme_supports('header-footer-composer')) {			
		echo '<div class="notice notice-error is-dismissible">';
			echo '<p>Hey, your current theme is not supported by Header Footer Composer, click <a href="#">here</a> to check out all the supported themes.</p>';
		echo '</div>';		
		}
	}	

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Header_Footer_Composer_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Header_Footer_Composer_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
