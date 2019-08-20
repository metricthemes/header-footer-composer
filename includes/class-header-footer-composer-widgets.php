<?php
/**
 * The file that holds all the elementor widgets
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
 * @since      1.0.0
 * @package    Header_Footer_Composer
 * @subpackage Header_Footer_Composer/includes
 * @author     MetricThemes <support@metricthemes.com>
 */
class Header_Footer_Composer_Widgets {

 	 /**
	 * Main Theme Class Constructor
	 */
	public function __construct() {

		// Register the video widget
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );		
		add_action( 'elementor/elements/categories_registered',  array( $this,'add_elementor_widget_categories') );	
		

	} // End constructor
	
	public function add_elementor_widget_categories( $elements_manager ) {
	
		$elements_manager->add_category(
			'hfc-elementor-widgets',
			[
				'title' => __( 'Header Footer Composer', 'plugin-name' ),
				'icon' => 'fa fa-plug',
			]
		);
	
	}	

	// Register the video widget
	public static function widgets_registered() {

		// We check if the Elementor plugin has been installed / activated.
		if ( defined( 'ELEMENTOR_PATH' ) && class_exists( 'Elementor\Widget_Base' ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/hfc-sitetitle.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/hfc-sitelogo.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/hfc-navmenu.php';
		}

	}	
	

}