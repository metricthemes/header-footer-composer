<?php
/**
 * The file that registers the plugins post type
 *
 * @since      1.0.0
 * @package    Header_Footer_Composer
 * @subpackage Header_Footer_Composer/includes
 * @author     MetricThemes <support@metricthemes.com>
 */
class Header_Footer_Composer_Post_Type {

	/**
	 *
	 * Registring the post type for creating header, footer and custom layout
	 * @post_type = hfc_elementor
	 *
	 * @since    1.0.0
	 */
	public function hf_composer_register_post_type() {

		$labels = array(
			'name'                  => _x( 'Header Footer Layout', 'Post Type General Name', 'header-footer-composer' ),
			'singular_name'         => _x( 'Header Footer Layout', 'Post Type Singular Name', 'header-footer-composer' ),
			'menu_name'             => __( 'Header Footer Layouts', 'header-footer-composer' ),
			'name_admin_bar'        => __( 'Header Footer Layout', 'header-footer-composer' ),
			'archives'              => __( 'Layout Archives', 'header-footer-composer' ),
			'attributes'            => __( 'Layout Attributes', 'header-footer-composer' ),
			'parent_item_colon'     => __( 'Parent Layout:', 'header-footer-composer' ),
			'all_items'             => __( 'All Layouts', 'header-footer-composer' ),
			'add_new_item'          => __( 'Add New Layout', 'header-footer-composer' ),
			'add_new'               => __( 'Add New Layout', 'header-footer-composer' ),
			'new_item'              => __( 'New Layout', 'header-footer-composer' ),
			'edit_item'             => __( 'Edit Layout', 'header-footer-composer' ),
			'update_item'           => __( 'Update Layout', 'header-footer-composer' ),
			'view_item'             => __( 'View Layout', 'header-footer-composer' ),
			'view_items'            => __( 'View Layouts', 'header-footer-composer' ),
			'search_items'          => __( 'Search Layout', 'header-footer-composer' ),
			'not_found'             => __( 'Not found', 'header-footer-composer' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'header-footer-composer' ),
			'featured_image'        => __( 'Featured Image', 'header-footer-composer' ),
			'set_featured_image'    => __( 'Set featured image', 'header-footer-composer' ),
			'remove_featured_image' => __( 'Remove featured image', 'header-footer-composer' ),
			'use_featured_image'    => __( 'Use as featured image', 'header-footer-composer' ),
			'insert_into_item'      => __( 'Insert into Layout', 'header-footer-composer' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Layout', 'header-footer-composer' ),
			'items_list'            => __( 'Layouts list', 'header-footer-composer' ),
			'items_list_navigation' => __( 'Layouts list navigation', 'header-footer-composer' ),
			'filter_items_list'     => __( 'Filter layouts list', 'header-footer-composer' ),
		);
		$args = array(
			'label'                 => __( 'Header Footer Layout', 'header-footer-composer' ),
			'description'           => __( 'Header Footer Layout Composer for Elementor', 'header-footer-composer' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'elementor' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => false,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'rewrite'               => false,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);

		register_post_type( 'hf_composer', $args );
	}
	
	
}