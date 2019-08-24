<?php
/**
 * The file that registers the plugin's metabox
 *
 * @link       https://metricthemes.com
 * @since      1.0.0
 *
 * @package    Header_Footer_Composer
 * @subpackage Header_Footer_Composer/includes
 * @since      1.0.0
 * @author     MetricThemes <support@metricthemes.com>
 * 
 */
 
class Header_Footer_Composer_Meta_Box {
	
		public function hf_composer_add_meta_box() {
			add_meta_box(
				'header-footer-composer-meta-box',
				__( 'Layout Type', 'header-footer-composer' ),
				array( $this, 'hf_composer_meta_html'),
				'hf_composer',
				'normal',
				'high'
			);
		}
				
		
		public function hf_composer_meta_html( $post) {
			global $post;
			$layout_type = get_post_meta( $post->ID, 'hf_composer_layout_type', true );
			wp_nonce_field( '_hf_composer_nonce', 'hf_composer_nonce' ); ?>
		
			<div class="hfc-metabox">
				<div class="hfc-meta-label">
                <label for="hf_composer_layout_type"><?php echo esc_html( 'Choose Layout type', 'header-footer-composer' ); ?></label>
                </div>
				<div class="hfc-meta-input">                
				<select name="hf_composer_layout_type" id="hf_composer_layout_type">
					<option value="" <?php if ( $layout_type === '' ) { echo 'selected'; } ?>><?php echo esc_html('Select Layout Type', 'header-footer-composer'); ?></option>
					<option value="header" <?php if ( $layout_type === 'header' ) { echo 'selected'; } ?>><?php echo esc_html('Header', 'header-footer-composer'); ?></option>
					<option value="footer" <?php if ( $layout_type === 'footer' ) { echo 'selected'; } ?>><?php echo esc_html('Footer', 'header-footer-composer'); ?></option>
				</select>
                </div>
			</div>
			<?php
		}
		
		public function hf_composer_meta_save( $post_id ) {				
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;				
			if ( ! isset( $_POST['hf_composer_nonce'] ) || ! wp_verify_nonce( $_POST['hf_composer_nonce'], '_hf_composer_nonce' ) ) return;			
			if ( ! current_user_can( 'edit_post', $post_id ) ) return;	
		
			if ( isset( $_POST['hf_composer_layout_type'] ) )
				update_post_meta( $post_id, 'hf_composer_layout_type', esc_attr( $_POST['hf_composer_layout_type'] ) );				
		}
		
		
}		