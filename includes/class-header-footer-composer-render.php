<?php
/**
 * The file that renders custom header and footer
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
class Header_Footer_Composer_Render {
	

	/**
	 * Don't display the elementor header footer templates on the frontend for non edit_posts capable users.
	 *
	 * @since  1.0.0
	 */ 
	public function hf_composer_layout_frontend() {
		if ( is_singular( 'hf_composer' ) && ! current_user_can( 'edit_posts' ) ) {
			wp_redirect( site_url(), 301 );
			die;
		}
	}

	
	/**
	 * Single template function which will choose our template
	 *
	 * @since  1.0.1
	 *
	 * @param  String $single_template Single template.
	 */
	public function load_canvas_template( $single_template ) {
	
		global $post;
	
		if ( 'hf_composer' == $post->post_type ) {
	
			$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';
	
			if ( file_exists( $elementor_2_0_canvas ) ) {
				return $elementor_2_0_canvas;
			} else {
				return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
			}
		}
	
		return $single_template;
	}

	
		/**
		 * Get header or footer template id based on the meta query.
		 *
		 * @param  String $type Type of the template header/footer.
		 *
		 * @return Mixed       Returns the header or footer template id if found, else returns string ''.
		 */
	public function get_template_id( $type ) {
	
		$cached = wp_cache_get( $type );
	
		if ( false !== $cached ) {
			return $cached;
		}
	
		$args = array(
			'post_type'    => 'hf_composer',
			'meta_key'     => 'hf_composer_layout_type',
			'meta_value'   => $type,
			'meta_type'    => 'post',
			'meta_compare' => '>=',
			'orderby'      => 'meta_value',
			'order'        => 'ASC',
			'meta_query'   => array(
				'relation' => 'OR',
				array(
					'key'     => 'hf_composer_layout_type',
					'value'   => $type,
					'compare' => '==',
					'type'    => 'post',
				),
			),
		);
	
		$args = apply_filters( 'hfe_get_template_id_args', $args );
	
		$template = new WP_Query(
			$args
		);
	
		if ( $template->have_posts() ) {
			$posts = wp_list_pluck( $template->posts, 'ID' );
			wp_cache_set( $type, $posts );
	
			return $posts;
		}
	
	}
	
	public function remove_header() {
		$header_id = array($this, 'get_template_id')($type = 'header')[0];	
		if ($header_id) {
		remove_action('munk_header', 'munk_header_above_markup', 10);
		remove_action('munk_header', 'munk_header_primary_markup', 20);
		remove_action('munk_header', 'munk_header_below_markup', 30);
		}
	}

	
	public function new_header() {
			$header_id = array($this, 'get_template_id')($type = 'header')[0];	
			if ($header_id) {
				echo \Elementor\Plugin::$instance->frontend->get_builder_content( $header_id );
			}
	}

	
	
	public function remove_footer() {
		$footer_id = array($this, 'get_template_id')($type = 'footer')[0];	
		if ($footer_id) {
		remove_action('munk_footer', 'munk_footer_markup', 10);
		}
	}

	
	public function new_footer() {
			$footer_id = array($this, 'get_template_id')($type = 'footer')[0];	
			if ($footer_id) {
				echo \Elementor\Plugin::$instance->frontend->get_builder_content( $footer_id );
			}
	}
	
}